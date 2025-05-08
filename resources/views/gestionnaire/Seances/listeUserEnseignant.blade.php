@extends('modele')

@section('title', 'ajout étudiant')

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($users))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;Back</a>

            <!---------------------- Table ----------------------------------->
            <table class="table able-striped table-hover caption-top shadow">
                <caption>Liste des cours associés à des étudiants</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Type</th>
                    <th>Dissocier</th>
                    <th>Voir</th>
                </tr>
                </thead>
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user ->nom}}</td>
                        <td>{{$user ->prenom}}</td>
                        <td>{{$user ->type}}</td>
                        <td><a type="button" class="btn btn-warning" href="{{route('gestionnaire.dissocier.enseignant', ['id'=>$user->id])}}"><i class="bi bi-trash3-fill"></i>&nbsp;Dissocier</a></td>
                        <td><a type="button" class="btn btn-dark" href="{{route('gestionnaire.seance.ListEnseignant', ['id'=>$user->id])}}"><i class="bi bi-eye-fill"></i>&nbsp;Voir les associations</a></td>
                    </tr>
                @empty
                    <p>Aucun utilisateur Enseignant trouvé !</p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection


