<?php

namespace App\Http\Controllers;

use App\Episodio;
use Illuminate\Http\Request;

class EpisodiosController {

    public function index(Request $request){
        return Episodio::all();
    }

    public function store(Request $request){

        //return response()->json(Serie::create(['nome' => $request->nome]), 201);
        return response()->json(Episodio::create($request->all()), 201);

    }

    public function show(int $id){
        $recurso = Episodio::find($id);
        if(is_null($recurso)){
            return response()->json('', 204);
        }
        return response()->json($recurso); 

    }

    public function update(int $id, Request $request){
        $recurso = Episodio::find($id);

        if(is_null($recurso)){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        //pega todos os dados da requisicao no caso da serie, o unico obrigatorio é nome, demais coisas ele ignora
        $recurso->fill($request->all());
        $recurso->save();

        return response()->json($recurso); 

    }

    public function destroy(int $id){
        $qtdRecursoRemovidos = Episodio::destroy($id);
        if($qtdRecursoRemovidos === 0){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        return response()->json('', '200'); 
    }

    public function buscaPorSerie(int $serieId){
        $episodios = Episodio::query()
            ->where('serie_id', $serieId)
            ->paginate();

        return $episodios;
    }



}

?>