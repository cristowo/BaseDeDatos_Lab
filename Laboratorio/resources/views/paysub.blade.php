@extends('inicio')

@section('log')
<style>
    form{
    background-color: #252525;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 60px;
        margin: 0 auto;
        width: 1000px;
        Height: 630px
    }
    .contenedor{
        position: relative;
        display: inline-block;
        text-align: center;
        max-width: 100%;
        max-height: 100%;
        padding: 50px;
    }
</style>
@include('barra.barra')
<body><br><form><br>
<div class="row row-cols-1 row-cols-md-3 g-4">
<div class="card text-white bg-dark mb-3" style="width: 18rem;">
  <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/1-month-membership-chineseforus.png" class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">$3200</h5>
    <p class="card-text">1 MES DE SUSCRIPCIÓN</p>
    <a href="/paysub/confirm/1/{{$user->id}}" class="btn btn-primary">Suscribirse</a>
  </div>
</div>&nbsp&nbsp&nbsp
<div class="card text-white bg-dark mb-3" style="width: 18rem;">
  <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/6-month-membership-chineseforus.png" class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">$12600</h5>
    <p class="card-text">6 MESES DE SUSCRIPCIÓN.</p>
    <a href="/paysub/confirm/2/{{$user->id}}" class="btn btn-primary">Suscribirse</a>
  </div>
</div>&nbsp&nbsp&nbsp
<div class="card text-white bg-dark mb-3" style="width: 18rem;">
  <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/1-year-membership-chineseforus.png" class="card-img-top" >
  <div class="card-body">
    <h5 class="card-title">$24000</h5>
    <p class="card-text">1 AÑO DE SUSCRIPCIÓN</p>
    <a href="/paysub/confirm/3/{{$user->id}}" class="btn btn-primary">Suscribirse</a>
  </div>
</div>
</div>
</body>