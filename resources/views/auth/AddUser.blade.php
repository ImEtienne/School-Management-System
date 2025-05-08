@extends('modele')

@section('title', 'Page confirmation - Suppression')

@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('admin.partials.navbar-admin')

    <div class="container-sm mt-3">
        <h3>Formulaire D'ajout d'un utilisateur</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" id="formGroupExampleInput" placeholder="login..." value="{{old('login')}}" required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom..." value="{{old('nom')}}" required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom.." value="{{old('prenom')}}" required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">password</label>
                <input type="password" class="form-control" name="mdp" id="formGroupExampleInput2" placeholder="mot de passe.." required>
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">password</label>
                <input type="password" class="form-control" name="mdp_confirmation" id="formGroupExampleInput2" placeholder="confirmation mot de passe.." required>
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="Supprimer" value="Confirmer">
            <input class="btn btn-danger w-auto" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection

