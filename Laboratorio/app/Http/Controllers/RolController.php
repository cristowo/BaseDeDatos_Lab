<?php

namespace App\Http\Controllers;

use App\Models\Rol;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rols = Rol::all();
        if ($rols->isEmpty()){
            return response()->json([
                'respuesta' => 'No exiten rols',
            ],404);
        }
        return response($rols);
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
            $request->all(),[
                'name'=> 'required|min:3|:max:30',
                'description' => 'required|min:1|:max:200',
                'delete'=> 'boolean',
            ],
            [
                'name.required' =>'Nombre incorrecto o no ingresado',
                'name.min' =>'Minimo de caracteres en nombre 3',
                'name.max' =>'Maximo de caracteres en nombre 30',
    
                'description.required' =>'Debes ingresarle una descripcion',
                'description.min' => 'Minimo de caracteres en descripcion 1 ',
                'description.max' => 'Maximo de caracteres en descripcion 200 ',
            ]
    
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
            $newRol = new Rol();
            $newRol ->name = $request->name;
            $newRol ->description = $request->description;
            $newRol->save();
            return response()->json([
                'respuesta' => 'Se ha creado el rol con exito',
                'id' =>$newRol->id
            ],400);
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
        $rol = Rol::find($id);
        if(empty($rol)){
            return response()->json([],204);
        }
        return response($rol,200);
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
            $request->all(),[
                'name'=> 'required|min:3|:max:30',
                'description' => 'required|min:1|:max:200',
                'delete'=> 'boolean',
            ],
            [
                'name.required' =>'Nombre incorrecto o no ingresado',
                'name.min' =>'Minimo de caracteres en nombre 3',
                'name.max' =>'Maximo de caracteres en nombre 30',
    
                'description.required' =>'Debes ingresarle una descripcion',
                'description.min' => 'Minimo de caracteres descripcion 1 ',
                'description.max' => 'Maximo de caracteres en descripcion 200 ',
            ]
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
        $rol =Rol::find($id);
        if(empty($rol)){
            return response()->json([],204);
        }
        if ($request->name == $rol->name &&  $request->description == $rol->description && $request->delete == $rol ->delete ){
            return response()->json([
                "message" => "Los datos antiguos son iguales a los nuevos"
            ], 404);
        }
        if(!empty($request->name)){
        $rol->name = $request->name;
        }

        if(!empty($request->description)){
        $rol->description = $request->description;
        }

        if(!empty($request->delete)){
        $rol->delete=$request->delete;
        }
        $rol->save();
        return response()->json([
            'respuesta' => 'Rol modificado',
            'id' =>$rol->id
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
        $rol = Rol::find($id);
        if(empty($rol)){
            return response()->json([],204);
        }
        $rol -> delete();
        return response()->json([
        'respuesta'=> 'Rol eliminado con exito',
            'id'=> $rol->id],200);
    }
}
