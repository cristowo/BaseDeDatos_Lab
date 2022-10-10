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
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans', sans-serif;
            height: 400px;
            background: url("https://w0.peakpx.com/wallpaper/1013/11/HD-wallpaper-red-color-degradado.jpg");
            background-size: cover;
            background-repeat:no-repeat;
            background-position: center center;
        }
        a.table:link {color:white ;text-decoration:none;}
        a.table:hover {color:#E57C04;}
        a.table:visited {color: white ; text-decoration: none;}

        .color-container{
            width: 16px;
            height: 16px;
            display: inline-block;
            border-radius: 4px;
        }
        .contenedor{
            position: relative;
            display: inline-block;
            text-align: center;
            max-width: 100%;
            max-height: 100%;
            padding: 50px;
        }
        img{
            max-height:400px;
            max-width:400px;
        }
        picture{
            height:auto;
            width:auto;
            max-height:50px;
            max-width:50px;
        }
        figure {
            width: 400px;
            height: 200px;
            margin: 0;
            padding: 0;
            background: #fff;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.65);
        }

        figure:hover+span {
            bottom: -36px;
            opacity: 1;
        }
        .hover07 figure img {
            -webkit-filter: blur(3px);
            filter: blur(3px);
            border-radius: 1px;
            -webkit-transition: .4s ease-in-out;
            transition: .4s ease-in-out;
        }
        .hover07 figure:hover img {
            -webkit-filter: blur(0);
            filter: blur(0);
        }
        .centrado{
            font-size:3rem;
            font-family:sans-serif;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.8;
        }
        .styled-table {
            border-collapse: collapse;
            border-radius: 15px;
            margin: 20px 1;
            font-size: 0.9em;
            font-family: sans-serif;
            color: white;
            min-width: 400px;
            margin-left: 60px;
            margin-right: auto;
            background-color: #252525;
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
            border-bottom: 1px solid #dddddd;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
        .button {
            border-radius: 2px;
            margin: 20px 1;
            background-color: white;
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
<div class="hover07 contenedor">
    <a href="/music/top10"><figure><img src="https://cdn.vox-cdn.com/thumbor/xFoT8AWWnsw1D9oNPeYIUeTPdMQ=/1045x524:3301x1705/fit-in/1200x630/cdn.vox-cdn.com/uploads/chorus_asset/file/22695638/P2_still.png" /></figure></a>
    <a href="/music/top10"><div class="centrado">TOP 10</div></a>
</div><div class="hover07 contenedor">
    <a href="/music/categoria"><figure><img src="https://cdn.vox-cdn.com/thumbor/g3W55iBeJd9FeBnB6-HIIJMIyho=/0x75:3840x2085/fit-in/1200x630/cdn.vox-cdn.com/uploads/chorus_asset/file/22692401/P3_still.png" /></figure></a>
    <a href="/music/categoria"><div class="centrado">CATEGORÍAS</div></a>
</div><div class="hover07 contenedor">
    <a href="/music/fav"><figure><img src="https://i.blogs.es/3fc45d/musica-lofi-sin-derechos-riot/1366_2000.jpg" /></figure></a>
    <a href="/music/fav"><div class="centrado">FAVORITOS</div></a>
</div>
<table class="styled-table" id="tabla" style="max-height: 690px; display: inline-block; overflow-y: scroll;">
<thead>
    <tr>
        @if (session('premium') == true)
        <th scope="col" ></th>
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
    <tbody style="overflow-y: auto;">
      @foreach ($songs as $song)
      <tr id="datos">
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
                <form class= "element-selector" action="{{action('UserSongLikeController@destroy', [$usersonglike->id, 1 , $user->id, $song->id])}}" method='POST'>
                    @method('PUT')
                    <input type="int" class="form-control" id="id" name="id" value="{{$usersonglike->id}}" hidden>
                    <input type="int" class="form-control" id="page" name="page" value="1" hidden>
                    <input type="int" class="form-control" id="idp" name="idp" value="{{$user->id}}" hidden>
                    <input type="int" class="form-control" id="id_song" name="$id_song" value="{{$song->id}}" hidden>
                    <button type="submit" class="btn btn-danger">X</button>
                    <?php $a = 1; ?>
                </form>
                @endif
            @endforeach
            @if($a != '1')
            <a class="btn btn-success" href='/song/updatelike/1/{{$user->id}}/{{session("id_login")}}/{{$song->id}}'>❤</a>
            @endif
        </td>
        <td scope="row" align='right'>{{$song->reproduction}}</td>
        <td scope="row">{{$song->duration}}</td>
        <td scope="row"><a href="/playlist/addSongPlaylist/{{session('id_login')}}/{{$song->id}}" class="btn btn-primary">Agregar a Playlist</a></td>
      </tr>
    </tbody>
    @endforeach
</table>

<script type="text/javascript">
    tabla = document.getElementById("tabla");
    rows = tabla.rows;
    for (i = 1; i < (rows.length); i++) {
        var x = rows[i].getElementsByTagName("td")[7];
        x.innerHTML = (minutos(x.innerHTML) + ":" + segds(x.innerHTML));
    }
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
</div>
</body> 
</html>
