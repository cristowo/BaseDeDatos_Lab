<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Song;
use App\Models\UserSongListen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserSongListenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersonglistens = UserSongListen::all();
        if ($usersonglistens->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra la cancion escuchada por el usuario.',
            ],404);
        }
        return response($usersonglistens);
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
          $userSongListens= new UserSongListen();
          $userSongListens->id_user= $request->id_user;
          $userSongListens->id_song= $request->id_song;
          $userSongListens->save();
          return response()->json([
              'respuesta'=> 'Nuevo userSonglisten creado',
              'newIDrolpermission'=> $userSongListens->id ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
            $userSongListens = UserSongListen::find($id);
            if(empty($userSongListens))
            {
                return response()->json([
                    'msg' => 'No existe esa cancion escuchada por el usuario.',
                ], 204);
            };
            return response($userSongListens, 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
         if ($validator->fails() ){
            return response($validator->errors(),400);
         }
        $userSongListen =UserSongListen::find($id);
        if(empty($userSongListen)){
         return response()->json([],404);}

        if ($userSongListen->id_user == $request->id_user && $userSongListen->id_song == $request-> id_song &&  $userSongListen->delete==$request->delete){
            return response()->json([
                'respuesta'=> 'Los nuevos datos son iguales a los antiguos'
            ],404);
        }
        if (!empty($request->id_user)){
            $user = User::find($request->id_user);
            if(empty($user)){
                return response()->json([
                    "respuesta" => "ID_user no encontrado"
                ], 404);
            }
            $userSongListen->id_user = $request->id_user;
        }
        if (!empty($request->id_song)){
            $song = Song::find($request->id_song);
            if(empty($song)){
                return response()->json([
                    "respuesta" => "ID_song no encontrado"
                ], 404);
            }
            $userSongListen->id_song = $request->id_song;
        }
        if (!empty($request->delete)){
            $userSongListen->delete= $request->delete;
        }
        $userSongListen->save();
        return response()->json([
            'respuesta' => 'UserSongListen ha sido modificado',
            'id' =>$userSongListen->id
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
        $userSongListens =UserSongListen::find($id);
        if(empty( $userSongListens)){
            return response()->json([],204);
        }
        $userSongListens -> delete();
        return response()->json([
        'respuesta'=> 'Eliminación exitosa',
            'id'=>  $userSongListens->id],200);
    }
}
