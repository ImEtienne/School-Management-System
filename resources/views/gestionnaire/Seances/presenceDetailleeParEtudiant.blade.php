@extends('modele')

@section('title', "Liste de présences détaillée (par étudiant)")

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($presences))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;Back</a>

            <!---------------------- Table ----------------------------------->
            <table class="table table-striped table-hover table-sm caption-top shadow">
                <caption>Liste de présences détaillée (par étudiant)</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th class="text-center">séance cours</th>
                    <th class="text-center">date_début</th>
                    <th class="text-center">date_fin</th>
                </tr>
                </thead>
                @forelse($presences as $presence)
                    <tr>
                        <td>{{$presence->etudiant_id}}</td>
                        <td>{{$etudiants->nom}}</td>
                        <td>{{$etudiants->prenom}}</td>
                        <td class="text-center">{{ $presence->intitule_cours }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($presence->date_debut)->format('d/m/Y H:i') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($presence->date_fin)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <p>Aucune présence trouvée !</p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection

