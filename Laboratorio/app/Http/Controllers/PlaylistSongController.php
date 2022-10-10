<?php

namespace App\Http\Controllers;

use App\Models\PlaylistSong;
use App\Models\Playlist;
use App\Models\UserPlaylist;
use App\Models\Song;
use App\Models\User;
use App\Models\UserSongLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaylistSongController extends Controller
{
    public function viewPlaylistSong($id){
        $playlist = Playlist::find($id);
        $playlistsongs= PlaylistSong::all();
        $songs = Song::all();
        $users = User::all();
        $usersonglikes = UserSongLike::all();
        $colabs = UserPlaylist::all();
        return view('oneplaylist', compact('playlist','playlistsongs','songs','users','colabs','usersonglikes'));
    }
    public function addSP($id_u, $id_s){
        $song = Song::find($id_s);
        $user = User::find($id_u);
        $playlists = Playlist::all();
        $colabs = UserPlaylist::all();
        return view('addsongtoplaylist', compact('song','user','playlists','colabs'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlistsong = PlaylistSong::all();
        if ($playlistsong->isEmpty()){
            return response()->json([
                'respuesta' => 'Playlist/Canción no añadida',
            ], 404);
        }
        return response($playlistsong, 200);
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
        $validated = Validator::make(
            $request->all(),[
                'id_playlist' => 'required|integer',
                'id_song' => 'required|integer',

            ],
            [
                'id_playlist.required' => 'Se debe ingresar un id válido',
                'id_playlist.integer' => 'Se debe ingresar un id númerico',
                'id_song.required' => 'Se debe ingresar un id válido',
                'id_song.integer' => 'Se debe ingresar un id númerico',
            ]
        );
        
        if ($validated->fails()){
            return response($validated->errors());
        }

        $newPlaylistSong = new PlaylistSong();
        $newPlaylistSong->id_playlist = $request->id_playlist;
        $newPlaylistSong->id_song = $request->id_song;
        $newPlaylistSong->save();
        return redirect('/oneplaylist/'.$newPlaylistSong->id_playlist);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playlistsong = PlaylistSong::find($id);
        if (empty($playlistsong)){
            return response()->json([]);
        }
        return response($playlistsong, 200);
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
        $validated = Validator::make(
            $request->Song::all(),[
                'id_playlist' => 'integer',
                'id_song' => 'integer',

            ],
            [
                'id_playlist.integer' => 'Se debe ingresar un id númerico',
                'id_song.integer' => 'Se debe ingresar un id númerico',
            ]
        );
        $playlistsong = PlaylistSong::find($id);
        if (empty($playlistsong)){
            return response()->json([], 404);
        }
        if ($validated->fails()){
            return response($validated->errors());
        }

        $playlistsong->id_playlist = $request->id_playlist;
        $playlistsong->id_song = $request->id_song;
        $playlistsong->save();
        return response()->json([
            'respuesta' => 'Se ha actualizado la playlist/canción',
            'id' => $playlistsong->id
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
        $playlistsong = PlaylistSong::find($id);
        $playlistid = $playlistsong->id_playlist;
        if (empty($playlistsong)){
            return response()->json([], 404);
        }
        $playlistsong->delete();
        return redirect('/oneplaylist/'.$playlistid);
    }
}
