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
    <br>
        <form method="POST" action="/playlistsong/create">
        @csrf
        <h5>Seleccione un playlist suyo al cual quiera añadir la canción "{{$song->name}}"</h5>
            <label for="validationCustom03" class="form-label">Playlist</label>
            <select class="form-select" aria-label="Default select example" name="id_playlist" required>
                <option value="">Seleccione una Playlist</option>
                @foreach ($playlists as $playlist)
                    @if($playlist->id_user == session('id_login'))
                        <option value="{{$playlist->id}}">{{$playlist->name}}</option>
                    @endif
                @endforeach
            </select>
            <div style="display:none;">
                <input type = "int" name = "id_song" value = "{{$song->id}}" />    
            </div><br>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form> 
    
    <br>
        <form method="POST" action="/playlistsong/create">
        @csrf
        <h5>Seleccione un playlist de colaboración al cual quiera añadir la canción "{{$song->name}}"</h5>
            <label for="validationCustom03" class="form-label">Playlist</label>
            <select class="form-select" aria-label="Default select example" name="id_playlist" required>
                <option value="">Seleccione una Playlist</option>
                @foreach ($playlists as $playlist)
                    @foreach ($colabs as $colab)
                        @if($colab->id_user == session('id_login') && $playlist->id == $colab->id_playlist)
                            <option value="{{$playlist->id}}">{{$playlist->name}}</option>
                        @endif
                    @endforeach
                @endforeach
            </select>
            <div style="display:none;">
                <input type = "int" name = "id_song" value = "{{$song->id}}" />    
            </div> <br>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
</body>
@endsection