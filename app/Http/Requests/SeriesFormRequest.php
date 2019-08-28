<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{

    // Verifica se o usuário está autorizado a fazer a solicitação.
    public function authorize()
    {
        return true;    //A princípio, todos os usuários vão poder solicitar
    }

    // Define as regras de validação
    public function rules()
    {
        // Mapeia conforme 'campo'->'regras', onde 'campo' = nome do campo e 'regras' = regras aplicáveis ao campo
        return [
            'nome' => 'required | min:3',      // Define que o campo 'nome' é obrigatório e que deve possuir pelo menos 3 caracteres.

        ];
    }

    // Define mensagens personalizadas em PORTUGUÊS
    public function messages()
    {
        // Mapeia o nome da regra para uma resposta em português.
        return [
            'required'    => 'O campo :attribute é obrigatório!',  // :attribute => Substitui dinamicamente o nome do campo (+ genérico)
            'nome.min'    => 'O campo nome precisa ter pelo menos 3 caracteres!'
         ];
    }
}
