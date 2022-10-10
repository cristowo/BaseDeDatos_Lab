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
  Height: 450px
}
</style>
@include('barra.barra')
    <div class="p-4">
      <form method="POST" action="{{action('UserController@login')}}">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Dirección de correo electronico</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" value="" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Mantenme conectado</label>
        </div>
          <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
          <p class="text-center text-muted mt-2 mb-0">¿No tienes una cuenta? <a href="/register" class="fw-bold text-body"><u>Ingrese aquí para registrarte</u></a></p>
      </form>
    </div>
@endsection
