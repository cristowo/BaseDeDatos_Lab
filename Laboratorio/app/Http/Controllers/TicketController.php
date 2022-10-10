<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function viewSubs($id){
        $user = User::find($id);
        $tickets = Ticket::all();
        $payments = Payment::all();
        return view('subs', compact('user','tickets','payments'));
    }

    public function paySubs($id){
        $user = User::find($id);
        $payments = Payment::all();
        return view('paysub', compact('user','payments'));
    }

    public function paySubConfirm($id_pay, $id_u){
        $user = User::find($id_u);
        $pago = $id_pay;
        $payments = Payment::all();
        return view('confirmpay', compact('user','pago','payments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = Ticket::all();
        if ($ticket->isEmpty()){
            return response()->json([
                'respuesta' => 'Pago no añadido',
            ], 404);
        }
        return response($ticket, 200);
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
                'amount' => 'required|integer',
                'date' => 'required|date',

            ],
            [
                'amount.required' => 'Se debe ingresar un método de pago válido',
                'amount.integer' => 'Se debe ingresar un monto en números',
                'date.required' => 'Fecha inválida',
                'date.date' => 'Formato de fecha inválido (Año-Mes-Día)',
            ]
            );
            if ($validated->fails()){
                return response($validated->errors());
            }
            $newTicket = new Ticket();
            $newTicket->id_user = $request->id_user;
            $newTicket->id_payment = $request->id_payment;
            $newTicket->amount = $request->amount;
            $newTicket->date = $request->date;
            $user = User::find($newTicket->id_user);
            $user->premium = true;
            $newTicket->save();
            $user->save();
            return redirect('/profile/subs/'.$newTicket->id_user);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Payment::find($id);
        if (empty($ticket)){
            return response()->json([]);
        }
        return response($ticket, 200);
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
                'amount' => 'integer',
                'date' => 'date',

            ],
            [
                'amount.integer' => 'Se debe ingresar un monto en números',
                'date.date' => 'Formato de fecha inválido (Año-Mes-Día)',
            ]
        );
        $ticket = Ticket::find($id);
        if (empty($ticket)){
            return response()->json([], 404);
        }
        if ($validated->fails()){
            return response($validated->errors());
        }

        $ticket->amount = $request->amount;
        $ticket->date = $request->date;
        $ticket->save();
        return response()->json([
            'respuesta' => 'Se ha actualizado el pago',
            'id' => $ticket->id
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
        $ticket = Payment::find($id);
        if (empty($ticket)){
            return response()->json([], 404);
        }
        $ticket->delete();
        return response()->json([
        'respuesta' => 'Eliminación exitosa',
            'id' =>  $ticket->id],200);
    }
}
