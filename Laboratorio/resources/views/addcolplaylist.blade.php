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
  <form action="{{action('UserPlaylistController@store')}}" method='POST'>
  @csrf
  <input type="id" class="form-control" id="id" name="id_playlist" value="{{$playlist->id}}" hidden>
  <div class="mb-3">
    <label for="validationCustom03" class="form-label">Añadir Colaborador</label>
      <select class="form-select" aria-label="Default select example" name="id_user" required>
      <option value="">Seleccione un Colaborador</option>
          @foreach ($users as $user)
            @if($user->id != $playlist->id_user)
              <option value="{{$user->id}}">ID: {{$user->id}}, Nombre: {{$user->name}}</option>
            @endif
          @endforeach
      </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Añadir Colaborador</button>
  </div>
</div>
</form>
  @endsection