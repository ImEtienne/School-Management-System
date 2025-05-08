<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <!-- Boostrap ICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <!-- CSS perso -->
        <link href="{{asset('style.css')}}" rel="stylesheet" type="text/css"/>

        <!-- Redirection des pages -->
        @yield('redirect')
    </head>
    <body class="d-flex flex-column min-vh-100">
            <!-- Messages Flash -->
            @section('Messages_flash')
                @if(session()->has('etat'))
                    <div class="position-relative" style="z-index:1;">
                        <div class="position-absolute top-0 start-50 translate-middle-x">
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="40" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/>
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                <div>
                                    <p class="etat">
                                        {{session()->get('etat')}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            @show

            <!--error validation-->
            @section('validation')
                @if ($errors->any())
                    <div class="position-relative" style="z-index:1;">
                        <div class="position-absolute top-0 start-50 translate-middle-x">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @show

        <!-- Contents Page-->
            <main class="flex-grow-1">
                @yield('contents')
            </main>

        <!------------- Footer ------------------->
            @section('footer')
                @auth
                    <footer class="footer bg-light text-muted py-3 border-top">
                        <div class="container d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                Vous êtes connecté en tant que <strong>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</strong> |
                                {{ Auth::user()->type }}
                                <a class="btn btn-outline-secondary btn-sm ms-2" href="{{ route('logout') }}">Déconnexion</a>
                            </div>
                            <div class="text-end">
                                &copy; <script>document.write(new Date().getFullYear());</script> Projet
                            </div>
                        </div>
                    </footer>
                @endauth
            @show

            <!-- Bootstrap Bundle avec Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>
