<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use App\Models\Permission;
use App\Models\RolPermission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rolpermission= RolPermission::all();  
        if ($rolpermission-> isEmpty()) {  
            return response()->json([
                'respuesta'=> 'rolpermission no existente'] ,404 );
        }
        return response($rolpermission);
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
            $request-> all(),[
                'id_rol'=> 'required|integer',
                'id_permission'=> 'required|integer', 
                'delete'=> 'boolean',
            ],
            [   
                'id_rol.required' => 'ID rol no ingresado o incorrecto',
                'id_permission.required'=> 'ID permiso no ingresado o incorrecto', 
            ] 
            );
            if ($validator->fails()){  
             return response($validator->errors(),404);  
            }
            $newrolpermission= new RolPermission();
            $newrolpermission->id_rol= $request->id_rol;
            $newrolpermission->id_permission= $request->id_permission;
            $newrolpermission->save();
            return response()->json([
                'respuesta'=> 'Nuevo rol permiso creado',
                'newIDrolpermission'=> $newrolpermission->id ],201);
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
        $rolpermission= RolPermission::find($id);
        if(empty ($rolpermission)){
            return response()-> json([],404);
        }
        return response()->json([
            'respuesta'=>'RolPermiso encontrado', 
            'rol_permission:'=> $rolpermission,
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
        $validator= Validator::make(
            $request-> all(),[
                'id_rol'=> 'required|integer',
                'id_permission'=> 'required|integer', 
            ],
            [   
                'id_rol.required' => 'ID rol no ingresado o incorrecto',
                'id_permission.required'=> 'ID permiso no ingresado o incorrecto', 
            ] 
        );
             if ($validator->fails() ){
                return response($validator->errors(),400);
             }
            $rolpermission =RolPermission::find($id);
            if(empty($rolpermission)){
             return response()->json([],404);}

            if ($rolpermission->id_rol == $request->id_rol && $rolpermission->id_permission == $request-> id_permission &&  $rolpermission->delete==$request->delete){
                return response()->json([
                    'respuesta'=> 'Los nuevos datos son iguales a los antiguos'
                ],404);
            }
            if (!empty($request->id_rol)){
                $rol = Rol::find($request->id_rol);
                if(empty($rol)){
                    return response()->json([
                        "respuesta" => "ID_Rol no encontrado"
                    ], 404);
                }
                $rolpermission->id_rol = $request->id_rol;
            }
            if (!empty($request->id_permission)){
                $permission = Permission::find($request->id_permission);
                if(empty($permission)){
                    return response()->json([
                        "respuesta" => "ID_Permission no encontrado"
                    ], 404);
                }
                $rolpermission->id_permission = $request->id_permission;
            }
            if (!empty($request->delete)){
                $rolpermission->delete= $request->delete;
            }
            $rolpermission->save();
            return response()->json([
                'respuesta' => 'RolPermission ha sido modificado',
                'id' =>$rolpermission->id
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
        $rolpermission = RolPermission::find($id);
        if(empty($rolpermission)){
            return response()->json([],204);
        }
        $rolpermission->delete();
        return response()->json([
        'respuesta'=> 'RolPermission eliminado',
            'id'=> $rolpermission->id],200);
    }
}
