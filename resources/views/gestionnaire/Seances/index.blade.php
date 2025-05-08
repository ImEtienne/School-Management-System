@extends('modele')
@section('title', 'Liste de toutes les séances')
@section('contents')
    <!---------------------- Nav------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($seances))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{route('gestionnaire.seance.index')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

            <!----------------------------Table------------------------------>
            <table class="table table-hover caption-top shadow-lg">
                <caption>Liste des Séances</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Cours</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th class="text-center">Action</th>
                    <th>Liste des présences (des étudiants) par séance</th>
                </tr>
                </thead>
                @forelse($seances as $seance)
                    <tr>
                        <td>{{$seance ->id}}</td>
                        <td>{{$seance->cours()->first()->intitule}}</td>
                        <td>{{$seance ->date_debut}}</td>
                        <td>{{$seance ->date_fin}}</td>
                        <td class="text-center">
                            <a type="button" class="btn btn-primary" href="{{route('gestionnaire.seance.edit', [$seance->id])}}"><i class="bi bi-pencil-square"></i>&nbsp;Modifier</a>
                            <a type="button" class="btn btn-danger" href="{{route('gestionnaire.seance.delete', [$seance->id])}}"><i class="bi bi-trash3-fill"></i>&nbsp;Supprimer</a>
                        </td>
                        <td><a type="button" class="btn btn-dark d-flex justify-content-center" href="{{route('gestionnaire.listePresencesParSeance', [$seance->id])}}"><i class="bi bi-eye"></i>&nbsp;Voir liste</a></td>
                    </tr>
                @empty
                    <p> Aucune séance trouvée ! </p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection
