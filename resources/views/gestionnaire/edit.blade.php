@extends('modele')

@section('title', 'Modifier l\'étudiant')

@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <!------------------------ END Nav--------------------------------->
    <!-----------------------------Formulaire de modification------------------->
    <div class="container-sm mt-4">
        <h3>Modify étudiant</h3>
        <form action="{{route('gestionnaire.etudiant.edit', ['id'=>$etudiants->id])}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom..." value="{{old('nom',$etudiants->nom)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom.." value="{{old('prenom', $etudiants->prenom)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Noet</label>
                <input type="text" class="form-control" name="noet" id="formGroupExampleInput2" placeholder="numéro étudiant.." value="{{old('noet', $etudiants->noet)}}">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="Supprimer" value="Confirmer">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
