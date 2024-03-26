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
        

        $progress->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Entrée supprimée avec succès',
        ]);
    }
    }

    
    
     public function store(Request $request)
    {
       
            $validatedData = $request->validate([
                'title' => 'required|string',
                'weight' => 'nullable|numeric',
                'measurements' => 'nullable|json',
                'performance' => 'nullable|string',
                'user_id' =>'nullable',
            ]);
            $validatedData['status'] = 'Non terminé';
            $validatedData['user_id'] = auth()->id();

            $progress = Progresse::create($validatedData);


            return response()->json([
                'status' => 200,
                'message' => 'Progression enregistrée avec succès',
                'progress' => $progress,
            ]);
    }


    public function update(Request $request, Progresse $progress)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'weight' => 'nullable|numeric',
            'measurements' => 'nullable|json', 
            'performance' => 'nullable|string',
        ]);
        if ($progress->user_id !== Auth::id()) {
            return response()->json([
                'status' => 403,
                'message' => 'Accès non autorisé',
            ], 403);
        }
        $progress->update($validatedData);
    
        return response()->json([
            'status' => 200,
            'message' => 'Progression mise à jour avec succès',
            'progress' => $progress,
        ]);
    }
    

    public function updateStatus(Request $request, Progresse $progress)
{
    if ($progress->user_id !== Auth::id()) {
        return response()->json([
            'status' => 403,
            'message' => 'Accès non autorisé',
        ], 403);
    }

    $validatedData = $request->validate([
        'status' => 'required|in:Non terminé,Terminé',
    ]);

    $progress->status = $validatedData['status'];
    $progress->save();

    return response()->json([
        'status' => 200,
        'message' => 'Statut de la progression mis à jour avec succès',
        'progress' => $progress,
    ]);
}

}

    