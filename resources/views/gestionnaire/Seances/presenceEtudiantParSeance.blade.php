@extends('modele')

@section('title', "Liste des présences (des étudiants) par séance.")

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($presences))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;Back</a>

            <!---------------------- Table ----------------------------------->
            <table class="table table-hover caption-top shadow">
                <caption>Liste des présences (des étudiants) par séance.</caption>
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cours</th>
                    <th>date_debut</th>
                    <th>date_fin</th>
                    <th>nom d'étudiant</th>
                </tr>
                </thead>
                @forelse($presences as $presence)
                    <tr>
                        <td>{{$seances->id}}</td>
                        <td>{{$seances->cours()->first()->intitule}}</td>
                        <td>{{$seances->date_debut}}</td>
                        <td>{{$seances->date_fin}}</td>
                        <td>{{ $presence->nom }} {{ $presence->prenom }}</td>
                    </tr>
                @empty
                    <p>Aucune présence trouvée !</p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection


