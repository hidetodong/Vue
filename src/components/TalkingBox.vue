<template>
  <div id='talksbox'>
      <div class="talk-inner">

      </div>
      <div class="talk-input">
        <div class="talk-text">
          <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="talk-button">
          <div class="talk-send-button">发送</div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'talksbox',
  data () {
    return {
      
    }
  }
  
}
</script>

<style scoped>
  #talksbox{
      width: 100%;
      height: 100%;
      /* background-color: blue; */
      border: 1px solid;
      /* background-color: azure; */
      
  }
  .talk-inner{
    height: 60%;
    margin-left: 1%;
    margin-right: 1%;
    margin-top: 1%;
    border: 1px solid;
  }
  .talk-input{
    height: 30%;
    margin-left: 1%;
    margin-top: 1%;
    margin-right: 1%;
    border: 1px solid;
  }
  .talk-text{
    border: 1px solid;
    height: 80%;
    margin-left: 0.5%;
    margin-right: 0.5%;
    margin-top: 0.5%;
  }
  .talk-text textarea{
    height: 100%;
    width: 100%;
    resize: none;
  }
  .talk-text textarea:active{
    box-shadow:0 0 10px rgb(137, 20, 233) inset;
  }
  .talk-button{
    height: 10%;
    margin-top: 0.5%;
    margin-left: 0.5%;
    margin-right: 0.5%;
    /* border: 1px solid; */
  }
  .talk-send-button{
    height: 100%;
    width: 10%;
    border-radius: 10px;
    border: 1px solid;
    text-align: center;
    line-height: 100%;
    vertical-align: center;
    font-size: 20px;
    text-shadow: 2px;
  }
  .talk-send-button:hover{
    background-color: #c0c0c0;

  }
</style>
