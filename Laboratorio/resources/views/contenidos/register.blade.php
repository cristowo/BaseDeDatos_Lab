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
</style>
@include('barra.barra')
<div class="p-4">
  <form method="POST" action="/user/create">
  @csrf
  <form class="row g-3">

  <div class="col-md-12">
    <label for="name" class="form-label">Nombre y Apellido</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <label class="col-md-12">
    <label for="date_of_birth" class="form-label"> </label>
    <input type="date" name="date_of_birth" class="form-control">
  </label>

  <div class="col-md-6">
    <label for="email" class="form-label"></label>
    <input type="text" name="email" class="form-control" required>
  </div>

  <div class="col-md-6">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="validationCustom03" class="form-label">Pais</label>
      <select class="form-select" aria-label="Default select example" name="id_country" required>
      <option value="">Seleccione un pais</option>
      @foreach ($countries as $country)
      <option value="{{$country->id}}">{{$country->country}}</option>
      @endforeach
      </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrarme</button>
  </div>

  <p class="text-center text-muted mt-2 mb-0">¿Ya tienes una cuenta? <a href="/login" class="fw-bold text-body"><u>Ingrese aquí</u></a></p>
  
  </form>
  </form>
</div>
@endsection
