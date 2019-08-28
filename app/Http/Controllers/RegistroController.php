<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{

    // Redireciona p/ a view de criação do usuário
    public function create()
    {
        return view('registro.create');
    }

    /**
     * @param Request $request
     */
    public function story(Request $request)
    {
        $data = $request->except('_token');           // Pega todas os campos retornados do form, menos o token

        $data['password'] = Hash::make($data['password']); // Realiza a criptografia da senha criando um Hash (Padrão do Laravel)

        $user = User::create($data);                      // Cria um usuário

        Auth::login($user);                                // Realiza o login/cadastro do usuário no banco

        return redirect()->route('listar_series');


    }
}
