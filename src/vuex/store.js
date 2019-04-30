import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
// 存放需要使用的变量
const state = {
  // Websocket通用信息维护
  webInfo: {
    'wsurl': 'ws://127.0.0.1:8085'
  },
  sockets: {
    ws: []
  },
  // 用于切换页面状态
  pageState: {
    'isLogin': false,
    'isTalk': false,
    'isEmpty': false,
    'isPrivate': false
  },
  // 用于存储登录用户信息
  localUser: {
    'name': '邢滋东',
    'password': '',
    'status': '离线'
  },
  // 用于存储已经登录在服务器上的用户信息
  user: [
    { 'uname': 'user', 'ip': '127.0.0.1:8888', 'port': '1000' },
    { 'uname': 'user1', 'ip': '127.0.0.1:8888', 'port': '1000' },
    {'uname': 'user2', 'ip': '127.0.0.1:8888', 'port': '1000'},
    {'uname': 'user3', 'ip': '127.0.0.1:8888', 'port': '1000'},
    {'uname': 'user4', 'ip': '127.0.0.1:8888', 'port': '1000'},
    { 'uname': 'user5', 'ip': '127.0.0.1:8888', 'port': '1000' },
    {'uname': 'user6', 'ip': '127.0.0.1:8888', 'port': '1000'}
  ],
  // 聊天界面中的消息
  msglist: [
    { 'name': '未知用户', 'content': '这是测试' },
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    { 'name': '未知用户', 'content': '这是测试' },
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    {'name': '未知用户', 'content': '这是测试'},
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' },
    { 'name': '未知用户', 'content': '这是测试' }
  ],
  userMsgList: [
    {
      'from': '吴帅均',
      'data': [
      ]
    }
  ],
  // 系统消息暂存
  systemMsg: {
    'message': '123123'
  },
  currentUser: {
    'name': ''
  }
}
// 存放修改变量的方法
const mutations = {
  setWs (state, ws) {
    state.sockets.ws = ws
  },
  addUser (state, Userinfo) {
    state.user.push(Userinfo)
  },
  addMsg (state, msgInfoAdd) {
    state.msglist.push(msgInfoAdd)
  },
  resetMsg (state) {
    state.msglist = []
  },
  sysMsgRefresh (state, sysStr) {
    state.systemMsg.message = sysStr.message
  },
  updateUserInfo (state, userinfo) {
    state.localUser.name = userinfo.name
    state.localUser.password = userinfo.password
  },
  updateLocalStatus (state, status) {
    state.localUser.status = status
  },
  confirmLogin (state) {
    state.pageState.isLogin = true
  },
  resetUserList (state, userlist) {
    state.user = userlist
  },
  setEmptyTrue (state) {
    state.pageState.isEmpty = true
  },
  setEmptyFalse (state) {
    state.pageState.isEmpty = false
  },
  addUserMsg (state, msg) {
    // state.userMsgList
  },
  setCurrentUser (state, user) {
    state.currentUser.name = user
  },
  setIsPrivate (state) {
    state.pageState.isPrivate = true
  },
  setNotPrivate (state) {
    state.pageState.isPrivate = false
  }
}

const store = new Vuex.Store({
  state,
  mutations
})

export default store
