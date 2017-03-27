<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validateRequest;
use App\Categorie;
use App\Restaurant;
use Illuminate\Support\Facades\Input;

class rechercheController extends Controller
{
    public function affichageVue(){
        return view('recherche');
    }

  public function selectionCategorie(){
  	$categorie = new Categorie;
  	$categories = $categorie::all();
  	 return view('recherche', array('categories' => $categories));

  }

    public function resultatFormulaire(validateRequest $request){
      	$id = $request->input('type');

        if(!empty($request->input('commune'))){
          $codeP = $request->input('commune');
          return redirect()->route('resultats',['id'=>$id, 'codeP'=>$codeP]);
        }
        else {
          return redirect()->route('resultats-categorie',['id'=>$id]);
        }
    }

    public function restoParCategorie($id){
      $categorie = new Categorie;
    	$categories = $categorie::where('id_categorie', $id)->get();
    	$restaurant = new Restaurant;

      	$restaurants = $restaurant::
      	join('categories','restaurants.id_categorie','=','categories.id_categorie')
      	->select('*')
      	->where('categories.id_categorie',$id)
      	->get();

        return view('resultats', array("restaurants"=>$restaurants, "categories"=>$categories));
    }

    public function restoParCategorieEtCP($id, $codeP){
      $categorie = new Categorie;
    	$categories = $categorie::where('id_categorie', $id)->get();
    	$restaurant = new Restaurant;

      	$restaurants = $restaurant::
      	join('categories','restaurants.id_categorie','=','categories.id_categorie')
      	->select('*')
      	->where('categories.id_categorie',$id)
        ->where('restaurants.code_postale', $codeP)
      	->get();

        return view('resultats', array("restaurants"=>$restaurants, "categories"=>$categories));
    }
}
