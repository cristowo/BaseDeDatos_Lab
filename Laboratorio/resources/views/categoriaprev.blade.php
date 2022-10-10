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
        form{
            background-color: #252525;
            border-radius: 5px;
            font-size: 1.2em;
            padding: 60px;
            margin: 0 auto;
            color:white;
            width: 500px;
            Height: 210px
        }
        .element-selector{
        all: unset !important;
        }
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

    </style>
<body>
    @include('barra.barra')
    <h1 class="centrado">Categorias</h1>
    <form>
        Selecciones una categoria de genero
        <div class="p-4">Busqueda por selección
    <select onchange="document.location.href = '/music/categoria/' + this.value">
        <option value="">Seleccione un usuario a editar</option>
        @foreach ($genres as $genre)
            <option value="{{$genre->id}}">Genero: {{$genre->name}}</option>
        @endforeach
    </select></div>
    </form>