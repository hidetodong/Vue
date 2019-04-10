import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
var state = {
  pageState: {
    'isLogin': false,
    'isTalk': false
  },
  localUser: {
    'name': ''
  },
  user: [
    {'name': '老王'}
  ],
  msglist: [

  ],
  systemMsg: {'message': '123123'}
}
// 存放修改变量的方法
var mutations = {
  addUser (state, Userinfo) {

  },
  addMsg (state, textMsg) {

  },
  sysMsgRefresh (state, sysStr) {
    state.systemMsg.message = sysStr
  },
  updateUserInfo (state, userinfo) {
    state.localUser.name = userinfo.name
  },
  confirmLogin (state) {
    state.pageState.isLogin = true;
  }
}

const store = new Vuex.Store({
  state,
  mutations
})

export default store
