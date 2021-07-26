<script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
<script>
    var appUrl ="{{env('APP_URL')}}";
    var modulo = 'contrato_produto_atividades';

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
                $('#card_create').html('<div data-aos=zoom-in data-aos-delay=0>'+load+'</div>');
                $('#card_lista').html('<div data-aos=zoom-in data-aos-delay=0>'+load+'</div>');
              
                $.get(appUrl+'/'+modulo+'/add/create-1', function(data){
                    $('#card_create').html(data); 
                    $.get(appUrl+'/'+modulo+'/add/lista-1', function(data){
                        $('#card_lista').html(data);
                    });
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
    
    
    function form_informacoes() {    
        let form = $('#form_informacoes');
        console.log(form.serializeArray());
        $.ajax({
            type: "POST",
            url: appUrl+'/'+modulo+'/cadastro',
            data: form.serializeArray(), 
            success: function(data)
            {
                console.log('form_informacoes');
                if (!Array.isArray(data)) {
                    demo.showNotification('top','center', 'info', 'Relacionamento existente');
                }else{
                    demo.showNotification('top','center', 'success', 'Cadastro concluido com sucesso ');
                    add_cards('lista',data, 'add');  
                    atualiza_atividades();
                    atualiza_produtos();
                }
                
            }
        });
    }

    function atualiza_produtos(){
        var dados = {'contrato': $('#contratos_id').val() }
        $.get(appUrl+'/contrato_produto_atividades/get_produto', dados, function(retorno){
            $('#recebeprodutos').html(retorno);
            $('.get-select').materialSelect(); 
             $('.form-control').trigger("change");
            $('.dropdown-content, .select-dropdown').perfectScrollbar();
            atualiza_atividades();
        }); 
        
    }
    function atualiza_atividades(){
        $.get(appUrl+'/contrato_produto_atividades/get_atividade', function(retorno){
            $('#recebeatividades').html(retorno);
            $('.get-select2').materialSelect(); 
            $('.form-control').trigger("change");
            $('.dropdown-content, .select-dropdown').perfectScrollbar();  
        });
    }
</script>