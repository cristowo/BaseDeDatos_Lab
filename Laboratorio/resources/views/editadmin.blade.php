@extends('inicio')

@section('log')
<style>
    form{
    background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 60px;
        margin: 0 auto;
        width: 600px;
        Height: 230px
    }
</style>
@include('barra.barra')
@if(session('id_rol') == 1) <!--solo un administrador pueden editar-->
<br><form><b>Edicion De Usuarios</b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/editprofile/' + this.value">
        <option value="">Seleccione un usuario a editar</option>
        @foreach ($users as $user)
            <option value="{{$user->id}}">ID: {{$user->id}}, Nombre: {{$user->name}}</option>
        @endforeach
    </select></div></form>
<br><form><b>Edicion De Canciónes</b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/editsong/' + this.value">
        <option value="">Seleccione una canción a editar</option>
        @foreach ($songs as $song)
            <option value="{{$song->id}}">ID: {{$song->id}}, Nombre: {{$song->name}}</option>
        @endforeach
    </select></div></form>
<br><form><b>Crear Nueva Canción a Usuario (Solo Artistas) </b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/listsong/newsong/' + this.value">
        <option value="">Seleccione un usuario a crearle la canción</option>
        @foreach ($users as $user)
            @if($user->id_rol == 2)
            <option value="{{$user->id}}">ID: {{$user->id}}, Nombre: {{$user->name}}</option>
            @endif
        @endforeach
    </select></div></form>
<br><form><b>Edicion De Playlists </b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = 'playlist/editplaylist/' + this.value">
        <option value="">Seleccione una playlist a editar</option>
        @foreach ($playlists as $playlist)
            <option value="{{$playlist->id}}">ID: {{$playlist->id}}, Nombre: {{$playlist->name}}</option>
        @endforeach
    </select></div></form>
<br><form><b>Crear Nueva Playlist a Usuario</b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/playlist/newplaylist/' + this.value">
        <option value="">Seleccione un usuario a crearle la playlist</option>
        @foreach ($users as $user)
            <option value="{{$user->id}}">ID: {{$user->id}}, Nombre: {{$user->name}}</option>
        @endforeach
    </select></div></form>
<br><form><b>Edicion De Paises <a href='/newcountry' class="btn btn-success">Nuevo País</a></b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/editcountry/' + this.value">
        <option value="">Seleccione un pais a editar</option>
        @foreach ($countries as $country)
            <option value="{{$country->id}}">ID: {{$country->id}}, Nombre: {{$country->country}}</option>
        @endforeach
    </select></div></form>
<br><form><b>Edicion De Genero <a href='/newgenre' class="btn btn-success">Nuevo Genero</a></b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/editgenre/' + this.value">
        <option value="">Seleccione un genero a editar</option>
        @foreach ($genres as $genre)
            <option value="{{$genre->id}}">ID: {{$genre->id}}, Nombre: {{$genre->name}}</option>
        @endforeach
    </select></div></form>
@endif