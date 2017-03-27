<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{URL::to('css/style-page.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style-site.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style-results.css')}}">
    <title>Résultats</title>
</head>
<body>

  <div class="content-results">
        
    <h2>Restaurants correspondants à votre recherche</h2>
            
        @foreach($restaurants as $restaurant)
        <section class="restaurant">
            <h3>{{$restaurant->nom}}</h3>
            <p class="description">{{$restaurant->description}}</p>

            <div class="bas">
              <div class="adresse">
                <p>{{$restaurant->adresse}}<br>
                  {{$restaurant->code_postale}} {{$restaurant->ville}}<br>
                  {{$restaurant->mail}}<br>
                  {{$restaurant->site}}<br>
                  {{$restaurant->telephone}}
                </p>
              </div>

              <div class="droite">
                <p>Type de cuisine :
                  @foreach($categories as $categorie)
                    {{$categorie->nom_categorie}}
                  @endforeach
                </p>
                <div><a href="#">Voir sur la carte</a></div>
              </div>
            </div>
        </section>
        @endforeach
  </div>

</body>
</html>
