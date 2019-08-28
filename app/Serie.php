<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

/* A classe Serie modela a tabela 'series' do banco usando o ORM Eloquent
 * O Eloquent ORM mapeia Objeto em Relacional e vice-versa.
 *
 * Obs.: O nome da classe deve ser igual ao nome da tabela no banco, porém no singular.
 *       Por 'baixo dos panos' o Laravel acrescenta o 's' para ficar igual ao nome da tabela no banco.
*/

class Serie extends Model
{
    /*
     *  Nas classes do Laravel (Model) não é necessário informar os seus atributos, pois eles já são definidos nas migrations.
     */

    public $timestamps = false;        // Indica que nesta tabela não precisa guardar info de tempo sobre atualização, como data/hora da ultima modificação.

    protected $fillable = ['nome'];    // Indica quais atributos da classe/entidade podem ser manipulados no Banco


    /*
     * Os relacionamentos entre entidades no Laravel (Eloquent) são feitos através de métodos, e não de atributos.
     * O nome do método 'indica' a relação com a outra entidade
    */
    public function temporadas()
    {
        return $this->hasMany(Temporada::class);  // = Esta Serie POSSUI MUITAS Temporadas
    }
}