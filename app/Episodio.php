<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    /*
     *  Nas classes do Laravel (Model) não é necessário informar os seus atributos, pois eles já são definidos nas migrations.
     */

    public $timestamps = false;              // Indica que nesta tabela não precisa guardar info de tempo sobre atualização, como data/hora da ultima modificação.

    protected $fillable = ['numero'];        // Indica quais campos podem ser inseridos/manipulados no Banco


    /*
     * Obs.: No Laravel, o relacionamento entre entidades é feito através dos métodos.
     */

    // Retorna a temporada deste episódio
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);  // Retorna a Temporada a qual este Episodio 'PERTENCE'
    }
}
