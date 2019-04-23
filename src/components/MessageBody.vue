<template>
  <div id="msgbody">
    <msgbox></msgbox>
    <div class="msg-container" v-if="isTalk"> 
      <msgcon></msgcon>
      <input type="button" v-on:click="change()" class='msgcon-button'>
    </div>
    <div class="msg-container" v-else>
      <div class="msg-tab" v-if="isPrivate">
        <privatetalk></privatetalk>
      </div>
      <div class="msg-tab" v-else>
        <talksbox></talksbox>
      </div>
      
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
  },
  computed:{
    isPrivate () {
      return this.$store.state.pageState.isPrivate;
    }
  }
}
</script>

<style scoped>
  #msgbody{
    float:left;
    height: 73%;
    width: 80%;
    display: inline-block;
    /* border: 1px solid rgb(10, 161, 146); */
    margin-top: 8px;
    padding-left: 2px;
    padding-top: 2px;
    padding-right: 4px;
    margin-left: 1%;
    /* margin-right: 1%; */
  }
  .msg-container{
    height: 90%;
    border: 1px solid;
    margin-top: 0.5%;
    
  }
  .msgcon-button{
    width: 50px;
    height: 30px;
  }

</style>
