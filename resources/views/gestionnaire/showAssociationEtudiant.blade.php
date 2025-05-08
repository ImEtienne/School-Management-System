@extends('modele')
@section('title', 'ajout étudiant')
@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($etudiants))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{route('gestionnaire.seance.index')}}"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;Back</a>

            <!-------------------------Boutton Ajoute ----------------------->
            <a type="buttom" style="margin-top:20px; margin-bottom: 20px;" class="btn btn-info" href="{{route('gestionnaire.etudiant.add')}}"><i class="bi bi-plus-circle-fill"></i>&nbsp;Ajouter Etudiant</a>

            <!---------------------------- Barre de recherche --------------->
            <form action="{{route('gestionnaire.etudiant.search')}}" class="d-flex">
                <input class="form-control me-2" type="search" name="q" value="{{request()->q ?? ''}}" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-primary"  type="submit">&nbsp;Recherche</button>
            </form>

            <!---------------------- Table ----------------------------------->
            <table class="table table-hover caption-top" style="box-shadow: 5px 10px 20px rgba(0,0,0, 0.3);">
                <caption>Liste des étudiants associés à un cours</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Noet</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Dissocier</th>
                    <th>Liste de présences détaillée (par étudiant)</th>
                </tr>
                </thead>
                @forelse($etudiants as $etudiant)
                    <tr>
                        <td>{{$etudiant->id}}</td>
                        <td>{{$etudiant->nom}}</td>
                        <td>{{$etudiant->prenom}}</td>
                        <td>{{$etudiant->noet}}</td>
                        <td>{{$etudiant->created_at}}</td>
                        <td>{{$etudiant->updated_at}}</td>
                        <td><a type="button" class="btn btn-warning" href="{{route('gestionnaire.dissocier', ['id'=>$etudiant->id])}}"><i class="bi bi-trash3-fill"></i>&nbsp;Dissocier</a></td>
                        <td><a type="button" class="btn btn-dark" href="{{route('gestionnaire.listePresenceDetaille', ['id'=>$etudiant->id])}}"><i class="bi bi-eye"></i>&nbsp;Voir les détailles</a></td>
                    </tr>
                @empty
                    <p>Aucun utilisateur Etudiant trouvé !</p>
                @endforelse
            </table><br><br><br><br>
        </div>
    @endunless
@endsection

