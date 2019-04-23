<template>
  <div id="privatetalk">
    <div class="private-wrapper">
        <p class="talk-header">
            <span class="talk-name">{{currentUser.name}}</span>
        </p>
        <div class="talk-body">
            <div class="talk-content-wrapper" v-for="x in user_msg.data">
               <p class="talk-content">{{x.name}}:{{x.content}}</p> 
            </div>
        </div>
        <div class="talk-text">
            <textarea name="" id="talk-textarea"></textarea>
            
        </div>
        <div class="talk-button">
            <div class="talk-send"><span id='talk-send-button' v-on:click="sendToUser">发 送</span></div>
            <div class="talk-send"><span id='talk-return-button' v-on:click="returnToPublic">返 回</span></div>
            
        </div>
    </div>
  </div>
</template>

<script>
// import store from './vuex/store.js';
export default {
  name: 'privatetalk',
  data () {
    return {
      user:{
          'name':'小周',
      }
    }
  },
  computed: {
        user_msg () {
            // 预定义  待修改到store
            var oppo_user_name='吴帅均';
            // var oppo_user_name=this.currentUser.name;
            var allMsg = this.$store.state.userMsgList;
            // 还需要做一重检测  当信息列表中还不存在当前的用户时 要先添加一层JSON
            var currentMsg = this.userCheck(allMsg,oppo_user_name);
            // console.log(currentMsg);
            // return this.$store.state.msglist
            var finalList = {
                'name': currentMsg[0].from,
                'data': currentMsg[0].data
            }
            return finalList;
        },
        currentUser () {
            return this.$store.state.currentUser
        }
        
    },
  methods: {
      userCheck (user_msg,oppo_user_name) {
          var list=[]
          for(var i in user_msg){
              if(user_msg[i].from == oppo_user_name){
                  list.push(user_msg[i]);
              }
              else{
                  continue;
              }
          }
          console.log(list);
        //   list=JSON.stringify(list);
          console.log(list);
          return list;
      },
      returnToPublic () {
        
      },
      sendToUser () {
          var currentUser = this.$store.state.currentUser.name;
          var user_msg = this.$store.state.userMsgList;
          var msg = document.getElementById('talk-textarea').value;
          console.log(msg);
          var localName = this.$store.state.localUser.name;
          var sendInfo = {
              'name': localName,
              'content': msg
          }
          for(var i in user_msg){
              if(user_msg[i].from==currentUser){
                  user_msg[i].data.push(sendInfo);
                  console.log(user_msg)
              }
              else{
                  continue;
              }
          }
      }
  }
}
</script>

<style scoped>
  #privatetalk{
      height: 900px;
      /* border: 1px solid; */
  }
  .private-wrapper{
      margin-left: 15%;
      margin-right: 15%;
      margin-top: 2%;
      border: 1px solid;
      border-radius: 10px;
      height: 80%;
      
  }
  .private-wrapper hr{
      height: 2px;
      border-bottom: 1px solid;
      display: inline-block;
      margin-left: 5%;
      margin-right: 5%;
  }
  .talk-header{
      height: 5%;
  }
  .talk-name{
      font-size: 18px;
      margin-left: 10%;
      margin-right: 10%;
      padding-bottom: 3px;
      border-bottom: 1px solid;
      display: block;
      margin-top: 3%;
  }
  .talk-body{
      margin-top: 1%;
      margin-left: 10%;
      margin-right: 10%;
      height: 50%;
      border: 1px solid;
      border-radius: 10px;
  }
  .talk-text{
      overflow: hidden;
      margin-top: 1%;
      margin-left: 10%;
      margin-right: 10%;
      height: 20%;
      border-radius: 10px;
      border: 1px solid;
  }
  .talk-button{
      margin-left: 10%;
      margin-right: 10%;
      height: 8%;
      /* border: 1px solid; */
      margin-top: 1%;
  }
  #talk-textarea{
      width: 100%;
      height: 100%;
      resize: none;
      border: none;
      padding: 3% 3%;
  }
  .talk-send{
      -webkit-user-select: none;
      display: inline-block;
      margin-left: 5%;
      margin-top: 0.5%;
      border: 1px solid;
      border-radius: 5px;
      padding:1% 3%;
      color: aliceblue;
      background-color: #5bc0de;
      border-color: #46b8da;
  }
  .talk-content{
      border: 1px solid;
      border-radius: 5px;
      /* margin-top: 2%; */
      margin-left: 5%;
      display: inline-block;
      padding: 5px 10px;
  }
  .talk-content-wrapper{
    overflow: scroll;
    /* border: 1px solid; */
    padding-bottom: 5px;
    padding-top: 5px;
     /* background-color: #5bc0de; */

  }
</style>
