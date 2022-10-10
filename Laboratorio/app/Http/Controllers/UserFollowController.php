<?php

namespace App\Http\Controllers;

use App\Models\UserFollow;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userfollows= UserFollow::all();
        if ($userfollows->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra los seguidores',
            ],404);
        }
        return response($userfollows);
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
                'id_user'=>'required|integer',
                'id_user1' => 'required|integer',      
            ],
            [
                'id_user.required' =>'id no existente',
                'id_user1.required' =>'id no existente',
            ]
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
            $newuserfollow = new UserFollow();
            $newuserfollow ->id_user = $request->id_user;
            $newuserfollow ->id_user1 = $request->id_user1;
            $userfollwed= $newuserfollow->id_user1;
            $newuserfollow->save();

            return redirect('/profile/'.$userfollwed);
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
        $userfollow = UserFollow::find($id);
        if(empty($userfollow)){
            return response()->json([],204);
        }
        return response($userfollow,200);
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
                'id_user'=>'nullable|integer',
                'id_user1' =>'nullable|integer',
                'delete'=> 'boolean',
                
            ],
            [
                'id_user.required' =>'id no existente',
                'id_user1.required' =>'id no existente',
            ]
        );
        if ($validator->fails()){
            return response($validator->errors(),400);
        }

        $userfollow =UserFollow::find($id);
        if(empty($userfollow)){
            return response()->json([],204);
        }

        if ($request->id_user == $userfollow ->id_user && $request->id_user1 == $userfollow ->id_user1 && $request->delete == $userfollow ->delete){
            return response()->json([
                "message" => "Los nuevos datos son iguales a los antiguos"
            ], 404);
        }
        if(!empty($request->delete)){
            $userfollow->delete=$request->delete;
        }
        $userfollow->id_user1 = $request->id_user1;
        $userfollow->id_user = $request->id_user;
        $userfollow->save();
        return response()->json([
            'respuesta' => 'userfollow modificado',
            'id' =>$userfollow->id
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
        $userfollow = UserFollow::find($id);
        $userfollwed= $userfollow->id_user1;
        if(empty($userfollow)){
            return response()->json([],204);
        }
        $userfollow -> delete();
        return redirect('/profile/'.$userfollwed);
    }
}
