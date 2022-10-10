<!DOCTYPE html>
<html lang="en">
@include('barra.barra')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        /* dejar son margen*/
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: arial;
            background: white;
        }
        /* centrar informacion*/
        .seccion-perfil-usuario .perfil-usuario-body,
        .seccion-perfil-usuario {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-items: center;
        }
        .seccion-perfil-usuario .perfil-usuario-header {
            width: 100%;
            display: flex;
            justify-content: center;
            background: linear-gradient(#F75C22, #E80D3B);
            margin-bottom: 1.25rem;
            
        }

        .seccion-perfil-usuario .perfil-usuario-portada {
            display: block;
            position: relative;
            width: 90%;
            height: 17rem;
        }
        /*avatar perfil*/
        .seccion-perfil-usuario .perfil-usuario-avatar {
            display: flex;
            width: 180px;
            height: 180px;
            align-items: center;
            justify-content: center;
            border: 7px solid #FFFFFF;
            background-color: #DFE5F2;
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(0, 0, 0, .2);
            position: absolute;
            bottom: -40px;
            left: calc(50% - 90px);
            z-index: 1;
        }
        /*Foto de perfil*/
        .seccion-perfil-usuario .perfil-usuario-avatar img {
            width: 100%;
            height:100%;
            position: relative;
            border-radius: 50%;
            object-fit: cover;
        }

        /*datos personales*/
        .seccion-perfil-usuario .perfil-usuario-body {
            width: 70%;
            position: relative;
            max-width: 750px;
        }
        /*superior*/
        .seccion-perfil-usuario .perfil-usuario-body .titulo {
            width: 100%;
            font-size: 1.75em;
            margin-bottom: 0.5rem;
        }

        .seccion-perfil-usuario .perfil-usuario-body .texto {
            color: #848484;
            font-size: 0.95em;
        }

        .seccion-perfil-usuario .perfil-usuario-footer,
        .seccion-perfil-usuario .perfil-usuario-bio {
            display: flex;
            flex-wrap: wrap;
            padding: 1.5rem 2rem;
            box-shadow: 0 0 12px rgba(0, 0, 0, .2);
            background-color: #fff;
            border-radius: 15px;
            width: 100%;
        }

        .seccion-perfil-usuario .perfil-usuario-bio {
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .seccion-perfil-usuario .lista-datos {
            width: 50%;
            list-style: none;
        }

        .seccion-perfil-usuario .lista-datos li {
            padding: 5px 0;
        }
    </style>
</head>
<script>

</script>
<body>
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="https://1.bp.blogspot.com/-cKziSzAud-A/YC_yJJpe3YI/AAAAAAAAG-Y/3eBn2ej7z_0ztRYsjftkUJzouZQFAIkEQCPcBGAsYHg/w919/lofi-girl-jinx-lol-uhdpaper.com-4K-3.3244-wp.thumbnail.jpg" alt="img-avatar">
                </div>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo">{{$user->name}} 
                    @if($user->premium == true)
                        <img src="https://cdn-icons-png.flaticon.com/512/6364/6364343.png" width="20" height="20">
                    @endif</h3>
                <p class="texto">
                    @if ($user->id_rol === 1)
                        Administrador
                    @elseif ($user->id_rol === 2)
                        Artista
                    @else
                        Usuario
                    @endif
                </p><br>
            </div>
            @if($user->id_rol === 2)
                <div class="perfil-usuario-footer">
                    {{$user->description}}
                </div>
                <br>
            @endif
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li> Nombre: <b>{{$user->name}}</b></li>
                    <li> Email: {{$user->email}} </li>
                    <li> Nacimiento: {{$user->date_of_birth}}</li>
                </ul>
                <ul class="lista-datos">
                <!--funcion que cuenta los seguidos-->
                <div>
                    <script>var suma = 0;</script>
                        @foreach ($userfollow as $followed)                 <!--datos de userfollow-->
                            @if ($followed->id_user === $user->id)
                                @foreach ($alluser as $uzer)
                                @if ($followed->id_user1 === $uzer->id)
                                <script>var numero1 = 1;var numero2 = suma;var suma = numero1 + numero2;</script> <!--funcion para sumar el numero de seguidos-->
                                @endif
                                @endforeach
                            @endif
                        @endforeach
                </div>
                    <li><a class="dropdown-item" href="/profile/followed/{{$user->id}}">Seguidos:  <b><script>document.writeln(suma);</script></b></a></li>
                <!--funcion que cuenta los seguidores-->
                <div>
                    <script>var suma = 0;</script>
                        @foreach ($userfollow as $followed)                 <!--datos de userfollow-->
                            @if ($followed->id_user1 === $user->id)
                                @foreach ($alluser as $uzer)
                                @if ($followed->id_user === $uzer->id)
                                <script>var numero1 = 1;var numero2 = suma;var suma = numero1 + numero2;</script> <!--funcion para sumar el numero de seguidos-->
                                @endif
                                @endforeach
                            @endif
                        @endforeach
                </div>
                    <li><a class="dropdown-item" href="/profile/followers/{{$user->id}}">Seguidores: <b><script>document.writeln(suma);</script></b></a></li>
                    @if($user->id !== session('id_login'))
                    <?php $a = 0; ?>
                        @foreach ($userfollow as $followed)
                            @if($followed->id_user1 === $user->id  && session('id_login') === $followed->id_user)
                                <form action="{{action('UserFollowController@destroy', $followed->id)}}" method='POST'>
                                @method('PUT')
                                <input type="int" class="form-control" id="id" name="id" value="{{$followed->id}}" hidden>
                                <button type="submit" class="btn btn-danger">UnFollow</button>
                                <?php $a = 1; ?>
                                @endif
                        @endforeach
                        @if($a != '1')
                            <form method="POST" action="/userfollow/create">
                            <div style="display:none;">
                                <input type = "int" name = "id_user" value = "{{session('id_login')}}" />
                                <input type = "int" name = "id_user1" value = "{{$user->id}}" />
                            </div> 
                            <button type="submit" class="btn btn-primary">Follow</button>
                        @endif
                    @endif
                </ul>
                @if($user->id == session('id_login') || session('id_rol')==1) <!--boton para que sea mas facil encontrar al usuario a editar-->
                <a href="/editprofile/{{$user->id}}" class="btn btn-dark">Editar perfil</a>
                @endif
            </div>
            <br>
            <div class="perfil-usuario-footer">
                @if($user->id == session('id_login'))   <!--solo el dueño de la cuenta puede crearse playlists-->
                <a href="/playlist/newplaylist/{{session('id_login')}}" class="btn btn-success">Crear PlayList</a> 
                @endif
                @if(session('id_rol')==1 && $user->id != session('id_login')) <!--El Admin puede crear Playlists a otros usuarios-->
                    <a href="/playlist/newplaylist/{{$user->id}}" class="btn btn-success">Crearle un PlayList</a> 
                @endif
                &nbsp; &nbsp; &nbsp;<a href="/myplaylist/{{$user->id}}" class="btn btn-info">Ver PlayLists</a>
                @if($user->id == session('id_login') && session('id_rol')==2) <!--el artista puede crear canciones su perfil-->
                &nbsp; &nbsp; &nbsp;<a href="/listsong/newsong/{{$user->id}}" class="btn btn-success">Crear Una Canción</a> 
                @endif
                @if(session('id_rol')==1 && $user->id != session('id_login') && $user->id_rol == 2) <!--El Admin puede crear canciones a el perfil del artista-->
                &nbsp; &nbsp; &nbsp;<a href="/listsong/newsong/{{$user->id}}" class="btn btn-success">Crearle Una Canción</a> 
                @endif
                @if($user->id_rol == 2)
                &nbsp; &nbsp; &nbsp;<a href="/listsong/{{$user->id}}" class="btn btn-info">Ver Canciones</a>
                @endif
            </div>
            </div>
    </section>
</body>
</html>