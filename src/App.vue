<template>
  <div id="app">
    <!-- <input type="button" value="切换" v-on:click="turned()"> -->
    <titlebar></titlebar>
    <div class='bodycontainer' v-if="isLogin">
     <bodybar></bodybar>
    </div>
    <div class='bodycontainer' v-else>
      <loginbar v-on:ConfirmLogin="turned($event)"></loginbar>
      
    </div>
  </div>
</template>

<script>
// import {WebTool,newss} from './js/connect-util.js'
import store from './vuex/store.js';
export default {
  name: 'App',
  data () {
    return {
      isLogin:false
    }
  },
  //引入全局变量store
  store,
  methods:{
    // created () {
    //   this.initWebsocket;
    // },
    //页面点击逻辑 
    turned (isLogin) {
      this.isLogin = isLogin;
      this.initWebsocket();
    },
    //WebSocket连接控制
    initWebsocket () {
      const wsurl = "ws://127.0.0.1:8085";//这个地址由后端提供
      this.websock = new WebSocket(wsurl);
      this.websock.onmessage = this.websocketonmessage;
      this.websock.onopen = this.websocketonopen;
      this.websock.onerror = this.websocketonerror;
      this.websock.onclose = this.websocketclose;
    },
    websocketonmessage (e) {
        var msg = JSON.parse(e.data);
        var sender,user_name,name_list,change_type;
        switch (msg.type) {
          case 'system':
            sender = '系统消息：';
            break;
          case 'user':
            sender = msg.from + ': ';
            break;
          case 'handshake':
                var user_info = {'type': 'login', 'content': 'sss'};
                // sendMsg(user_info);
                return;
            case 'login':
            case 'logout':
                user_name = msg.content;
                name_list = msg.user_list;
                change_type = msg.type;
                dealUser(user_name, change_type, name_list);
                return;
        }
    },
    websocketonopen () {
      console.log('连接成功');
      // var sysStr='连接成功！'+this.$store.state.localUser.name+'已上线';
      this.$store.state.systemMsg='连接成功！'+this.$store.state.localUser.name+'已上线';
      // setTimeout(1000);
      // this.sysMsgRefresh(sysStr);
      console.log(this.$store.state.systemMsg);

    },
    websocketonerror () {

    },
    websocketclose () {

    },
    //Websocket信息处理


    //页面其他逻辑 暂缺
    sendMsg (userinfo) {

    },
    dealUser () {
      
    },
    listMsg () {
      
    },
    sysMsgRefresh(str){
      this.$store.commit("sysMsgRefresh",str);
    }
  }
  
}
</script>

<style scoped>
  #app{
    border:1px solid #111;
    width: 100%;
    height: 1000px;
    /* background-color: rgb(205, 207, 219); */
  }
  .bodycontainer{
    height: 100%;
  }
</style>
