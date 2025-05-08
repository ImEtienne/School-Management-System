@extends('modele')

@section('title', 'Ajouter un cours')

@section('contents')
    @include('admin.partials.navbar-admin')
    <div class="container-sm mt-4">
        <!-----------------------------Btn Back------------------------------>
        <a class="btn btn-info mt-3" href="{{ URL::previous() }}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a><br>
        <h4>Formulaire d'ajout</h4>
        <form action="{{route('admin.cours.add')}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Intitulé</label>
                <input type="text" class="form-control" name="intitule" id="formGroupExampleInput" placeholder="intitule...">
            </div>

            <input class="btn btn-primary w-auto" type="submit" name="creer" value="Créer">
            @csrf
        </form>
    </div>
@endsection
