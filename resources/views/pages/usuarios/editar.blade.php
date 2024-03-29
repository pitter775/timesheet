<style>
    .avatarp10 {
    height: 50px;
    width: 50px !important;
    margin: 2px!important;
    border-radius: 50%;
    box-sizing: unset;
    object-fit: cover;
    margin-top: -5px;
    box-shadow: 0 4px 8px 0 rgb(34 41 47 / 12%), 0 2px 4px 0 rgb(34 41 47 / 8%);

}
</style>
<div class="modal-header justify-content-center">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
    <h5>Editar Usuário</h5>
</div>
<div class="modal-body" style="padding: 0 0 20px 0;">
    <div class="card-body">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab-fill" data-toggle="pill" href="#home-fill" aria-expanded="true">Atual</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="about-tab-fill" data-toggle="pill" href="#about-fill" aria-expanded="false">Retroativo</a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel"class="tab-pane active"id="home-fill"aria-labelledby="home-tab-fill"aria-expanded="true">
            <div class="row" style="margin-top: 30px">
                <div class="col-md-12" style="padding: 0">
                    <form name="form_informacoes_edit" id="form_informacoes_edit" class="col-md-12">
                        <input type="hidden" id="id_geral_edit" name="id_geral" class="form-control" value="{{$dados_editar->uid}}" required>
                        @csrf                       
                        <div class="row">                                            
                            <div class="col-md-5">                                                
                                <div class="md-form">
                                    <input type="text" id="ed_name" name="name" class="form-control" value="{{$dados_editar->name ?? ''}}" required>
                                    <label for="ed_name" class="active">Nome</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="contrato" id="ed_contrato" required >  
                                        <option value="" disabled selected></option>                                            
                                        <option @if( $dados_editar->contrato == 'PJ') selected @endif>PJ</option>                                                   
                                        <option @if( $dados_editar->contrato == 'CLT') selected @endif>CLT</option>                                                   
                                    </select>                                                
                                    <label for="ed_contrato" class="active">Contrato</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form">                                                
                                    <div class="switch switchacord2 pequeno" style="margin-left: 0; padding-left:0; margin-top: 10px">
                                        <label><input type="checkbox" style="width: 20px;" name="horas" value="1" class="checklever" id="ed_horas" />
                                        <span class="lever" style="margin-left: 0; padding-left:0"></span> ilimitado</label> 
                                        <input type="hidden" id="hidhoras" value="{{$dados_editar->horas_ilimitadas ?? ''}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="equipes_id" id="ed_equipes_id" required >                                                                            
                                        <option value="" disabled selected></option>                                            
                                                @foreach($equipe as $key => $value)
                                                    <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->equipes_id ) selected @endif >{{$value->eqnome ?? ''}}</option>
                                                @endforeach                                                         
                                        </select>                                                
                                    <label for="ed_equipes_id" class="active">Equipe</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="funcaos_id" id="ed_funcaos_id" required >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($funcao as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->funcaos_id ) selected @endif >{{$value->fndescricao ?? ''}}</option>
                                            @endforeach                                                          
                                    </select>                                                
                                    <label for="ed_funcaos_id" class="active">Função</label>
                                </div>
                            </div>
            
                            <div class="col-md-3">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="alocacaos_id" id="ed_alocacaos_id" required >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($alocacao as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->alocacaos_id ) selected @endif>{{$value->aldescricao ?? ''}}</option>
                                            @endforeach                                                     
                                    </select>                                                
                                    <label for="ed_alocacaos_id" class="active">Alocação</label>
                                </div>
                            </div> 
                            
                            
                            <div class="col-md-3">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="departamentos_id" id="ed_departamentos_id" >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($departamento as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->departamentos_id ) selected @endif>{{$value->depnome ?? ''}}</option>
                                            @endforeach                                                     
                                    </select>                                                
                                    <label for="ed_departamentos_id" class="active">Departamento</label>
                                </div>
                            </div> 
            
                            <div class="col-md-3">                                                
                                <div class="md-form">
                                    <input type="text" id="ed_tarifa" name="tarifa" class="form-control" value="{{ $dados_editar->tarifa ?? ''}}" required>
                                    <label for="ed_tarifa" class="active">Tarifa</label>
                                </div>
                            </div>  
                        
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="email" name="email" id="ed_email" class="form-control"  value="{{ $dados_editar->email ?? ''}}" required>
                                    <label for="ed_email" class="active">Login</label>
                                </div>
                            </div>                         
                            <div class="col-md-2">
                                <div class="md-form">
                                    <input type="text" name="password" id="ed_password" class="form-control"  value="">
                                    <label for="ed_password" class="active">Trocar Senha</label>
                                </div>
                            </div>
            
                            <div class="col-md-6" style="text-align: right;">
                            <div class="md-form">
                                <div class="form-check-inline">
                                    <input     class="form-check-input"    type="radio"    name="perfil"    id="ed_perfil1" value="0"  @if('0' == $dados_editar->perfil ) checked @endif   />
                                    <label class="form-check-label" for="ed_perfil1"> Normal </label>
                                </div>
            
                                <div class="form-check-inline">  
                                    <input    class="form-check-input"    type="radio"    name="perfil"    id="ed_perfil2"   value="1"   @if('1' == $dados_editar->perfil ) checked @endif  />
                                    <label class="form-check-label" for="ed_perfil2"> Administrativo </label>
                                </div>
                                @if( Auth::user()->perfil  == '2')
                                    <div class="form-check-inline">  
                                        <input    class="form-check-input"    type="radio"    name="perfil"    id="ed_perfil3"  value="2"   @if('2' == $dados_editar->perfil ) checked @endif   />
                                        <label class="form-check-label" for="ed_perfil3"> Master </label>
                                    </div>
                                @endif  
                            </div>
                            </div>
                    
                        </div>
                        <div class="footerint">
                            <button type="submit" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"><i class="fas fa-save"></i> Salvar</button>                                                                       
                        </div>                                  
                    </form>
                </div>
            </div>
          </div>

          <div class="tab-pane"id="about-fill"role="tabpanel"aria-labelledby="about-tab-fill"aria-expanded="false">
            <div class="row" style="margin-top: 30px">
                <div class="col-md-12" style="padding: 0">
                    <form name="form_informacoes_edit_retro" id="form_informacoes_edit_retro" class="col-md-12">
                        <h5 style="margin-bottom: 40px">
                            <img class="avatarp10" src="/storage/{{ $dados_editar->foto }}" style="width: 80px;"> {{ $dados_editar->name }}
                            
                        </h5>
                        <input type="hidden" id="id_geral_edit" name="id_geral" class="form-control" value="{{$dados_editar->uid}}" required>
                        @csrf                       
                        <div class="row">  
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data Início:</label>
                                    <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data Fim:</label>
                                    <input type="date" class="form-control" id="dataFim" name="dataFim" required>
                                </div>
                            </div>
                            <div class="col-md-6"> <p style="margin-top: 30px">Selecione o período das alterações.</p> </div>
                            <div class="col-md-12" style="margin-top: 30px">As opções setadas abaixo no formulário, são as atuais.</div>

                            <div class="col-md-3">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="equipes_id" id="ed_equipes_id" required >                                                                            
                                        <option value="" disabled selected></option>                                            
                                                @foreach($equipe as $key => $value)
                                                    <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->equipes_id ) selected @endif >{{$value->eqnome ?? ''}}</option>
                                                @endforeach                                                         
                                        </select>                                                
                                    <label for="ed_equipes_id" class="active">Equipe</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="funcaos_id" id="ed_funcaos_id" required >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($funcao as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->funcaos_id ) selected @endif >{{$value->fndescricao ?? ''}}</option>
                                            @endforeach                                                          
                                    </select>                                                
                                    <label for="ed_funcaos_id" class="active">Função</label>
                                </div>
                            </div>
            
                            <div class="col-md-4">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="alocacaos_id" id="ed_alocacaos_id" required >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($alocacao as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->alocacaos_id ) selected @endif>{{$value->aldescricao ?? ''}}</option>
                                            @endforeach                                                     
                                    </select>                                                
                                    <label for="ed_alocacaos_id" class="active">Alocação</label>
                                </div>
                            </div> 
                            
                            
                            <div class="col-md-4">
                                <div class="md-form">                                                
                                    <select class="mdb-select editselect colorful-select dropdown-primary md-form" name="departamentos_id" id="ed_departamentos_id" >
                                        <option value="" disabled selected></option>                                            
                                            @foreach($departamento as $key => $value)
                                                <option value="{{$value->id ?? ''}}" @if($value->id == $dados_editar->departamentos_id ) selected @endif>{{$value->depnome ?? ''}}</option>
                                            @endforeach                                                     
                                    </select>                                                
                                    <label for="ed_departamentos_id" class="active">Departamento</label>
                                </div>
                            </div> 
            
                            <div class="col-md-3">                                                
                                <div class="md-form">
                                    <input type="text" id="ed_tarifa" name="tarifa" class="form-control" value="{{ $dados_editar->tarifa ?? ''}}" required>
                                    <label for="ed_tarifa" class="active">Tarifa</label>
                                </div>
                            </div>  
                    
                    
                        </div>
                        <div class="footerint">
                            <button type="submit" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"><i class="fas fa-save"></i> Salvar</button>                                                                       
                        </div>                                  
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>

</div>
<script>

    if($('#hidhoras').val() == '1'){
        $('#ed_horas').prop("checked", true);
    }
    $(document).ready(function () {
        $('.editselect').materialSelect();     
        $('.form-control').trigger("change");     
        $('#ed_valor').mask('#.##0,00', {reverse: true});     
        $('.dropdown-content, .select-dropdown').perfectScrollbar();  
    });  
    $("#form_informacoes_edit").submit(function(e) {   
        e.preventDefault();        
        form_informacoes_edit(); 
    });
    $("#form_informacoes_edit_retro").submit(function(e) {   
        e.preventDefault();        
        form_informacoes_edit_retro(); 
    });
</script>

