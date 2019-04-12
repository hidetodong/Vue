<template>
  <div id="titlebar">

    <h1><span class="titlebar-span">云端消息文件中转系统</span></h1>

  </div>
</template>

<script>
export default {
  name: 'titlebar',
  data () {
    return {

    }
  }
}
</script>

<style scoped>
  #titlebar h1{
    font-size: 50px;
    border-top:5px solid rgb(56, 66, 69);
    border-bottom:6px solid rgb(56, 66, 69);
    text-align: center;
    vertical-align:middle;
    height: 100%;
    line-height: 100%;

  }
  #titlebar{
    width: 100%;
    height: 11%;
  }
  #titlebar img{
    width: 6%;
    display: inline-block;
    vertical-align:middle;
    text-align: center;
  }
  .titlebar-span{
    padding-top: 2%;
    font-family: fantasy;
    display: inline-block;
    vertical-align:middle;
    text-align: center;
  }
  #titlebar span{

  }
</style>
