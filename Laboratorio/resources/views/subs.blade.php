@extends('inicio')

@section('log')
<style>
    form{
    background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 30px;
        margin: 0 auto;
        width: 500px;
        Height: 200px
    }
</style>
@include('barra.barra')
<body><br>
    @foreach ($tickets as $ticket)
        @if($ticket->id_user == $user->id)
        <form>
            Pago realizado por: {{$user->name}}<br>
            Costo pagado: ${{$ticket->amount}}<br>
            Fecha de compra: {{$ticket->created_at}}<br>
            Metodo de pago: @foreach($payments as $payment)
                                @if($payment->id == $ticket->id_payment)
                                    {{$payment->name}}
                                @endif
                            @endforeach<br>
            Duración: @if($ticket->amount == 3200)
                        1 Mes de Suscripción
                        @elseif($ticket->amount == 12600)
                        6 Meses de Suscripción
                        @elseif($ticket->amount == 24000)
                        1 Año de Suscripción
                        @endif
        </form><br>
        @endif
    @endforeach
</body>