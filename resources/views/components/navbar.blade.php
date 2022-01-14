
<nav class="navbar navbar-expand-md mynavbar">
    <div class="container-fluid">
        <a class="navbar-brand mybrand" href="{{route('homepage')}}">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                <span class="nav-item">
                    <a class="nav-link primary bold" aria-current="page" href="{{route('homepage')}}"><i class="fas fa-home"></i></a>
                </span>
                @guest
                    <li class="nav-item">
                        <a class="nav-link primary bold" href="{{route('register')}}">Registrati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link primary bold" href="{{route('login')}}">Accedi</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <span class="nav-link disabled bold" style="color: rgb(134, 86, 211) !important;">Benvenuto {{Auth::user()->name}}</span>
                    </li>
                    @if (Auth::user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link primary bold" href="{{route('revisor.home')}}">
                                Revisiona
                                @if (\App\Models\Announcement::ToBeRevisionedCount()!=0)
                                    <span class="badge bg-warning primary bold rounded-circle mybadge">
                                        {{\App\Models\Announcement::ToBeRevisionedCount()}}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle primary bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Annunci
                    </a>
                        <ul class="dropdown-menu text-center" style="left: -2rem; background-color:black;" aria-labelledby="navbarDropdown">
                            <li><a class="drop-item primary bold" href="{{route('announcement.create')}}">Crea annuncio</a></li>
                            <li><a class="drop-item primary bold" href="{{route('announcement.show')}}">I tuoi annunci</a></li>

                            <li><hr class="dropdown-divider" style="color: white"></li>
                            <li><a class="drop-item primary bold" href="{{route('logout')}}" 
                                onclick="event.preventDefault(); 
                                document.getElementById('form-logout').submit();">
                                Logout</a></li>
                            <form method="POST" action="{{route('logout')}}" id="form-logout">
                                @csrf
                            </form>
                        </ul>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>