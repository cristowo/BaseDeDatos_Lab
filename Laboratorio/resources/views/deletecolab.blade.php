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
        Height: 200px
    }
</style>
@include('barra.barra')
<body><br>
@foreach($colabs as $colab)
@if($colab->id_user == $user->id && $colab->id_playlist == $playlist->id)
<form action="{{action('UserPlaylistController@destroy', $colab->id)}}" method='POST'>
    @method('PUT')
    <input type="int" class="form-control" id="id" name="id" value="{{$colab->id}}" hidden>
    <center>Esta seguro que desea eliminar la Colaboración de {{$user->name}} en {{$playlist->name}} 
    <button type="submit" class="btn btn-danger">Confirmar</button>
@endif
@endforeach
</body>