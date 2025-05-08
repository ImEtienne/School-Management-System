
@extends('modele')

@section('title', 'Association de l\'étudiant à un cours')

@section('contents')
    <!----------------------------NAVBAR-------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <!----------------------------------Formulaire--------------------------->
    <div class="container-sm mt-3">
        <!----------------------------Back-------------------------------->
        <a class="btn btn-info" href="{{URL::previous()}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <h3>Dissocié plusieurs étudiants d’un coup pour la séance.</h3>
        <form method="POST">

            <select name="id">
                <option value="">--Choix un d'un cours--</option>
                @foreach($cours as $cour)
                    <option title="{{$cour->id}}" value="{{$cour->id}}">{{$cour->intitule}}</option>
                @endforeach
            </select>


            <legend>--choisir les etudiants--</legend>
            @foreach($etudiants as $etudiant)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$etudiant->id}}" name="id_etudiant[]" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" title="{{$etudiant->id}}">{{$etudiant->nom}}{{$etudiant->prenom}} </label>
                </div>
            @endforeach


            <input class="btn btn-success w-auto" type="submit" name="associer" value="Dissocier">
            @csrf
        </form>
    </div>
@endsection

