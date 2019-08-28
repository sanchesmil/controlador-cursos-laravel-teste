<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
     }

    /*
     * Tenta realizar o login do usuário consultando o banco de dados. Retorna true ou false
     *
     * Por padrão, o Laravel utiliza esses nomes para autenticação (email e password)
     *
     * Obs.: Qd o usuário consegue logar, o Laravel armazena na sessão um TOKEN que representa este usuário
    */
    public function entrar(Request $request)
    {
        $dadosRequisicao = $request->only(['email','password']);  // Retorna um array associativo já preenchido com os valores da view

        if(!Auth::attempt($dadosRequisicao)){                     // tenta realizar o login do usuário
            return redirect()
                ->back()                                          // Redireciona p/ página anterior
                ->withErrors('Usuário e/ou senha incorretos.');   // Define e retorna msg de erro

        }

        return redirect()->route('listar_series');                  // Caso logado, redireciona p/ view de séries

     }
}
