<?php

use App\Jobs\newDisparo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

//use Illuminate\Auth;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home'); 
Route::get('disparar-email', function (){
	$user = new stdClass();
	$user->name = 'pitter web';
	$user->email = 'pitter775@gmail.com';
	//return new newDisparo($user);
	// Mail::send(new newDisparo($user));	
	// JobsNewdisparo::dispatch($user)->delay(now()->addSecond('2'));
	// JobsNewdisparo::dispatch($user)->delay(now()->addSecond('2'));
	newDisparo::dispatch($user)->delay(now()->addSecond('2'));
});
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('app/public/' . $filename); 
    if (!File::exists($path)) {
        abort(404);
    } 
    $file = File::get($path);
    $type = File::mimeType($path); 
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type); 
    return $response; 
});

Route::group(['middleware' => 'acesso'], function () {
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');  
	Route::get('/home/mudanca', 'App\Http\Controllers\HomeController@mudanca')->name('mudanca');  
	Route::post('/home/get_card', 'App\Http\Controllers\HomeController@get_card');
	Route::get('/home/atu_banco', 'App\Http\Controllers\HomeController@atu_banco');

	Route::get('/avisos', 'App\Http\Controllers\AvisosController@index')->name('avisos');
	Route::get('/avisos/disparar-email', 'App\Http\Controllers\AvisosController@enviar_email')->name('enviarEmail');
	Route::get('/avisos/add/{card}', 'App\Http\Controllers\AvisosController@add_card');
	Route::get('/avisos/delete/{id}', 'App\Http\Controllers\AvisosController@delete');
	Route::get('/avisos/editar/{id}', 'App\Http\Controllers\AvisosController@editar');
	Route::post('/avisos/cadastro', 'App\Http\Controllers\AvisosController@store'); 

	
	
	Route::get('/feriados', 'App\Http\Controllers\FeriadoController@index')->name('feriados');
	Route::get('/feriados/add/{card}', 'App\Http\Controllers\FeriadoController@add_card');
	Route::get('/feriados/delete/{id}', 'App\Http\Controllers\FeriadoController@delete');
	Route::get('/feriados/editar/{id}', 'App\Http\Controllers\FeriadoController@editar');
	Route::post('/feriados/cadastro', 'App\Http\Controllers\FeriadoController@store');


	Route::get('/meuscontratos', 'App\Http\Controllers\MeuscontratosController@index')->name('meuscontratos');
	Route::get('/meuscontratos/add/{card}', 'App\Http\Controllers\MeuscontratosController@add_card');
	Route::get('/meuscontratos/delete/{id}', 'App\Http\Controllers\MeuscontratosController@delete');
	Route::get('/meuscontratos/get_produtos/{id}', 'App\Http\Controllers\MeuscontratosController@get_produtos');
	Route::post('/meuscontratos/cadastro', 'App\Http\Controllers\MeuscontratosController@store');

	Route::get('/horas', 'App\Http\Controllers\HorasController@index')->name('horas');
	Route::get('/horas/add/{card}', 'App\Http\Controllers\HorasController@add_card');
	Route::get('/horas/delete/{id}', 'App\Http\Controllers\HorasController@delete');
	Route::get('/horas/editar/{id}', 'App\Http\Controllers\HorasController@editar'); 
	Route::post('/horas/cadastro', 'App\Http\Controllers\HorasController@store');
	Route::get('/horas/permissao_selecao', 'App\Http\Controllers\HorasController@permissao_selecao');
	Route::get('/horas/horasOk', 'App\Http\Controllers\HorasController@horasOk');

	Route::get('/contrato_produto_atividades', 'App\Http\Controllers\Contrato_produto_atividadeController@index')->name('contrato_produto_atividades');
	Route::get('/contrato_produto_atividades/add/{card}', 'App\Http\Controllers\Contrato_produto_atividadeController@add_card');
	Route::get('/contrato_produto_atividades/delete/{id}', 'App\Http\Controllers\Contrato_produto_atividadeController@delete');
	Route::get('/contrato_produto_atividades/editar/{id}', 'App\Http\Controllers\Contrato_produto_atividadeController@editar');
	Route::post('/contrato_produto_atividades/cadastro', 'App\Http\Controllers\Contrato_produto_atividadeController@store');
	Route::get('/contrato_produto_atividades/get_produto', 'App\Http\Controllers\Contrato_produto_atividadeController@get_produto');
	Route::get('/contrato_produto_atividades/get_atividade', 'App\Http\Controllers\Contrato_produto_atividadeController@get_atividade');
	Route::get('/contrato_produto_atividades/get_atividade_dataajax','App\Http\Controllers\Contrato_produto_atividadeController@get_atividade_dataajax')->name('get_atividade_dataajax');
	

	Route::get('/contrato_produtos', 'App\Http\Controllers\Contrato_produtoController@index')->name('contrato_produtos');
	Route::get('/contrato_produtos/add/{card}', 'App\Http\Controllers\Contrato_produtoController@add_card');
	Route::get('/contrato_produtos/delete/{id}', 'App\Http\Controllers\Contrato_produtoController@delete');
	Route::get('/contrato_produtos/editar/{id}', 'App\Http\Controllers\Contrato_produtoController@editar');
	Route::post('/contrato_produtos/cadastro', 'App\Http\Controllers\Contrato_produtoController@store');


	Route::get('/contratos', 'App\Http\Controllers\ContratoController@index')->name('contratos');
	Route::get('/contratos/add/{card}', 'App\Http\Controllers\ContratoController@add_card');
	Route::get('/contratos/delete/{id}', 'App\Http\Controllers\ContratoController@delete');
	Route::get('/contratos/editar/{id}', 'App\Http\Controllers\ContratoController@editar');
	Route::post('/contratos/cadastro', 'App\Http\Controllers\ContratoController@store');
	Route::get('/contratos/relacionamento', 'App\Http\Controllers\ContratoController@add_relacionamento');
	Route::get('/contratos/get_produtos/{id}', 'App\Http\Controllers\ContratoController@get_produtos');

	Route::get('/usuarios', 'App\Http\Controllers\UserController@index')->name('usuarios');
	Route::get('/usuarios/add/{card}', 'App\Http\Controllers\UserController@add_card');
	Route::post('/usuarios/cadastro', 'App\Http\Controllers\UserController@store');
	Route::get('/usuarios/editar/{id}', 'App\Http\Controllers\UserController@editar');
	Route::get('/usuarios/delete/{id}', 'App\Http\Controllers\UserController@delete');

	Route::get('/funcaos', 'App\Http\Controllers\FuncaoController@index')->name('funcaos');
	Route::get('/funcaos/add/{card}', 'App\Http\Controllers\FuncaoController@add_card');
	Route::get('/funcaos/delete/{id}', 'App\Http\Controllers\FuncaoController@delete');
	Route::get('/funcaos/editar/{id}', 'App\Http\Controllers\FuncaoController@editar'); 
	Route::post('/funcaos/cadastro', 'App\Http\Controllers\FuncaoController@store');

	Route::get('/departamentos', 'App\Http\Controllers\DepartamentoController@index')->name('departamentos');
	Route::get('/departamentos/add/{card}', 'App\Http\Controllers\DepartamentoController@add_card');
	Route::get('/departamentos/delete/{id}', 'App\Http\Controllers\DepartamentoController@delete');
	Route::get('/departamentos/editar/{id}', 'App\Http\Controllers\DepartamentoController@editar'); 
	Route::post('/departamentos/cadastro', 'App\Http\Controllers\DepartamentoController@store');

	Route::get('/municipios', 'App\Http\Controllers\MunicipioController@index')->name('municipios');
	Route::get('/municipios/add/{card}', 'App\Http\Controllers\MunicipioController@add_card');
	Route::get('/municipios/delete/{id}', 'App\Http\Controllers\MunicipioController@delete');
	Route::get('/municipios/editar/{id}', 'App\Http\Controllers\MunicipioController@editar'); 
	Route::post('/municipios/cadastro', 'App\Http\Controllers\MunicipioController@store');

	Route::get('/equipes', 'App\Http\Controllers\EquipeController@index')->name('equipes');
	Route::get('/equipes/add/{card}', 'App\Http\Controllers\EquipeController@add_card');
	Route::get('/equipes/delete/{id}', 'App\Http\Controllers\EquipeController@delete');
	Route::get('/equipes/editar/{id}', 'App\Http\Controllers\EquipeController@editar');
	Route::post('/equipes/cadastro', 'App\Http\Controllers\EquipeController@store');

	Route::get('/atividades', 'App\Http\Controllers\AtividadeController@index')->name('atividades');
	Route::get('/atividades/add/{card}', 'App\Http\Controllers\AtividadeController@add_card');
	Route::get('/atividades/delete/{id}', 'App\Http\Controllers\AtividadeController@delete');
	Route::get('/atividades/editar/{id}', 'App\Http\Controllers\AtividadeController@editar');
	Route::post('/atividades/cadastro', 'App\Http\Controllers\AtividadeController@store');

	Route::get('/empreendimentos', 'App\Http\Controllers\EmpreendimentoController@index')->name('empreendimentos');
	Route::get('/empreendimentos/add/{card}', 'App\Http\Controllers\EmpreendimentoController@add_card');
	Route::get('/empreendimentos/delete/{id}', 'App\Http\Controllers\EmpreendimentoController@delete');
	Route::get('/empreendimentos/editar/{id}', 'App\Http\Controllers\EmpreendimentoController@editar');
	Route::post('/empreendimentos/cadastro', 'App\Http\Controllers\EmpreendimentoController@store');

	Route::get('/tarifas', 'App\Http\Controllers\TarifaController@index')->name('tarifas');
	Route::get('/tarifas/add/{card}', 'App\Http\Controllers\TarifaController@add_card');
	Route::get('/tarifas/delete/{id}', 'App\Http\Controllers\TarifaController@delete');
	Route::get('/tarifas/editar/{id}', 'App\Http\Controllers\TarifaController@editar');
	Route::get('/tarifas/get', 'App\Http\Controllers\TarifaController@gettarifa');
	Route::post('/tarifas/cadastro', 'App\Http\Controllers\TarifaController@store');

	Route::get('/alocacoes', 'App\Http\Controllers\AlocacaoController@index')->name('alocacoes');
	Route::get('/alocacoes/add/{card}', 'App\Http\Controllers\AlocacaoController@add_card');
	Route::get('/alocacoes/delete/{id}', 'App\Http\Controllers\AlocacaoController@delete');
	Route::get('/alocacoes/editar/{id}', 'App\Http\Controllers\AlocacaoController@editar');
	Route::post('/alocacoes/cadastro', 'App\Http\Controllers\AlocacaoController@store');

	Route::get('/produtos', 'App\Http\Controllers\ProdutoController@index')->name('produtos');
	Route::get('/produtos/add/{card}', 'App\Http\Controllers\ProdutoController@add_card');
	Route::get('/produtos/delete/{id}', 'App\Http\Controllers\ProdutoController@delete');
	Route::get('/produtos/editar/{id}', 'App\Http\Controllers\ProdutoController@editar');
	Route::post('/produtos/cadastro', 'App\Http\Controllers\ProdutoController@store');

	Route::get('/ferias', 'App\Http\Controllers\FeriasController@index')->name('ferias');
	Route::get('/ferias/add/{card}', 'App\Http\Controllers\FeriasController@add_card');
	Route::get('/ferias/delete/{id}', 'App\Http\Controllers\FeriasController@delete');
	Route::get('/ferias/editar/{id}', 'App\Http\Controllers\FeriasController@editar');
	Route::post('/ferias/cadastro', 'App\Http\Controllers\FeriasController@store'); 

	Route::get('/atestado', 'App\Http\Controllers\AtestadoController@index')->name('atestado');
	Route::get('/atestado/add/{card}', 'App\Http\Controllers\AtestadoController@add_card');
	Route::get('/atestado/delete/{id}', 'App\Http\Controllers\AtestadoController@delete');
	Route::get('/atestado/editar/{id}', 'App\Http\Controllers\AtestadoController@editar');
	Route::post('/atestado/cadastro', 'App\Http\Controllers\AtestadoController@store'); 
	
});
Route::group(['middleware' => 'auth'], function () {
	// Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::post('/profile/ferias/cadastro', 'App\Http\Controllers\ProfileController@store_ferias');
	Route::get('/profile/ferias/delete/{id}', 'App\Http\Controllers\ProfileController@delete');

	Route::post('/profile/atestado/cadastro', 'App\Http\Controllers\ProfileController@store_atestado');
	Route::get('/profile/atestado/delete/{id}', 'App\Http\Controllers\ProfileController@delete_atestado');

	Route::post('/profile/anexos/add', 'App\Http\Controllers\ProfileController@store_anexo');
	Route::get('/profile/add/{card}', 'App\Http\Controllers\ProfileController@add_card');

	Route::get('/avisos/aviso_qnt', 'App\Http\Controllers\AvisosController@aviso_qnt'); 
	Route::get('/avisos/aviso_qnt_novo', 'App\Http\Controllers\AvisosController@aviso_qnt_novo'); 
	Route::get('/avisos/aviso_user', 'App\Http\Controllers\AvisosController@aviso_user'); 
	Route::get('/avisos/aviso_visto', 'App\Http\Controllers\AvisosController@aviso_visto'); 
	
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

