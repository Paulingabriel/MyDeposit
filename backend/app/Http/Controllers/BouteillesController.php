<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Bouteilles;
use Illuminate\Http\Request;
use App\Http\Requests\BouteillesRequest;

class BouteillesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bouteilles = Bouteilles::all();

       // Return Json Response
       return response()->json([
          'bouteilles' => $bouteilles
       ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BouteillesRequest $request)
    {
        try {

            // Creation d'un fournisseur
            Bouteilles::create([
                'volume' => $request->volume,
                'prix' => $request->prix
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Bouteille ajoutée avec succès!!!"
            ],200);
        } catch (Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
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
    public function edit(Bouteilles $bouteilles)
    {
       // Bouteille Detail

       if(!$bouteilles){
         return response()->json([
            'message'=>'Bouteille Not Found.'
         ],404);
       }

       // Return Json Response
       return response()->json([
          'bouteilles' => $bouteilles
       ],200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bouteilles $bouteilles)
    {
        try {
            // Find Fournisseur
            if(!$bouteilles){
              return response()->json([
                'message'=>'Bouteille Not Found.'
              ],404);
            }

            // Update Bouteille

            $bouteilles->volume = $request->volume;
            $bouteilles->prix = $request->prix;

            $bouteilles->update();

            // Return Json Response
            return response()->json([
                'message' => "Bouteille successfully updated."
            ],200);
        } catch (Exception $e) {
            // dd($e);
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bouteilles $bouteilles)
    {
         // Detail

         if(!$bouteilles){
           return response()->json([
              'message'=>'Bouteille Not Found.'
           ],404);
         }

         // Delete Bouteille
         $bouteilles->delete();

         // Return Json Response
         return response()->json([
             'message' => "Bouteille successfully deleted."
         ],200);
    }
}
