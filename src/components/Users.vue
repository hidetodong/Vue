<template>
  <div id="users">
    <div class="users-inner"  v-for="x in users">
      <h1>
        <div class="p-name">{{x.username}}</div> | <div class="p-button">发送消息</div>
        <div class="p-button"> 传送文件</div>
      </h1>
    </div>
  </div>
</template>

<script>

export default {
  name: 'users',
  data () {
    return {
        users:[
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'},
          {username:'吴帅均傻逼'}
        ]
    }
  }
}
</script>

<style scoped>
  #users{
    height: 93%;
    width: 100%;
    overflow-y:scroll;
    overflow-x:hidden;
    vertical-align: center;
  }
  /* #users p{
    width: 100%;
    height: 100px;
    vertical-align: middle;
    border: 2px solid rgb(96, 129, 249);
  } */
  #users h1{
    font-size: 14px;
    width: 94%;
    padding-left: 5%;
    display: inline-block;
    border: 1px solid;
    border-radius: 12px;
    height: 40px;
    line-height: 40px;
    vertical-align: center;
  }
  .p-name{
    display: inline-block;
    width: 35%;
    /* overflow: hidden;   */
    height: 100%;
    /* border: 1px solid; */
    text-align: center;
    }

  .p-button{
    display: inline-block;
    width: 25%;
    border: 1px solid;
    border-radius: 10px;
    text-align: center;
    
  }
  .p-button:hover{
    background-color: rgb(58, 56, 56);
    /* 此处要增加文字不可选中 */
  }
  #users h1 span:hover{
    color: blue;
    font-size: 14px;
  }
  #users h1 input{
     font-size: 12px;
     width: 25%;
     border-radius: 10px;
     height: 70%;
     border: 1px solid rgb(161, 126, 199);
     background-color:#FFFFFF;
  }
  #users h1 input:active{
     width: 25%;
     border-radius: 10px;
     border: 1px solid rgb(161, 126, 199);
     background-color: blueviolet;
  }
  #users h1 input:hover{
     
     width: 25%;
     border-radius: 10px;
     border: 1px solid rgb(161, 126, 199);
     background-color:rgb(87, 87, 87);
  }

  .users-inner{
    margin-top: 3%;
    display: inline-block;
    width: 100%;
    height: 40px;
  }
</style>
