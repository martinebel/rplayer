var estado=0;

//get data
$.ajax({
url: 'api/player.php?action=getData&idCliente='+localStorage.getItem("idCliente"),
async: true,
contentType: "application/json",
   success: function(data) {
	   var obj=JSON.parse(data);

    for(var i=0;i<obj.length;i++)
    {
      $("#nombreGrupo").html(obj[i].nombre);
      $("#estado").html("Esperando...");
      $("#archivo").html('<source src="'+obj[i].archivo+'" type="audio/mpeg">');
      if(obj[i].logo!=""){
      $("body").css("background-image","url('"+obj[i].logo+"')");
      $("body").css("background-size","contain");
    }
      window.setInterval(function(){
      startMonitoring();
    }, 1000);
    }

   }
});



function startMonitoring()
{
  if(estado==0)
  {
    $.ajax({
    url: 'api/player.php?action=getStatus&idCliente='+localStorage.getItem("idCliente"),
    async: true,
    contentType: "application/json",
       success: function(data) {
    	   var obj=JSON.parse(data);
         if(obj=="1")
         {
           estado=1;
           //start playing
           var media = document.getElementById("archivo");
           const playPromise = media.play();
           if (playPromise !== null){
               playPromise.catch(() => { media.play(); })
           }
           $("#estado").html("Reproduciendo");
         }

       }
    });
  }
}

$(document).on('click','#repetir',function(e){

  //change status on server
  $.ajax({
  url: 'api/player.php?action=setStatus&idCliente='+localStorage.getItem("idCliente")+'status=1',
  async: true,
  contentType: "application/json",
     success: function(data) {
       estado=1;
       //start playing
       var media = document.getElementById("archivo");
       const playPromise = media.play();
       if (playPromise !== null){
           playPromise.catch(() => { media.play(); })
       }
       $("#estado").html("Reproduciendo");
       $("#repeat").hide();
     }
  });
});

var aud = document.getElementById("archivo");
aud.onended = function() {
  //change status on server
  $.ajax({
  url: 'api/player.php?action=setStatus&idCliente='+localStorage.getItem("idCliente")+'status=2',
  async: true,
  contentType: "application/json",
     success: function(data) {
       estado=0;
     }
  });
  $("#estado").html("Finalizado");
  $("#repeat").show();
};
aud.ontimeupdate = function() {
  var progreso=aud.currentTime / aud.duration * 100 ;
  $('.progress-bar').css('width', progreso+'%').attr('aria-valuenow', progreso);
};
