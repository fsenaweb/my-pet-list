<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CriadorResource;
use App\Models\Criador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CriadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CriadorResource::collection(Criador::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Criador::create($request->all());
        return response()->json([
            'message'   => 'Informação cadastrada com sucesso.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criador  $criador
     * @return \Illuminate\Http\Response
     */
    public function show(Criador $criador)
    {
        if(!$criador->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        return new CriadorResource($criador);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criador  $criador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criador $criador)
    {
        if(!$criador->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $criador->update($request->all());
        return new CriadorResource($criador);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criador  $criador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criador $criador)
    {

        if(!$criador->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $criador->delete();
        return response()->json([
            'message'   => 'Dados removidos com sucesso',
        ], 200);
    }
}
