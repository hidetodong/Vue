<template>
  <div id="loginbar">
    <div class="loginbar-inner">
      <div class="loginbar-text">
        <div class='login-img'>
          <img src="../img/cloud.jpg" alt="">
        </div>
        <div class='login-text'>
          <div class='login-input-user'>
              <span>用户名 <input type="text" value='' id='username-text' placeholder="请输入用户名"></span>
          </div>
          <div class="login-input-pass">
              <span>密  码 <input type="password" id='user-password' placeholder="请输入密码"></span>
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
      var info = '已取得用户名，值为' + '('+userinfo.name+')'
      console.log(info)
      //验证用户名合理性
      this.loginVerify();
      //vue更新数据
      this.$store.commit("updateUserInfo",userinfo);
      var sysMsg=userinfo.name + '已上线!';
      this.$store.commit("sysMsgRefresh",sysMsg);
      //发送Websocket包给PHP后台
      var wsurl = this.$store.state.webInfo.wsurl
      // console.log('已取得Websocket连接地址')
      var websock = new WebSocket(wsurl)
      console.log('已创建Websocket')
      this.$store.commit('setWs',websock)
      // 连接成功后控制台输出信息
      console.log('已保存Socket至全局变量')
      this.$store.state.sockets.ws.onopen = this.webConnectOnOpen
      console.log(this.$store.state.sockets.ws.readyState)
      console.log('已执行Socket ONOPEN函数')
      // 接收到信息时 启用回调函数
      this.$store.state.sockets.ws.onmessage = function (e) {
        var msg = JSON.parse(e.data)
        // console.log(msg.type)
        switch (msg.type){
          // 如果是握手 则发送用户名至服务器
          case 'handshake':
            var userinfo = {
            'type': 'login',
            'content': this.$store.state.localUser.name 
            }
            userinfo = JSON.stringify(userinfo)
            this.$store.state.sockets.ws.send(userinfo)
            break;
          // 如果是一般信息 则解析 并填充页面
          case 'user':
            console.log('niubia')
            break;
          case 'system':
            break;
        }
      }.bind(this)
     
    },
    webConnectOnOpen (e) {      
      this.updateLocalState()
      console.log('页面登录状态信息已更新')
      this.confirmLogin()
      console.log('切换页面')
    },
    webConnectOnOnmessage (e) {
        var msg = JSON.parse(e.data)
        // console.log(msg.type)
        switch (msg.type){
          // 如果是握手 则发送用户名至服务器
          case 'handshake':
            var userinfo = {
            'type': 'login',
            'content': this.$store.state.localUser.name 
            }
            userinfo = JSON.stringify(userinfo)
            this.$store.state.sockets.ws.send(userinfo)
            break;
          // 如果是一般信息 则解析 并填充页面
          case 'user':
            console.log('niubia')
            break;
          case 'system':
            break;
        }
        // console.log(this.$store.state.sockets.ws.readyState)
      
    },
    loginVerify () {
      if (document.getElementById('username-text').value == ''||document.getElementById('user-password').value=='')
      {
        alert('请正确输入用户名和密码！');
      }
    },
    updateLocalState () {
      this.$store.commit("updateLocalStatus","在线")
    },
    confirmLogin () {
      this.$store.commit("confirmLogin")
    }

  }
}
</script>

<style scoped>
  #loginbar{
    height: 100%;
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
    margin-top: 10%;
    text-align: center;
  }
  .login-img img{
    
    width: 30%;
  }
  .login-text{
    margin-top: 10%;
    height: 70%;
  }
  .login-input-user{
    border:1px solid;
    border-radius: 10px;
    height: 15%;
    width: 60%;
    margin-left: 20%;
    margin-top: 7%;
    font-size: 16px;
    /* box-shadow:0 0 10px #000; */
  }
  .login-input-user span{
    display: inline-block;
    margin-left: 4%;
    height: 100%;
    line-height: 100%;
  }
  .login-input-user span input{
    width: 70%;
    border: none;
    text-indent: 10px;
    border-left: 1px solid;
    height: 100%;
  }
  .login-input-pass{
    border:1px solid;
    border-radius: 10px;
    height: 15%;
    width: 60%;
    margin-left: 20%;
    margin-top: 7%;
    font-size: 16px;
    /* box-shadow:0 0 10px #000; */
  }
  /* 密码部分 */
  .login-input-pass span{
    display: inline-block;
    width: 100%;
    margin-left: 4%;
    height: 100%;
    line-height: 100%;
  }
  .login-input-pass span input{
    border: none;
    border-left: 1px solid;
    height: 100%;
    text-indent: 10px;
  }


  /* 登录按钮部分 */
  .login-input-confirm{
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
    margin-top: 5%;
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
