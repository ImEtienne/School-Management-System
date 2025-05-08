<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="{{route('enseignant.home')}}"><span style="background-color:#ffa400; padding: 0px 5px;">Ma</span> page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('enseignant.home')}}">Accueil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('enseignant.showSeance')}}">Voir séance</a>
                <li>

                @if(Auth::user()->type == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.home')}}">Back To Home Admin</a>
                    <li>
                @endif


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('enseignant.account.edit')}}">Changer son mot de passe</a></li>
                        <li><a class="dropdown-item" href="{{route('enseignant.account.editNomPrenom', ['id'=>Auth::user()->id])}}">Modifier son nom/prénom</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

