function WebTool (host, name, pass) {
  var createSocket = function () {
    var ws = new WebSocket(host)
    ws.onopen = function () {
      var data = '建立连接成功';
      return data;
    }
    
  }
  var listMsg = function () {
    console.log('111')
  }
}
function createSocket () {
  

}
export function newss () {
  console.log('11111111')
}

// WebTool.prototype = {
//   constructor: WebTool,
//   listMsg: function () {
//     alert('niubi')
//   }
// }
export {
  WebTool
}
