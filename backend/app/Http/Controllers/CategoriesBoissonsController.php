<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\CategoriesBoissons;
use App\Http\Requests\CategoriesBoissonsRequest;

class CategoriesBoissonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoriesBoissons::all();

        // Return Json Response
        return response()->json([
            'categories' => $categories
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
    public function store(CategoriesBoissonsRequest $request)
    {
        try{
            CategoriesBoissons::create([
                'nom' => $request->nom
            ]);

             // Return Json Response
             return response()->json([
                'message' => "Categorie ajoutée avec succès!!!"
            ],200);
        }
        catch(Exception $e)
        {
            // dd($e);
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
    public function edit(CategoriesBoissons $categories_boissons)
    {
        // Bouteille Detail

       if(!$categories_boissons){
        return response()->json([
           'message'=>'Catégorie Not Found.'
        ],404);
      }

      // Return Json Response
      return response()->json([
         'categorie' => $categories_boissons
      ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesBoissonsRequest $request, CategoriesBoissons $categories_boissons)
    {
        try {
            // Find Fournisseur
            if(!$categories_boissons){
              return response()->json([
                'message'=>'Casier Not Found.'
              ],404);
            }

            // Update Bouteille


            $categories_boissons->nom = $request->nom;

            $categories_boissons->update();

            // Return Json Response
            return response()->json([
                'message' => "Categorie successfully updated."
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
    public function destroy(CategoriesBoissons $categories_boissons)
    {
        if(!$categories_boissons){
            return response()->json([
               'message'=>'Categorie Not Found.'
            ],404);
          }

          // Delete Categorie
          $categories_boissons->delete();

          // Return Json Response
          return response()->json([
              'message' => "Categorie successfully deleted."
          ],200);
    }
}
