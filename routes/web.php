<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| MIDDLEWARE
| Neste arquivo de rotas foi usado o middleare 'autenticador' para proteger algumas rotas de acesso indevido. 
| Nem todas as rotas necessitam que o usuário esteja autenticado para acessá-la, como por
| exemplo, a rota que mostra as séries. Neste caso, todos os visitantes poderão visualizar as séries.
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/series', 'SeriesController@index')         // Redireciona p/ o método index() do controller 'SeriesControler' (via GET).
       ->name('listar_series');                         // Dá um apelido (alias) para a rota
                                                        //Obs.: O apelido (alias) garante que a funcionalidade continue operando nas views e controllers mesmo que a rota seja alterada

Route::get('/series/criar', 'SeriesController@create')  // Redireiona p/ o form de criação de série
    ->name('form_criar_serie')                          // Dá um 'alias/nome' para a rota que cria uma série (via GET)
    ->middleware('autenticador');                       // Protege a rota, chamando o middler de autententicacao de usuarios antes de redirecionar p/ o método 'create' do controller;

Route::post('/series/criar', 'SeriesController@store')  // Armazena a nova série no banco (via POST)
    ->middleware('autenticador');                       // Antes de criar a série, chama o middler de autenticacao de usuarios

Route::delete('/series/{id}', 'SeriesController@destroy') // Exclui uma série do banco (via DELETE) passando um argumento
    ->middleware('autenticador');

Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/temporadas/{temporadaId}/episodios', 'EpisodiosController@index');

Route::post('/temporadas/{temporadaId}/episodios/assistir', 'EpisodiosController@assistir')  // Marcar os episódios como assistidos
    ->middleware('autenticador');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');        //Chama o controller que lida com o login na aplicação
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@story');

// Desloga o usuário
Route::get('/sair', function (){
    Auth::logout();
    return redirect('/entrar');  // Redireciona p/ página de login
});
