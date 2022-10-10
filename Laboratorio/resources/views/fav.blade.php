<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
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
    </script>
    <style>
        body{
            font-family: arial;
            background: white;
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
        a.table:link {color:white;text-decoration:none;}
        a.table:hover {color:#E57C04;}
        a.table:visited {color:white;}

        .centrado{
            font-size:3rem;
            font-family:sans-serif;
            color: white;
            text-align: left;
            margin-left: 40px;

            opacity: 0.8;
        }
        .styled-table {
            border-collapse: collapse;
            border-radius: 15px;
            margin: 20px 1;
            color: white;
            font-size: 0.9em;
            font-family: sans-serif;
            background-color: #252525;
            min-width: 400px;
            margin-left: 60px;
            margin-right: auto;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
        }
        .styled-table tbody tr:hover {
            background-color: #FFBE12;
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

        .styled-table tbody tr:last-of-type {
            border-bottom: thin solid #dddddd;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
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
<body>
    @include('barra.barra')
    <h1 class="centrado">Tus Canciones favoritas</h1>

<table class="styled-table" id="tabla" style="max-height: 690px; display: inline-block;">
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
        <th scope="col"></th>
    </tr>

</thead>
    <tbody>
      @foreach ($songs as $song)
      @foreach ($usersonglikes as $usersonglike)
      @if(session('id_login')== $usersonglike->id_user && $song->id == $usersonglike->id_song)
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
        <td scope="row"><div class="count" align='right'>{{$song->likes}}</div></td>
        <td scope="row">
        <?php $a = 0; ?>
            @foreach($usersonglikes as $usersonglike)
                @if(session("id_login") == $usersonglike->id_user && $song->id == $usersonglike->id_song)
                <form class= "element-selector" action="{{action('UserSongLikeController@destroy', [$usersonglike->id, 5 , $user->id, $song->id])}}" method='POST'>
                    @method('PUT')
                    <input type="int" class="form-control" id="id" name="id" value="{{$usersonglike->id}}" hidden>
                    <input type="int" class="form-control" id="page" name="page" value="5" hidden>
                    <input type="int" class="form-control" id="idp" name="idp" value="{{$user->id}}" hidden>
                    <input type="int" class="form-control" id="id_song" name="$id_song" value="{{$song->id}}" hidden>
                    <button type="submit" class="btn btn-danger">X</button>
                    <?php $a = 1; ?>
                </form>
                @endif
            @endforeach
            @if($a != '1')
            <a class="btn btn-success" href='/song/updatelike/5/{{$user->id}}/{{session("id_login")}}/{{$song->id}}'>❤</a>
            @endif
        </td>
        <td scope="row" align='right'>{{$song->reproduction}}</td>
        <td scope="row">{{$song->duration}}</td>
        <td scope="row"><a href="/playlist/addSongPlaylist/{{session('id_login')}}/{{$song->id}}" class="btn btn-primary">Agregar a Playlist</a></td>
        </tr>
    </tbody>
    @endif
    @endforeach
    @endforeach

</table>
<script type="text/javascript">
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