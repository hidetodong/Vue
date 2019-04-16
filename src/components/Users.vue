<template>
  <div id="users">
    <div class='local-user-inner'><h1>当前用户:{{localUser.name}} | 状态： {{localUser.status}}</h1></div>
    <hr class="divide-line">
    <div class="users-inner"  v-for="x in users">
      <h1>
        <div class="p-name">{{x.name}}</div><div class="p-button">发送消息</div>
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
        users:this.$store.state.user
    }
  },
  computed: {
    localUser () {
      return this.$store.state.localUser
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
    text-align: center;
    border: 1px solid;
    border-radius: 12px;
    height: 40px;
    line-height: 40px; 
    /* vertical-align: bottom; */
  }
  .p-name{
    display: inline-block;
    width: 35%;
    overflow: hidden;  
    height: 100%;
    /* border: 1px solid; */
    text-align: center;
    vertical-align: bottom;
    -webkit-user-select:none; 
    }

  .p-button{
    padding-top: 5%;
    display: inline-block;
    /* vertical-align: bottom; */
    width: 25%;
    border: 1px solid;
    border-radius: 10px;
    height: 50%;
    line-height: 50%;
    padding-left: 2%;
    padding-right: 2%;
    -webkit-user-select:none; 
  }
  .p-button:hover{
    background-color: #c0c0c0;
    /* 此处要增加文字不可选中 */
    -webkit-user-select:none; 
  }
  .local-user-inner{
    height: 40px;
    border-radius: 10px;
    /* border:1px solid; */
    -webkit-user-select:none; 
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
  .divide-line{
    margin-top: 3%;
    margin-left: 10%;
    width: 80%;
    border-bottom: 1px solid #111111;
  }
</style>
