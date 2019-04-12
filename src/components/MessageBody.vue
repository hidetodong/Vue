<template>
  <div id="msgbody">
    <msgbox></msgbox>
    <div class="msg-container" v-if="isTalk"> 
      <msgcon></msgcon>
      <input type="button" v-on:click="change()" class='msgcon-button'>
    </div>
    <div class="msg-container" v-else>
      <talksbox></talksbox>
    </div>
   
  </div>
</template>

<script>
export default {
  name: 'msgbody',
  data () {
    return {
      isTalk:false
    }
  },
  methods:{
    change(){
      this.isTalk = !this.isTalk;
    }
  }
}
</script>

<style scoped>
  #msgbody{
    float: right;
    width: 81%;
    height: 93%;
    display: inline-block;
    /* border: 1px solid rgb(10, 161, 146); */
    margin-top: 3px;
    margin-left: 3px;
    padding-left: 2px;
    padding-top: 2px;
    padding-right: 4px;
  }
  .msg-container{
    height: 100%;
    border: 1px solid;
    margin-top: -0.5%;
  }
  .msgcon-button{
    width: 50px;
    height: 30px;
  }

</style>
