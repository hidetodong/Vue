<template>
  <div id="app">
    <!-- <input type="button" value="切换" v-on:click="turned()"> -->
    <titlebar></titlebar>
    <div class='bodycontainer' v-if="isLogin == true">
      <bodybar></bodybar>
    </div>
    <div class='bodycontainer' v-else>
      <loginbar></loginbar>
    </div>
  </div>
</template>

<script>
// import {WebTool,newss} from './js/connect-util.js'
import store from './vuex/store.js';
// import func from '../vue-temp/vue-editor-bridge';
export default {
  name: 'App',
  data () {
    return {
      
    }
  },
  computed: {
            isLogin () {
                return this.$store.state.pageState.isLogin
            }

        },
  //引入全局变量store
  store,
  methods: {
    initWs () {
      // var websock = new WebSocket(this.$store.state.webInfo.wsurl)
      this.$store.commit('setWs',websock) 
      this.$store.state.sockets.ws.onmessage = function (e) {
        var msg = JSON.parse(e.data)
        console.log(msg.type)
        if (msg.type == 'handshake'){
        console.log(this.$store.state.sockets.ws.readyState)
        var userinfo = {
          'type': 'login',
          'content': this.$store.state.localUser.name 
        }
        userinfo = JSON.stringify(userinfo)
        this.$store.state.sockets.ws.send(userinfo)
        }
      }.bind(this)
    },
    
    // created () {
    //   this.initWebsocket;
    // },
    //页面点击逻辑 
    //WebSocket连接控制
    // initWebsocket () {

    //   const wsurl = "ws://127.0.0.1:8085";//这个地址由后端提供
    //   this.websock = new WebSocket(wsurl);
    //   // 保存进全局WEBSOCKET变量内
    //   this.WebCon.setWs(this.websock);
    //   this.websock.onmessage = this.websocketonmessage;
    //   this.websock.onopen = this.websocketonopen;
    //   this.websock.onerror = this.websocketonerror;
    //   this.websock.onclose = this.websocketclose;
    //   console.log('连接成功！')
    // },
    websocketonmessage (e) {
      console.log('12314');
        // var msg = JSON.parse(e.data);
        // var sender,user_name,name_list,change_type;
        // switch (msg.type) {
        //   case 'system':
        //     sender = '系统消息：';
        //     break;
        //   case 'user':
        //     sender = msg.from + ': ';
        //     break;
        //   case 'handshake':
        //     var user_info = {'type': 'login', 'content': 'sss'};
        //     // sendMsg(user_info);
        //     return;
        //   case 'login':
        //   case 'logout':
        //     user_name = msg.content;
        //     name_list = msg.user_list;
        //     change_type = msg.type;
        //     dealUser(user_name, change_type, name_list);
        //     return;
        this.$store.state.sockets.ws.onmessage = function (e) {
        var msg = JSON.parse(e.data)
        console.log(msg.type)
        if (msg.type == 'handshake'){
        console.log(this.$store.state.sockets.ws.readyState)
        var userinfo = {
          'type': 'login',
          'content': this.$store.state.localUser.name 
          }
        userinfo = JSON.stringify(userinfo)
        this.$store.state.sockets.ws.send(userinfo)
         }
         }.bind(this)
        }
    },
    websocketonopen () {
    

    },
    websocketonerror () {

    },
    websocketclose () {

    },
    //Websocket信息处理


    
    sendMsg (userinfo) {

    },
    dealUser () {
      
    },
    listMsg () {
      
    }
}

</script>

<style scoped>
  #app{
    border:1px solid #111;
    width: 100%;
    height: 1800px;
    /* background-color: rgb(205, 207, 219); */
  }
  .bodycontainer{
    height: 100%;
  }
</style>
