@extends('modele')

@section('title', 'Modication et validation')

@section('contents')
    @include('admin.partials.navbar-admin')

    <!---------------------- FORM ------------------------------->
    <div class="d-flex flex-column h-90">
        <div class="position-relative">
            <div class="container-sm mt-2">
                <div class="position-absolute top-50 start-50 translate-middle-x">
                    <p>Formulaire de modification</p>
                    <form action="{{route('admin.users.edit',['id'=>$users->id])}}" method="POST">
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" id="formGroupExampleInput2" placeholder="nom..." value="{{old('nom',$users->nom)}}">
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Prenom</label>
                            <input type="text" class="form-control" name="prenom" id="formGroupExampleInput2" placeholder="prenom.." value="{{old('prenom',$users->prenom)}}">
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Type</label>
                            <select name="type">
                                <option value="">--Veuillez choisir un type--</option>
                                <option value="admin">Administrateur</option>
                                <option value="enseignant">Enseignant</option>
                                <option value="gestionnaire">Gestionnaire</option>
                            </select>
                        </div>

                        <input class="btn btn-success w-auto" type="submit" name="Accepter" value="Accepter">
                        <input class="btn btn-danger w-auto" type="submit" name="Refuser" value="Refuser">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------------- END FORM ------------------------------------>

@endsection
