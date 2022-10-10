@extends('inicio')

@section('log')
<style>
    form{
        background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 30px;
        margin: 5px auto;
        width: 500px;
        Height: 50px;
    }
    body{
        margin: 0;
        padding: 0;
        font-family: 'Noto Sans', sans-serif;
        height: 400px;
        background: url("https://w0.peakpx.com/wallpaper/1013/11/HD-wallpaper-red-color-degradado.jpg");
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center;
    }
    a.table:link {color:#100000;text-decoration:none;}
    a.table:visited {color:#FAA300;text-decoration:none;}
    a.table:hover {color:#E57C04;}

    .color-container{
        width: 16px;
        height: 16px;
            
        display: inline-block;
        border-radius: 4px;
    }
    .contenedor{
        position: relative;
        display: inline-block;
        background-color:#100000;
        text-align: center;
        padding: 30px;
        border-radius: 15px;
    }
    .styled-table {
        border-collapse: collapse;
        margin: 20px 1;
        font-size: 0.9em;
        font-family: sans-serif;
        color: white;
        min-width: 400px;
        margin-left: auto;
        margin-right: auto;
        background-color: #252525;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
        }
    .styled-table thead tr {
        background-color: #100000;
        color: #ffffff;
        text-align: left;
    }
    .styled-table th,
    .styled-table td {
        padding: 13px 15px;
    }
    .styled-table tbody tr {
        border-bottom: thin solid #dddddd;
    }  

    .styled-table tbody tr:nth-of-type(even) {
        background-color: white;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 1px solid #100000;
    }
    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }
    .element-selector{
        all: unset !important;
    }
    ::-webkit-scrollbar {
        width: 6px;
    } 
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    } 
    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    }
    .table td,
    .search-input {
        font-size: 1em;
        padding: 0.6em 1em;
        color: white;
    }
    .search-input {
        border: none;
        outline: none;
        background-color: black;
        font-family: "Fira Sans", sans-serif;
        color: white;
    }
    </style>
</style>
@include('barra.barra')
<body><br>
<form>
    <b><center> Canciónes de {{$user->name}}</center></b>
</form>
<table class="styled-table">
<thead>
    <tr>
        @if (session('premium') == true)
        <th scope="col"></th>
        @endif
        <th scope="col">#</th>
        <th scope="col"><input type="text" class="search-input" placeholder="Nombre"></th>
        <th scope="col"><input type="text" class="search-input" placeholder="Artista"></th>
        <th scope="col">Likes</th>
        <th scope="col">Favorito</th>
        <th scope="col">Reproducciones</th>
        <th scope="col">Duración</th>
        @if($user->id == session('id_login') && session('id_rol')==2) <!--si la cancion es del artista, el artista la puede editar-->
        <th scope="col">Editar</th>
        @endif
        @if(session('id_rol')==1 && $user->id != session('id_login')) <!--admin la puede editar-->
        <th scope="col">Editar</th>
        @endif
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
</thead>
    <tbody>
    @foreach($songs as $song)
        @if($user->id == $song->id_user)
        <tr>
        @if (session('premium') == true)
        <td scope="row"><a href='/song/updaterep/{{$song->id}}' class="btn btn-success">▷</a></td>
        @endif
            <td scope="row">{{$song->id}}</td>
            <td scope="row">{{$song->name}}</td>
            <td scope="row"><a class="table" href="/profile/{{$user->id}}">{{$user->name}}</a></td>
            <td scope="row" align='right'>{{$song->likes}}</td>
            <td scope="row">
            <?php $a = 0; ?>
            @foreach($usersonglikes as $usersonglike)
                @if(session("id_login") == $usersonglike->id_user && $song->id == $usersonglike->id_song)
                <form class= "element-selector" action="{{action('UserSongLikeController@destroy', [$usersonglike->id, 2 , $user->id, $song->id])}}" method='POST'>
                    @method('PUT')
                    <input type="int" class="form-control" id="id" name="id" value="{{$usersonglike->id}}" hidden>
                    <input type="int" class="form-control" id="page" name="page" value="2" hidden>
                    <input type="int" class="form-control" id="idp" name="idp" value="{{$user->id}}" hidden>
                    <input type="int" class="form-control" id="id_song" name="$id_song" value="{{$song->id}}" hidden>
                    <button type="submit" class="btn btn-danger">X</button>
                    <?php $a = 1; ?>
                </form>
                @endif
            @endforeach
            @if($a != '1')
            <a class="btn btn-success" href='/song/updatelike/2/{{$user->id}}/{{session("id_login")}}/{{$song->id}}'>❤</a>
            @endif
            </td>
            <td scope="row" align='right'>{{$song->reproduction}}</td>
            <td scope="row">{{$song->duration}}</td>
            @if($user->id == session('id_login') && session('id_rol')==2)
            <td scope="row"><a href="/editsong/{{$song->id}}" class="btn btn-info">Editar</a></td>
            @endif
            @if(session('id_rol')==1 && $user->id != session('id_login')) <!--admin la puede editar-->
            <td scope="row"><a href="/editsong/{{$song->id}}" class="btn btn-info">Editar</a></td>
            @endif
            <td scope="row"><a href="/playlist/addSongPlaylist/{{session('id_login')}}/{{$song->id}}" class="btn btn-primary">Agregar a Playlist</a></td>
            <td scope="row"> <!--pendiente-->
        </tr>
    </tbody>
        @endif
    @endforeach
</table>
<script type="text/javascript">
    function minutos(segundos) {
      return ~~((segundos % 3600) / 60);
    } 
    function segds(segundos) {
      var x = ~~segundos % 60;
      return ('0' + x).slice(-2);
    }
    function puntos(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
    tabla = document.getElementById("tabla");
    rows = tabla.rows;
    for (i = 1; i < (rows.length); i++) {
        var x = rows[i].getElementsByTagName("td")[7];
        x.innerHTML = (minutos(x.innerHTML) + ":" + segds(x.innerHTML));
    }
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".search-input").forEach((inputField) => {
            const tableRows = inputField
            .closest("table")
            .querySelectorAll("tbody > tr");
        const headerCell = inputField.closest("th");
        const otherHeaderCells = headerCell.closest("tr").children;
        const columnIndex = Array.from(otherHeaderCells).indexOf(headerCell);
        const searchableCells = Array.from(tableRows).map(
            (row) => row.querySelectorAll("td")[columnIndex]
        );
    inputField.addEventListener("input", () => {
        const searchQuery = inputField.value.toLowerCase();
        for (const tableCell of searchableCells) {
            const row = tableCell.closest("tr");
            const value = tableCell.textContent.toLowerCase().replace(",", "");

            row.style.visibility = null;

            if (value.search(searchQuery) === -1) {
                row.style.visibility = "collapse";
            }
    }
    });
    });
    });
</script>

<script type="text/javascript">
    tabla = document.getElementById("tabla");
    rows = tabla.rows;
    for (i = 1; i < (rows.length); i++) {
        var x = rows[i].getElementsByTagName("td")[6];
        x.innerHTML = (puntos(x.innerHTML));
    }
</script>

<script type="text/javascript">
    tabla = document.getElementById("tabla");
    rows = tabla.rows;
    for (i = 1; i < (rows.length); i++) {
        var x = rows[i].getElementsByTagName("td")[4];
        x.innerHTML = (puntos(x.innerHTML));
    }
</script>
</body>
@endsection