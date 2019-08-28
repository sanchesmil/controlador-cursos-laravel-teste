<?php


namespace App\Http\Controllers;



use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;


class SeriesController extends Controller
{

    /*  O Laravel propõe uma nomenclatura padrão para determinadas ações (métodos)
     *  Ex. método index()  = busca todos os objetos (séries)
     *  Ex. método create() = exibe um formulario para criar uma série
     *  Ver mais exemplos em: https://laravel.com/docs/5.8/controllers
     */

    // Busca todas as séries
    public function index(Request $request)
    {
        // var_dump( $request->query());
        // exit();

        $series = Serie::query()->orderBy('nome')->get();           // Busca todas as séries por ordem alfabética dos seus nomes

        $mensagem = $request->session()->get('mensagem');           // Pega a mensagem da sessao

        // Redireciona p/ o arquivo de view 'index' da pasta 'series', levando as variáveis criadas.
        return view ('series.index', compact('series','mensagem')); //compact — Cria um array associativo com nomes e valores iguais aos das variáveis
    }

    // Redireciona p/ a view 'create' que exibe um formulário p/ usuário
    public function create()
    {
        return view ('series.create');
    }

    // Armazena no banco a nova série, suas temporadas e episodios
    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)   // A classe SeriesFormRequest faz a validacao dos dados vindos da view/form
    {
        // Chama a classe criadora de Serie passando os dados que vieram da view
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);

        $request->session()->flash(        // Define uma msg de sucesso na sessao HTTP que dura somente uma requisição (flash)
            'mensagem',
            "Série " . $serie->nome . " e suas temporadas e epsódios criados com sucesso!"
        );

        return redirect()->route('listar_series'); // Redireciona p/ a rota 'listar_series' definida em routes
    }

    // Remove uma série do banco
    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);  // Chama a classe removedora de série passando o Id da serie

        $request->session()->flash(        // Define msg sucesso na sessao HTTP que dura somente uma requisição (flash)
            'mensagem',
            "Série $nomeSerie excluída com sucesso!"
        );

        return redirect()->route('listar_series');    // Redireciona p/ a rota 'listar_series'
    }

    // Posso pegar diretamente o nome do parametro passado na rota (ex. id), sem usar o request.
    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;                                 // Pega o novo nome da série

        $serie = Serie::find($id);                                  // Busca uma referência à série no banco pelo Id

        $serie->nome = $novoNome;                                   // Altera o nome da série

        $serie->save();                                             // Salva no banco a alteração

        return redirect()->route('listar_series');            // Redireciona p/ a página de Séries
    }
}