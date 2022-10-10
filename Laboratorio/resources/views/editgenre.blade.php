@extends('inicio')

@section('log')
<style>
    form{
    background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 60px;
        margin: 0 auto;
        width: 500px;
        Height: 420px
    }
</style>
@include('barra.barra')
@if(session('id_rol') == 1) <!--administrador pueden los paises-->
<div class="p-4">
    <form action= "{{action('GenreController@update', $genre->id)}}" method='POST'>
        @method('PUT')
        <center><b>Modificando los datos del genero {{$genre->name}}</b></center>
        <br><div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Nuevo nombre del Genero</label>
            <input name= "name" type="text" class="form-control" id="name" placeholder="{{$genre->name}}">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Nueva descripción del Genero</label>
            <input name= "description" type="text" class="form-control" id="description" placeholder="{{$genre->description}}">
        </div>
        <button type="submit" class="btn btn-primary" required>  Guardar cambios</button>
        <a href="/admineditp/" class="btn btn-danger">Descartar cambios</a>
@else <!--cuando otro usuario intenta editar una cuenta y no es admin o dueño-->
<div  class="p-4"><form>
    <center>SOLO LOS ADMINISTRADOS PUEDEN EDITAR LOS GENEROS!!!<br><br>
    <a href="/profile/{{session('id_login')}}" class="btn btn-info mb-5">Volver a tu perfil</a></center>
</form></div>
@endif
@endsection
