@extends('modele')

@section('title', 'Liste de toutes les séances')

@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('enseignant.partials.navbar-enseignant')

    @unless(empty($seances))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{route('enseignant.showSeance')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

            <!----------------------------Associé plusieurs-------------------------------->
            <button title="Liste des séances de cours"  type="button" class="btn btn-info"  aria-expanded="false">
                <a href="{{route('enseignant.pointer.etudiantPlusieurs')}}" style="text-decoration: none; color: black;"><i class="bi bi-chevron-contract"></i>&nbsp;Associé Plusiers Etudiants</a>
            </button>

            <button title="Liste des séances de cours"  type="button" class="btn btn-info"  aria-expanded="false">
                <a href="{{route('gestionnaire.seance.ListEnseignant', ['id'=>Auth::user()->id])}}" style="text-decoration: none; color: black;"><i class="bi bi-eye-fill"></i>&nbsp;Voir la liste des cours associés</a>
            </button>
            <!----------------------------Table------------------------------>
            <table class="table table-hover caption-top shadow">
                <caption>Liste des Séances</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>cours_id</th>
                    <th>date_debut</th>
                    <th>date_fin</th>
                    <th>Pointage Etudiant</th>
                </tr>
                </thead>
                @forelse($seances as $seance)
                    <tr>
                        <td>{{$seance ->id}}</td>
                        <td>{{$seance ->cours()->first()->intitule}}</td>
                        <td>{{$seance ->date_debut}}</td>
                        <td>{{$seance ->date_fin}}</td>
                        <td><a type="button" class="btn btn-primary" href="{{route('enseignant.pointer.etudiant', [$seance->id])}}">&nbsp;Pointer présent.e</a></td>
                    </tr>
                @empty
                    <p> Aucune séance trouvée ! </p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection
