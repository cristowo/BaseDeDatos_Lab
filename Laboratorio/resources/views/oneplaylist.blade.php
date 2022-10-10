<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{$playlist->name}}</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
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
        a.table:link {color:white;text-decoration:none;}
        a.table:hover {color:#E57C04;}
        a.table:visited {color:white;}

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
</head>
<body>
@include('barra.barra')
<br><form>
    <div p-4><center>
    <div class='contenedor'>
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
    <a>Creado por : 
        @foreach($users as $user)
            @if($playlist->id_user == $user->id)
                <b><a href = "/profile/{{$user->id}}">{{$user->name}}</a></b>
            @endif
        @endforeach
    </a>
    <a>Colaboradores:
        @foreach($colabs as $colab)
            @foreach($users as $user)
                @if($colab->id_user == $user->id && $playlist->id == $colab->id_playlist)
                    {{$user->name}}/
                @endif
            @endforeach
        @endforeach
    </a> 
        <a href="/oneplaylist/{{$playlist->id}}"><img class="card-img-top" src="https://pm1.narvii.com/7700/f761838baf686773ed02255a50caa18b2b2a4728r1-2048-2048v2_hq.jpg" alt="Card image cap"></a>
        <div class="card-body">
            <h5 class="card-title">{{$playlist->name}}</h5>
            @if($playlist->id_user == session('id_login') || session('id_rol') == 1)
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                •••
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="/playlist/editplaylist/{{$playlist->id}}">Editar Playlist</a></li>
                    <li><a class="dropdown-item" href="/playlist/addcolplaylist/{{$playlist->id}}">Añadir Colaboradores Playlist</a></li>
                    <li><a class="dropdown-item" href="/playlist/deleteplaylist/{{$playlist->id}}">Eliminar Playlist</a></li>
                </ul>
            </div>
            @endif
            <!--Solo para colaboradores-->
            @foreach($colabs as $colab)<!--El Colaborador no puede añadir colaboradores ni eliminar la playlist a no ser que sea admin-->
                @if($colab->id_user == session('id_login') && $playlist->id == $colab->id_playlist && session('id_rol') != 1)
                <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                •••
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="#">Editar Playlist</a></li>
                </ul>
                </div>
                @endif
            @endforeach
        </center>
        </div>
        <br>
        </center>
    </div>
    </div>
    </div>
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
        <th scope="col">Colaboradores</th>
        <th scope="col">Likes</th>
        <th scope="col">Favorito</th>
        <th scope="col">Reproducciones</th>
        <th scope="col">Duración</th>
        <!--casi :c-->
        @if($playlist->id_user == session('id_login')|| session('id_rol') == 1)
        <th scope="col"></th>
        @endif
        @foreach($colabs as $colab)
                @if($colab->id_user == session('id_login') && $playlist->id == $colab->id_playlist && session('id_rol') != 1)<!--Para que no se le repita al admin si es colaborador-->
                <th scope="col"></th>
                @endif
        @endforeach
        <th scope="col"></th>
    </tr>
</thead>
    <tbody>
      @foreach($playlistsongs as $playlistsong)
        @foreach ($songs as $song)
            @if($song->id == $playlistsong->id_song && $playlist->id == $playlistsong->id_playlist)
        <tr>
            @if (session('premium') == true)
            <td scope="row"><a href='/song/updaterep/{{$song->id}}' class="btn btn-success">▷</a></td>
            @endif
            <td scope="row">{{$song->id}}</td>
            <td scope="row"><center><a class="table" href="/song/{{$song->id}}">{{$song->name}}</a></center></td>
            @foreach ($users as $user)
            @if ($song->id_user === $user->id)
                <td scope="row"><a class="table" href="/profile/{{$user->id}}">{{$user->name}}</a></td>
            @endif
            @endforeach
            <td scope="row">{{$song->collaborator}}</td>
            <td scope="row" align='right'>{{$song->likes}}</td>

            <td scope="row">
            <?php $a = 0; ?>
            @foreach($usersonglikes as $usersonglike)
                @if(session("id_login") == $usersonglike->id_user && $song->id == $usersonglike->id_song)
                <form action="{{action('UserSongLikeController@destroy', [$usersonglike->id, 3, $playlist->id, $song->id])}}" method='POST'>
                    @method('PUT')
                    <input type="int" class="form-control" id="id" name="id" value="{{$usersonglike->id}}" hidden>
                    <input type="int" class="form-control" id="page" name="page" value="3" hidden>
                    <input type="int" class="form-control" id="idp" name="idp" value="{{$playlist->id}}" hidden>
                    <input type="int" class="form-control" id="id_song" name="$id_song" value="{{$song->id}}" hidden>
                    <button type="submit" class="btn btn-danger">X</button>
                    <?php $a = 1; ?>
                </form>
                @endif
            @endforeach
            @if($a != '1')
            <a class="btn btn-success" href='/song/updatelike/3/{{$playlist->id}}/{{session("id_login")}}/{{$song->id}}'>❤</a>
            @endif
            </td>

            <td scope="row" align='right'>{{$song->reproduction}}</td>
            <td scope="row">{{$song->duration}}</td>
            @if($playlist->id_user == session('id_login') || session('id_rol') == 1) 
            <!--casi :c-->
            <td scope="row">
            <form action="{{action('PlaylistSongController@destroy', $playlistsong->id)}}" method='POST'>
                    @method('PUT')
                        <input type="int" class="form-control" id="id" name="id" value="{{$playlistsong->id}}" hidden>
                        <button type="submit" class="btn btn-danger">Eliminar de playlist</button>
                    </form>
            </td>
            @endif
            <!--caso colab-->
            @foreach($colabs as $colab)
                @if($colab->id_user == session('id_login') && $playlist->id == $colab->id_playlist && session('id_rol') != 1)<!--Para que no se le repita al admin si es colaborador-->
                <td scope="row">
                    <form action="{{action('PlaylistSongController@destroy', $playlistsong->id)}}" method='POST'>
                    @method('PUT')
                        <input type="int" class="form-control" id="id" name="id" value="{{$playlistsong->id}}" hidden>
                        <button type="submit" class="btn btn-danger">Eliminar de playlist</button>
                    </form>
                </td>
                @endif
            @endforeach
            
        </tr>
    </tbody>
            @endif
        @endforeach
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
</html>