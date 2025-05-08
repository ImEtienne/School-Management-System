@extends('modele')

@section('title', 'ajout étudiant')

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($etudiants))
        <div class="container-sm mt-3">
            <!-------------------------Boutton Ajoute ----------------------->
            <a type="button" class="btn btn-info mt-3" href="{{route('gestionnaire.etudiant.add')}}"><i class="bi bi-plus-circle-fill"></i> Ajouter Etudiant</a>

            <!---------------------------- Barre de recherche --------------->
            <form action="{{route('gestionnaire.etudiant.search')}}" class="d-flex mt-3">
                <input class="form-control me-2" type="search" name="q" value="{{request()->q ?? ''}}" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-primary"  type="submit"> Recherche</button>
            </form>

            <!---------------------- Table ----------------------------------->
            <table class="table table-hover caption-top shadow">
                <caption>Liste des étudiants</caption>
                <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Noet</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th class="text-center">Action</th>
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
                        <td class="text-center">
                            <a type="button" class="btn btn-primary" href="{{route('gestionnaire.etudiant.edit',['id'=>$etudiant->id])}}"><i class="bi bi-pencil-square"></i>&nbsp;Modifier</a>
                            <a type="button" class="btn btn-danger" href="{{route('gestionnaire.etudiant.delete', ['id'=>$etudiant->id])}}"><i class="bi bi-trash3-fill"></i>&nbsp;Supprimer</a>
                        </td>
                    </tr>
                @empty
                    <p> Aucun utilisateur Etudiant trouvé ! </p>
                @endforelse
            </table>
            {{$etudiants -> links()}}
        </div>
    @endunless
@endsection
