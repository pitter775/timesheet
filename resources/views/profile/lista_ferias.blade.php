

<div class="card"{{$add_anima ?? ''}} >
    <div class="card-header">
        <h5><i class="far fa-calendar-alt" style="color: #ccc;"></i> @if(auth()->user()->contrato == 'PJ') Ausência @else Férias @endif Solicitadas</h5> 
    </div>
    <div class="card-body">
        <div class="row">
            <table id="example" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Inicio</th>   
                        <th>Data Fim</th>   
                        <th>Status</th>   
                        <th></th>   
          
                    </tr>
                </thead>
                <tbody>
                @foreach($dados_lista_ferias as $key => $value)
                    <tr id="tab{{ $value->id }}" class="shadomtable">
                        <td>{{ $value->id }}</td>
                        <td><span style="font-size: 1px; color:#fff">{{$value->datainicio}}</span> {{ date( 'd/m/Y' , strtotime($value->datainicio))}}</td>     
                        <td><span style="font-size: 1px; color:#fff">{{$value->datafim}}</span> {{ date( 'd/m/Y' , strtotime($value->datafim))}}</td>     
                        <td>@if($value->status == 0) <i class="fas fa-exclamation"></i> Pendente @else <i class="fas fa-check"></i> Ativo @endif</td>      
                        <td>
                        @if($value->status == 0) <a href="#" class="btn btn-outline-danger btn-rounded btn-sm waves-effect" onclick="return deletar_item('{{ $value->id }}')"><i class="fas fa-trash-alt"></i></a> @endif
                            
                        </td>
                
                    </tr>
                @endforeach                            
                </tbody>
            </table> 
        </div>                        
    </div>
</div>

<script>
    $('#example').DataTable({ 
        // dom: 'Bfrtip',
        // buttons: ['excel',  'print'],
        "pagingType": "full_numbers",
        "lengthMenu": [
                [25, 50, -1],
                [25, 50, "All"]
                ],
            "columnDefs": [{
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }], 
            responsive: true,
            order: [[ 1, 'asc' ]],
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Buscar",
        }
    });
</script>