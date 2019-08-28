<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    /*
     *  Nas classes do Laravel (Model) não é necessário informar os seus atributos, pois eles já são definidos nas migrations.
     */

    public $timestamps = false;              // Indica que nesta tabela não precisa guardar info de tempo sobre atualização, como data/hora da ultima modificação.

    protected $fillable = ['numero'];        // Indica quais campos podem ser inseridos/manipulados no Banco


    /*
     * Obs.: No Laravel, o relacionamento entre entidades é feito através dos métodos.
     */

    // Implementa o lado N do relacionamento 1 - N, onde cada Temporada possui N episodios.
    public function episodios()
    {
        return $this->hasMany(Episodio::class); // Retorna os episodios desta Temporada
    }

    // Implementa o lado 1 do relacionamento 1 - N, onde cada Temporada PERTENCE a 1 serie.
    public function serie()
    {
        return $this->belongsTo(Serie::class);   // Retorna a qual Serie esta Temporada 'PERTENCE'
    }

    // Retorna uma lista de episódios assistidos
    public function getEpisodiosAssistidos() : Collection
    {
        return $this->episodios->filter(function (Episodio $episodio){     // Filtra cada episódio e no fim retorna uma lista de episodios assistidos
            return $episodio->assistido;                                   // Se o episodio foi assistido, acrescenta na lista de episódios assistidos
        });
    }
}
