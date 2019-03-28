<template>
  <div id="msgcon">
    <div class="msgcon-inner">
      <div class="msgcon-header">
        <div class="msgcon-header-inner">
          <input type="button" name="uploadfile" value="上传文件">
          <input type="button" name="downloadfile" value="下载文件">
        </div>
      </div>
      <div class="msgcon-body">
        <filecontainer></filecontainer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'msgcon',
  data () {
    return {

    }
  }
}
</script>

<style scoped>
  #msgcon{
    width: 100%;
    height: 96%;
    /* border: 1px solid rgb(21, 244, 96); */
  }
  #msgcon h1{
    font-size: 15px;
  }
  .msgcon-inner{
    margin: 0.3% auto 0.3% auto;
    width: 99%;
    height: 100%;
    align-self: center;
    border-radius: 10px;
    border: 1px solid;
  }
  .msgcon-header{
    border-bottom: 1px solid;
    width: 100%;
    height: 7%;

  }
  .msgcon-header-inner{
    height:100%;
  }
  .msgcon-header-inner input{
    margin:0.5% 0% auto 1%;
    height:70%;
    border-radius: 10px;
    width: 15%;
  }
  .msgcon-body{
    width: 98%;
    height: 90%;
    margin: 0.5% auto 0% auto;
    /* border: 1px solid; */
  }
</style>
