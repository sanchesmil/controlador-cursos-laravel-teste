@extends('layout')

@section('cabecalho')
    Registrar-se
@endsection

@section('conteudo')

    <!-- Exibe os erros de validação (padrão do Laravel) -->
    @include('erros', ['errors'=>$errors])    <!-- Inclui a página de erros passando os $errors que vieram do controller -->

    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Entrar
        </button>
    </form>
@endsection