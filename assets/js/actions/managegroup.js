startMonitoring();
  window.setInterval(function(){
      startMonitoring();
    }, 5000);




function startMonitoring()
{
$("#tabla").empty();
var final="";
    $.ajax({
    url: '../api/managegroup.php?action=getStatus&idGroup='+$("#idgrupo").val(),
    async: true,
    contentType: "application/json",
       success: function(data) {
    	   var obj=JSON.parse(data);
         for(var i=0;i<obj.length;i++)
         {
            final='<tr><td>'+obj[i].nombre+'</td><td>';
            switch (obj[i].estado) {
                 case '0':
                   final+= '<span class="badge badge-danger">Esperando</span> <a href="#" data-identificacion="'+obj[i].identificacion+'" class="btn btn-secondary btn-sm reproducir-cliente"><i class="fas fa-fw fa-play"></i> Reproducir</a> <a href="#" class="btn btn-dark btn-sm delete-cliente" data-identificacion="'+obj[i].identificacion+'"><i class="fas fa-fw fa-trash"></i> Eliminar</a>';
                   break;

                 case '1':
                   final+= '<span class="badge badge-success">Reproduciendo</span> <a href="#" data-identificacion="'+obj[i].identificacion+'" class="btn btn-danger btn-sm parar-cliente"><i class="fas fa-fw fa-stop"></i> Reiniciar</a> <a href="#" class="btn btn-dark btn-sm delete-cliente" data-identificacion="'+obj[i].identificacion+'"><i class="fas fa-fw fa-trash"></i> Eliminar</a>';
                   break;

                   case '2':
                   final+= '<span class="badge badge-warning">Finalizado</span> <a href="#" data-identificacion="'+obj[i].identificacion+'" class="btn btn-primary btn-sm reproducir-cliente"><i class="fas fa-fw fa-sync-alt"></i> Repetir</a> <a href="#" class="btn btn-dark btn-sm delete-cliente" data-identificacion="'+obj[i].identificacion+'"><i class="fas fa-fw fa-trash"></i> Eliminar</a>';
                   break;
               }
               final+='</td></tr>';
               $("#tabla").append(final);
         }

       }
    });

}

$(document).on('click','.reproducir-cliente',function(e){
var id=$(this).data("identificacion");
  //change status on server
  $.ajax({
  url: '../api/managegroup.php?action=playClient&idClient='+id,
  async: true,
  contentType: "application/json",
     success: function(data) {
       startMonitoring();
     }
  });
});

$(document).on('click','.parar-cliente',function(e){
var id=$(this).data("identificacion");
  //change status on server
  $.ajax({
  url: '../api/managegroup.php?action=stopClient&idClient='+id,
  async: true,
  contentType: "application/json",
     success: function(data) {
       startMonitoring();
       $(".alert").show();
       $(".alert").delay(5000).fadeOut();
     }
  });
});

$(document).on('click','.delete-cliente',function(e){
var id=$(this).data("identificacion");
  //change status on server
  $.ajax({
  url: '../api/managegroup.php?action=deleteClient&idClient='+id,
  async: true,
  contentType: "application/json",
     success: function(data) {
       startMonitoring();
     }
  });
});

$(document).on('click','.reproducir-todo',function(e){

  //change status on server
  $.ajax({
  url: '../api/managegroup.php?action=playAll&idGroup='+$("#idgrupo").val(),
  async: true,
  contentType: "application/json",
     success: function(data) {
       startMonitoring();
     }
  });
});
