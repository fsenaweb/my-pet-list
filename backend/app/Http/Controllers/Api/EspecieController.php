<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EspecieResource;
use App\Models\Especie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EspecieResource::collection(Especie::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Especie::create($request->all());
        return response()->json([
            'message'   => 'Informação cadastrada com sucesso.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show(Especie $especie)
    {
        if(!$especie->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        return new EspecieResource($especie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especie $especie)
    {
        if(!$especie->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $especie->update($request->all());
        return new EspecieResource($especie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especie $especie)
    {
        if(!$especie->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $especie->delete();
        return response()->json([
            'message'   => 'Dados removidos com sucesso',
        ], 200);
    }
}
