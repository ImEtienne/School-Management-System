
@extends('modele')

@section('title', 'Association de l\'étudiant à un cours')

@section('contents')
    <!----------------------------NAVBAR-------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    <!----------------------------------Formulaire--------------------------->
    <div class="container-sm mt-3">
        <!----------------------------Back-------------------------------->
        <a class="btn btn-info" href="{{route('gestionnaire.seance.index')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <h3>Associé un étudiant à un cours</h3>
        <form action='{{route('gestionnaire.dissocier')}}' method="POST">
            <select name="cours_id">
                <option value="">--Please choose an option--</option>
                @foreach($cours as $cour)
                    <option title="{{$cour->id}}" value="{{$cour->id}}">{{$cour->intitule}}</option>
                @endforeach
            </select>

            {{--<div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">id</label>
                <input type="text" class="form-control" name="id" id="formGroupExampleInput" readonly value="{{old('id', $cours->id)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">intitule</label>
                <input type="text" class="form-control" name="intitule" id="formGroupExampleInput" readonly value="{{old('intitule', $cours->intitule)}}">
            </div>--}}

            {{--<div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Cours_id</label>
                <input type="text" class="form-control" name="cours" id="formGroupExampleInput" readonly value="{{old('cours_id',$seances->cours_id)}}">
            </div>--}}

            <select name="id_etudiant">
                <option value="">--Please choose an option--</option>
                @foreach($etudiants as $etudiant)
                    <option title="{{$etudiant->id}}" value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                @endforeach
            </select>
            <input class="btn btn-success w-auto" type="submit" name="Dissocier" value="Dissocier">
            @csrf
        </form>
    </div>
@endsection
