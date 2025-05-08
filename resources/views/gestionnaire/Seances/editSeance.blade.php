@extends('modele')

@section('title', 'Modifier la séance')

@section('contents')
    <!----------------------------NAVBAR-------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    <!----------------------------Back-------------------------------->
    <a class="btn btn-info mt-3" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i>&nbsp;Back</a>


    <!------------------------ Formulaire ------------------------>
    <div class="container-sm mt-3">
        <h3>Modifier une séance de cours</h3>
        <form action='{{route('gestionnaire.seance.edit',['id'=>$seances->id])}}' method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Cours_id</label>
                <input type="text" class="form-control" name="cours" id="formGroupExampleInput" readonly value="{{old('cours_id',$seances->cours_id)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de début : </label>
                <input type="datetime-local" class="form-control" name="date_debut" id="formGroupExampleInput" value="{{old('date_debut',$seances->date_debut)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de fin : </label>
                <input type="datetime-local" class="form-control" name="date_fin" id="formGroupExampleInput" value="{{old('date_fin',$seances->date_fin)}}">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="Modifier" value="Modifier">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
