@extends('modele')
@section('title', 'Changement du mot de passe')
@section('contents')
    <!---------------------- Nav------------------------->
    @include('gestionnaire.partials.navbar-gestionnaire')
    <!---------------------- ENDNav------------------------->

    <div class="container-sm mt-3">
        <h3>Modification du mot de passe : </h3>
        <form action="{{route('gestionnaire.account.edit')}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Ancien Mot de passe</label>
                <input type="password" class="form-control" name="mdp_old"  id="formGroupExampleInput2" placeholder="ancien mot de passe.." required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="mdp"  id="formGroupExampleInput2" placeholder="nouveau mot de passe.." required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Confirmer</label>
                <input type="password" class="form-control" name="mdp_confirmation"  id="formGroupExampleInput2" placeholder="Confirmer mot de passe.." required>
            </div>
            <input class="btn btn-primary w-auto" type="submit" name="Supprimer" value="Confirmer">
            @csrf
        </form>
    </div>
@endsection
