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


export default {
  name: 'App',
  data () {
    return {
      isLogin:false
    }
  },
  methods:{
    turned(isLogin){
      this.isLogin = isLogin;
      // v-bind:isLogin="isLogin"
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
