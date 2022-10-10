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
        Height: 600px
    }
    .element-selector {
    all: unset !important; 
    }
</style>
@include('barra.barra')
@if($user->id === session('id_login') || session('id_rol') == 1) <!--solo el usuario del perfil o un administrador pueden editar la cuenta-->
<div class="p-4">
    <form action= "{{action('UserController@update', $user->id)}}" method='POST'>
        @method('PUT')
        <center><b>Modificando los datos de {{$user->name}}</b></center>
        <br><div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Nombre</label>
            <input name= "name" type="text" class="form-control" id="name" placeholder="{{$user->name}}">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Correo electronico</label>
            <input name= "email"type="email" class="form-control" id="email" placeholder="{{$user->email}}">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Nueva contraseña</label>
            <input name= "password" type="text" class="form-control" id="password" placeholder="*********">
        </div>
        <button type="submit" class="btn btn-primary" required>  Guardar cambios</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <a href="/profile/{{$user->id}}" class="btn btn-danger">Descartar cambios</a><br>
        <br><div style="text-align: center;"><a href="/profile/subs/{{$user->id}}" class="btn btn-info">Historial de suscripciones</a></div>
    </form>
    
    @if(session('id_rol') == 1)<!--opciones que solo un admin puede tener-->
    <br><form action= "{{action('UserController@update', $user->id)}}" method='POST'>
        @method('PUT')
        <center><b>Opciones de desarrollador</b></center><br>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">ID Rol (1 admin, 2 artista, 3 usuario)</label>
            <input name= "id_rol" type="int" class="form-control" id="id_rol" placeholder="{{$user->id_rol}}">
        </div>
        Pais
        <select class="form-select" aria-label="Default select example" name="id_country">
            <option value="">@foreach($countries as $country)
                                @if($country->id == $user->id_country)
                                    País anterior: {{$country->country}}
                                @endif
                            @endforeach
            </option>
            @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->country}}</option>
            @endforeach
        </select>
        Fecha de nacimiento
        <label class="col-md-6">
            <label for="date_of_birth" class="form-label"></label>
            <input type="date" name="date_of_birth" class="form-control">
        </label>
        <br><br><div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label ">Premium (1 = true/ 0 = false)</label>
            <input name= "premium" type="boolean" class="form-control" id="premium" placeholder="{{$user->premium}}">
        </div>
        <button type="submit" class="btn btn-primary" required>  Guardar cambios</button>
        <a href="/profile/{{$user->id}}" class="btn btn-danger">descartar cambios</a>
    </form><br>
    @endif
@else <!--cuando otro usuario intenta editar una cuenta y no es admin o dueño-->
<div  class="p-4"><form>
    <center>SOLO LOS ADMINISTRADOS Y EL PROPIO USUARIO PUEDEN EDITAR SU INFORMACIÓN!!!<br><br>
    <a href="/profile/{{session('id_login')}}" class="btn btn-info mb-5">Volver a tu perfil</a></center>
</form></div>
@endif
<form action="{{action('UserController@destroy', $user->id)}}" method='POST'>
    @method('PUT')
    <input type="int" class="form-control" id="id" name="id" value="{{$user->id}}" hidden>
    <center>Seguro de Eliminar usuario?, una vez eliminado no hay vuelta atras.</center>
    <br><button type="submit" class="btn btn-danger">Eliminar usuario</button>
</form>
@endsection
