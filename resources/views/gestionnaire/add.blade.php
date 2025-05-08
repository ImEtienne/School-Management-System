@extends('modele')
@section('title', 'Ajoute étudiant')
@section('contents')
    <!------------------------ Nav--------------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    <!------------------------------Formulaire d'ajout----------------------------->
    <div class="container-sm mt-3">
        <h3>Ajout étudiant</h3>
        <form action="{{route('gestionnaire.etudiant.add')}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom...">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom..">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Noet</label>
                <input type="text" class="form-control" name="noet" id="formGroupExampleInput2" placeholder="Numéro étudiant..">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="ajouter" value="Ajouter">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
