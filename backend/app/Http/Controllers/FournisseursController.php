<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;
use App\Http\Requests\FournisseursRequest;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Tous les Fournisseurs
    $fournisseurs = Fournisseurs::all();

       // Return Json Response
       return response()->json([
          'fournisseurs' => $fournisseurs
       ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(FournisseursRequest $request)
    {
        try {

            // Creation d'un fournisseur
            Fournisseurs::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'telephone1' => $request->telephone1,
                'telephone2' => $request->telephone2
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Fourniseur ajouté avec succès!!!"
            ],200);
        } catch (Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        //
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
    public function edit(Fournisseurs $fournisseurs)
    {
       // Fournisseur Detail

       if(!$fournisseurs){
         return response()->json([
            'message'=>'Fournisseur Not Found.'
         ],404);
       }

       // Return Json Response
       return response()->json([
          'fournisseurs' => $fournisseurs
       ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseurs $fournisseurs)
    {
        try {
            // Find Fournisseur
            if(!$fournisseurs){
              return response()->json([
                'message'=>'Fournisseur Not Found.'
              ],404);
            }

            // Update Fournisseur

            $fournisseurs->nom = $request->nom;
            $fournisseurs->email = $request->email;
            $fournisseurs->adresse = $request->adresse;
            $fournisseurs->telephone1 = $request->telephone1;
            $fournisseurs->telephone2 = $request->telephone2;

            $fournisseurs->update();

            // Return Json Response
            return response()->json([
                'message' => "Fournisseur successfully updated."
            ],200);
        } catch (Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseurs $fournisseurs)
    {
         // Detail

         if(!$fournisseurs){
           return response()->json([
              'message'=>'Fournisseur Not Found.'
           ],404);
         }

         // Delete Fournisseur
         $fournisseurs->delete();

         // Return Json Response
         return response()->json([
             'message' => "Fournisseur successfully deleted."
         ],200);
    }
}
