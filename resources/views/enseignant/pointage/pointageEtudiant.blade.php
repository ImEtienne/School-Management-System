@extends('modele')

@section('title', 'Association de l\'étudiant à un cours')

@section('contents')
    <!--------------------- NavBar ------------------------------->
    @include('enseignant.partials.navbar-enseignant')

    <!----------------------------------Formulaire--------------------------->
    <div class="container-sm mt-3">
        <!----------------------------Back-------------------------------->
        <a class="btn btn-info" href="{{route('enseignant.showSeance')}}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

        <h3>Pointer un enseignant à un cours</h3>
        <form action='{{route('enseignant.pointer.etudiant', [$seances->id])}}' method="POST">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">ID</label>
                <input type="text" class="form-control" name="id" id="formGroupExampleInput" readonly value="{{old('cours_id',$seances->id)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Cours_id</label>
                <input type="text" class="form-control" name="cours" id="formGroupExampleInput" readonly value="{{old('cours_id',$seances->cours_id)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de début : </label>
                <input type="datetime-local" class="form-control" name="date_debut" id="formGroupExampleInput" readonly value="{{old('date_debut',$seances->date_debut)}}">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Date de fin : </label>
                <input type="datetime-local" class="form-control" name="date_fin" id="formGroupExampleInput" readonly value="{{old('date_fin',$seances->date_fin)}}">
            </div>

            <select name="id_etudiant">
                <option value="">--Please choose an option--</option>
                @foreach($etudiants as $etudiant)
                    <option title="{{$etudiant->id}}" value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                @endforeach
            </select><br>
            <input class="btn btn-success w-auto" type="submit" name="associer" value="Associer">
            @csrf
        </form>
    </div>
@endsection

