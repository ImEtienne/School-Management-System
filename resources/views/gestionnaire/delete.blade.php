@extends('modele')
@section('title', 'Page confirmation - Suppression étudiant')
@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <!------------------------ END Nav--------------------------------->
    <div class="container-sm">
        <h3>Voulez-vous supprimer {{$etudiants->nom}} {{$etudiants->prenom}} ?</h3>
        <form action='{{route('gestionnaire.etudiant.delete',['id'=>$etudiants->id])}}' method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom..." value="{{old('nom',$etudiants->nom)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom.." value="{{old('prenom',$etudiants->prenom)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Noet</label>
                <input type="text" class="form-control" name="noet" id="formGroupExampleInput2" placeholder="numéro étudiant.." value="{{old('noet',$etudiants->noet)}}">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="Supprimer" value="Supprimer">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
