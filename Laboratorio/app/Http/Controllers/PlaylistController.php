<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPlaylist;
use App\Models\Song;
use App\Models\UserSongLike;
use App\Models\Playlist;
use Illuminate\Support\Facades\Validator;
class PlaylistController extends Controller
{
    public function forPlaylist($id){
        $user = User::find($id);
        $songs= Song::all();
        return view('contenidos.newplaylist', compact('user','songs' ));
    }
    
    public function toAddColPlaylist($id){
        $playlist = Playlist::find($id);
        $users= User::all();
        $colabs= UserPlaylist::all();
        return view('addcolplaylist', compact('playlist','users','colabs'));
    }

    public function editPlaylist($id){
        $playlist = Playlist::find($id);
        $colabs = UserPlaylist::all();
        $users = User::all();
        return view('editplaylist', compact('playlist','colabs','users'));
    }

    public function deletePlaylist($id){
        $playlist = Playlist::find($id);
        return view('deleteplaylist', compact('playlist'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlists = Playlist::all();
        if($playlists->isEmpty())
        {
            return response()->json([
                'msg' => 'No hay Playlists',
            ], 204);
        }
        return response($playlists, 200);
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
    public function store(Request $request) //agregamos el $id para que se enlace al usuario
    {
        $validator = Validator::make(
            $request->all(),
            [
              'name' => 'required',
              'id_user'=> 'required' ,
            
     
            ],
            [
              'name.required' => 'Nombre no existe o está incorrecto ',
              'id_user.required'=>'Id no existe.',
              
            ]
     
          );
          if ($validator->fails()){
            return response($validator->errors(),400);
         }
       
        //se crea nueva playlist
        $newPlaylist = new Playlist();
        $newPlaylist ->id_user = $request-> id_user;
        $newPlaylist ->name = $request->name;
        //$newPlaylist ->date =date; queda como created_at
        $newPlaylist ->songs = 0;
        $newPlaylist ->duration = 0;
        $newPlaylist ->link = '/oneplaylist/'.$newPlaylist->id;

        $newPlaylist->save();
        return redirect('/myplaylist/'.$newPlaylist ->id_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playlists = Playlist::find($id);
        if(empty($playlists))
        {
            return response()->json([
                'msg' => 'No existe esa playlist',
            ], 204);
        };
        return response($playlists, 200);
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
        $validator=Validator::make(
            $request->all(),
            [
            'nombre'=>'min:1|max:80',
            'link'=>'min:1|max:80',
            'id_user'=>'integer',
            'duration'=>'integer',
           // 'date'=>'string',
            'song'=>'integer'
            ],
              [
                  'name.min:1|max:80' => 'Debe tener un min de 1 o un max de 80 caracteres',
                  'link.min:1|max:80' => 'Debe tener un min de 1 o un max de 80 caracteres',
                  'song.integer' => 'Canciones debe ser numerico',
                  'duration.integer' => 'Duracion debe ser numerico',
  
              ]
          );
                  //Falla validación.
        if($validator->fails()){
            return response($validator->errors(),400);
        }
        $playlist = Playlist::find($id);
                //Comprueba si se ingresó un nombre.
                if(!empty($request->name))
                {
                  $playlist->name=$request->name;
                }
        
        $playlist->save();
        return redirect('/oneplaylist/'.$playlist->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playlist = Playlist::find($id);
        $userPlaylists=UserPlaylist::all();
        $playlistidu = $playlist->id_user;
        if(empty($playlist)){
            return response()->json([],204);
        }
        foreach($userPlaylists as $userPlaylist){
            if($userPlaylist->id_playlist == $playlist->id){
                $userPlaylist-> delete();
            }
        }

        $playlist -> delete();
        /*
        return response()->json([
        'msg'=> 'Eliminación exitosa',
            'id'=>  $playlist->id],200);*/
        return redirect('/myplaylist/'.$playlistidu);
    }
}
