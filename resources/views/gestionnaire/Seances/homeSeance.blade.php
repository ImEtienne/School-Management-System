@extends('modele')

@section('title', 'Gestion des séances des cours')

@section('contents')
    <!---------------------- Nav------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($cours))
        <div class="container-sm mt-3">
            <!-------------------------Liste des séances-------------------->
            <button title="Liste des séances de cours mt-3" class="btn btn-info" type="button"  aria-expanded="false">
                <a href="{{route('gestionnaire.seance.afficheList')}}"><i class="bi bi-eye-fill"></i>&nbsp;Voir liste séances</a>
            </button>

            <!-------------------------Liste des cours associés à des enseignants-------------------->
            <button title="Liste des séances de cours mt-3" type="button" class="btn btn-info" aria-expanded="false">
                <a href="{{route('gestionnaire.liste.enseignant')}}"><i class="bi bi-chevron-contract"></i>&nbsp;Liste des cours associés à des enseignants</a>
            </button>

            <!-------------------------Associer des étudiants au cours (plusieurs d’un coup).-------------------->
            <button title="Liste des séances de cours mt-3" type="button" class="btn btn-info" aria-expanded="false">
                <a href="{{route('gestionnaire.etudiant.associePlusieurs')}}"><i class="bi bi-chevron-contract"></i>&nbsp;Associé Plusieurs Etudiant</a>
            </button>

            <!-------------------------Dissocier étudiants plusieurs au cours (plusieurs d’un coup).-------------------->
            <button title="Liste des séances de cours mt-3" type="button" class="btn btn-info" aria-expanded="false">
                <a href="{{route('gestionnaire.etudiant.dissociePlusieurs')}}"><i class="bi bi-chevron-contract"></i>&nbsp;dissocié Plusieurs Etudiant</a>
            </button>

            <!------------------------ Formulaire -------------------------->
            {{--<form action="{{route('gestionnaire.seance.afficheListSeanceUncours')}}">
                <h6>Liste des séances pour un cours</h6>
                <select name="cours" style="margin-bottom: 5px;" class="form-select" aria-label="Default select example">
                        <option value="" selected>--Veuillez choisir le cours--</option>
                    @foreach($cours as $cour)
                        <option title="{{$cour->id}}" value="{{$cour->id}}">{{$cour->intitule}}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary" type="submit" name="liste" value="Voir la liste">
            </form>--}}
            <!---------------------- Table --------------------------------->
            <table class="table table-striped table-sm table-hover caption-top shadow">
                <caption>Liste des cours</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>intitule</th>
                    <th>created_at</th>
                    <th>update_at</th>
                    <th class="text-nowrap">Créer séance</th>
                    <th class="text-nowrap">Séances cours</th>
                    <th class="text-nowrap">Étudiant</th>
                    <th class="text-nowrap">Voir étudiant associé cours</th>
                    <th class="text-nowrap">Enseignant</th>
                    <th class="text-nowrap">Voir ens. associé au cours</th>
                </tr>
                </thead>
                @forelse($cours as $cour)
                    <tr>
                        <td>{{$cour ->id}}</td>
                        <td>{{$cour ->intitule}}</td>
                        <td>{{$cour ->created_at}}</td>
                        <td>{{$cour ->updated_at}}</td>
                        <td class="text-nowrap"><a type="button" class="btn btn-primary btn-md" href="{{route('gestionnaire.seance.create',['id'=>$cour->id])}}"><i class="bi bi-plus-circle"></i>&nbsp;Créer</a></td>
                        <td class="text-nowrap"><a type="button" class="btn btn-dark btn-md" href="{{route('gestionnaire.seance.afficheListSeanceUncours',['id'=>$cour->id])}}"><i class="bi bi-eye-fill"></i>&nbsp;Voir</a></td>
                        <td class="text-nowrap"><a type="button" class="btn btn-info btn-md" href="{{route('gestionnaire.etudiant.associe', [$cour->id])}}"><i class="bi bi-chevron-contract"></i>&nbsp;Associé</a></td>
                        <td class="text-nowrap"><a type="button" class="btn btn-success btn-md" href="{{route('gestionnaire.seance.showListAssociationEtudaint', [$cour->id])}}"><i class="bi bi-eye-fill"></i>&nbsp;Voir Etudiant</a></td>
                        <td class="text-nowrap"><a type="button" class="btn btn-info btn-md" href="{{route('gestionnaire.associer.enseignant', [$cour->id])}}"><i class="bi bi-chevron-contract"></i>&nbsp;Associer</a></td>
                        <td class="text-nowrap"><a type="button" class="btn btn-success btn-md" href="{{route('gestionnaire.seance.showListAssociationEnseignant', [$cour->id])}}"><i class="bi bi-eye-fill"></i>&nbsp;Voir Enseignant</a></td>
                    </tr>
                @empty
                    <p>Aucun cours trouvé !</p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection
