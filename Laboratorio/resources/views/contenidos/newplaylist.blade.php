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
    Height: 250px
    }
</style>
@include('barra.barra')
<div class="p-4">
  <form action="{{action('PlaylistController@store')}}" method='POST'>
  @csrf
  <form class="row g-3">
  <input type="id" class="form-control" id="id" name="id_user" value="{{$user->id}}" hidden>
  <div class="col-md-12">
    <label for="name" class="form-label">Nombre de la PlayList</label>
    <input type="text" name="name" class="form-control">
    
  </div>
  <br>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Crear</button>
  </div>
  
  </form>
  </form>
</div>
@endsection