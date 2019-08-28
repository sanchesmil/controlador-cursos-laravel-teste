<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Temporada;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(Request $request)
    {
         //echo $request->serieId;

         $serie = Serie::find($request->serieId); // Busca a série conforme Id com todos os seu atributos (+ pesado)

         $nomeSerie = $serie->nome;               // Busca o nome da série

         $temporadas = $serie->temporadas;        // Busca todas as temporadas da serie informada

         // ou Buscando diretamente as temporadas ( + leve):

         // $temporadas = Temporada::query()->where('serie_id', $request->serieId)->orderBy('numero')->get();

         return view('temporadas.index', compact('temporadas','nomeSerie'));
    }
}
