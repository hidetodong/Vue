import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
var state = {

    localUser: {
        "name": "老周",
        "isSame": "same"
    },
    user:[
        {"name":"老王","isSame":"same"},
        {"name":"老周","isSame":"same"}
    ],
    msglist: [

    ],
    systemMsg:'123'
}
//存放修改变量的方法
var mutations = {
    addUser (Userinfo) {

    },
    addMsg (textMsg) {

    },
    sysMsgRefresh (sysStr) {
      this.state.systemMsg=sysStr;
    }
}

const store = new Vuex.Store({
  state,
  mutations
})

export default store;