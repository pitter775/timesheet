<div class="card" {{$add_anima ?? ''}} style="z-index: 9;">
        <div class="card-body">
            <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                <div class="card card-plain card_dif">
                    <div class="card-header" role="tab" id="headingOne">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                            <h5 style="margin: 0; padding:0; font-weight:300"> <i class="fas fa-plus" style="float: left; font-size: 15px; margin-top: 2px; opacity:.5"></i> Cadastrar Atestados <i class="nc-icon nc-minimal-down"></i></h5> 
                            
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="card-body">
                            <div class="row">
                                <form name="form_atestado" id="form_atestado" class="col-md-12" style="width: 100%; margin: 0; padding:0;" enctype="multipart/form-data">                    
                                    @csrf 
                                    <input type="hidden" id="tipo" name="tipo" class="form-control" value="">
                                    <div class="row" style="margin-left: 10px;">   
                                        <div style="float: left;">
                                            <img id='output2' src="">                                            
                                        </div>    
                                        <div style="float: left; margin-left: 10px">
                                            <label for="arquivo2" class="btn btn-outline-primary btn-sm btn-rounded waves-effect">Adicionar Atestado</label>
                                            <input type="file" id="arquivo2" name="arquivo2" hidden><br>
                                            <p style="color: #777; margin-left: 10px; font-size: 12px;">JPG, GIF ou PNG, máximo de 800kB</p>
                                        </div>                                    
                                    </div>
    
                                    <div class="card-body escolha" style="text-align: center;">
                                        <h6 style="font-weight: 500; color: #777">Escolha o tipo de periodo ausente</h6>
    
                                        <div class="row" style="margin: 20px 0;">
    
                                            <div class="col-3"></div>
                                            <div class="col-6 align-self-center">
                                                <button type="button" style="font-size: 16px;"  onclick="btdias()" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"> <i class="far fa-calendar" style=" margin-right: 5px"></i> Dias</button>
                                                <button type="button" style="font-size: 16px;"  onclick="bthoras()" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"> <i class="far fa-clock" style=" margin-right: 5px"></i> Horas</button>
                                            </div>
                                            <div class="col-3"></div>                
    
                                        </div>
                                    </div>
    
                                    <div class="comdatas">
                                        <div class="card-body">
                                            <div class="row tipodias"> 
                                                <div class="col-md-4" >
                                                    <div class="md-form">
                                                        <select searchable="Procurar..." class="mdb-select colorful-select dropdown-primary md-form" name="usuario" id="usuario" >
                                                            <option value="" disabled selected></option>                                            
                                                            <option value="">Selecione...</option>                                            
                                                            @foreach($usuarios as $key => $value)                              
                                                                <option value="{{$value->id ?? ''}}">{{$value->name ?? ''}}</option> 
                                                            @endforeach                                                     
                                                        </select> 
                                                        <label for="usuario" class="active"><i class="fas fa-users" style="color: #444; margin-right: 5px"></i>  Usuários</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="md-form">
                                                        <input type="text" id="datainicio_at" class="form-control datepicker" name="datainicio_at" value="" >
                                                        <label for="datainicio_at" class="active"><i class="far fa-calendar" style="color: #444; margin-right: 5px"></i> Data Início</label>
                                                    </div>  
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="md-form">
                                                        <input type="text" id="datafim_at" class="form-control datepicker" name="datafim_at" value="" >
                                                        <label for="datafim_at" class="active"> <i class="far fa-calendar" style="color: #444; margin-right: 5px"></i> Data Fim</label>
                                                    </div>  
                                                </div>                                             
                                            </div> 
    
                                            <div class="row tipohoras"> 
                                                <div class="col-md-6">
                                                    <div class="md-form">
                                                        <input type="text" id="datahora" class="form-control datepicker" name="datahora">
                                                        <label for="datahora" class="active"><i class="far fa-calendar" style="color: #444; margin-right: 5px"></i> Data</label>
                                                    </div>  
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="md-form">
                                                        <input type="text" id="horas_at" name="horas_at" class="form-control timepicker">
                                                        <!-- <label for="input_starttime">Light version, 12hours</label> -->
                                                        <label for="horas_at" class="active"><i class="far fa-clock" style="color: #444; margin-right: 5px"></i> Selecione as horas</label>
                                                    </div> 
                                                </div>                                             
                                            </div> 
                                    
    
                                        </div>
                                        <div class="card-footer ">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"> <i class="fas fa-save"></i> Enviar Atestado</button>
                                                    <button type="button" class="btn btn-outline-warning btn-sm btn-rounded waves-effect"  onclick="btvoltar()"><i class="fas fa-broom"></i> Voltar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('.mdb-select').materialSelect();     
            $('.form-control').trigger("change"); 
            $('.dropdown-content, .select-dropdown').perfectScrollbar();    
            $(".datepicker").pickadate({
                isRTL: false,
                format: 'dd/mm/yyyy',
                autoclose:true,
                language: 'pt-br'
            });      
            });
            $("#form_informacoes").submit(function(e) {           
                e.preventDefault(); 
                form_informacoes();        
            });

    $('.comdatas').hide();
    $('#output2').hide();
    $('.tipodias').hide();
    $('.tipohoras').hide();
    setTimeout(function(){ $( ".nav-item" ).removeClass( "waves-effect" )}, 1000);

    $("#form_atestado").submit(function(e) {           
        e.preventDefault(); 
        form_atestado();        
    });


    $("#arquivo").change(function(e) {
        var input = e.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('output');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);

   


        form_anexo(); 
    })
    $("#arquivo2").change(function(e) {
        var input = e.target;
        var reader = new FileReader();
        reader.onload = function(){
            var dataURL = reader.result;
            var output = document.getElementById('output2');

            retorno = dataURL.split(";");
            retornof = retorno[0].split("/");
            if(retornof[1] == 'pdf'){
                dataURL = '/storage/pdfico.png';
            }   

            output.src = dataURL;
            
        };
         reader.readAsDataURL(input.files[0]); 
        $('#output2').show();
        
    })
</script>