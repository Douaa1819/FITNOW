<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $user=User::all();
     $data=[
        'status'=> 200,
        'users'=>$user,
        'msg'=>'i am there',
     ];
      return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $progresse=User::all();
      
         return response()->json([
            'status'=> 200,
            'users'=>$progresse,
         ], 200);
       }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validated();
        User::create($validatedData);
        $data=[
            "status"=>422,
            "message"=>$validatedData->messages()
        ];
        if($validatedData->fails()){
            return response()->json($data, 422);
        }else{
            $data=[
                "status"=>200,
                "message"=>'Data uploaded successfuly'
            ];
            return response()->json($data, 200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
