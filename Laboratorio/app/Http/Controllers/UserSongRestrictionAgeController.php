<?php

namespace App\Http\Controllers;

use App\Models\UserSongRestrictionAge;
use App\Models\User;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSongRestrictionAgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersongrestrictionages = UserSongRestrictionAge::all();
        if ($usersongrestrictionages->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra la restricción de edad.',
            ],404);
        }
        return response($usersongrestrictionages);
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
            $request->all(),
            [
              'id_user' => 'required|integer',
              'id_song' => 'required|integer',
     
            ],
            [
              'id_user.required' => 'Solicitud no incluye id_user',
              'id_song.required' => 'Solicitud no incluye id_song',
              'id_user.integer' => 'id_user debe ser un numero entero',
              'id_song.integer' => 'id_song debe ser un numero entero',
            ]
     
          );
        if ($validator->fails()) {
            return response($validator->errors(),400);
        }
        $newUserSongRestrictionAge = new UserSongRestrictionAge();
        $newUserSongRestrictionAge->id_user = $request->id_user;
        $newUserSongRestrictionAge->id_song = $request->id_song;
        $newUserSongRestrictionAge->save();
        return response()->json([
            'respuesta' => 'Nuevo User/Playlist creado',
            'id' =>$newUserSongRestrictionAge->id
         ],400);
        return response($newUserSongRestrictionAge);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usersongrestrictionages = UserSongRestrictionAge::find($id);
        if(empty($usersongrestrictionages))
        {
            return response()->json([
                'msg' => 'No existe esa restricción de edad.',
            ], 204);
        };
        return response($usersongrestrictionages, 200);
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
            $request->all(),
            [
              'id_user' => 'integer',
              'id_song' => 'integer',
            ],
          );
                //FAIL
      if ($validator->fails()) {
        return response($validator->errors(),400);
      }
      $usersongrestrictionages = UserSongRestrictionAge::find($id);
       if(empty($usersongrestrictionages))
       {
           return response()->json([
               'msg' => 'No existe esta relación canción-usuario.',
           ], 400);
       };

       if (!empty($request->id_user)) {
            $user = User::find($request->id_user);
        
        if (empty($user)) {
            return response()->json([
               'msg' => 'No existe el usuario seleccionado'
            ],400);
        }
        $usersongrestrictionages->id_user = $request->id_user;
        }
        if (!empty($request->id_song)) {
            $song = Song::find($request->id_song);
        
        if (empty($song)) {
            return response()->json([
               'msg' => 'No existe la canción indicada.'
            ],400);
        }
        $usersongrestrictionages->id_song = $request->id_song;
        }

        $usersongrestrictionages->save();
        return response()->json([
            'msg' => 'Se actualizo el userRestrictionAges',
            'userRestrictionAges' => $usersongrestrictionages,
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
        $userSongRestrictionAges =UserSongRestrictionAge::find($id);
        if(empty( $userSongRestrictionAges)){
            return response()->json([],204);
        }
        $userSongRestrictionAges -> delete();
        return response()->json([
            'respuesta'=> 'Eliminación exitosa',
            'id'=>  $userSongRestrictionAges->id],200);
    }
}
