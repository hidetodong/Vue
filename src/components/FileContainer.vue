<template>
  <div id="filecontainer">
    <table border="3">
     <tr>
      <th>文件名</th>
      <th>类型</th>
      <th>操作</th>
      <th>时间</th>
      <th>序号</th>
     </tr>
     <tr v-for="file in files" v-bind:key="file">
        <td>{{file.message}}</td>
        <td>{{file.name}}</td>
        <td>{{file.Button}}</td>
        <td>{{file.time}}</td>
        <td>{{file.index}}</td>
      </tr>
    </table>
  </div>
</template>

<script>

export default {
  name: 'filecontainer',
  data () {
    return {
      files:[
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     
        {'message':'XXX','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},     

      ]
    }
  }
}
</script>

<style scoped>
  #filecontainer{
    margin-top: 0.5%;
    margin-left: 20px;
    width: 95%;
    /* border: 1px solid rgb(21, 248, 238); */
    height: 98%;
    overflow-y: scroll;
  }
  #filecontainer table{
    margin-top: 1%;
    margin-left: 3%;

  }
  #filecontainer td{
    text-align: center;
    height: 15px;
    width: 200px;
  }
</style>
