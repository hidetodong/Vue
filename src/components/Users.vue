<template>
  <div id="users">
    <div class="users-inner"  v-for="x in users">
      <h1>
        <span>{{x.username}}</span>  |  <input value="发送消息" type="button">
        <input value="传送文件" type="button">
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
          {username:'邢滋东'},
          {username:'肖睿1'},
          {username:'肖睿2'},
          {username:'肖睿3'},
          {username:'肖睿4'},
          {username:'肖睿5'},
          {username:'肖睿6'},
          {username:'肖睿7'},
          {username:'肖睿8'},
          {username:'肖睿9'},
          {username:'肖睿10'}
        ]
    }
  }
}
</script>

<style scoped>
  #users{
    height: 100%;
    width: 90%;
    vertical-align: middle;
  }
  #users p{
    width: 100%;
    height: 100px;
    vertical-align: middle;
    border: 2px solid rgb(96, 129, 249);
  }
  #users h1{
    font-size: 14px;
    width: 100%;
    padding-left: 5%;
    display: inline-block;
    border: 1px solid;
    border-radius: 12px;
    height: 40px;
    line-height: 40px;
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
     background-color: rgb(213, 176, 215, 0.08);
  }
  #users h1 input:active{
     width: 25%;
     border-radius: 10px;
     border: 1px solid rgb(161, 126, 199);
     background-color: rgba(107, 107, 107, 0.81);
  }
  .users-inner{
    margin-top: 3%;
    display: inline-block;
    width: 100%;
    height: 40px;
  }
</style>
