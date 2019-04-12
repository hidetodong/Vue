import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
const state = {
  // Websocket通用信息维护
  webInfo: {
    'wsurl': 'ws://127.0.0.1:8085'
  },
  // 用于切换页面状态
  pageState: {
    'isLogin': false,
    'isTalk': false
  },
  // 用于存储登录用户信息
  localUser: {
    'name': '',
    'status': '离线'
  },
  // 用于存储已经登录在服务器上的用户信息
  user: [
    {'name': '老王', 'url': '127.0.0.1:8888'}
  ],
  // 聊天界面中的消息
  msglist: [
    {'name': '未知用户', 'content': '你们都要发财'}
  ],
  // 系统消息暂存
  systemMsg: {
    'message': '123123'
  }
}
// 存放修改变量的方法
const mutations = {
  addUser (state, Userinfo) {
    state.user.push(Userinfo)
  },
  addMsg (state, msg_info_add) {
    state.msglist.push(msg_info_add)
  },
  resetMsg (state) {
    state.msglist = []
  },
  sysMsgRefresh (state, sysStr) {
    state.systemMsg.message = sysStr
  },
  updateUserInfo (state, userinfo) {
    state.localUser.name = userinfo.name
  },
  updateLocalStatus (state, status) {
    state.localUser.status = status
  },
  confirmLogin (state) {
    state.pageState.isLogin = true
  }
}

const store = new Vuex.Store({
  state,
  mutations
})

export default store
