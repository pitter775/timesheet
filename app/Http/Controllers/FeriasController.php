<?php

namespace App\Http\Controllers;
use App\Models\Feria;
use App\Models\Feriado;
use App\Models\Feriado_users;
use App\Models\History_add;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use PDOException;
use Carbon\Carbon;



   class FeriasController extends Controller
   {
      public function __construct(){
         $this->middleware('auth');
      }
      public function index(){
         return view("pages.ferias.index");
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
         $dados_lista  = DB::table('ferias AS f')
         ->join('users', 'users.id', '=', 'f.users_id')
         ->select('*', 'f.id AS id', 'f.status As status')
         ->get();
         return view("pages.ferias.lista", compact('dados_lista','add_anima'));
      }

      public function add_create($add_anima){
         $usuarios = User::orderBy('name')->get();
         return view("pages.ferias.create", compact('add_anima', 'usuarios')); 
      }

      public function editar($id){
         
         $dados_editar  = DB::table('ferias AS f')
         ->join('users', 'users.id', '=', 'f.users_id')
         ->select('*', 'f.id AS id', 'f.status As status')
         ->where('f.id', $id)
         ->first();
         return view("pages.ferias.editar", compact('dados_editar'));  
      }



      public function verificadata($dateEndF, $iduser){

  

         $tem = false;
         $semana =  Carbon::parse($dateEndF)->format('l');

            if($semana == 'Friday'){
               $tem = true;
               $dateEndF->modify('+3day');
            } 
            if($semana == 'Saturday'){
               $tem = true;
               $dateEndF->modify('+2day');
            }
            if($semana == 'Sunday'){
               $tem = true;
               $dateEndF->modify('+1day');
            }
            if(!$tem){
               $dateEndF->modify('+1day');
            }


         $feriadosff  = DB::table('feriados as f')
         ->where([['f.fn_data', $dateEndF->format('Y-m-d')]])    
         ->get();  
         
         foreach($feriadosff as $fer){

            if($fer->horas_user == 0){
               $dateEndF->modify('+1day');
            }
            if($fer->horas_user == 1){
               $feriadosH  = DB::table('feriados as f')
               ->join('feriado_users', 'feriado_users.feriados_id', '=', 'f.id')
               ->where([['feriado_users.users_id', $iduser], ['f.fn_data', $dateEndF->format('Y-m-d')]])
               ->first(); 

               if(isset($feriadosH->fn_data)){
                  $dateEndF->modify('+1day');
               }
            }

         }            

         $semana2 =  Carbon::parse($dateEndF)->format('l');
         if($semana2 == 'Saturday'){    
            $dateEndF->modify('+2day');
         }
         if($semana2 == 'Sunday'){     
            $dateEndF->modify('+1day');
         }     
 

         return $this->dataok($dateEndF, $iduser);             
      }


      

      public function dataok($dateEndF, $iduser){        

      

         $impedido = false;
         $feriadosff  = DB::table('feriados as f')
         ->where([['f.fn_data', $dateEndF->format('Y-m-d')]])    
         ->get();  
         
         foreach($feriadosff as $fer){

            if($fer->horas_user == 0){
               $impedido = true;
            }
            if($fer->horas_user == 1){
               $feriadosH  = DB::table('feriados as f')
               ->join('feriado_users', 'feriado_users.feriados_id', '=', 'f.id')
               ->where([['feriado_users.users_id', $iduser], ['f.fn_data', $dateEndF->format('Y-m-d')]])
               ->first(); 

               if(isset($feriadosH->fn_data)){
                  $impedido = true;
               }
            }

         }        

       
         if($impedido){         
            return $this->verificadata($dateEndF, $iduser);
         }else{          
            return $dateEndF;
         }
      }


      

      public function verComp(Request $request){

        

         //bater em cada data das ferias e ver se tem na tabela de feriados
         $userids = null;
         $cadastrar = null;
         $history_cad = null;
         if($request->input('datainicio')){         
            $dateStart = $this->dateEmMysql($request->input('datainicio'));
            $dateEnd = $this->dateEmMysql($request->input('datafim'));   
            
            $dateStart = new DateTime($dateStart); 
            $dateEnd = new DateTime($dateEnd);   

            $dateEndF =  $dateEnd;  


            $dateEndFG = $this->dateEmMysql($request->input('datafim'));   
            $dateEndFG =  new DateTime($dateEndFG);  




            

            while ($dateStart < $dateEnd) {             
               $feriados  = DB::table('feriados as f')
               ->where('f.feriados_tipos_id', 9)
               ->whereBetween('f.fn_data', [$dateStart->format('Y-m-d'), $dateEnd->format('Y-m-d')])
               ->select('*', 'f.id AS id')
               ->get();    


          
               
               
               foreach($feriados as $val){     
                  
                  if($dateStart->format('Y-m-d') == $val->fn_data      &&      $dateStart->format('Y-m-d') <= $dateEndFG->format('Y-m-d')){           
                              
                     if($val->horas_user == 0){
                        //todos, entao acrescentar o mesmo depois das ferias 



                        $dateEndF2 = $this->verificadata($dateEndF, $request->input('usuario'));              
                        
       



                        $cadastrar[] = ['fn_data' => $dateEndF2->format('Y-m-d'), 
                                          'fn_data_antiga' => $val->fn_data,
                                          'fn_descricao' => $val->fn_descricao,
                                          'feriados_tipos_id' => $val->feriados_tipos_id,
                                          'horas'=> $val->horas,
                                          'horas_user'=> 1,
                                          'users_id'=> $request->input('usuario'),
                                         ]; 

                     }
                     if($val->horas_user == 1){
                        $feriadosH  = DB::table('feriados as f')
                        ->join('feriado_users', 'feriado_users.feriados_id', '=', 'f.id')
                        ->where([['feriado_users.users_id', $request->input('usuario')], ['f.fn_data', $val->fn_data]])
                        ->first(); 


                        if(isset($feriadosH->fn_data)){
                           $dateEndF2 = $this->verificadata($dateEndF, $request->input('usuario'));  
                           $cadastrar[] = ['fn_data' => $dateEndF2->format('Y-m-d'), 
                                          'fn_data_antiga' => $val->fn_data,
                                          'fn_descricao' => $val->fn_descricao,
                                          'feriados_tipos_id' => $val->feriados_tipos_id,
                                          'horas'=> $val->horas,
                                          'horas_user'=> 1,
                                          'users_id'=> $request->input('usuario'),
                                         ];  
                        }                     

                     }

                  };
               }         
               $dateStart = $dateStart->modify('+1day');
            }

            // return var_dump($cadastrar);


            if(isset($cadastrar)){
               foreach ($cadastrar as $cad){
                  $dados = new Feriado();
                  $dados->fn_data = $cad['fn_data'];
                  $dados->fn_descricao = $cad['fn_descricao'];
                  $dados->feriados_tipos_id =  $cad['feriados_tipos_id'];
                  $dados->horas = $cad['horas'];
                  $dados->horas_user = 1;                  
                  $dados->users_id_atualizou = Auth::user()->id;
                  $dados->save(); 

                  $history_cad[] = [ 'feriado_id'=> $dados->id, 'users_id'=> $cad['users_id' ]];    

                  $dados_user = new Feriado_users();
                  $dados_user->feriados_id = $dados->id;
                  $dados_user->users_id  = $cad['users_id'];
                  $dados_user->save(); 
               }
            }
         }
         


         return $this->store($request, $cadastrar, $history_cad);

      }



      public function store($request, $cadastrar, $history_cad){


          
         $id_geral = $request->input('id_geral'); 
         
         if($id_geral == ''){
            // CADASTRA               
            $datainicio = $this->dateEmMysql($request->input('datainicio'));
            $datafim = $this->dateEmMysql($request->input('datafim'));   
                   
            $dados = new Feria();
            $dados->datainicio = $datainicio;
            $dados->datafim = $datafim;
            $dados->users_id = $request->input('usuario');      

            
         }else{
            // ATUALIZA
            $dados = Feria::find($id_geral);
            $dados->status = $request->input('status');
          
         }
         $dados->save();  
          
         if(isset($history_cad)){
            foreach($history_cad as $cad){
               $history = new History_add();
               $history->feriados_id = $cad['feriado_id'];
               $history->users_id  = $cad['users_id'];
               $history->ferias_id  = $dados->id;
               $history->save(); 
            }
         }

         if($cadastrar){
            return view("pages.ferias.lista-ferias", compact('cadastrar'));          
         }
         return '2';
      }



      public function delete($id){
         $deletar = Feria::find($id);
         if(isset($deletar)){
               try {

                  $history = History_add::where('ferias_id', $id)->get();

                  if( $history){
                     foreach($history as $hist){

                        $Feriado_users = Feriado_users::where('feriados_id', $hist->feriados_id)->get();
                        if($Feriado_users){
                           foreach($Feriado_users as $feruser){
                              $del1= Feriado_users::find($feruser->id);
                              if(isset($del1)){
                                 $del1->delete();
                              }
                           }
                        }                                             
                        
                        $del2 = History_add::find($hist->id);
                        if(isset($del2)){
                           $del2->delete();
                        }   
                        
                        $del3 = Feriado::find($hist->feriados_id);
                        if(isset($del3)){
                           $del3->delete();
                        } 
                     }
                  }

                  $deletar->delete();
                  return 'Removido com sucesso!';
               }catch (PDOException $e) {
                  if (isset($e->errorInfo[1]) && $e->errorInfo[1] == '1451') {
                     return 'Erro, esse item esta comprometido em outro relacionamento.';
                  }
               }
         }
      }
      public static function dateEmMysql($dateSql){
         $ano= substr($dateSql, 6);
         $mes= substr($dateSql, 3,-5);
         $dia= substr($dateSql, 0,-8);
         return $ano."-".$mes."-".$dia;
      }
   }
