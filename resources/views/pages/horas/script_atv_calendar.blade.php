<script>
  if( document.readyState !== 'loading' ) {
        myInitCode();
} else {
    document.addEventListener('DOMContentLoaded', function () {
        myInitCode();
    });
}




function myInitCode(){
  var data_inicial = new Date();
  if($('#data_voltar_calend').val()){
    data_inicial = $('#data_voltar_calend').val();
  }

    var calendarEl = document.getElementById('fullCalendar');     
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        center: '',
        left: 'title',   
        right: 'prevYear,prev,next,nextYear today'
      },
      buttonText: {
          today: "Hoje"
      },
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: false,
      selectable: true,
      weekends: false,
      height: "auto",

      initialDate: data_inicial,
      events: [
        {
            title: 'Titulo',
            start: '2021-03-03',
              end: '2021-03-04',
              url: '', 
            color: '#257e4a'
          }
          

     ],
      


      select: function(info) {
        data = [info.startStr, info.endStr];
        add_atividade(data);
        // url = 'atividade/horas?inicio='+info.startStr+'&fim='+info.endStr;
        // window.location.href = url; 
      },
      navLinkDayClick: function(date, jsEvent) {
        // url = 'atividade/horas?dataunica='+date.toISOString();
        // window.location.href = url; 
        // console.log('day', date.toISOString());
        // console.log('coords', jsEvent.pageX, jsEvent.pageY);
      }



    });

    var eventSource = calendar.getEventSourceById('a');
    calendar.setOption('locale', 'pt-br');
    calendar.render();
  }

  setTimeout(function(){ 
  }, 500); 

function add_atividade(datas){

  var data_inicio = new Date(datas[0]+ ' 22:22:22');
  let data_inicio_ok = ((data_inicio.getFullYear() )) + "-" + ((data_inicio.getMonth() + 1)) + "-" + data_inicio.getDate();

  var data_fim = new Date(datas[1]+ ' 22:22:22');
      data_fim.setDate(data_fim.getDate()-1);
  let data_fim_ok = ((data_fim.getFullYear() )) + "-" + ((data_fim.getMonth() + 1)) + "-" + data_fim.getDate();


  dados = {inicio: data_inicio_ok, fim:data_fim_ok, data_voltar:datas[0]}; 



  $( ".card-calendar" ).hide();
  $( ".card_lista_cale" ).hide();
  setTimeout(function(){ 
    $.get(appUrl+'/'+modulo+'/add/add_horas-1', dados, function(retorno){
      $('#card_horas').html(retorno);
        $.get(appUrl+'/'+modulo+'/add/lista_horas-1', dados, function(retorno){
          $('#card_horas_lista').html(retorno);
      });
    });
  }, 200); 

  
  


}
</script>