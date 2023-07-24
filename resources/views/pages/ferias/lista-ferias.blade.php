


<table id="example3" class="table table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Horas</th>
            <th>Data Antiga</th>   
            <th>Data Nova</th>                
        </tr>
    </thead>
    <tbody>
    @foreach($cadastrar as $key => $value)
        <tr class="shadomtable">
            <td>{{$value['fn_descricao']}}</td>
            <td>{{$value['horas']}}</td>
            <td>{{ date( 'd/m/Y' , strtotime($value['fn_data_antiga']))}}</td>     
            <td> {{ date( 'd/m/Y' , strtotime($value['fn_data']))}}</td>             
        </tr>
    @endforeach                            
    </tbody>
</table> 
