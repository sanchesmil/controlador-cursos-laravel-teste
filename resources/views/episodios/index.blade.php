<!-- Extende o tamplate padrão 'layout' = Recurso do Blade -->
@extends('layout')

@section('cabecalho')   <!-- Define as sessoes / áreas de conteúdo -->
    Episódios da temporada {{$nomeTemporada}}
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem'=> $mensagem])   <!-- Chama a 'subwiew' 'mensagem' passando uma mensagem p/ ser exibida -->

    <form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            <!-- Sintaxe do blade p/ tratar com PHP -->
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}

                    <!-- Cria um checkbox e define uma array de episódios [] que foram marcados como assistidos -->
                    <input type="checkbox"
                           name="episodios[]"
                           value="{{$episodio->id}}"
                           {{$episodio->assistido ? 'checked' : ''}} 
                    >
                    <!-- No carregamento da página marca 'checked' se o episódio já foi assistido  -->
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
@endsection