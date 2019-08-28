<?php

namespace App\Services;


use App\{ Episodio, Serie, Temporada};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string
    {
        $nomeSerie = '';

        DB::transaction(function () use ($serieId, &$nomeSerie){  // Abre uma transação e executa uma função passando o id e uma variável por referência

            $serie = Serie::find($serieId);                       // Busca a serie do banco pelo Id

            $nomeSerie = $serie->nome;                            // Define o nome da Série

            $this->removerTemporadas($serie);                     // 1º Deleta as temporadas da Serie

            $serie->delete();                                     // 2º Deleta a serie após deletar todas as temporadas
        });

        return $nomeSerie;                                        // Retorna o nome da serie
    }

    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {     // Para cada temporada de uma série chama função que deleta a temporada

            $this->removerEpisodios($temporada);                       // 1º Deleta todos os episódios da temporada

            $temporada->delete();                                      // 2º Deleta a temporada após deletar todos os episódios
        });
    }

    private function removerEpisodios(Temporada $temporada) : void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {  // Para cada episodio de uma temporada chama função que deleta o episodio
            $episodio->delete();                                       // Deleta o episodio da temporada
        });
    }

}