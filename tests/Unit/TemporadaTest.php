<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


/*
 * Realiza testes Unitários
 *
 */
class TemporadaTest extends TestCase
{
    /** @var Temporada */
    private $temporada;

    // Método chamado antes de cada teste para montar o Cenário de testes
    protected function setUp(): void
    {
        parent::setUp();

        // Monta o Cenário de testes
        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true;

        $episodio2 = new Episodio();
        $episodio2->assistido = false;

        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function testEpisodiosAssistidos()
    {
        // Recupera os epsodios assistidos
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();

        $this->assertCount(2, $episodiosAssistidos);  // Testa se são 2 episódios assistidos na temporada

        // Testa se a propriedade 'assistido' dos episódios assistidos é realmente 'true'
        foreach ($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testBuscaTodosOsEpisodios()
    {
        $episodios = $this->temporada->episodios;

        $this->assertCount(3, $episodios);
    }
}
