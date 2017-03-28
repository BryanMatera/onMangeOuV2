<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validateRequest;
use App\Categorie;
use App\Restaurant;
use App\Horaire;
use Illuminate\Support\Facades\Input;

class rechercheController extends Controller
{
    public function affichageVue(){
        return view('recherche');
    }

    public function selectionCategorie(){
        $horaire = new Horaire;
        $horaires = $horaire::all();

        $categorie = new Categorie;
        $categories = $categorie::all();
        return view('recherche', array('categories' => $categories,'horaires'=>$horaires));

    }

    public function resultatFormulaire(validateRequest $request){
      	$id = $request->input('type');
        $idH = $request->input('horaire');

        if(!empty($request->input('commune'))){
          $codeP = $request->input('commune');
          return redirect()->route('resultats',['id'=>$id, 'codeP'=>$codeP, 'horaire'=>$idH]);
        }
        else {
          return redirect()->route('resultats-categorie',['id'=>$id, 'horaire'=>$idH]);
        }
    }

    public function restoParCategorie($id, $idH){
        $horaire = new Horaire;
        $horaires = $horaire::where('id_horaire',$idH)->get();
        $categorie = new Categorie;
    	  $categories = $categorie::where('id_categorie', $id)->get();
    	  $restaurant = new Restaurant;

      	$restaurants = $restaurant::
        join('categories','restaurants.id_categorie','=','categories.id_categorie')
        ->join('ouvrir','ouvrir.id_restaurant','=','restaurants.id_restaurant')
      	->select('restaurants.*','ouvrir.id_horaire')
      	->where('categories.id_categorie',$id)
        ->where('ouvrir.id_horaire',$idH)
      	->get();

        if (count($restaurants)) {
          return view('resultats', array("restaurants"=>$restaurants, "categories"=>$categories, "horaires" => $horaires));
        }
        else {
          return view('no-resultat');
        }
    }

    public function restoParCategorieEtCP($id, $codeP, $idH){
        $horaire = new Horaire;
        $horaires = $horaire::where('id_horaire',$idH)->get();
        $categorie = new Categorie;
    	  $categories = $categorie::where('id_categorie', $id)->get();
        $restaurant = new Restaurant;

      	$restaurants = $restaurant::
      	join('categories','restaurants.id_categorie','=','categories.id_categorie')
        ->leftJoin('ouvrir','ouvrir.id_restaurant','=','restaurants.id_restaurant')
      	->select('restaurants.*','ouvrir.id_horaire')
      	->where('categories.id_categorie',$id)
        ->where('restaurants.code_postale', $codeP)
        ->where('ouvrir.id_horaire',$idH)
      	->get();

        if (count($restaurants)) {
          return view('resultats', array("restaurants"=>$restaurants, "categories"=>$categories, "horaires"=>$horaires));
        }
        else {
          return view('no-resultat');
        }
    }
}
