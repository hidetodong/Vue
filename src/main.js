// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'

import TitleBar from './components/TitleBar'
import BodyBar from './components/BodyBar'
import MessageBox from './components/MessageBox'
import Users from './components/Users'
import ListBar from './components/ListBar'
import MessageContent from './components/MessageContent'
import FileContainer from './components/FileContainer'
import LoginBar from './components/LoginBar'
import MessageBody from './components/MessageBody'
import TalkingBox from './components/TalkingBox'
Vue.config.productionTip = false

// 全局注册

Vue.component('titlebar', TitleBar)
Vue.component('bodybar', BodyBar)
Vue.component('msgbox', MessageBox)
Vue.component('users', Users)
Vue.component('listbar', ListBar)
Vue.component('msgcon', MessageContent)
Vue.component('filecontainer', FileContainer)
Vue.component('loginbar', LoginBar)
Vue.component('msgbody', MessageBody)
Vue.component('talksbox', TalkingBox)
/* eslint-disable no-new */

new Vue({
  el: '#app',
  components: { App },
  template: '<App/>'
})
