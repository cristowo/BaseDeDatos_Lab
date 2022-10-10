<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = Payment::all();
        if ($payment->isEmpty()){
            return response()->json([
                'respuesta' => 'Método de pago no añadido',
            ], 404);
        }
        return response($payment, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make(
            $request->all(),[
                'name' => 'required|min:2|max:40|string',
            ],
            [
                'name.string' => 'Se debe ingresar el nombre del método de pago',
                'name.required' => 'Se debe ingresar un método de pago válido',
                'name.min' => 'Se requiere un mínimo de dos letras (método de pago)',
                'name.max' => 'Sobrepasa el máximo (método de pago)',

            ]
        );
        if ($validated->fails()){
            return response($validated->errors());
        }

        $newPayment = new Payment();
        $newPayment->name = $request->name;
        $newPayment->save();
        return response()->json([
            'respuesta' => 'Se ha añadido el método de pago',
            'id' => $newPayment->id
        ], 200);        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)){
            return response()->json([]);
        }
        return response($payment, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make(
            $request->all(),[
                'name' => 'required|min:2|max:40|string',

            ],
            [
                'name.string' => 'Se debe ingresar el nombre del método de pago',
                'name.required' => 'Se debe ingresar un método de pago válido',
                'name.min' => 'Se requiere un mínimo de dos letras (método de pago)',
                'name.max' => 'Sobrepasa el máximo (método de pago)',
            ]
        );
        $payment = Payment::find($id);
        if (empty($payment)){
            return response()->json([], 404);
        }
        if ($validated->fails()){
            return response($validated->errors());
        }

        $payment->name = $request->name;
        $payment->save();
        return response()->json([
            'respuesta' => 'Se ha actualizado el método de pago',
            'id' => $payment->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)){
            return response()->json([], 404);
        }
        $payment->delete();
        return response()->json([
        'respuesta' => 'Eliminación exitosa',
            'id' =>  $payment->id],200);
    }
}
