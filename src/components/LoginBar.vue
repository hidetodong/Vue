<template>
  <div id="loginbar">
    <div class="loginbar-inner">
      <div class="loginbar-text">
        <div class='login-img'>
          <img src="../img/cloud.jpg" alt="">
        </div>
        <div class='login-text'>
          <div class='login-input-user'>
              <span>用户名 <input type="text" value='sss' id='username-text'></span>
          </div>
          <div class="login-input-pass">
              <span>密  码 <input type="password" id='user-password'></span>
          </div>
            <div class="login-button-bar">
              <div class="login-input-confirm" v-on:click="loginConfirm()">
                <span>登 录</span>
              </div>
              <div class="login-input-register">
                <span>注 册</span>
              </div>
            </div>
            <div class="login-bottom">
              <span><a href="">联系我们{{name}}</a> / <a href="">忘记密码</a></span>
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
      isLogin:false,
      name:'Mazii'
    }
  },
  methods:{
    loginConfirm:function(){
      var uname = document.getElementById('username-text').value;
      var upass = document.getElementById('user-password').value;
      // console.log('用户名为'+str.value);
      if(uname=='sss'){
         this.$emit('ConfirmLogin',true);
         
      }
      else{
         this.$emit('ConfirmLogin',false);

      }
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
