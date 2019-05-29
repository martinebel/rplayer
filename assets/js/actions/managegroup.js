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
                   final+= '<span class="badge badge-danger">Esperando</span> <a href="#" data-identificacion="'+obj[i].identificacion+'" class="btn btn-secondary btn-sm reproducir-cliente"><i class="fas fa-fw fa-play"></i> Reproducir</a>';
                   break;

                 case '1':
                   final+= '<span class="badge badge-success">Reproduciendo</span> ';
                   break;

                   case '2':
                   final+= '<span class="badge badge-warning">Finalizado</span> <a href="#" data-identificacion="'+obj[i].identificacion+'" class="btn btn-primary btn-sm reproducir-cliente"><i class="fas fa-fw fa-sync-alt"></i> Repetir</a>';
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
