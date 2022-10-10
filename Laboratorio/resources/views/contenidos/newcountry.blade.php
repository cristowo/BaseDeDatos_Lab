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
  <form action="{{action('CountryController@store')}}" method='POST'>
  @csrf
  <div class="col-md-12">
    <label for="country" class="form-label">Nombre del País</label>
    <input type="text" name="country" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="state" class="form-label">Nombre del Estado</label>
    <input type="text" name="state" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="city" class="form-label">Nombre de la Ciudad</label>
    <input type="text" name="city" class="form-control">
  </div><br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Crear</button>
  </div>
</div>
@endsection