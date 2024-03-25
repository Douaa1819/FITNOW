<?php

namespace App\Http\Controllers;

use App\Models\Progresse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProgresseController extends Controller
{
    public function index()
    {
       $user = Auth::user();
        $progress = Progresse::latest()->where('user_id', $user->id)->get();
        return response()->json([
        'status' => 200,
        'message'=>'yes',
        'progress' => $progress,
        ]);
    }

    public function destroy(int $id)
    {
        $progress = Progresse::findOrFail($id);

        if ($progress->user_id !== auth()->user()->id) {
            return response()->json([
                'status' => 403,
                'message' => 'Accès non autorisé',
            ], 403);
        }

        $progress->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Entrée supprimée avec succès',
        ]);
    }
     public function store(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'measurements' => 'required',
            'weight' => 'required|string',
            'performance' => 'required',
            'status' => 'required',]);
        $progress = Progresse::findOrFail($id);

        if ($progress->user_id !== auth()->user()->id) {
            return response()->json([
                'status' => 403,
                'message' => 'Accès non autorisé',
            ], 403);
        }

        $progress->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Entrée stocker avec succès',
        ]);
    }


    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'measurements' => 'required',
            'weight' => 'required|string',
            'performance' => 'required',
            'status' => 'required',]);

        $progress = Progresse::findOrFail($id);

        if ($progress->user_id !== auth()->user()->id) {
            return response()->json([
                'status' => 403,
                'message' => 'Accès non autorisé',
            ], 403);
        }

        $progress->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Entrée modifiée avec succès',
        ]);
    }
}

    