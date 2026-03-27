<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return response()->json(
            Session::with('formation', 'formateur')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'lieu' => 'required|string|max:255',
            'horaire' => 'required|string|max:255',
            'capacite_max' => 'required|integer',
            'statut' => 'required|string|max:255',
            'formation_id' => 'required|exists:formations,id',
            'formateur_id' => 'required|exists:users,id',
        ]);

        $session = Session::create($request->all());

        return response()->json([
            'message' => 'Session ajoutée avec succès',
            'session' => $session
        ], 201);
    }

    public function show($id)
    {
        $session = Session::with('formation', 'formateur', 'inscriptions')->findOrFail($id);
        return response()->json($session);
    }

    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        $session->update($request->all());

        return response()->json([
            'message' => 'Session modifiée avec succès',
            'session' => $session
        ]);
    }

    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();

        return response()->json([
            'message' => 'Session supprimée avec succès'
        ]);
    }
}