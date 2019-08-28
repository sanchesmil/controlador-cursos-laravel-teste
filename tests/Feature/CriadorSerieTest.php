<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\CriadorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


/*
 *  Testes de Integração com o Banco de Dados
 */

class CriadorSerieTest extends TestCase
{
                           // Trait que atualiza o banco especificamente criado para testes
    use RefreshDatabase;   // Informa ao laravel que vou utilizar o banco de dados SQLITE em memória

    public function testCriarSerie()
    {
        $criadorSerie = new CriadorDeSerie();
        $nomeSerie = 'Nome série test phpUnit';

        //Cria uma série com 6 temporadas e 10 episódios em cada temporada.
        $serie = $criadorSerie->criarSerie($nomeSerie, 6, 10);

        $this->assertInstanceOf(Serie::class,$serie);                 // Verifica se a variavel $serie é do tipo 'Serie'
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);       // Verifica se a série foi realmente incluída no banco consultando o seu nome
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serie->id, 'numero' => 1]); // Verifica no banco se existe a 1ª temporada desta série
        $this->assertDatabaseHas('episodios', [ 'numero' => 1]);          // Verifica no banco se existe um episodio com número 1

    }

}
