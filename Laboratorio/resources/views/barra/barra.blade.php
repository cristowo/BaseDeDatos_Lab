<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
<!--<img src="https://cdn3.emoji.gg/emojis/8784_pengu_dab.gif" alt="" width="50" height="50" class="d-inline-block align-text-top">-->
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">MUZIC</a>
        <!--creo que no es necesario este button-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if (empty(session('id_login')))
            <li class="nav-item">
                <a class="nav-link active" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/register">Register</a>
            </li>
            @else
            @if(session('premium') == false)
                <li class="nav-item">
                    <a class="nav-link active" href="/paysub/{{session('id_login')}}">Suscribirse</a>
                </li>
             @endif
            <li class="nav-item">
                <a class="nav-link active" href="/music">Musica</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/music/fav">Likes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/myplaylist/{{session('id_login')}}">Mis Playlist</a>
            </li>
            <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/profile/{{session('id_login')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="/editprofile/{{session('id_login')}}">Edit Profile</a></li>
                            @if(session('id_rol')==1)<!--solo el admin puede tener esta opcion-->
                                <li><a class="dropdown-item" href='/admineditp'>Menú Edicion Admin</a></li> 
                            @endif    
                            <li> <a class="dropdown-item" href='/logout'>{{ __('Logout') }}</a></li>
                        </ul>
                    </li>
            @endif
        </ul>
    </div>
    </div>
</nav>