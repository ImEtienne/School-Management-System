
@extends('modele')

@section('title', 'Association de l\'étudiant à un cours')

@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('enseignant.partials.navbar-enseignant')
    <!----------------------------------Formulaire--------------------------->
    <div class="container-sm mt-3">
        <!----------------------------Back-------------------------------->
        <a class="btn btn-info" href="{{route('enseignant.showSeance')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <h3>Pointage de plusieurs étudiants d’un coup pour la séance.</h3>
        <form method="POST">

            <select name="id">
                <option value="">--Choix une séance--</option>
                @foreach($seances as $seance)
                    <option title="{{$seance->id}}" value="{{$seance->id}}">{{$seance->id}}</option>
                @endforeach
            </select>
                <legend>--choisir les etudiants--</legend>
                @foreach($etudiants as $etudiant)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$etudiant->id}}" name="id_etudiant[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault" title="{{$etudiant->id}}">{{$etudiant->nom}}{{$etudiant->prenom}} </label>
                    </div>
                @endforeach
            <input class="btn btn-success w-auto" type="submit" name="associer" value="Pointer">
            @csrf
        </form>
    </div>
@endsection

