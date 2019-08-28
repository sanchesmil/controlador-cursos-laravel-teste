<?php


namespace App\Services;


use App\Serie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/*
 * Classe de 'ajuda' ou 'helper' que cria uma Serie, suas temporadas e episódios
 */
class CriadorDeSerie
{

    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada) : Serie
    {
        DB::beginTransaction();                                 // Abre uma transação

            $serie = Serie::create(['nome'=> $nomeSerie]);      // create = cria e já salva no banco uma nova série a partir do seu nome
                                                                // Obs.: 'create' substitui a instanciação 'new Serie()' e save()

            $this->criarTemporadas($serie,$qtdTemporadas,$epPorTemporada);  // Chama método que cria temporadas

        DB::commit();                                                    // Confirma a transação

        return $serie;
    }

    private function criarTemporadas(Serie $serie, int $qtdTemporadas, int $epPorTemporada)
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);   // Cria as Temporadas através da Serie (o Eloquent já faz o relacionamento)

            $this->criarEpisodios($temporada, $epPorTemporada);            // Chama método que cria episódios
        }
    }

    private function criarEpisodios(Model $temporada, int $epPorTemporada)
    {
        for ($j = 1; $j <= $epPorTemporada; $j++){
            $temporada->episodios()->create(['numero'=> $j]);              // Cria os Episódios de cada Temporada (o Eloquent já faz o relacionamento)
        }
    }
}