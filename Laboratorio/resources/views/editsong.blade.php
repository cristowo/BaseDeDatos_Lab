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
        Height: 800px
    }
</style>
@include('barra.barra')
<body>
    <div class="p-4">
        <form action= "{{action('SongController@update', $song->id)}}" method='POST'>
            @method('PUT')
            <center><b>Modificando los datos de la Canción: {{$song->name}}</b></center>
            <br><div class="mb-3">
                Cambiar nombre
                <label for="formGroupExampleInput2" class="form-label ">Nombre</label>
                <input name= "name" type="text" class="form-control" id="name" placeholder="{{$song->name}}">
            </div>
            <div class="mb-3">
                Cambiar Colaborador
                <label for="formGroupExampleInput2" class="form-label ">Collaborador</label>
                <input name= "collaborator" type="text" class="form-control" id="collaborator" placeholder="{{$song->collaborator}}">
            </div>
            <div class="mb-3">
                Cambiar URL
                <label for="formGroupExampleInput2" class="form-label ">URL</label>
                <input name= "link" type="text" class="form-control" id="link" placeholder="{{$song->link}}">
            </div>
            <div class="col-md-12">
                <label for="age_restriction" class="form-label">Restricción de edad (1=true/0=false)</label>
                <input type="boolean" name="age_restriction" class="form-control" placeholder="{{$song->age_restriction}}">
            </div>
            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Genero</label>
                <select class="form-select" aria-label="Default select example" name="id_genre" required>
                @foreach($genres as $genre)
                @if($genre->id == $song->id_genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endif
                @endforeach
                @foreach ($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="validationCustom02" class="form-label">Pais</label>
                <select class="form-select" aria-label="Default select example" name="id_country" required>
                @foreach($countries as $country)
                @if($country->id == $song->id_country)
                    <option value="{{$country->id}}">{{$country->country}}</option>          
                @endif
                @endforeach
                @foreach ($countries as $country)
                <option value="{{$country->id}}">{{$country->country}}</option>
                @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" required>  Guardar cambios</button>
        </form>
    </div>
</body>
<form action="{{action('SongController@destroy', $song->id)}}" method='POST'>
    @method('PUT')
    <input type="int" class="form-control" id="id" name="id" value="{{$song->id}}" hidden>
    <center>Seguro de Eliminar la Canción?, una vez eliminado no hay vuelta atras.</center>
    <br><button type="submit" class="btn btn-danger">Eliminar canción</button>
</form>