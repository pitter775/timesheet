<?php

namespace App\Http\Controllers;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;


class MunicipioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
      return view("pages.municipios.index");
    }

    public function add_card($card){
      $cards = explode("-", $card);
      $anima_create = $cards[1] == 1?'data-aos=fade-left data-aos-delay=0':'';  
      $anima_lista = $cards[1] == 1?'data-aos=fade-left data-aos-delay=200':'';  

      switch ($cards[0]) {
        case 'lista':               
            return $this->add_lista($anima_lista);
            break;
        case 'create':
          return $this->add_create($anima_create);
            break;
      }      
    }

    public function add_lista($add_anima){
      $dados_lista  = Municipio::all();   
      return view("pages.municipios.lista", compact('dados_lista','add_anima'));
    }

    public function add_create($add_anima){
      return view("pages.municipios.create", compact('add_anima'));  
    }

    public function editar($id){
        $dados_editar = Municipio::find($id);
        return view("pages.municipios.editar", compact('dados_editar'));  
    }

    public function store(Request $request){
        $id_geral = $request->input('id_geral');
        
        
        if($id_geral == ''){
          $tem = Municipio::where('muninome', $request->input('muninome'))->get();
          if(!count($tem) == 0){return 'erro, Já existe esse item cadastrado no sistema.';}
          // CADASTRA          
          $dados = new Municipio();
        }else{
          // ATUALIZA
          $dados = Municipio::find($id_geral);
          if($dados->muninome !== $request->input('muninome')){
            $tem = Municipio::where('muninome', $request->input('muninome'))->get();
            if(!count($tem) == 0){return 'erro, Já existe esse item cadastrado no sistema.';}
          }
        }
        $dados->muninome = $request->input('muninome');
        $dados->save();     
        return $dados->id;
    }
    public function delete($id){
        $deletar = Municipio::find($id);
        if(isset($deletar)){
            try {
                $deletar->delete();
                return 'Removido com sucesso!';
            }catch (PDOException $e) {
                if (isset($e->errorInfo[1]) && $e->errorInfo[1] == '1451') {
                    return 'Erro, esse item esta comprometido em outro relacionamento.';
                }
            }
        }
    }
}
