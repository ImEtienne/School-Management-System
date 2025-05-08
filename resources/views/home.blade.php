@extends('modele')

@section('title', 'Page d\'accueil')

@section('redirect')
    @auth
        @switch($type = Auth::user()->type)
            @case('admin')
                <meta http-equiv="refresh" content="0; URL=http://localhost/admin" />
            @break
            @case('gestionnaire')
                <meta http-equiv="refresh" content="0; URL=http://localhost/gestionnaire" />
            @break
            @case('enseignant')
                <meta http-equiv="refresh" content="0; URL=http://localhost/enseignant" />
            @break
            @default
                <meta http-equiv="refresh" content="0; URL=http://localhost/home" />
            @break
        @endswitch
    @endauth
@endsection

@section('contents')
    <div class="container-css">
        <nav>
            <h1><span class="f-letter">Ma</span> Page</h1>
            <ul>
                <li><a  style="color:#ddd;" href="/">Accueil</a></li>
                <li><a  style="color:#ddd;" href="#">Nous contacter</a></li>
                <li><a  style="color:#ddd;" href="#">À propos</a></li>
            </ul>
        </nav>

        <div class="side-container">
            <p class="para">Bienvenue à</p>
            <h2 class="planning">Planning</h2>
            <h4 class="paraLorem">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h4>

            <div class="row-css">
                @guest
                    <a href="{{route('login')}}">Connexion</a>
                    <a href="{{route('register')}}">S'inscrire</a>
                @endguest

                <span>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            <br />Recusandae veritatis ad cupiditate libero sequi iusto.
          </span>
            </div>
        </div>
    </div>
    <!--<h1 style="font-size: 20px; font-weight:bold;">Planning Enseignant</h1>-->
   {{--@guest()
        <p>Bienvenue Lorem ipsum dolor sit amet ! </p>
        <a class="btn btn-outline-primary" href="{{route('login')}}">Connexion</a>
        <a class="btn btn-outline-primary" href="{{route('register')}}">S'inscrire</a>
    @endguest--}}
@endsection












{{--@auth
        <a href="{{route('admin.home')}}">Partie Admin</a>
    @endauth---}}


