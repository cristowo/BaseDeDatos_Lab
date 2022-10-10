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
    Height: 650px
    }
</style>
@include('barra.barra')
<div class="p-4">
  <form action="{{action('GenreController@store')}}" method='POST'>
  @csrf
  <div class="col-md-12">
    <label for="name" class="form-label">Nombre del Genero</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="description" class="form-label">Descripción</label>
    <input type="text" name="description" class="form-control">
  </div><br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Crear</button>
  </div>
</div>
@endsection