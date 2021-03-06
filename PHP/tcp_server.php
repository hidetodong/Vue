<?php
//初始设置
error_reporting(E_ALL);
set_time_limit(0);// 设置超时时间为无限,防止超时
//date_default_timezone_set('Asia/shanghai');

class WebSocket {
    // 设置日志路径
    const LOG_PATH = '';
    // 设置最大连接数
    const LISTEN_SOCKET_NUM = 9;
    /**
     * @var array $sockets
     *    [
     *      (int)$socket => [
     *                        info
     *                      ]
     *      ]
     *  todo 解释socket与file号对应
     */
    private $sockets = [];
    private $user_info = [];
    private $master;
    public function __construct($host, $port) {
        try {
            //创建SOCKET
            $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            // 设置IP和端口重用,在重启服务器后能重新使用此端口;
            socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1);
            // 将IP和端口绑定在服务器socket上;
            socket_bind($this->master, $host, $port);
            // listen函数使用主动连接套接口变为被连接套接口，
            // 使得一个进程可以接受其它进程的请求，从而成为一个服务器进程。
            // 在TCP服务器编程中listen函数把进程变为一个服务器，
            // 并指定相应的套接字变为被动连接,其中的能存储的请求不明的socket数目。
            socket_listen($this->master, self::LISTEN_SOCKET_NUM);
        } catch (\Exception $e) {
            $err_code = socket_last_error();
            $err_msg = socket_strerror($err_code);
            $this->error([
                'error_init_server',
                $err_code,
                $err_msg
            ]);
        }
        $this->sockets[0] = ['resource' => $this->master];
        //$pid = posix_getpid(); linux环境下使用
        //获取当前用户的PID
        $pid = get_current_user();
        //输出Debug信息
        $this->debug(["server: {$this->master} started,pid: {$pid}"]);
        while (true) {
            try {
                $this->doServer();
                print_r($this->sockets) ;
            }
            catch (\Exception $e){
                $this->error([
                    'error_do_server',
                    $e->getCode(),
                    $e->getMessage()
                ]);
            };
        }
    }
    private function doServer() {
        $write = $except = NULL;
        $sockets = array_column($this->sockets, 'resource');
        $read_num = socket_select($sockets, $write, $except, NULL);
        // select作为监视函数,参数分别是(监视可读,可写,异常,超时时间),返回可操作数目,出错时返回false;
        if (false === $read_num) {
            $this->error([
                'error_select',
                $err_code = socket_last_error(),
                socket_strerror($err_code)
            ]);
            return;
        }
        foreach ($sockets as $socket) {
            // 如果可读的是服务器socket,则处理连接逻辑
            if ($socket == $this->master) {
                $client = socket_accept($this->master);
                //echo $client;
                // 创建,绑定,监听后accept函数将会接受socket要来的连接,一旦有一个连接成功,
                // 将会返回一个新的socket资源用以交互,如果是一个多个连接的队列,只会处理第一个,
                // 如果没有连接的话,进程将会被阻塞,直到连接上.如果用set_socket_blocking或socket_set_noblock()
                // 设置了阻塞,会返回false;返回资源后,将会持续等待连接。
                if (false === $client) {
                    $this->error([
                        'err_accept',
                        $err_code = socket_last_error(),
                        socket_strerror($err_code)
                    ]);
                    continue;
                } else {
                    self::connect($client);
                    continue;
                }
            } else {
                // 如果可读的是其他已连接socket,则读取其数据,并处理应答逻辑
                // 函数前加@ 表示错误信息控制 不输出
                $bytes = @socket_recv($socket, $buffer, 4096, 0);
                // 长度小于9 断开连接
                if ($bytes < 9) { 
                    $recv_msg = $this->disconnect($socket);
                } else {
                    if (!$this->sockets[(int)$socket]['handshake']) {
                        self::handShake($socket, $buffer);
                        continue;
                    } else {
                        $recv_msg = self::parse($buffer);

                    }
                }
                array_unshift($recv_msg, 'receive_msg');
                // 如果是点对点信息 就私发给指定用户 如果是其他类型 就进行广播
                if($recv_msg['type']=='usermsg'){
                    // 私发消息
                    self::sendToUser($recv_msg);
                }
                else{
                    // 组装需要发送的消息
                    $msg = self::dealMsg($socket, $recv_msg);
                    // 广播接收的消息
                    $this->broadcast($msg);
                }
                // 更新用户列表
                $this->refreshUserlist($this->sockets);
            }
        }
    }
    public function sendToUser($recv_msg){
        $sendmsg['ip']=$recv_msg['ip'];
        $sendmsg['port']=$recv_msg['port'];
        $sendmsg['content']=$recv_msg['data'];
    }

    /**
     * 发送最新的用户列表信息至客户端
     * @param $socket
     *
     */
    public function refreshUserlist($sockets){
        $userinfo_list = [];
        $socketsIndex = array_column($sockets, 'resource');
        $userinfo_list['type']='userinfo';
        $userinfo_list['from']='Server';
        // 遍历服务器上已存储的所有已连接的Socket的客户端信息 并取出用户名 IP 和PORT
        foreach ($socketsIndex as $socket){
            if ($socket['resource'] == $this->master) {
                continue;
            }
            $userinfo_list['data'][(int)$socket]['uname']=$sockets[(int)$socket]['uname'];
            $userinfo_list['data'][(int)$socket]['ip']=$sockets[(int)$socket]['ip'];
            $userinfo_list['data'][(int)$socket]['port']=$sockets[(int)$socket]['port'];
        }
        print_r($userinfo_list);
        $userList =$this->build(json_encode($userinfo_list));
        $this->broadcast($userList);

    }
    /**
     * 将socket添加到已连接列表,但握手状态留空;
     *
     * @param $socket
     */
    public function connect($socket) {
        socket_getpeername($socket, $ip, $port);
        $socket_info = [
            'resource' => $socket,
            'uname' => '',
            'handshake' => false,
            'ip' => $ip,
            'port' => $port,
        ];
        $this->sockets[(int)$socket] = $socket_info;
        $this->debug(array_merge(['socket_connect'], $socket_info));
    }
    /**
     * 客户端关闭连接
     *
     * @param $socket
     *
     * @return array
     */
    private function disconnect($socket) {
        $recv_msg = [
            'type' => 'logout',
            'content' => $this->sockets[(int)$socket]['uname'],
        ];
        unset($this->sockets[(int)$socket]);
        return $recv_msg;
    }
    /**
     * 用公共握手算法握手
     *
     * @param $socket
     * @param $buffer
     * @return bool
     */
    public function handShake($socket, $buffer) {
        // 获取到客户端的升级密匙
        $line_with_key = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
        $key = trim(substr($line_with_key, 0, strpos($line_with_key, "\r\n")));
        // 生成升级密匙,并拼接websocket升级头
        $upgrade_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));// 升级key的算法
        $upgrade_message = "HTTP/1.1 101 Switching Protocols\r\n";
        $upgrade_message .= "Upgrade: websocket\r\n";
        $upgrade_message .= "Sec-WebSocket-Version: 13\r\n";
        $upgrade_message .= "Connection: Upgrade\r\n";
        $upgrade_message .= "Sec-WebSocket-Accept:" . $upgrade_key . "\r\n\r\n";
        socket_write($socket, $upgrade_message, strlen($upgrade_message));// 向socket里写入升级信息
        $this->sockets[(int)$socket]['handshake'] = true;
        socket_getpeername($socket, $ip, $port);
        $this->debug([
            'hand_shake',
            $socket,
            $ip,
            $port
        ]);
        // 向客户端发送握手成功消息,以触发客户端发送用户名动作;
        $msg = [
            'type' => 'handshake',
            'content' => 'done',
        ];
        $msg = $this->build(json_encode($msg));
        socket_write($socket, $msg, strlen($msg));
        return true;
    }
    /**
     * 解析数据
     *
     * @param $buffer
     *
     * @return bool|string
     */
    private function parse($buffer) {
        $decoded = '';
        $len = ord($buffer[1]) & 127;
        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        } else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return json_decode($decoded, true);
    }
    /**
     * 将普通信息组装成websocket数据帧
     *
     * @param $msg
     *
     * @return string
     */
    private function build($msg) {
        $frame = [];
        $frame[0] = '81';
        $len = strlen($msg);
        if ($len < 126) {
            $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
        } else if ($len < 65025) {
            $s = dechex($len);
            $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
        } else {
            $s = dechex($len);
            $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
        }
        $data = '';
        $l = strlen($msg);
        for ($i = 0; $i < $l; $i++) {
            $data .= dechex(ord($msg{$i}));
        }
        $frame[2] = $data;
        $data = implode('', $frame);
        return pack("H*", $data);
    }
    /**
     * 拼装信息
     *
     * @param $socket
     * @param $recv_msg
     *          [
     *          'type'=>user/login
     *          'content'=>content
     *          ]
     *
     * @return string
     */
    private function dealMsg($socket, $recv_msg) {
//      $msg_user_list=self::refreshUserlist($this->sockets);
        $msg_type = $recv_msg['type'];
        $msg_content = $recv_msg['content'];
        $msg_ip = $this->sockets[(int)$socket]['ip'];
        $msg_port =$this->sockets[(int)$socket]['port'];
        $response = [];
        switch ($msg_type) {
            case 'login':
                $this->sockets[(int)$socket]['uname'] = $msg_content;
                // 取得最新的名字记录
                $user_list = array_column($this->sockets, 'uname');
                $response['type'] = 'login';
                $response['content'] = $msg_content;
                $response['user_list'] = $user_list;
                break;
            case 'logout':
                // 去除已注销的用户
                $this->disconnect($socket);
                echo '注销完毕';
                break;
            case 'user':
                $uname = $this->sockets[(int)$socket]['uname'];
                $response['type'] = 'user';
                $response['from'] = $uname;
                $response['content'] = $msg_content;
                $response['ip'] = $msg_ip;
                $response['port'] = $msg_port;
                break;
            case 'system':
                $response['type'] = 'system';
                $response['from'] = 'Server';
                $response['content']= $msg_content;
                echo $response;

                break;
        }
        return $this->build(json_encode($response));
    }
    private function sendUserInfo($sockets){
//        foreach() {
//
//        }
    }
    /**
     * 广播消息
     *
     * @param $data
     */
    //广播收到的信息
    // 修改
    private function broadcast($data) {
        foreach ($this->sockets as $socket) {
            if ($socket['resource'] == $this->master) {
                continue;
            }
            socket_write($socket['resource'], $data, strlen($data));
        }
    }
    /**
     * 记录debug信息
     *
     * @param array $info
     */
    private function debug(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);
        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_debug.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }
    /**
     * 记录错误信息
     *
     * @param array $info
     */
    private function error(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);
        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_error.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }
}
$ws = new WebSocket("127.0.0.1", "8085");