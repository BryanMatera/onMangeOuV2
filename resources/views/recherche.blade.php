<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{URL::to('css/style-page.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style-site.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style-recherche.css')}}">
    <title>Rechercher un établissement</title>
</head>
<body>
        <nav class="principal-nav">
            <ul>
               <div class="nav-left">
                    <li><a href="/"><img class="logo" src="css/images/logo.png" alt=""></a></li>
                   <li class="logo-title"><a href="recherche">On mange où ?</a></li>
               </div>
            </ul>
        </nav>

        <div class="content-search">
          <h1>Recherchez votre restaurant</h1>

          <section class="search">
            <form method="POST" action="traitement">
              {{ csrf_field() }}

              <div class="champs">


                <select type="text" name="type">
                @foreach($categories as $categorie)
                  <option value="{{$categorie->id_categorie}}">{{$categorie->nom_categorie}}</option>
                 @endforeach
                </select>
                <!-- {!! $errors->first('type', '<small class="help-block">:message</small>') !!} -->

                <input type="number" name="commune" placeholder="Code postal...">
                
                <select type="text" name="horaire">
                @foreach($horaires as $horaire)
                  <option value="{{$horaire->id_horaire}}">{{$horaire->jour}}</option>
                 @endforeach
                </select>
                <!-- {!! $errors->first('type', '<small class="help-block">:message</small>') !!} -->

                <input type="text" name="departement" value="71" hidden>

                

              </div>
              <div class="messages-erreur">
                {!! $errors->first('commune', '<small class="help-block">:message</small>') !!}
                {!! $errors->first('date', '<small class="help-block">:message</small>') !!}
              </div>

              <input class="button" type="submit" value="RECHERCHE">
            </form>
          </section>
        </div>
</body>
</html>
