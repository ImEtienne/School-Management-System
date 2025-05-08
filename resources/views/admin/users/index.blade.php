@extends('modele')

@section('title', 'Gestion des Utilisateurs')

@section('contents')

    @include('admin.partials.navbar-admin')

    @unless(empty($users))
        <div class="container-md mt-3">
            <!-----------------------------Btn Back------------------------------>
            <a class="btn btn-info" href="{{ URL::previous() }}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
        <!--------------------- FILTRE ------------------------>
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle m-1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter-left"></i> Filtre
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('admin.users.indexAll')}}">Tous</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.users.indexEnseignant')}}">Enseignant</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.users.indexGestionnaire')}}">Gestionnaire</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.users.index')}}">Type null</a></li>
                </ul>
            </div>
        <!---------------------- Create User ----------------------->

            <div class="btn-group d-inline-block">
                <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i> Créer user
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('admin.user.createAdmin')}}">Administrateur</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.user.createEnseignant')}}">Enseignant</a></li>
                    <li><a class="dropdown-item" href="{{route('admin.user.createGestionnaire')}}">Gestionnaire</a></li>
                </ul>
            </div>

        <!---------------------------- Barre de recherche --------------->
            <form action="{{route('admin.users.search')}}" class="d-flex mt-3">
                <input class="form-control me-2" type="search" name="q" value="{{request()->q ?? ''}}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary"  type="submit">Recherche</button>
            </form>
        <!---------------------------------- Table ---------------------------->
        <table class="table table-striped table-hover table-sm caption-top shadow">
            <caption>Liste des utilisateurs</caption>
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Login</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Type</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            @forelse($users as $user)
                <tr>
                    <td>{{$user ->id}}</td>
                    <td>{{$user ->login}}</td>
                    <td>{{$user ->nom}}</td>
                    <td>{{$user ->prenom}}</td>
                    <td>{{$user ->type}}</td>
                    <td class="text-center">
                        <a type="button" class="btn btn-primary" href="{{route('admin.users.edit', ['id'=>$user->id])}}"><i class="bi bi-pencil-square"></i> Modifier</a>
                        <a type="button" class="btn btn-danger" href="{{route('admin.users.delete', ['id'=>$user->id])}}"><i class="bi bi-trash3"></i> Supprimer</a>
                    </td>
                </tr>
            @empty
                <p> Aucun utilisateur trouvé ! </p>
            @endforelse
        </table>
        </div>
    @endunless
@endsection
