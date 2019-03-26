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
      <tr v-for="x in files">
        <td>{{x.message}}</td>
        <td>{{x.name}}</td>
        <td>{{x.Button}}</td>
        <td>{{x.time}}</td>
        <td>{{x.index}}</td>
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
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'},
        {'message':'吴帅均傻逼','name':'doc','Button':'Start','time':'2019年3月21日23:56:23'}

      ]
    }
  }
}
</script>

<style scoped>
  #filecontainer{
    margin-top: 20px;
    margin-left: 20px;
    width: 95%;
    border: 1px solid rgb(21, 48, 238);
    height: 95%;
    overflow-y: scroll;
  }
  #filecontainer table{
    margin-top: 3%;
    margin-left: 3%;

  }
  #filecontainer td{
    text-align: center;
    height: 15px;
    width: 200px;
  }
</style>
