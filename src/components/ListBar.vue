<template>
  <div id="listbar">
   <span><h1>用户列表</h1><hr style="height:2px;border:none;border-top:2px solid rgb(68, 67, 64);margin-top:2%;"/></span>
   <users></users>
  </div>
</template>

<script>
// import Users from 'Users.vue'

export default {
  name: 'listbar',
  data () {
    return {

    }
  }
}
</script>

<style scoped>
  #listbar{
    border-right: 2px solid rgb(79, 78, 82);
    border-bottom: 2px solid rgb(79, 78, 82);
    width: 18%;
    margin-top: 0.3%;
    display: inline-block;
    /* text-align: center; */
    height: 100%;
  }
  #listbar span{
    text-align: center;
    width: 100%;
    padding-top: 2%;

  }
  #listbar h1{
    display: inline-block;
    text-align: center;
    width: 100%;
    padding-top: 5%;
    padding-bottom: 3%;
  }



</style>
