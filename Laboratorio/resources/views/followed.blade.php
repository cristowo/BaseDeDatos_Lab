@extends('inicio')

@section('log')
<style>
    form{
    background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 30px;
        margin: 5px auto;
        width: 500px;
        Height: 50px;
    }
</style>
@include('barra.barra')
<form>
    <center>Personas seguidas por {{$iduser->name}}</center>
    <div class="d-grid gap-2 col-6 mx-auto p-3">
        <a href="/profile/{{$iduser->id}}" class="btn btn-success mb-5">Volver a perfil</a>
    </div>
</form>
<form>
</form>
<br>
@foreach ($userfollow as $followed)                 <!--datos de userfollow-->
    @if ($followed->id_user === $iduser->id)
    <form>
    <a href="/profile/{{$followed->id_user1}}">
        @foreach ($alluser as $user)
        @if ($followed->id_user1 === $user->id)
            <center>{{$user->name}}</center>
        @endif
        @endforeach
    </a><br>
    </form>
    @endif
@endforeach
