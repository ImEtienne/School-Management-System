@extends('modele')

@section('title', 'Liste séance pour un cours')

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    @unless(empty($seances))
        <div class="container-sm mt-3">
            <!----------------------------Back-------------------------------->
            <a class="btn btn-info" href="{{route('gestionnaire.seance.index')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
            <!----------------------------Table------------------------------>
            <table class="table table-striped table-hover caption-top shadow-lg">
                <caption>Liste séance pour un cours</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>intitulé</th>
                    <th>date_debut</th>
                    <th>date_fin</th>
                </tr>
                </thead>
                @forelse($seances as $seance)
                    <tr>
                        <td>{{$seance ->id}}</td>
                        <td>{{$seance->cours->intitule}}</td>
                        <td>{{$seance ->date_debut}}</td>
                        <td>{{$seance ->date_fin}}</td>
                    </tr>
                @empty
                    <p> Aucune séance trouvée ! </p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection



