<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Casiers;
use App\Models\Bouteilles;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;
use App\Http\Requests\CasiersRequest;

class CasiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $casiers = Casiers::all();
        $casiers = Casiers::with(['fournisseur', 'bouteille'])->get();

        // Return Json Response
        return response()->json([
           'casiers' => $casiers
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
    public function store(CasiersRequest $request)
    {
        try {

            // Creation d'un fournisseur
            Casiers::create([
                'capacite' => $request->capacite,
                'prix_achat' => $request->prix_achat,
                'intitule' => $request->intitule,
                'bouteille_id' => $request->bouteille_id,
                'fournisseur_id' => $request->fournisseur_id,
            ]);

            // Return Json Response
            return response()->json([
                'message' => "Casier ajouté avec succès!!!"
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
    public function edit(Casiers $casiers)
    {
        $fournisseurs = Fournisseurs::all();
        $bouteilles = Bouteilles::all();
       // Bouteille Detail

       if(!$casiers){
         return response()->json([
            'message'=>'Casier Not Found.'
         ],404);
       }

       // Return Json Response
       return response()->json([
          'casiers' => $casiers,
          'fournisseur' => $fournisseurs->where('id', '=', $casiers->fournisseur_id)->first(),
          'bouteille' => $bouteilles->where('id','=', $casiers->bouteille_id)->first()
       ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CasiersRequest $request, Casiers $casiers)
    {
        try {
            // Find Fournisseur
            if(!$casiers){
              return response()->json([
                'message'=>'Casier Not Found.'
              ],404);
            }

            // Update Bouteille


            $casiers->capacite = $request->capacite;
            $casiers->prix_achat = $request->prix_achat;
            $casiers->intitule = $request->intitule;
            $casiers->bouteille_id = $request->bouteille_id;
            $casiers->fournisseur_id = $request->fournisseur_id;

            $casiers->update();

            // Return Json Response
            return response()->json([
                'message' => "Casier successfully updated."
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
    public function destroy(Casiers $casiers)
    {

         if(!$casiers){
           return response()->json([
              'message'=>'Casier Not Found.'
           ],404);
         }

         // Delete Bouteille
         $casiers->delete();

         // Return Json Response
         return response()->json([
             'message' => "Casier successfully deleted."
         ],200);
    }
}
