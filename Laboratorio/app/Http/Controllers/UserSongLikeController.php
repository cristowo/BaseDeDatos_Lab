<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Song;
use App\Models\UserSongLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSongLikeController extends Controller
{

  public function boolLike(Request $request, $page, $idp, $id_user, $id_song)
  {
      $validated = Validator::make(
          $request->all(),[
              'id_user' => 'nullable|integer',
              'id_song' => 'nullable|integer',
              'page' => 'nullable|integer',
              'idp' => 'nullable|integer'
          ],
          [
          ]
      );
      $song = Song::find($request->id_song);
      $song->likes = $song->likes+1;
      $song->save();
      $user = User::find($request->id_user);
      $newUserSongLike = new UserSongLike();
      $newUserSongLike->id_user = $request->id_user;
      $newUserSongLike->id_song = $request->id_song;
      $newUserSongLike->save();
      if($page == "1"){
        return redirect('/music');}
      if($page == "2"){
        return redirect('/listsong/'.$idp);}
      if($page == "3"){
        return redirect('/oneplaylist/'.$idp);}
      if($page == "4"){
        return redirect('/music/top10');}
      if($page == "5"){
        return redirect('/music/fav');}
      if($page == "6"){
        return redirect('/music/categoria/'.$idp);}
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSongLikes = UserSongLike::all();
        if ($userSongLikes->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra la cancion reaccionada por el usuario.',
            ],404);
        }
        return response($userSongLikes);
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
        $newUserSongLike = new UserSongLike();
        $newUserSongLike->id_user = $request->id_user;
        $newUserSongLike->id_song = $request->id_song ;
        $newUserSongLike->save();
        return response()->json([
            'respuesta' => 'Nuevo UserSongLike creado',
            'id' =>$newUserSongLike->id
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
        $userSongLikes = UserSongLike::find($id);
        if(empty($userSongLikes))
        {
            return response()->json([
                'msg' => 'No existe esa cancion reaccionada por el usuario.',
            ], 204);
        };
        return response($userSongLikes, 200);
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
      $userSongLikes = UserSongLike::find($id);
       if(empty($userSongLikes))
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
       $userSongLikes->id_user = $request->id_user;

     }
     if (!empty($request->id_song)) {
       $song = Song::find($request->id_song);
       if (empty($song)) {
         return response()->json([
               'msg' => 'No existe la canción indicada.'
         ],400);
       }
       $userSongLikes->id_song = $request->id_song;
     }

     $userSongLikes->save();
     return response()->json([
     'msg' => 'Se actualizo el userSongLikes',
     'userSongLikes' => $userSongLikes,
   ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $page, $idp, $id_song)
    {
        $userSongLikes =UserSongLike::find($id);
        if(empty($userSongLikes)){
            return response()->json([],204);
        }
        $userSongLikes -> delete();
        $song = Song::find($id_song);
        $song->likes = $song->likes-1;
        $song->save();
        if($page == "1"){
          return redirect('/music');}
        if($page == "2"){
          return redirect('/listsong/'.$idp);}
        if($page == "3"){
          return redirect('/oneplaylist/'.$idp);}
        if($page == "4"){
          return redirect('/music/top10');}
        if($page == "5"){
          return redirect('/music/fav');}
        if($page == "6"){
          return redirect('/music/categoria/'.$idp);}
    }
}
