<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        return response()->json(Formation::with('formateur')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree_totale' => 'required|integer',
            'niveau' => 'required|string|max:255',
            'tarif' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $formation = Formation::create($request->all());

        return response()->json([
            'message' => 'Formation ajoutée avec succès',
            'formation' => $formation
        ], 201);
    }

    public function show($id)
    {
        $formation = Formation::with('formateur', 'sessions')->findOrFail($id);
        return response()->json($formation);
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->update($request->all());

        return response()->json([
            'message' => 'Formation modifiée avec succès',
            'formation' => $formation
        ]);
    }

    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return response()->json([
            'message' => 'Formation supprimée avec succès'
        ]);
    }
}