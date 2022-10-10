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
        Height: 300px
    }
</style>
@include('barra.barra')
<body>
    <div class="p-4">
        <form action= "{{action('PlaylistController@update', $playlist->id)}}" method='POST'>
            @method('PUT')
            <center><b>Modificando los datos de la Playlist: {{$playlist->name}}</b></center>
            <br><div class="mb-3">
                Cambiar nombre
                <label for="formGroupExampleInput2" class="form-label ">Nombre</label>
                <input name= "name" type="text" class="form-control" id="name" placeholder="{{$playlist->name}}">
            </div>
            <button type="submit" class="btn btn-primary" required>  Guardar cambios</button>
        </form>
    </div>
</body>
<body>
    <form><b>Eliminar Colaborador</b><div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/playlist/editplaylist/deletecolab/{{$playlist->id}}/' + this.value">
        <option value="">Seleccione un colaborador a eliminar</option>
        @foreach ($colabs as $colab)
            @foreach($users as $user)
                @if($user->id == $colab->id_user && $playlist->id == $colab->id_playlist)
                    <option value="{{$user->id}}">ID: {{$user->id}}, Nombre: {{$user->name}}</option>
                @endif
            @endforeach
        @endforeach
    </select></div></form>
</body>