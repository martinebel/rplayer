//get groups list
$.ajax({
url: 'api/register.php?action=getGroups',
async: true,
contentType: "application/json",
   success: function(data) {
	   var obj=JSON.parse(data);

    for(var i=0;i<obj.length;i++)
    {
      $("#grupo").append('<option value="'+obj[i].idgrupo+'">'+obj[i].nombre+'</option>');
    }

    if (localStorage.getItem("keyCliente") === null) {

  }
  else {
    $("#nombre").val(localStorage.getItem("nombreCliente"));
    $("#grupo").val(localStorage.getItem("grupoCliente"));
    $("#nombre").hide();
    $("#grupo").hide();
  }

   }
});

//get app name and logo
$.ajax({
url: 'api/register.php?action=getConfig',
async: true,
contentType: "application/json",
   success: function(data) {
	   var obj=JSON.parse(data);

    for(var i=0;i<obj.length;i++)
    {
      $("#titulo").html(obj[i].appname);
      document.title=obj[i].appname;
      if(obj[i].logo!=""){
      $("body").css("background-image","url('"+obj[i].logo+"')");
      $("body").css("background-size","contain");
    }
    }

   }
});


//register button
$(document).on('click','#register',function(e){
  //save local variables
  if (localStorage.getItem("keyCliente") === null) {
  localStorage.setItem("nombreCliente",$("#nombre").val());
  localStorage.setItem("grupoCliente",$("#grupo").val());
  //generate local key
  localStorage.setItem("keyCliente",jQuery.now());
}
  //send data to server
  $.ajax({
  url: 'api/register.php?action=register&nombre='+localStorage.getItem("nombreCliente")+"&grupo="+localStorage.getItem("grupoCliente")+"&key="+localStorage.getItem("keyCliente"),
  async: true,
  contentType: "application/json",
     success: function(data) {
       //get client id and redirect to player
        var obj=JSON.parse(data);
       localStorage.setItem("idCliente",obj);
       //window.location.href="player.html";
       $("#login").hide();
       initPlayer();

     }
  });
});
