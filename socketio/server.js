var server = require('http').createServer();
var io = require('socket.io')(server);
console.log("Online")
io.on('connection', function(socket){
  io.emit('actualizar')

  socket.on('cambio',function(){
    io.emit('actualizar')
  });

  socket.on('termina_viaje',function(){
    io.emit('actualiza_pagina')
  });

  socket.on('disconnect', function(){
  });


});

setInterval(function() {
  io.emit('actualizar')
},15000);

server.listen(8080);
