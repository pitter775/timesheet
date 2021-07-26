@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'criacao',
    'elementActive2' => 'atestado'
])

@section('content')
<div class="modal fade" id="myModal_lista" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content" id="retorno_modal_lista"></div>
    </div>
</div>

<div class="modal fade" id="myModal_foto" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <h5>Atestado Médico</h5>
            </div>
            <div aling="center" class="modal-body divverfoto" style="padding: 0 0 20px 0; text-align: center">
            
            </div>
        </div>
    </div>
</div>

    <div class="content">
        <div class="row">
            <div class="col-md-12" id="card_lista"></div>
        </div>
    </div>

@endsection

@push('scripts')
    @extends('pages.atestado.script_page')  

    <script>
    $(document).ready(function () { 
       add_cards(null);         
    });      
    </script>
@endpush