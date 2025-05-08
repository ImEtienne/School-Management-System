@extends('modele')

@section('title', 'Gestion des Cours')

@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('enseignant.partials.navbar-enseignant')

    <!--------------------------- END NAVBAR ----------------------------------->
    @unless(empty($cours))
        <div class="container-sm mt-3">
            <!-----------------------------Btn Back------------------------------>
            <a class="btn btn-info mt-3" href="{{ route('enseignant.showSeance')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

            <!---------------------- Table --------------------------------->
            <table class="table table-hover caption-top" style="box-shadow: 5px 10px 20px rgba(0,0,0, 0.3);">
                <caption>Liste des cours</caption>
                <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>intitule</th>
                    <th>created_at</th>
                    <th>update_at</th>
                </tr>
                </thead>
                @forelse($cours as $cour)
                    <tr>
                        <td>{{$cour ->id}}</td>
                        <td>{{$cour ->intitule}}</td>
                        <td>{{$cour ->created_at}}</td>
                        <td>{{$cour ->updated_at}}</td>
                    </tr>
                @empty
                    <p> Aucun cours trouvé ! </p>
                @endforelse
            </table><br><br><br><br><br><br>
        </div>
    @endunless
@endsection
