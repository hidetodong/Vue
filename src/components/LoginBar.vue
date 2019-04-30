<template>
  <div id="loginbar">
    <div class="loginbar-inner">
      <div class="loginbar-text">
        <div class='login-img'>
          <span><img src="../img/cloud.jpg" alt=""></span>
        </div>
        <div class='login-text'>
          <p class="login-user-tag">用户名</p>
          <div class='login-input-user'>
              <input type="text" value='' id='username-text' placeholder="请输入用户名">
          </div>
          <p class='login-user-tag'>密码</p>
          <div class="login-input-pass">
              <input type="password" id='user-password' placeholder="请输入密码">
          </div>

            <div class="login-button-bar">
              <div class="login-input-confirm" v-on:click="updateUserInfo()">
                <span>登 录</span>
              </div>
              <div class="login-input-register">
                <span>注 册</span>
              </div>
            </div>
            <div class="login-bottom">
              <span><a href="">联系我们</a> / <a href="">忘记密码</a></span>
            </div>
        </div>
        
      </div>
    </div> 
      
  </div>
</template>

<script>

export default {
  name: 'loginbar',
  props:[],
  data () {
    return {
      isLogin:false
    }
  },
  methods:{
    // loginConfirm:function(){
    //   var uname = document.getElementById('username-text').value;
    //   var upass = document.getElementById('user-password').value;
    //   // console.log('用户名为'+str.value);
    //   if(uname=='sss'){
    //      this.$emit('ConfirmLogin',true);
         
    //   }
    //   else{
    //      this.$emit('ConfirmLogin',false);

    //   }
    // },
    updateUserInfo () {
      //新选项之后补充
      //取得数据
      var userinfo = {
        'name':document.getElementById('username-text').value,
        'password':document.getElementById('user-password').value
      }
      //验证用户名合理性
      this.loginVerify();
      //vue更新数据
      
      this.$store.commit("updateUserInfo",userinfo);
      //发送Websocket包给PHP后台
      var wsurl = this.$store.state.webInfo.wsurl
      // console.log('已取得Websocket连接地址')
      var websock = new WebSocket(wsurl)
      // console.log('已创建Websocket')
      this.$store.commit('setWs',websock)
      // 连接成功后控制台输出信息
      // console.log('已保存Socket至全局变量')
      this.$store.state.sockets.ws.onopen = this.webConnectOnOpen
      // 更新系统消息
      // console.log(this.$store.state.sockets.ws.readyState)
      // console.log('已执行Socket ONOPEN函数')
      // 接收到信息时 启用回调函数
      this.$store.state.sockets.ws.onmessage = function (e) {
        var msg = JSON.parse(e.data) 
        // console.log(msg.type)
        switch (msg.type){
          // 如果是握手 则发送用户名至服务器
          case 'handshake':
            this.handshakeInfo();
            break;
          // 如果是一般信息 则解析 并填充页面
          case 'user':
            // 解析从服务器发送来的消息 并且填充到页面
            this.diaboxAdd(msg);
            // 更新用户列表
            // this.userListReset(msg);
            break;
          // 系统信息 则更新系统消息栏
          case 'system':
            // 更新系统消息
            this.sysMsgReset(msg);
            // // 更新用户列表
            // this.userListReset(msg);          
            break;
          case 'userinfo':
            this.userListReset(msg);          
            break;
          case 'login':
            break;
          case 'logout':
            break;
          
        }
      }.bind(this)
      // 关闭连接操作
      this.$store.state.sockets.ws.onclose = function (e) {
        // 发送系统消息
        var sysMsg = this.$store.state.localUser.name + '已下线';
        var msg = {
          'type': 'logout',
          'content': sysMsg
        }
        this.$store.state.sockets.ws.send(msg);

      }.bind(this)
      
    },
    
    webConnectOnOpen (e) {      
      // 打开连接时 更新本地用户状态
      this.updateLocalState()
      // 转换页面
      this.confirmLogin()
      // 更新系统消息
      this.sysMsgLogin()
      
    },
    loginVerify () {
      // 页面确认逻辑，
      if (document.getElementById('username-text').value == ''||document.getElementById('user-password').value=='')
      {
        alert('请正确输入用户名和密码！');
      }
    },
    // 更新在线状态
    updateLocalState () {
      
      this.$store.commit("updateLocalStatus","在线")
    },
     // 确认登录 切换页面
    confirmLogin () {
     
      this.$store.commit("confirmLogin")
    },
    // 登录系统信息上传发送至服务器
    sysMsgLogin () {
      var userinfo = {
        'name':document.getElementById('username-text').value,
        'password':document.getElementById('user-password').value
      }
      var sysMsg=userinfo.name + '已上线!';
      var sys_send = {
        'type': 'system',
        'content': sysMsg
      }
      sys_send = JSON.stringify(sys_send)
      // this.$store.commit("sysMsgRefresh",sysMsg);
      this.$store.state.sockets.ws.send(sys_send) 
    },
    // 根据实际需求修改 重置系统信息
    sysMsgReset (msg) {
      var sysMsg = {
              'message': msg.content
            }
      this.$store.commit('sysMsgRefresh',sysMsg)
    },
    // 添加公共聊天信息
    diaboxAdd (msg) {
      var msg_con = {
              'name': msg.from,
              'content': msg.content
            }
      this.$store.commit('addMsg',msg_con)
    },
    // 刷新在线用户列表
    userListReset (msg) {
      var user_list = msg.data
      var localList = [];
      var localName = this.$store.state.localUser.name
      for(var i in user_list){
        if(user_list[i].uname==null||user_list[i].uname==localName){
          continue;
        }
        else{
          localList.push(user_list[i]);
        }
        
      }
      this.$store.commit('resetUserList',localList)
      // 设置用户列表为空
      if(localList.length == 0){
        this.$store.commit('setEmptyTrue');
      }
      else{
        this.$store.commit('setEmptyFalse');
      }
      // console.log('1')
      console.log(localList)
      // console.log(user_list)
    },
    handshakeInfo () {
      var userinfo = {
            'type': 'login',
            'content': this.$store.state.localUser.name 
            }
            userinfo = JSON.stringify(userinfo)
            this.$store.state.sockets.ws.send(userinfo)
    }
  }
}
</script>

<style scoped>
  #loginbar{
    height: 1000px;
  }
  .loginbar-inner{
      margin:0.5% 0% 10% 0%;
      display: inline-block;
      border: 1px solid;
      width: 100%;
      height: 100%;
  }
  .loginbar-text{
    margin-left: 35%;
    border: 1px solid;
    border-radius: 20px;
    height: 60%;
    width: 30%;
    margin-top: 3%;
    box-shadow:0 0 10px #000;
  }
  .login-img{
    margin-top: 8%;
    text-align: center;
  }
  .login-img img{
    width: 30%;
  }
  .login-text{
    margin-top: 10%;
    height: 70%;
  }
   /* 用户名部分 */
   .login-user-tag{
     font-size: 16px;
     font-family: 'Microsoft YaHei';
     /* border: 1px solid; */
     margin-left: 20%;
     margin-right: 20%;
     padding-top: 10px;
     padding-left:5px;
     padding-bottom: 5px;
   }
  #username-text{
    font-family: 'Microsoft YaHei';
    margin-top: 1%;
    margin-left: 5%;
    margin-right: 1%;
    height: 90%;
  }
  .login-input-user{
    border:1px solid;
    border-radius: 10px;
    height: 15%;
    width: 60%;
    margin-left: 20%;
    /* margin-top: 7%; */
    font-size: 16px;
    /* box-shadow:0 0 10px #000; */
  }
  
  .login-input-user span{
    display: inline-block;
    margin-left: 4%;
    height: 100%;
    line-height: 100%;
  }
  .login-input-user input{
    border: none;
    text-indent: 10px;
    /* border-left: 1px solid; */
    height: 100%;
  }
  .login-input-pass{
    border:1px solid;
    border-radius: 10px;
    height: 15%;
    width: 60%;
    margin-left: 20%;
    /* margin-top: 7%; */
    font-size: 16px;
    /* box-shadow:0 0 10px #000; */
  }
  /* 密码部分 */
  #user-password{
    font-family: 'Microsoft YaHei';
    margin-top: 1%;
    margin-left: 5%;
    margin-right: 1%;
    height: 90%;
  
  }
  .login-input-pass span{
    display: inline-block;
    width: 100%;
    margin-left: 4%;
    height: 100%;
    line-height: 100%;
  }
  .login-input-pass  input{
    border: none;
    height: 100%;
    text-indent: 10px;
  }


  /* 登录按钮部分 */
  .login-input-confirm{
    font-family: 'Microsoft YaHei';
    border:1px solid;
    border-radius: 10px;
    height: 8%;
    width: 25%;
    margin-top: 10%;
    margin-left: 22%;
    display: inline-block;
    font-size: 20px;
    text-align: center;
    box-shadow:0 0 3px #000;
  }
  .login-input-confirm:hover{
    
    border:1px solid;
    border-radius: 10px;
    height: 8%;
    width: 25%;
    margin-top: 10%;
    margin-left: 22%;
    display: inline-block;
    font-size: 20px;
    text-align: center;
    background-color:rgb(126, 181, 243);

  }

  .login-input-confirm span{
    display: inline-block;
    margin-top: 15%;
    margin-bottom: 15%;
    -webkit-user-select:none;
    
  }
  /* 取消按钮部分 */
  .login-input-register{
    font-family: 'Microsoft YaHei';
    border:1px solid;
    border-radius: 10px;
    height: 8%;
    width: 25%;
    margin-top:10%;
    margin-left: 5%;
    display: inline-block;
    font-size: 20px;
    text-align: center;
    box-shadow:0 0 3px #000;
  }
  .login-input-register:hover{
    border:1px solid;
    border-radius: 10px;
    height: 8%;
    width: 25%;
    margin-top:10%;
    margin-left: 5%;
    display: inline-block;
    font-size: 20px;
    text-align: center;
    background-color:rgb(126, 181, 243);
  }
  .login-button-bar{
    margin-top: 10px;
  }
  .login-input-register span{
    display: inline-block;
    padding-top:0%;
    margin-top: 15%;
    margin-bottom: 15%;
    -webkit-user-select:none;
    
  } 
  .login-bottom{
    margin-top: 15%;
    text-align: center;
    
  }
  .login-bottom a{
    color: #434546;
    text-decoration: none;
  }
  .login-bottom a:hover{
    color: rgb(126, 181, 243);
  }
</style>
