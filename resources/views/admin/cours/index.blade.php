@extends('modele')
@section('title', 'Gestion des Cours')
@section('contents')
    <!--------------------- NavBar --------------------------->
    @include('admin.partials.navbar-admin')
    <!--------------------------- END NAVBAR ----------------------------------->
    @unless(empty($cours))
        <div class="container-sm mt-4">
            <!-----------------------------Btn Back------------------------------>
            <a class="btn btn-info mt-3" href="{{ URL::previous() }}"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>

            <!------------------------------btn ajoute Cours-------------------------->
            <a type="buttom" class="btn btn-info mt-3" href="{{route('admin.cours.add')}}"><i class="bi bi-plus-circle-fill"></i> Ajoute Cours</a>

            <!---------------------------- Barre de recherche --------------->
            <form action="{{route('admin.cours.search')}}" class="d-flex mt-3">
                <input class="form-control me-2" type="search" name="q" value="{{request()->q ?? ''}}" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary"  type="submit">Recherche</button>
            </form>

            <!---------------------- Table --------------------------------->
            <table class="table table-hover caption-top mb-3 shadow-sm">
                <caption>Liste des cours</caption>
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>intitule</th>
                    <th>created_at</th>
                    <th>update_at</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                @forelse($cours as $cour)
                    <tr>
                        <td>{{$cour ->id}}</td>
                        <td>{{$cour ->intitule}}</td>
                        <td>{{$cour ->created_at}}</td>
                        <td>{{$cour ->updated_at}}</td>
                        <td class="text-center">
                            <a type="button" class="btn btn-primary" href="{{route('admin.cours.edit', ['id'=>$cour->id])}}"><i class="bi bi-pencil-square"></i> Modifier</a>
                            <a type="button" class="btn btn-danger" href="{{route('admin.cours.delete', ['id'=>$cour->id])}}"><i class="bi bi-trash3"></i> Supprimer</a>
                        </td>
                    </tr>
                @empty
                    <p> Aucun cours trouvé ! </p>
                @endforelse
            </table>
        </div>
    @endunless
@endsection
