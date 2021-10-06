<div class="modal-header justify-content-center">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
    <h5>{{$dados_editar->name}}</h5>
</div>
<div class="modal-body" style="padding: 0 ">
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12">
           <h6 style="font-weight: 400; margin: -20px 0 30px 0; color: #777 ">Atestado Médico</h6>
        </div>
        @if($dados_editar->tipo == 'dias')
        <div class="col-md-6">
           <p style="font-weight: 600;"><span style="color: #777; margin-right: 10px">Data de ínicio:</span> <i class="far fa-calendar-alt" style="color: #ccc;"></i> {{ date( 'd/m/Y' , strtotime($dados_editar->datainicio))}}</p> 
        </div>
        <div class="col-md-6">
            <p style="font-weight: 600;"><span style="color: #777; margin-right: 10px">Data de fim:</span> <i class="far fa-calendar-alt" style="color: #ccc;"></i> {{ date( 'd/m/Y' , strtotime($dados_editar->datafim))}}</p>
        </div>
        @endif
        @if($dados_editar->tipo == 'horas')
        <div class="col-md-6">
           <p style="font-weight: 600;"><span style="color: #777; margin-right: 10px">Data:</span> <i class="far fa-calendar-alt" style="color: #ccc;"></i> {{ date( 'd/m/Y' , strtotime($dados_editar->datainicio))}}</p> 
        </div>
        <div class="col-md-6">
            <p style="font-weight: 600;"><span style="color: #777; margin-right: 10px">Horas:</span> <i class="far fa-calendar-alt" style="color: #ccc;"></i> {{ $dados_editar->horas}}</p>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <form name="form_informacoes_edit" id="form_informacoes_edit" class="col-md-12">
                <input type="hidden" id="id_geral_edit" name="id_geral" class="form-control" value="{{$dados_editar->id}}" required>
                <input type="hidden" id="status" name="status" class="form-control" value="{{$dados_editar->status}}" required>
                @csrf                       
                <div class="row">                                            
                    <div class="col-md-6">                                                
                        <div class="switch switchacord" style="padding: 20px 0 20px 5px;" >
                            <label>
                                <span style="color: #777;">Pendente</span>
                                <input type="checkbox" value="01"  class="checkprod" id="checkprod01" @if($dados_editar->status == 1) checked @endif >
                                <span class="lever"></span>
                                <span style="color: #25598a;">Aceitar</label>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-primary btn-sm btn-rounded waves-effect"><i class="fas fa-save"></i> Salvar</button>
                    </div>                                 
                </div>
                <div class="footerint" style="padding: 10px;">
                    <img src="/storage/{{$dados_editar->foto}}" >
                </div>                                  
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.form-control').trigger("change");      
    });  
    $("#form_informacoes_edit").submit(function(e) {   
        e.preventDefault();        
        form_informacoes_edit(); 
    });
    $(document).on('change', '.checkprod', function() {
        if($(this).is(":checked")){
            $('#status').val(1);

        }else{
            $('#status').val(0);

        }
    });
</script>

