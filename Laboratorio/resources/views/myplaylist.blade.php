@extends('inicio')

@section('log')
<style>
    form{
    background-color: #252525;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 60px;
        margin: 0 auto;
        width: 800px;
        Height: 210px
    }
    .contenedor{
        position: relative;
        display: inline-block;
        text-align: center;
        max-width: 100%;
        max-height: 100%;
        padding: 50px;
    }
</style>
@include('barra.barra')
<br><form>
    <center>
        <h1 style="color: white"><b>PlayLists de {{$user->name}}</b></h1>
        <a href="/profile/{{$user->id}}" class="btn btn-info">Ver perfil</a>
        @if($user->id == session('id_login') || session('id_rol')==1)   <!--solo el dueño de la cuenta puede crear playlists o un admin-->
        <a href="/playlist/newplaylist/{{session('id_login')}}" class="btn btn-success">Crear PlayList</a>
        @endif
        <br><p style="color: white">(Recuerda tocar la foto del PlayList para acceder a su contenido)</p>
        </center>
</form>
<div p-4><center>
        @foreach($playlists as $playlist)
            @if($playlist->id_user === $user->id)
                        <div class='contenedor'>
                        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                            <a href="/oneplaylist/{{$playlist->id}}"><img class="card-img-top" src="https://pm1.narvii.com/7700/f761838baf686773ed02255a50caa18b2b2a4728r1-2048-2048v2_hq.jpg" alt="Card image cap"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{$playlist->name}}</h5>
                                <p class="card-text">Creada por {{$user->name}}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-white bg-dark mb-3">Total de Canciónes: {{$playlist->songs}}</li>
                                <li class="list-group-item text-white bg-dark mb-3">Duracion: {{$playlist->duration}}</li>
                                <li class="list-group-item text-white bg-dark mb-3">Fecha de creación: {{$playlist->created_at}}</li>
                            </ul>
                            @if($user->id == session('id_login') || session('id_rol')==1)
                            <div class="card-body">
                                <a href="/playlist/editplaylist/{{$playlist->id}}" class="btn btn-info">Editar PlayList</a><br>
                                <br><a href="/playlist/addcolplaylist/{{$playlist->id}}" class="btn btn-secondary">Añadir Colaboradores a Playlist</a><br>
                                <br><a href="/playlist/deleteplaylist/{{$playlist->id}}" class="btn btn-danger">Eliminar PlayList</a>
                            </div>
                            @endif
                            @foreach($colabs as $colab)
                                @if($colab->id_user == session('id_login') && $colab->id_playlist == $playlist->id && session('id_rol')!=1)<!-- se elimina al admin porque el ya deberia tener esta opción-->
                                <div class="card-body">
                                    <a href="" class="btn btn-info">Editar PlayList</a><br>
                                @endif
                            @endforeach
                        </div>
                        </div>
            @endif
        @endforeach
        </center></div>
<div p-4><center>
<!--COLABORACIONES-->
    @foreach($playlists as $playlist)
            @foreach($colabs as $colab)
                @if($colab->id_user == $user->id && $colab->id_playlist == $playlist->id)
                            <div class='contenedor'>
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">Colaboración
                                <a href="/oneplaylist/{{$playlist->id}}"><img class="card-img-top" src="https://pm1.narvii.com/7700/f761838baf686773ed02255a50caa18b2b2a4728r1-2048-2048v2_hq.jpg" alt="Card image cap"></a>
                                <div class="card-body">
                                    <h5 class="card-title">{{$playlist->name}}</h5>
                                    <p class="card-text">Creada por 
                                        @foreach($users as $us)
                                            @if($playlist->id_user == $us->id)
                                                {{$us->name}}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-white bg-dark mb-3">Total de Canciónes: {{$playlist->songs}}</li>
                                    <li class="list-group-item text-white bg-dark mb-3">Duracion: {{$playlist->duration}}</li>
                                    <li class="list-group-item text-white bg-dark mb-3">Fecha de creación: {{$playlist->created_at}}</li>
                                </ul>
                                @if($user->id == session('id_login') || session('id_rol')==1)
                                <div class="card-body">
                                    <a href="/playlist/editplaylist/{{$playlist->id}}" class="btn btn-info">Editar PlayList</a><br>
                                    @if(session('id_rol')==1)
                                    <br><a href="/playlist/addcolplaylist/{{$playlist->id}}" class="btn btn-secondary">Añadir Colaboradores a Playlist</a><br>
                                    @endif
                                    @if(session('id_login') != $user->id)
                                    <br><a href="/playlist/editplaylist/deletecolab/{{$playlist->id}}/{{session('id_login')}}" class="btn btn-danger">Eliminar {{$user->name}} de colaborador</a>
                                    @endif
                                    @if(session('id_login') == $user->id)
                                    <br><a href="/playlist/editplaylist/deletecolab/{{$playlist->id}}/{{session('id_login')}}" class="btn btn-danger">Dejar de ser colaborador</a>
                                    @endif
                                </div>
                                @endif
                            </div>
                            </div>
                @endif
            @endforeach
        @endforeach
</center></div>