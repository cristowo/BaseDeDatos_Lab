<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function forEdit($id){
        $country = Country::find($id);
        return view('editcountry', compact('country'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        if ($countries->isEmpty()){
            return response()->json([
                'respuesta' => 'País no ingresado',
            ],404);
        }
        return response($countries);
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),[
                'country'=> 'required',
                'state'=> 'required',
                'city'=> 'required',
            ],
            [
                'country.required' =>'País no ingresado o incorrecto',
                'state.required' =>'Estado no ingresado o incorrecto',
                'city.required' =>'Ciudad no ingresado o incorrecto',
            ]
            );
        if ($validator->fails()){
            return response($validator->errors());
         }
        $newCountry = new Country();
        $newCountry ->country = $request->country;
        $newCountry ->state = $request->state;
        $newCountry ->city = $request->city;
        $newCountry->save();
        return redirect('/admineditp/');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([],204);
        }
        return response($country,200);
        //
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
        $validator = Validator::make(
            $request->all(),[
                'country'=> 'nullable',
                'state'=> 'nullable',
                'city'=> 'nullable',
                'delete'=> 'boolean',
            ],
            [
                'country.required' =>'País ingresado no valido',
                'state.required' =>'Estado ingresado no valido',
                'city.required' =>'Ciudad ingresada no valido',
            ]
            );
             //Caso falla la validación
        if ($validator->fails()){
                return response($validator->errors(),400);
            }
        $country =Country::find($id);
        if(empty($country)){
            return response()->json([],204);
        }
        if ($request->country == $country ->country && $request->state == $country ->state && 
        $request->city == $country ->city && $request->delete == $country ->delete){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if(!empty($request->country)){
            $country->country = $request->country;
        }
        if(!empty($request->state)){
            $country->state = $request->state;
        }
        if(!empty($request->city)){
            $country->city = $request->city;
        }
        if(!empty($request->delete)){
            $country->delete=$request->delete;
        }
        $country->save();
        return redirect('/admineditp/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([],204);
        }

        $country -> delete();

        return response()->json([
        'respuesta'=> 'Eliminación exitosa',
            'id'=>  $country->id],200);
        //
    }
}
