<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController {

    public function index(Request $request){
        //return Serie::all();

        //retorna com paginacao e define quantidade por página
        return Serie::paginate($request->per_page);
    }

    public function store(Request $request){

        //return response()->json(Serie::create(['nome' => $request->nome]), 201);
        return response()->json(Serie::create($request->all()), 201);

    }

    public function show(int $id){
        $serie = Serie::find($id);
        if(is_null($serie)){
            return response()->json('', 204);
        }
        return response()->json($serie); 

    }

    public function update(int $id, Request $request){
        $serie = Serie::find($id);

        if(is_null($serie)){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        //pega todos os dados da requisicao no caso da serie, o unico obrigatorio é nome, demais coisas ele ignora
        $serie->fill($request->all());
        $serie->save();

        return response()->json($serie); 

    }

    public function destroy(int $id){
        $qtdRecursoRemovidos = Serie::destroy($id);
        if($qtdRecursoRemovidos === 0){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        return response()->json('', '200'); 
    }



}

?>