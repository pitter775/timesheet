<script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
<script>
    var appUrl ="{{env('APP_URL')}}";
    var modulo = 'usuarios';

    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function add_cards(card, id, tipo){
        switch (card) {
            case 'lista':
                $.get(appUrl+'/'+modulo+'/add/lista-0', function(data){
                    $('#card_lista').html(data);
                    anima_editado(id, tipo); 
                });
            break;
            case 'create':
                $.get(appUrl+'/'+modulo+'/add/create-0', function(data){
                    $('#card_create').html(data);
                }); 
            break;
            case null:
                $.get(appUrl+'/'+modulo+'/add/lista-1', function(data){
                    $('#card_lista').html(data);
                });
                $.get(appUrl+'/'+modulo+'/add/create-1', function(data){
                    $('#card_create').html(data);
                }); 
            break;
        }
    }

    function deletar_item(id){
        if(confirm('Deseja remover esse item? ')){
            $.get(appUrl+'/'+modulo+'/delete/'+id, function(retorno){
                var result = retorno.split(',');
                if(result[0] == 'Erro'){
                    demo.showNotification('top','center', 'danger', result[1]);
                }else{                  
                    demo.showNotification('top','center', 'success', result[0]);
                    obj = '#tab'+id; 
                    obj2 = 'tr > .child';
                    $(obj).addClass('editremove');
                    setTimeout(function(){ $(obj).addClass('anima');}, 10);
                    setTimeout(function(){ $(obj).removeClass('editremove');}, 20);                 
                    setTimeout(function(){ $(obj).hide('slow');}, 400);   
                    setTimeout(function(){ $(obj2).hide();}, 400);    
                }                             
            });
        }
    }

    function editar_lista($id){
        $.get(appUrl+'/'+modulo+'/editar/'+$id, function(retorno){
            $('#retorno_modal_lista').html(retorno);
        });
    }     
    
    function form_informacoes_edit() {        
        let form = $('#form_informacoes_edit');
        console.log(form.serializeArray());
        var idgeral = $('#id_geral_edit').val();
        $.ajax({
            type: "POST",
            url: appUrl+'/'+modulo+'/cadastro',
            data: form.serializeArray(), 
            success: function(data)
            {
                var result = data.split(',');
                if(result[0] == 'erro'){
                    demo.showNotification('top','center', 'danger', result[1]);
                }else{                  
                    demo.showNotification('top','center', 'success', 'Item editado com sucesso ');
                    add_cards('lista',idgeral, 'edit');  
                    $('#myModal_lista').modal('toggle');
                }
            }
        });
    }
    function form_informacoes_edit_retro() {        
        let form = $('#form_informacoes_edit_retro');
        console.log(form.serializeArray());
        var idgeral = $('#id_geral_edit').val();
        $.ajax({
            type: "POST",
            url: appUrl+'/'+modulo+'/cadastro_retro',
            data: form.serializeArray(), 
            success: function(data)
            {
                demo.showNotification('top','center', 'success', 'Foram feitas '+data+' alterações');
                    add_cards('lista',idgeral, 'edit');  
                    $('#myModal_lista').modal('toggle');
                
            }
        });
    }
    
    function form_informacoes() {    
        let form = $('#form_informacoes');
        $.ajax({
            type: "POST",
            url: appUrl+'/'+modulo+'/cadastro',
            data: form.serializeArray(), 
            success: function(data)
            {
                var result = data.split(',');
                if(result[0] == 'erro'){
                    demo.showNotification('top','center', 'danger', result[1]);
                }else{                  
                    demo.showNotification('top','center', 'success', 'Cadastro concluido com sucesso ');
                    add_cards('lista',data, 'add');  
                    document.getElementById('form_informacoes').reset();
                    $('.form-control').trigger("change");   
                }
            }
        });
    }


    function atualizatarifa(){
        $('#tarifa').val(''); 
        console.log($('#funcaos_id').val());
        if($('#equipes_id').val() !== null && $('#funcaos_id').val() !== null){
            if($('#equipes_id').val() !== '' && $('#funcaos_id').val() !== ''){
                var dados = {'equipes_id': $('#equipes_id').val(), 'funcao':$('#funcaos_id').val() }
                console.log(dados);
                $.get(appUrl+'/tarifas/get', dados, function(retorno){               
                    $('#tarifa').val(retorno);
                    $('#tarifa').trigger("change"); 
                }); 
                $('#tarifa').trigger("change"); 
            }
        }
    }
</script>