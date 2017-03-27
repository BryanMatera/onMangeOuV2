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
    <h2>Restaurants correspondants à votre recherche<a href="/OnMangeOu/public/recherche">Retour </a></h2>

        @foreach($restaurants as $key => $restaurant)
        <section class="restaurant">
            <h3 class="nomResto">{{$restaurant->nom}}</h3>
            <p class="description">{{$restaurant->description}}</p>

            <div class="bas">
              <div class="adresse">
                <p>{{$restaurant->adresse}}<br>
                  {{$restaurant->code_postale}} {{$restaurant->ville}}<br>
                  {{$restaurant->mail}}<br>
                  {{$restaurant->site}}<br>
                  {{$restaurant->telephone}}<br>
                  <div class="map" id='map-{{$key}}' style="height: 200px;width:600px;border:1px solid black;display:none;"></div> 
                
                  <div class="latitude" style="display:none">
                  {{$restaurant->latitude}}
                  </div>
                  <div class="longitude" style="display:none">
                  {{$restaurant->longitude}}
                  </div>
                    
                  
                  
                </p>
              </div>
             
                    
               

             
              <div class="droite">
                <p>Type de cuisine :
                  @foreach($categories as $categorie)

                    {{$categorie->nom_categorie}}
                  @endforeach
                </p>
                <div class="bouton" ><a class='btn' href="#" id="btn-{{$key}}">Voir sur la carte</a></div>
              </div>
            </div>
        </section>
        @endforeach
  </div>
  <section>
   

<script type="text/javascript">

var boutons = document.getElementsByClassName('btn');
var test = true;


for (var i = boutons.length - 1; i >= 0; i--) {

  boutons[i].onclick = function(e){
    var numMap = e.target.id.replace("btn-","");
    var laMap = document.getElementById("map-"+numMap);
    e.preventDefault();
 

   

   
    
    
      if (laMap.style.display === 'none' && test === true){
       
        function initMap(position){ 
            latitudeUser = position.coords.latitude; 
            longitudeUser = position.coords.longitude;
            var maps = document.getElementsByClassName("map");
            var latitudes = document.getElementsByClassName('latitude');//latitude du resto dans le html fournit par la bdd
            var longitudes = document.getElementsByClassName('longitude');//longitude idem
            var nomDuRestos = document.getElementsByClassName('nomResto');
          
            
            
                                var latitudeBdd = latitudes[numMap]; // une bidouille pour récuperer les infos php de chaques  restos ici la latitude
                                var stringLatitudeBdd = latitudeBdd.innerText; //on recupere le contenu de la div 
                                var latitude = parseFloat(stringLatitudeBdd.replace(',','.'));// on transforme la string en number et on remplace la virugule par un point
                                
                                var longitudeBdd = longitudes[numMap]; // ici la longitude idem
                                var stringLongitudeBdd = longitudeBdd.innerText;
                                var longitude = parseFloat(stringLongitudeBdd.replace(',','.'));
                              
                              
                                var restoBdd = nomDuRestos[numMap];// ici le nom
                                var nomDuResto = restoBdd.innerText;
                                
                                
                                var indicatorResto = {lat:latitude, lng:longitude}; // les coordonnées du restos pour le markeur sur la carte
                                var myLatLng = {lat:latitudeUser, lng:longitudeUser};// les coordonnées de l'utilisateur pour le markeur sur la carte
                                
                                var map = new google.maps.Map(maps[numMap],{ //on crée la carte
                                    center: myLatLng,
                                    zoom: 8
                                  });
                                var marker = new google.maps.Marker({//on crée le markeur utilisateur
                                    position: myLatLng,
                                    map: map,
                                    title: 'Vous êtes ici!'
                                  });
              
                                var markerRestaurant = new google.maps.Marker({//on crée le markeur  du restaurant
                                    position: indicatorResto,
                                    map: map,
                                    title: nomDuResto
                                  });
        }

        if(navigator.geolocation){// FUNCTION JAVASCRIPT SI ON EST GEOCALISE
          navigator.geolocation.getCurrentPosition(initMap);// Ca lance la fonction initMap
        }


            laMap.style.display= 'block'; 
            test = false 
            e.preventDefault();
    } 
   

    else if(laMap.style.display === 'block' && test === false){
        laMap.style.display = 'none';
        test = true;
        e.preventDefault();  
      }
  }
}


</script>
   
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhryJ60F47Dlju2i7aQnHiz4tifEO6Aeg&libraries=geometry&callback=initMap">
    </script>
    
</section>

</body>
</html>
