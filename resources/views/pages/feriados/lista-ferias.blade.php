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