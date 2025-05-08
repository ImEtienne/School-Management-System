@extends('modele')
@section('title', 'Gestionnaire: Modification du Nom & Prenom')
@section('contents')
    <!---------------------- Nav------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')

    <!-------------------------------Formualire--------------------->
    <div class="container-sm">
        <h3>Formulaire de modifaction du Nom & Prenom - Gestionnaire</h3>
        <form action="{{route('gestionnaire.account.editNomPrenom',['id'=>$users->id])}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom..." value="{{old('nom',$users->nom)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom.." value="{{old('prenom',$users->prenom)}}">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="Supprimer" value="Confirmer">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
