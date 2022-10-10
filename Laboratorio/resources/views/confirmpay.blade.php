@extends('inicio')

@section('log')
<style>
    form{
    background-color: white;
        border-radius: 5px;
        font-size: 1.2em;
        padding: 40px;
        margin: 0 auto;
        width: 700px;
        Height: 400px
    }
</style>
@include('barra.barra')
<br><center>
<div class="card mb-3" style="max-width: 700px;">
            <div class="row g-4">
                <div class="col-md-4">
                    @if($pago == 1)
                    <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/1-month-membership-chineseforus.png" class="img-fluid rounded-start"></img><b>TOTAL: $3200</b>
                    @elseif($pago == 2)
                    <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/6-month-membership-chineseforus.png" class="img-fluid rounded-start"></img><b>TOTAL: $12600</b>
                    @elseif($pago == 3)
                    <img src="https://cdn.chinesefor.us/wp-content/uploads/2017/11/1-year-membership-chineseforus.png" class="img-fluid rounded-start"></img><b>TOTAL: $24000</b>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">PROCESO DE COMPRA</h5>
                            @if($pago == 1)
                                Suscripción de 1 mes.
                            @elseif($pago == 2)
                                Suscripción de 6 meses.
                            @elseif($pago == 3)
                                Suscripción de 1 año.
                            @endif
                    </div>
                </div>
            </div>
        </div>
</center>
      <br><form method="POST" action="/ticket/create">
        @csrf
        <div class="form-card">
            <h3 class="mt-0 mb-4 text-center">Ingrese los detalles de la tarjeta</h3>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Tarjeta</label>
                    <input type="text" name="" class="form-control" placeholder="0000 0000 0000 0000" minlength="16" maxlength="16">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Metodo de pago</label>
                    <select id="display" class="form-select" aria-label="Default select example" name="id_payment" required>
                    <option value="">Seleccione un metodo de pago</option>

                    <?php foreach($payments as $payment) :?>
                    <?php $arr[] = array();?>
                    <?php if (in_array($payment->name, $arr) == false):?>
                        <option value="{{$payment->id}}">{{$payment->name}}</option>
                    <?php endif;?>
                    <?php array_push($arr, $payment->name)?>
                    <?php endforeach;?>

                    </select>
                </div>
            </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-label">Fecha de expiración</label>
                        <input type="text" name="" class="form-control" placeholder="MM/YY" minlength="5" maxlength="5">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">CVV</label>
                        <input type="text" name="" class="form-control" placeholder="123" minlength="3" maxlength="3">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div style="display:none;">
                        <input type = "int" name = "id_user" value = "{{session('id_login')}}" />
                        @if ($pago == 1)
                        <input type = "integer" name = "amount" value = 3200 />
                        @elseif ($pago == 2)
                        <input type = "integer" name = "amount" value = 12400 />
                        @elseif ($pago == 3)
                        <input type = "integer" name = "amount" value = 24000 />
                        @endif
                        <input type = "date" name = "date" value = "2000-01-01"/>
                    </div> 
                    <div class="col-md-12"><button type="submit" class="btn btn-primary">Confirmar pago</button></div><br><br>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</center></form></div>
</body>
@endsection