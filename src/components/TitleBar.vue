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
    font-size: 3vw;
    border-top:6px solid rgb(56, 66, 69);
    border-bottom:8px solid rgb(56, 66, 69);
    /* text-align: center; */
    vertical-align:middle;
    height: 100%;
    line-height: 100%;

  }
  #titlebar{
    width: 100%;
    height: 100px;
  }
  #titlebar img{
    width: 6%;
    display: inline-block;
    vertical-align:middle;
    text-align: center;
  }
  .titlebar-span{
    margin-left: 25%;
    margin-right: 25%;
    width: 50%;
    margin-top: 25px;
    /* border: 1px solid; */
    /* margin-top: 1%;
    margin-bottom: 1%; */
    font-family: fantasy;
    display: inline-block;
    /* vertical-align:middle; */
    text-align: center;
  }
  
</style>
