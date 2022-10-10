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
        Height: 630px
    }
    img{
        height:auto;
        width:auto;
        max-height:600px;
        max-width:400px;
    }
</style>
@include('barra.barra')
<body><br>
<form action="{{action('PlaylistController@destroy', $playlist->id)}}" method='POST'>
    @method('PUT')
    <input type="int" class="form-control" id="id" name="id" value="{{$playlist->id}}" hidden>
    <center><b>Esta seguro que desea eliminar la Playlist: {{$playlist->name}}</b></center><br>
    <center><img src="https://chistesd.com/wp-content/uploads/lol-sorry-imagenes-fotos-raras-graciosas-231428_.jpg"></img></center><br>
    <center>Se desvincularan todos los colaboradores del playlist y se eliminara</center>
    <br><button type="submit" class="btn btn-danger">ELIMINAR</button>
</body>