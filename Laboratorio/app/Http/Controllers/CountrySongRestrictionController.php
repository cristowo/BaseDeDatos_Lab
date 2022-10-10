<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Country;
use App\Models\Song;
use App\Models\CountrySongRestriction;
class CountrySongRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $countrysongrestriction = CountrySongRestriction::all();
        if($countrysongrestriction->isEmpty()){
            return response()->json([
            'respuesta' => 'No hay información'] ,404);
        }
        return response($countrysongrestriction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                'id_country'=> 'required',
                'id_song'=> 'required',
            ],
            [
                'id_country.required'=> 'País no ingresado o incorrecto',
                'id_song.required' => 'Canción no ingresado o incorrecto',
            ]
            );

        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newcountrysongrestriction = new CountrySongRestriction();
        $newcountrysongrestriction->id_country = $request->id_country;
        $newcountrysongrestriction->id_song = $request->id_song;
        $newcountrysongrestriction->save();
        return response()->json([
            'respuesta' => 'Nuevo newcountrysongrestriction creado',
            'id' =>$newcountrysongrestriction->id
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $countrysongrestriction = CountrySongRestriction::find($id);
        if(empty($countrysongrestriction)){
            return response()->json([], 404);
        }

        return response()->json([
            'respuesta'=>'id encontrado', 
            'restrictioncountry:'=> $countrysongrestriction,
        ],200);
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                'id_country' => 'nullable',
                'id_song' => 'nullable',
                'delete'=>'boolean',
            ],
            [
                'id_country.required' => 'País no ingresado o incorrecto',
                'id_song.required' => 'Canción no ingresado o incorrecto',
                'delete.boolean'=>'Dato Booleano no ingresado o incorrecto',
            ]
        );

        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $countrysongrestriction = CountrySongRestriction::find($id);
        if(empty($countrysongrestriction)){
            return response()->json([], 204);
        }
        if ($request->id_country == $countrysongrestriction->id_country && $request->id_song == $countrysongrestriction->id_song){
            return response()->json([
                "message" => "Los datos nuevos son iguales a los datos antiguos."
            ], 404);
        }
        if (!empty($request->id_country)){
            $country = Country::find($request->id_country);
            if(empty($country)){
                return response()->json([
                    "message" => "El id_countrysongrestriction no se encuentra"
                ], 404);
            }
            $countrysongrestriction->id_country = $request->id_country;
        }
        if (!empty($request->id_song)){
            $song = Song::find($request->id_song);
            if(empty($song)){
                return response()->json([
                    "message" => "El id_countrysongrestriction no se encuentra"
                ], 404);
            }
            $countrysongrestriction->id_song = $request->id_song;
        }
        $countrysongrestriction->save();
        return response()->json([
            'respuesta' => 'Dato en countrysongrestriction modificado',
            'id' =>$countrysongrestriction->id
         ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $countrysongrestriction = CountrySongRestriction::find($id);
        if(empty($countrysongrestriction)){
            return response()->json([],204);
        }
        $countrysongrestriction -> delete();

        return response()->json([
        'respuesta'=> 'Se ha eliminado el id_countrysongrestriction',
            'id'=> $countrysongrestriction->id],200);
    }
}
