<!--------------------- NavBar ------------------------------->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand mb-0" href="{{route('admin.home')}}"><span style="background-color:#ffa400; padding: 0px 5px;" class="text-white">Ma</span>page</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Accueil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"  href="{{route('admin.users.index')}}">Utilisateur</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.cours.index')}}">Cours</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('gestionnaire.home')}}">Partie gestionnaire</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('enseignant.home')}}">Partie enseignant</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{route('admin.account.edit')}}">Changer son mot de passe</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.account.editNomPrenom',['id'=>Auth::user()->id])}}">Modifier son nom/prénom</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
