<?php

namespace App\Http\Controllers\Api;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PetResource;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Pet::with('criador', 'especie')->get();
        return PetResource::collection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pet::create($request->all());
        return response()->json([
            'message'   => 'Informação cadastrada com sucesso.',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        if(!$pet->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        return new PetResource($pet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        if(!$pet->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $pet->update($request->all());
        return new PetResource($pet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        if(!$pet->id) {
            return response()->json([
                'message'   => 'Informação não encontrada.',
            ], 404);
        }
        $pet->delete();
        return response()->json([
            'message'   => 'Dados removidos com sucesso',
        ], 200);
    }
}
