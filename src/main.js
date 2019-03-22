// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import ListBar from './components/ListBar'
import TitleBar from './components/TitleBar'
import BodyBar from './components/BodyBar'
import MessageBox from './components/MessageBox'
import Users from './components/Users'
import MessageBody from './components/MessageBody'
import MessageContent from './components/MessageContent'
import FileContainer from './components/FileContainer'
Vue.config.productionTip = false
// 全局注册
Vue.component('listbar',ListBar);
Vue.component('titlebar',TitleBar);
Vue.component('bodybar',BodyBar);
Vue.component('msgbox',MessageBox);
Vue.component('users',Users);
Vue.component('msgbody',MessageBody);
Vue.component('msgcon',MessageContent);
Vue.component('filecontainer',FileContainer);
/* eslint-disable no-new */

new Vue({
  el: '#app',
  components: { App },
  template: '<App/>'
})
