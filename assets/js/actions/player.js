var estado=0;

function initPlayer(){
  //obtener los datos desde el servidor
  $.ajax({
    url: 'api/player.php?action=getData&idCliente='+localStorage.getItem("idCliente"),
    async: true,
    contentType: "application/json",
    success: function(data) {
      var obj=JSON.parse(data);

      for(var i=0;i<obj.length;i++)
      {
        $("#nombreGrupo").html(obj[i].nombre); //nombre del grupo
        document.title=obj[i].nombre;
        $("#estado").html("Esperando..."); //estado inicial
        $("#archivo").html('<source src="'+obj[i].archivo+'" type="audio/mpeg">'); //cargar el audio
        if(obj[i].logo!=""){ //si hay una imagen, ponerla de background
          $("body").css("background-image","url('"+obj[i].logo+"')");
          $("body").css("background-size","contain");
          $("#player").fadeIn(); //mostrar el panel del reproductor
        }
        //iniciar cada 5seg la funcion que revisa el estado enviado por el servidor
        window.setInterval(function(){
          startMonitoring();
        }, 1000);
      }

    }
  });
}

//revisa si el servidor nos manda un estado
function startMonitoring()
{
  if(estado==0) //estoy en stop
  {
    $.ajax({
      url: 'api/player.php?action=getStatus&idCliente='+localStorage.getItem("idCliente"),
      async: true,
      contentType: "application/json",
      success: function(data) {
        var obj=JSON.parse(data);
        if(obj=="1") //si nos manda play
        {
          estado=1;
          //start playing

          var media = document.getElementById("archivo");
          const playPromise = media.play();

          if (playPromise !== null){
            playPromise.catch(() => { media.play(); })
          }

          $("#notworking").show(); //mostrar el boton de "no funciona?"

          $("#estado").html("Reproduciendo"); //cambiar el subtitulo de estado
        }

      }
    });
  }
}

//click en el boton Repetir
$(document).on('click','#repetir',function(e){

  //aviso al servidor que estoy en play
  $.ajax({
    url: 'api/player.php?action=setStatus&idCliente='+localStorage.getItem("idCliente")+'&status=1',
    async: true,
    contentType: "application/json",
    success: function(data) {
      estado=1; //estoy en play
      //start playing
      var media = document.getElementById("archivo");
      const playPromise = media.play();
      if (playPromise !== null){
        playPromise.catch(() => { media.play(); })
      }
      $("#estado").html("Reproduciendo"); //cambiar el subtitulo de estado
      $("#repeat").hide(); //ocultar este boton
    }
  });
});


//click en el boton "Recargar"
$(document).on('click','#recargar',function(e){

  //aviso al servidor que estoy en stop
  $.ajax({
    url: 'api/player.php?action=setStatus&idCliente='+localStorage.getItem("idCliente")+'&status=0',
    async: true,
    contentType: "application/json",
    success: function(data) {
      location.reload(); //recargo la pagina
    }
  });
});


var aud = document.getElementById("archivo");
aud.onended = function() { //evento del audio: cuando finaliza el archivo que se esta reproduciendo
  //aviso al servidor que estoy en stop
  $.ajax({
    url: 'api/player.php?action=setStatus&idCliente='+localStorage.getItem("idCliente")+'&status=2',
    async: true,
    contentType: "application/json",
    success: function(data) {
      estado=0; //estoy en stop
    }
  });
  $("#estado").html("Finalizado");  //cambiar el subtitulo de estado
  $("#repeat").show(); //mostrar el boton Repetir
};
aud.ontimeupdate = function() { //evento del audio: cuando avanza la reproduccion
  var progreso=aud.currentTime / aud.duration * 100 ;
  $('.progress-bar').css('width', progreso+'%').attr('aria-valuenow', progreso); //muestro el progreso del audio
};

//click en el boton "no funciona?"
$(document).on('click','#notworking',function(e){
  //pido los datos al servidor
  $.ajax({
    url: 'api/player.php?action=getData&idCliente='+localStorage.getItem("idCliente"),
    async: true,
    contentType: "application/json",
    success: function(data) {
      var obj=JSON.parse(data);

      for(var i=0;i<obj.length;i++)
      {
        //recargo el audio
        $("#archivo").html('<source src="'+obj[i].archivo+'" type="audio/mpeg">');
        $("#archivo").attr("controls","controls"); //muestro los controles html5 nativos
        $("#barra").hide(); //oculto barra de progreso
      }

    }
  });

});
