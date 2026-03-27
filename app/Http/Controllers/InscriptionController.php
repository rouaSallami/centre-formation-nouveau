<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        return response()->json(
            Inscription::with('apprenant', 'session')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_inscription' => 'required|date',
            'statut' => 'required|string|max:255',
            'mode_paiement' => 'required|string|max:255',
            'apprenant_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $inscription = Inscription::create($request->all());

        return response()->json([
            'message' => 'Inscription ajoutée avec succès',
            'inscription' => $inscription
        ], 201);
    }

    public function show($id)
    {
        $inscription = Inscription::with('apprenant', 'session')->findOrFail($id);
        return response()->json($inscription);
    }

    public function update(Request $request, $id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->update($request->all());

        return response()->json([
            'message' => 'Inscription modifiée avec succès',
            'inscription' => $inscription
        ]);
    }

    public function destroy($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();

        return response()->json([
            'message' => 'Inscription supprimée avec succès'
        ]);
    }
}