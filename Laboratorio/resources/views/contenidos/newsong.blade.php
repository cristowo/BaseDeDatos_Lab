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
  <form action="{{action('SongController@store')}}" method='POST'>
  @csrf
  <input type="id" class="form-control" id="id" name="id_user" value="{{$user->id}}" hidden>
  <div class="col-md-12">
    <label for="name" class="form-label">Nombre de la Canción</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="collaborator" class="form-label">Colaboradores</label>
    <input type="text" name="collaborator" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="link" class="form-label">URL de la canción</label>
    <input type="text" name="link" class="form-control">
  </div>
  <div class="col-md-12">
    <label for="age_restriction" class="form-label">Restricción de edad (true/false)</label>
    <input type="boolean" name="age_restriction" class="form-control">
  </div>
  <div class="mb-3">
    <label for="validationCustom03" class="form-label">Genero</label>
      <select class="form-select" aria-label="Default select example" name="id_genre" required>
      <option value="">Seleccione un Genero</option>
      @foreach ($genres as $genre)
      <option value="{{$genre->id}}">{{$genre->name}}</option>
      @endforeach
      </select>
  </div>
  <div class="mb-3">
    <label for="validationCustom02" class="form-label">Pais</label>
      <select class="form-select" aria-label="Default select example" name="id_country" required>
      <option value="">Seleccione un pais</option>
      @foreach ($countries as $country)
      <option value="{{$country->id}}">{{$country->country}}</option>
      @endforeach
      </select>
  </div>
  <br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Crear</button>
  </div>
  </form>

</div>
@endsection