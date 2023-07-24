
<style>
    .loaldingg{ width: 40px; display: none; float: right;}
</style>
    <h5 style="padding: 20px;"> Exportar para o Excel</h5>
    <p style="padding: 20px; padding-top:0px; margin-top: -30px">Selecione um periodo para criar os arquivos para download</p>


<form name="form_informacoes_export" id="form_informacoes_export" class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            @csrf    
            
            <div class="md-form" style="margin-top: 30px;">
                <input type="date" id="fn_data_inicio" class="form-control datepicker" name="fn_data_inicio" value="" required>
                <label for="fn_data_inicio" class="active">Data Inicio</label>
            </div>  
        </div>
        <div class="col-md-6">
            @csrf    
            
            <div class="md-form" style="margin-top: 30px;">
                <input type="date" id="fn_data_fim" class="form-control datepicker" name="fn_data_fim" value="" required>
                <label for="fn_data_fim" class="active">Data Fim</label>
            </div>  
        </div>
    </div>
    <div class="footerint">        
        <button type="submit" class="btn btn-outline-success btn-sm btn-rounded waves-effect "><i class="fas fa-save"></i> Download</button>       
        Periodos longos demora um pouco mais para entregar o arquivo.
        <img src="{{ asset('paper') }}/img/loading.gif" class="loaldingg">    
                                                           
    </div> 
</form>



<script>
    $(document).ready(function () {
        // $('.mdb-select').materialSelect();   
        // $(".datepicker").pickadate({
        //     isRTL: false,
        //     format: 'dd/mm/yyyy',
        //     autoclose:true,
        //     language: 'pt-br'
        // });       
    });

    $("#form_informacoes_export").submit(function(e) {           
        e.preventDefault(); 
        form_informacoes_export();        
    });

    function form_informacoes_export(){
        $('.loaldingg').css('display', 'block');
        var fn_data_inicio = $('#fn_data_inicio').val();
        var fn_data_fim = $('#fn_data_fim').val();
        $.ajax({
            url: appUrl+'/home/exportar_excel?fn_data_inicio=' + fn_data_inicio + '&fn_data_fim=' + fn_data_fim,
            type: 'GET',
            success: function(response) {
                window.location.href = appUrl+'/home/exportar_excel?fn_data_inicio=' + fn_data_inicio + '&fn_data_fim=' + fn_data_fim;
                demo.showNotification('top','center', 'success', 'Arquivo Criado, fazendo a requisição do download...');
                setTimeout(function(){ $('.loaldingg').css('display', 'none');}, 9000);           
            }
        });
    }

</script>