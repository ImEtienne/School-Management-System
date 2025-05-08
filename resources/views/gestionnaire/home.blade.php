@extends('modele')
@section('title', 'Accueil - Gestionnaire')
@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <div class="d-flex flex-column h-90">
        <div class="position-relative">
            <div class="container-sm">
                <h4>Page d'accueil Gestionnaire.</h4>
                <p class="text-start">
                    sit amet nunc tincidunt eros luctus rhoncus. Nam volutpat, mauris ullamcorper blandit convallis, ligula justo lobortis tortor, sed mollis felis augue ac lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pharetra tortor tortor, auctor ultricies nibh mollis quis. Ut cursus posuere est. Cras sed consectetur mi. Duis et leo purus. Mauris tempor, urna non vestibulum cursus, dui mauris finibus turpis, non semper sapien est mollis orci. Fusce vulputate hendrerit orci, ut malesuada est convallis et.
                </p>
            </div>
        </div>
    </div>
@endsection
