<template>
  <div id="msgbox">
    <span><h1>系统信息：{{message}}</h1></span>
  </div>
</template>

<script>
export default {
  name: 'msgbox',
  data () {
    return {
      message:'上线成功！'
    }
  }
}
</script>

<style scoped>
 #msgbox{
   height: 7%;
   width: 100%;
   /* border:1px solid rgb(240, 47, 66); */
 }
#msgbox span h1{
  font-size: 20px;
  padding-left: 4%;
  margin: 0.5% auto 0.5% auto;
  padding-top: 0.5%;
  padding-bottom: 0.5%;
  width: 95%;
  /* display: inline-block; */
  border-radius: 10px;
  border:1px solid;
}
#msgbox span{
  /* display: inline-block; */
  height: 100%;
  width: 100%;
}
</style>
