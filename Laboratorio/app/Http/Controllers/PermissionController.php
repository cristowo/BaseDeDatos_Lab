<?php

namespace App\Http\Controllers;

use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        if ($permissions->isEmpty()){
            return response()->json([
                'respuesta' =>'no hay permisos',
            ],404);
        }
        return response($permissions);
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
            $request->all(),[
                'name'=> 'required|min:3|:max:30',
                'description' => 'required|min:1|:max:200',
                
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
            $newPermission = new Permission();
            $newPermission ->name = $request->name;
            $newPermission ->description = $request->description;  
            $newPermission->save();
            return response()->json([
                'respuesta' => 'Nuevo permiso creado',
                'id' =>$newPermission->id
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
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([],204);
        }
        return response($permission,200);
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
        $permission =Permission::find($id);
        if(empty($permission)){
            return response()->json([],204);
        }
        if ($request->name == $permission ->name &&  $request->description == $permission ->description && $request->delete == $permission ->delete ){
            return response()->json([
                "message" => "Datos nuevos iguales a los antiguos"
            ], 404);
        }

        if(!empty($request->delete)){
        $permission->delete=$request->delete;
        }
        if(!empty($request->name)){
        $permission->name = $request->name;
        }
        if(!empty($request->description)){
        $permission->description = $request->description;
        }

        $permission->save();
        return response()->json([
            'respuesta' => 'Permiso modificado',
            'id' =>$permission->id
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
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([],204);
        }
        $permission -> delete();
        return response()->json([
        'respuesta'=> 'Permiso borrado',
            'id'=> $permission->id],200);
    }
}
