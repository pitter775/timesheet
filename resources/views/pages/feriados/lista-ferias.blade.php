<div style="padding: 10px">



@if($users)
<h5>Usuários em férias</h5>
<table id="example3" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Férias Início</th>   
            <th>Férias Fim</th>   
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $value)
        <?php
            $status = 'Pendente';
            if($value['status'] == '1'){ $status = 'Ativo'; }
        ?>
        
        <tr class="shadomtable">
            <td>{{ $value['name'] }}</td>
            <td><span style="font-size: 1px; color:#fff">{{$value['datainicio']}}</span> {{ date( 'd/m/Y' , strtotime($value['datainicio']))}}</td>     
            <td><span style="font-size: 1px; color:#fff">{{$value['datafim']}}</span> {{ date( 'd/m/Y' , strtotime($value['datafim']))}}</td>     
            <td>{{$status}}</td>
        </tr>
    @endforeach                            
    </tbody>
</table> 
<div style="margin-bottom: 50px"></div>
@endif

@if($dados_feriados_ok)
<h5>Outras informações desse dia</h5>
<table id="example" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Data</th>    
            <th>Descricao</th>    
            <th>Tipo</th>    
            @if(auth()->user()->perfil !== '2')
            <th style="width: 30px;"></th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($dados_feriados_ok as $key => $value)
        <tr id="tab{{ $value['id'] }}" class="shadomtable">
            <td>{{ $value['id'] ?? ''  }}</td>
            <td>
                <?php
                    if($value['feriados_tipos_id'] == 9 ){
                        if($value['name'] == ''){
                            echo 'Nenhum usuário';
                        }else{
                            echo $value['name'];
                        }
                    }else {
                        echo 'Todos';
                    }    
                ?>
            </td>
            <td><span style="font-size: 1px; color:#fff">{{$value['fn_data'] ?? '' }}</span><span style="font-size: 1px; color:#fff">{{$value['fn_data']}}</span> {{ date( 'd/m/Y' , strtotime($value['fn_data']))}}</td>
            <td>{{ $value['fn_descricao'] ?? '' }}</td>                                    
            <td>{{ $value['ftdescricao'] ?? '' }}</td>                                    
            
            <td>
                <a href="#" class="btn btn-outline-danger btn-rounded btn-sm waves-effect" onclick="return deletar_item('{{ $value['id'] }}')"><i class="fas fa-trash-alt"></i></a>
            </td>
            
        </tr>
    @endforeach                            
    </tbody>
</table> 
@endif





</div>