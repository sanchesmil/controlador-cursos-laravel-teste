<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Classe que manipula os pedidos de autenticação
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->is('entrar', 'registrar')  // Se a solicitação não for para as páginas de 'entrar' ou 'registrar'
            &&!Auth::check()) {                  // e o usuário não estiver logado: redireciona p/ página de 'entrar'
           return redirect('/entrar');
        }
        return $next($request);                  // Caso o usuário já esteja autenticado, continua a execução, encaminhando p/ o próximo middler (se houver) ou o controller;
    }
}
