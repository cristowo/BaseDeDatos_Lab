<?php

namespace App\Http\Controllers;

use App\Models\UserPlaylist;
use App\Models\User;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPlaylistController extends Controller
{

    public function viewUserPlaylist($id)
    {
        $user = User::find($id);
        $playlists = Playlist::all();
        $songs = Song::all();
        $colabs = UserPlaylist::all();
        $users = User::all();
        return view('myplaylist', compact('user','playlists','songs','colabs','users'));
    }
    public function deleteColab($p_id, $u_id)
    {
        $user = User::find($u_id);
        $playlist = Playlist::find($p_id);
        $colabs = UserPlaylist::all();
        return view('deletecolab', compact('user','playlist','colabs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPlaylists = UserPlaylist::all();
        if ($userPlaylists->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra la playlist guardada por el usuario.',
            ],404);
        }
        return response($userPlaylists);
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
              'id_playlist' => 'required|integer',
     
            ],
            [
              'id_user.required' => 'Solicitud no incluye id_user',
              'id_playlist.required' => 'Solicitud no incluye id_playlist',
              'id_user.integer' => 'id_user debe ser un numero entero',
              'id_playlist.integer' => 'id_playlist debe ser un numero entero',
            ]
     
          );
        if ($validator->fails()) {
            return response($validator->errors(),400);
        }
        $newUserPlaylist = new UserPlaylist();
        $newUserPlaylist->id_user = $request->id_user;
        $newUserPlaylist->id_playlist = $request->id_playlist;
        $idplaylist = $newUserPlaylist->id_playlist;
        $newUserPlaylist->save();
        /*
        return response()->json([
            'respuesta' => 'Nuevo User/Playlist creado',
            'id' =>$newUserPlaylist->id
         ],400);
        return response($newUserPlaylist);  */
        return redirect('/oneplaylist/'. $idplaylist);      
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userPlaylists = UserPlaylist::find($id);
        if(empty($userPlaylists))
        {
            return response()->json([
                'msg' => 'No existe esa playlist guardada por el usuario.',
            ], 204);
        };
        return response($userPlaylists, 200);
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
              'id_playlist' => 'integer',
            ],
        );
                //FAIL
        if ($validator->fails()) {
            return response($validator->errors(),400);
        }
        $userPlaylists = UserPlaylist::find($id);
        if(empty($userPlaylists))
        {
            return response()->json([
                'msg' => 'No existe esta relación playlist-usuario.',
            ], 400);
        };

        if (!empty($request->id_user)) {
            $user = User::find($request->id_user);

        if (empty($user)) {
            return response()->json([
                'msg' => 'No existe el usuario seleccionado'
            ],400);
        }
        $userPlaylists->id_user = $request->id_user;

        }
        if (!empty($request->id_playlist)) {
            $playlist = Playlist::find($request->id_playlist);
        if (empty($playlist)) {
            return response()->json([
                'msg' => 'No existe la playlist indicada.'
            ],400);
        }
        $userPlaylists->id_playlist = $request->id_playlist;
        }

        $userPlaylists->save();
        return response()->json([
            'msg' => 'Se actualizo el userPlaylists',
            'userPlaylists' => $userPlaylists,
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
        $userPlaylists =UserPlaylist::find($id);
        $playlist=$userPlaylists->id_playlist;
        if(empty( $userPlaylists)){
            return response()->json([],204);
        }
        $userPlaylists -> delete();
        /*
        return response()->json([
            'respuesta'=> 'Eliminación exitosa',
            'id'=>  $userPlaylists->id],200);*/
        return redirect('/oneplaylist/'.$playlist);
    }
}


