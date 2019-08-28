<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(int $temporadaId, Request $request)
    {
        $temporada = Temporada::find($temporadaId);

        $nomeTemporada = $temporada->numero;

        $episodios = $temporada->episodios;

        //var_dump($episodios);

        $mensagem = $request->session()->get('mensagem');   // Pega a mensagem da sessao se existir

        return view('episodios.index', compact('episodios','nomeTemporada', 'temporadaId', 'mensagem'));
    }

    public function assistir(int $temporadaId, Request $request)
    {
        $episodiosAssistidos = $request->episodios;       // Pega o array de episódios marcados como assistidos da view

        $temporada = Temporada::find($temporadaId);       // Busca a temporada no banco pelo Id

        $episodiosTemporada = $temporada->episodios;      // Pega todos os episódios da temporada

        // Percorre todos os episódios da temporada e atualiza aqueles que estão no array de $episodiosAssistidos
        $episodiosTemporada->each(function (Episodio $episodio) use ($episodiosAssistidos){

                // Atualiza o campo 'assistido' do episodio
                $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);  // Se o episódio estiver no array => assistido = true, caso contrário, false.
        });

        $temporada->push();             // Atualiza a temporada e os seus episódios no banco

        $request->session()->flash(     // Define msg sucesso na sessao HTTP que dura somente uma requisição (flash)
            'mensagem',
            "Episódios marcados como assistidos!"
        );

        return redirect()->back();      // Redireciona o usuário p/ a última página visitada (= view de episodios da temporada)
    }
}
