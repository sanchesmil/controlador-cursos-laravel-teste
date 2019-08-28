<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/*
 *  Realiza testes de Integração com o Banco de Dados
 */

class RemovedorSerieTest extends TestCase
{
                           // Trait que atualiza o banco especificamente criado para testes
    use RefreshDatabase;   // Informa ao laravel que vou utilizar o banco de dados SQLITE em memória

    /** @var Serie */
    private $serie;

    // Prepara o cenario, cria uma serie
    protected function setUp(): void
    {
        parent::setUp(); 

        $nomeSerie = 'Novo teste phpUnit';
        $criadorSerie = new CriadorDeSerie();
        $this->serie = $criadorSerie->criarSerie($nomeSerie,4,6);
    }

    public function testRemoverSerie()
    {

        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);   // Verifica se a série foi realmente incluída no banco

        $removedorSerie = new RemovedorDeSerie();

        $nomeSerie = $removedorSerie->removerSerie($this->serie->id);  // Remove a série do banco e retorna o nome dela

        $this->assertIsString($nomeSerie);       // Verifica se o retorno da remoção é do tipo string

        $this->assertDatabaseMissing('series', ['id' => $this->serie->id, 'nome'=> $nomeSerie]);    // Verifica se a série realmente não existe no banco
    }
}
