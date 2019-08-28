
<!-- Extende o tamplate padrão 'layout' = Recurso do Blade -->
@extends('layout')

@section('cabecalho')   <!-- Define as sessoes / áreas de conteúdo -->
    Entrar
@endsection

@section('conteudo')

    <!-- Exibe os erros de validação (padrão do Laravel) -->
    @include('erros', ['errors'=>$errors])     <!-- Inclui a página de erros passando os $errors que vieram do controller -->

    <form method="post">  <!-- Submete para esta mesma página -->
        @csrf
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

        <a href="/registrar" class="btn btn-secondary mt-3">
            Registrar-se
        </a>
    </form>

@endsection