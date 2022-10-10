@extends('inicio')

@section('home')
@include('barra.barra')
<style>
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
        height:auto;
        width:auto;
        max-height:900px;
        max-width:700px;
    }
    .centrado{
        font-size:3rem;
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.8;
    }
    /*------------------------------------*/
    .botton-hover{
        font-family: arial;
        border:none;
        background: none;
        color: white;
        cursor: pointer;
        font-size: 2rem;
        position: relative;
    }
    .botton-hover::before{
        content:'';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 0;
        background-color: #FFC145;
        transition:0.5s ease;
    }
    .botton-hover:hover::before{
        width:100%
    }
    .botton-hover::after{
        content:'';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 0;
        width: 100%;
        background-color: #FFC145;
        transition:0.4s ease;
        z-index:-1;
    }
    .botton-hover:hover::after{
        height:100%;
        transition-delay:0.5s;
    }
    
</style>
<body>
    <center>
        @if (empty(session('id_login')))
        <div class="contenedor">
        <button class="botton-hover">
        <a href='/register'><img src="https://horrorvacuiblog.altervista.org/wp-content/uploads/2021/02/jo-san-panophobiav7-1.jpg"><br></a>
            <a href='/register' style='text-decoration:none; color:white '>No pierdas la oportunidad de escuchar tu musica favorita.<br></a>
            <a href='/register' style='text-decoration:none; color:white '>Registrare ahora para explorar.</a>
        </button>
        </div>
        @else
        <div class="contenedor">
        <button class="botton-hover">
        <a href='/music'><img src=" https://preview.redd.it/adjiep379r731.jpg?width=3000&format=pjpg&auto=webp&s=0a7a2325638b711834127fd6ca44596806440290" width="70%" height="70%"><br></a>
            <a href='/music' style='text-decoration:none; color:white '>Explora un sin fin de canciones.</a>
        </button>
        </div>
        @endif
    </center>
</body>
@endsection