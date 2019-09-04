//obtengo la lista de grupos
$.ajax({
url: 'api/register.php?action=getGroups',
async: true,
contentType: "application/json",
   success: function(data) {
	   var obj=JSON.parse(data);

    for(var i=0;i<obj.length;i++)
    {
      //cargo en el combo
      $("#grupo").append('<option value="'+obj[i].idgrupo+'">'+obj[i].nombre+'</option>');
    }

//si ya existe una key, quiere decir que el cliente ya esta registrado
//y volvio a entrar (seguro porque recargó la pagina)
//entonces tengo que autocompletar los datos y deshabilitarlos (para que no cambien)
    if (localStorage.getItem("keyCliente") === null) {

  }
  else {
    $("#nombre").val(localStorage.getItem("nombreCliente")); //cargo el nombre
    $("#grupo").val(localStorage.getItem("grupoCliente")); //cargo el grupo que tenia
    $("#nombre").hide(); //oculto el campo de nombre
    $("#grupo").hide(); //oculto el campo de seleccion de grupo
  }

   }
});

//obtengo el nombre de la app y la imagen de fondo
$.ajax({
url: 'api/register.php?action=getConfig',
async: true,
contentType: "application/json",
   success: function(data) {
	   var obj=JSON.parse(data);

    for(var i=0;i<obj.length;i++)
    {
      $("#titulo").html(obj[i].appname); //muestro el titulo
      document.title=obj[i].appname; //muestro el titulo en la barra del navegador o en la pestaña
      if(obj[i].logo!=""){ //si hay imagen la pongo en background
      $("body").css("background-image","url('"+obj[i].logo+"')");
      $("body").css("background-size","contain");
    }
    }

   }
});


//boton "Entrar"
$(document).on('click','#register',function(e){
  //guardo las variables
  if (localStorage.getItem("keyCliente") === null) {
  localStorage.setItem("nombreCliente",$("#nombre").val());
  localStorage.setItem("grupoCliente",$("#grupo").val());
  //genero una key para este cliente
  localStorage.setItem("keyCliente",jQuery.now());
}
  //mando los datos al servidor
  $.ajax({
  url: 'api/register.php?action=register&nombre='+localStorage.getItem("nombreCliente")+"&grupo="+localStorage.getItem("grupoCliente")+"&key="+localStorage.getItem("keyCliente"),
  async: true,
  contentType: "application/json",
     success: function(data) {
       //el servidor me devuelve una ID para este cliente. la guardo
        var obj=JSON.parse(data);
       localStorage.setItem("idCliente",obj);
       //oculto el panel de inicio
       $("#login").hide();
       //inicializo el reproductor
       initPlayer();

     }
  });
});
