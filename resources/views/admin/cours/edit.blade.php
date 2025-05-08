
@extends('modele')

@section('title', 'Modication et validation')

@section('contents')
    @include('admin.partials.navbar-admin')

    <div class="container-sm mt-4">
        <!-----------------------------Btn Back------------------------------>
        <a class="btn btn-info mt-3" href="{{ URL::previous() }}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <p>Formulaire de modification</p>
        <form action="{{route('admin.cours.edit',['id'=>$cours->id])}}" method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Intitule</label>
                <input type="text" class="form-control" name="intitule" id="formGroupExampleInput2" placeholder="intitule..." value="{{old('intitule',$cours->intitule)}}">
            </div>

            <input class="btn btn-primary w-0" type="submit" name="Modifier" value="Modifier">
            <input class="btn btn-danger w-0" type="submit" name="Annuler" value="Annuler">
            @csrf
        </form>
    </div>
@endsection
