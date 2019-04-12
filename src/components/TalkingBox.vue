<template>
  <div id='talksbox'>
      <div class="talk-inner">
        <diabox></diabox>
      </div>
      <div class="talk-input">
        <div class="talk-text">
          <textarea  name="" id="text-content" cols="30" rows="10"></textarea>
        </div>
        <div class="talk-button">
          <div class="talk-send-button" v-on:click="sendMsg">发送</div>
          <div class="talk-reset-button" v-on:click="resetMsgContent">清空聊天窗</div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'talksbox',
  data () {
    return {
      
    }
  },
  methods: {
    sendMsg () {
      // send()
      var uname = this.$store.state.localUser.name
      var str = document.getElementById('text-content').value
      var msg_info_add = {
        'name': uname,
        'content' : str,
        'type': 'user'
      }
      this.$store.commit("addMsg",msg_info_add)
      this.WebCon.ws.send(msg_info_add);
      document.getElementById('text-content').value=''
      
    },
    resetMsgContent () {
      this.$store.commit("resetMsg")
    }
  }
  
}
</script>

<style scoped>
  #talksbox{
      width: 100%;
      height: 100%;
      /* background-color: blue; */
      border: 1px solid;
      /* background-color: azure; */
      
  }
  .talk-inner{
    height: 60%;
    margin-left: 1%;
    margin-right: 1%;
    margin-top: 1%;
    border: 1px solid;
    overflow-y: scroll;
  }
  .talk-input{
    height: 30%;
    margin-left: 1%;
    margin-top: 1%;
    margin-right: 1%;
    border: 1px solid;
  }
  .talk-text{
    border: 1px solid;
    height: 80%;
    margin-left: 0.5%;
    margin-right: 0.5%;
    margin-top: 0.5%;
  }
  .talk-text textarea{
    height: 100%;
    width: 100%;
    resize: none;
  }
  .talk-text textarea:active{
    box-shadow:0 0 10px rgb(137, 20, 233) inset;
  }
  .talk-button{
    height: 10%;
    margin-top: 0.5%;
    margin-left: 0.5%;
    margin-right: 0.5%;
    /* border: 1px solid; */
  }
  .talk-send-button{
    display: inline-block;
    height: 100%;
    width: 10%;
    border-radius: 10px;
    border: 1px solid;
    text-align: center;
    line-height: 100%;
    vertical-align: center;
    font-size: 20px;
    text-shadow: 2px;
  }
  .talk-send-button:hover{
    background-color: #c0c0c0;

  }
  .talk-reset-button{
    display: inline-block;

    height: 100%;
    width: 10%;
    border-radius: 10px;
    border: 1px solid;
    text-align: center;
    line-height: 100%;
    vertical-align: center;
    font-size: 20px;
    text-shadow: 2px;
  }
  .talk-reset-button:hover{
    background-color: #c0c0c0;

  }
</style>
