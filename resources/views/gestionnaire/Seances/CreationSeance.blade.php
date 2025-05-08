@extends('modele')

@section('title', 'Formulaire de création des séances')

@section('contents')
    <!---------------------- Nav------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <!------------------------ Formulaire ------------------------>
    <div class="container-sm mt-3">
        <!----------------------------Back-------------------------------->
        <a class="btn btn-info" style="margin-top:10px;margin-bottom:10px;" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <h3>Créer une séance de cours</h3>
        <form action='{{route('gestionnaire.seance.create',['id'=>$cours->id])}}' method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Intitule</label>
                <input type="text" class="form-control" name="cours" id="formGroupExampleInput" readonly value="{{old('intitule',$cours->intitule)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de début : </label>
                <input type="datetime-local" step="1" class="form-control" name="date_debut" id="formGroupExampleInput">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de fin : </label>
                <input type="datetime-local" step="1" class="form-control" name="date_fin" id="formGroupExampleInput">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="creer" value="Créer">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
