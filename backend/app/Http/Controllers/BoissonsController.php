<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Boissons;
use App\Models\Bouteilles;
use Illuminate\Support\Str;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;
use App\Models\CategoriesBoissons;
use App\Http\Requests\BoissonsRequest;
use Illuminate\Support\Facades\Storage;

class BoissonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtenir toute les boissons
        $boissons = Boissons::with(['fournisseur', 'bouteille', 'categories_boisson'])->get();

         // Return Json Response
         return response()->json([
            'boissons' => $boissons
         ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoissonsRequest $request)
    {
        try {

            // Creation d'un fournisseur
            if($request->hasFile("image"))
            {
                $imageName = $request->nom.'.'.$request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
                Boissons::create([
                    'nom' => $request->nom,
                    'prix' => $request->prix,
                    'image' => $imageName,
                    'categories_boisson_id' => $request->categories_boisson_id,
                    'bouteille_id' => $request->bouteille_id,
                    'fournisseur_id' => $request->fournisseur_id,
                ]);
            }
            else{

                Boissons::create([
                    'nom' => $request->nom,
                    'prix' => $request->prix,
                    'categories_boisson_id' => $request->categories_boisson_id,
                    'bouteille_id' => $request->bouteille_id,
                    'fournisseur_id' => $request->fournisseur_id,
                ]);

            }

            // Return Json Response
            return response()->json([
                'message' => "Boisson ajoutée avec succès!!!"
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boissons $boissons)
    {
        $fournisseurs = Fournisseurs::all();
        $bouteilles = Bouteilles::all();
        $categories = CategoriesBoissons::all();
       // Bouteille Detail

       if(!$boissons){
         return response()->json([
            'message'=>'Casier Not Found.'
         ],404);
       }

       // Return Json Response
       return response()->json([
          'boissons' => $boissons,
          'categorie' => $categories->where('id', '=', $boissons->categories_boisson_id)->first(),
          'fournisseur' => $fournisseurs->where('id', '=', $boissons->fournisseur_id)->first(),
          'bouteille' => $bouteilles->where('id','=', $boissons->bouteille_id)->first()
       ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BoissonsRequest $request, Boissons $boissons)
    {
        try {
            // Find Fournisseur
            if(!$boissons){
              return response()->json([
                'message'=>'Casier Not Found.'
              ],404);
            }

            // Update Bouteille

                // if($boissons->image){
                //     $exists = Storage::disk('public')->exists("product/image/{$boissons->image}");
                //     if($exists){
                //         Storage::disk('public')->delete("product/image/{$boissons->image}");
                //     }
                // }

                // if($request->hasFile("image"))
                // {
                //     $imageName = $request->nom.'.'.$request->image->getClientOriginalExtension();
                //     Storage::disk('public')->putFileAs('product/image', $request->image,$imageName);
                //     $boissons->image = $imageName;
                // }

                $boissons->prix = $request->prix;
                $boissons->nom = $request->nom;
                $boissons->categories_boisson_id = $request->categories_boisson_id;
                $boissons->bouteille_id = $request->bouteille_id;
                $boissons->fournisseur_id = $request->fournisseur_id;

            $boissons->update();

            // Return Json Response
            return response()->json([
                'message' => "Boisson successfully updated."
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
    public function destroy(Boissons $boissons)
    {

        if(!$boissons){
            return response()->json([
               'message'=>'Boisson Not Found.'
            ],404);
          }

          if($boissons->image){
                $exists = Storage::disk('public')->exists("product/image/{$boissons->image}");
                if($exists){
                    Storage::disk('public')->delete("product/image/{$boissons->image}");
                }
            }

          // Delete Boisson
          $boissons->delete();

          // Return Json Response
          return response()->json([
              'message' => "Boissons successfully deleted."
          ],200);
    }
}
