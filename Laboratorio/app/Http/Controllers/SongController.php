<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\UserSongLike;
use App\Models\UserSongRestrictionAge;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{
    public function onlyRep(Request $request, $id)
    {
        $validated = Validator::make(
            $request->all(),[
                'reproduction' => 'nullable|integer',
            ],
            [
            ]
        );
        $song = Song::find($id);
        if (empty($song)){
            return response()->json([], 404);}
        if(empty($request->reproduction)){
            $song->reproduction = $song->reproduction+1;}
        $song->save();
        return redirect($song->link);
    }



    public function newsong($id){
        $user = User::find($id);
        $genres = Genre::all();
        $countries = Country::all();
        return view('contenidos.newsong', compact('user','genres','countries'));
    }
    public function editSong($id){
        $song = Song::find($id);
        $genres = Genre::all();
        $countries = Country::all();
        return view('editsong', compact('song','genres','countries'));
    }
    public function showsongs($id)
    {
        $user = User::find($id);
        $songs = Song::all();
        $usersonglikes = UserSongLike::all();
        return view('listsong', compact('user', 'songs','usersonglikes'));
    }

    public function ListSong(){
        $songs = Song::all();
        $users = User::all();
        $usersonglikes = UserSongLike::all();
        return view('/music', compact('users', 'songs', 'usersonglikes'));
    }

    public function TopSong(){
        $songs = Song::all();
        $users = User::all();
        $usersonglikes = UserSongLike::all();
        return view('top10', compact('users', 'songs','usersonglikes'));
    }

    public function CatSong($id){
        $users = User::all();
        $songs = Song::all();
        $genres = Genre::all();
        $genreselec = Genre::find($id);
        $usersonglikes = UserSongLike::all();
        $countries = Country::all();
        return view('categoria', compact('songs', 'countries', 'users','genres','usersonglikes','genreselec'));
    }
    public function GenreSong(){
        $users = User::all();
        $songs = Song::all();
        $genres = Genre::all();
        $usersonglikes = UserSongLike::all();
        $countries = Country::all();
        return view('categoriaprev', compact('songs', 'countries', 'users','genres','usersonglikes'));
    }

    public function FavSong(){
        $users = User::all();
        $songs = Song::all();
        $usersonglikes = UserSongLike::all();
        return view('fav', compact('songs', 'users','usersonglikes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $song = Song::all();
        if ($song->isEmpty()){
            return response()->json([
                'respuesta' => 'Canción no añadida',
            ], 404);
        }
        return response($song, 200);
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
                'name' => 'required|min:2|max:40|string',
                'link' => 'required|url',
                'age_restriction' => 'required',
            ],
            [
                'name.required' => 'Se debe ingresar un nombre válido',
                'name.string' => 'Se debe ingresar un nombre en formato texto',
                'name.min' => 'Se requiere un mínimo de dos letras (nombre)',
                'name.max' => 'Sobrepasa el máximo (nombre)',
                'link.required' => 'Dirección url inválida',
                'link.url' => 'Dirección url inválida',
                'age_restriction.required' => 'Restricción no válida',
            ]
        );
        
        if ($validated->fails()){
            return response($validated->errors());
        }

        $newSong = new Song();
        $newSong ->id_user = $request-> id_user;
        $newSong->name = $request->name;
        $newSong->collaborator = $request->collaborator;
        $newSong->date = "2022-01-01";
        $newSong->likes = 0;
        $newSong->reproduction = 0;
        $newSong->duration = 300;
        $newSong->link = $request->link;
        $newSong->id_genre = $request-> id_genre;
        $newSong->id_country = $request-> id_country;
        $newSong->age_restriction = $request->age_restriction;
        $newSong->save();
        /*
        return response()->json([
            'respuesta' => 'Se ha agregado una nueva canción',
            'id' => $newSong->id
        ], 201);*/
        return redirect('/listsong/'.$newSong->id_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Song::find($id);
        $users = User::all();
        if (empty($song)){
            return response()->json([]);
        }
        return view('song', compact('song', 'users'));
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
            $request->all(),[
                'name' => 'nullable|min:2|max:40|string',
                'collaborator' => 'nullable|min:0|max:100|string',
                'date' => 'nullable|date',
                'reproduction' => 'nullable|integer',
                'duration' => 'nullable|integer',
                'link' => 'nullable|url',
                
                'age_restricion' => 'nullable|boolean',
            ],
            [
                'name.string' => 'Se debe ingresar un nombre en formato texto',
                'name.min' => 'Se requiere un mínimo de dos letras (nombre)',
                'name.max' => 'Sobrepasa el máximo (nombre)',
                'collaborator.string' => 'El nombre de colaboradores debe ser ingresado en formato texto',
                'collaborator.min' => 'Se requiere un mínimo de cero letras (colaborador)',
                'collaborator.max' => 'Sobrepasa el máximo (colaborador)',
                'date.date' => 'Formato de fecha inválido (Año-Mes-Día)',
                'link.url' => 'Dirección url inválida',
            ]
        );
        $song = Song::find($id);
        if (empty($song)){
            return response()->json([], 404);
        }
        if ($validated->fails()){
            return response($validated->errors());
        }
        if(!empty($request->name)){
            $song->name = $request->name;
        }
        if(!empty($request->collaborator)){
            $song->collaborator = $request->collaborator;
        }
        if(!empty($request->date)){
            $song->date = $request->date;
        }
        if(!empty($request->reproduction)){
            $song->reproduction = $request->reproduction;
        }
        if(!empty($request->duration)){
            $song->duration = $request->duration;
        }
        if(!empty($request->link)){
            $song->link = $request->link;
        }
        if(!empty($request->age_restriction)){
            $song->age_restriction = $request->age_restriction;
        }
        if(!empty($request->id_user)){
            $user =User::find($request->id_user);
            if(empty($user)){
                return response()->json([
                    "message" => "ID user no encontrado"
                ], 404);
        }$song->id_user = $request->id_user;}
        if(!empty($request->id_country)){
            $country =Country::find($request->id_country);
            if(empty($country)){
                return response()->json([
                    "message" => "ID country no encontrado"
                ], 404);
        }$song->id_country = $request->id_country;}
        if(!empty($request->id_genre)){
            $genre =Genre::find($request->id_genre);
            if(empty($genre)){
                return response()->json([
                    "message" => "ID genre no encontrado"
                ], 404);
        }$song->id_genre = $request->id_genre;}

        $song->save();
        return redirect('/listsong/'.$song->id_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::find($id);
        $likes = UserSongLike::all();
        $playlistsongs = PlaylistSong::all();
        $id_artist=$song->id_user;
        $usras = UserSongRestrictionAge::all(); 
        if (empty($song)){
            return response()->json([], 404);
        }
        foreach($likes as $like){
            if($like->id_song == $song->id){
                $like-> delete();
            }
        }
        foreach($playlistsongs as $playlistsong){
            if($playlistsong->id_song == $song->id){
                $playlistsong-> delete();
            }
        }
        foreach($usras as $usra){
            if($usra->id_song == $song->id){
                $usra-> delete();
            }
        }
        $song->delete();
        return redirect('/listsong/'.$id_artist);
    }
}
