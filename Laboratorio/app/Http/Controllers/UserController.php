<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFollow;
use App\Models\Rol;
use App\Models\Country;
use App\Models\Song;
use App\Models\Playlist;
use App\Models\Genre;
use App\Models\UserSongLike;
use App\Models\UserPlaylist;
use App\Models\Ticket;
use App\Models\UserSongRestrictionAge;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function CountryRegister(){
        $countries = Country::all();
        return view('contenidos.register', compact('countries'));
    }

    public function editProfile($id){
        $user = User::find($id);
        $countries = Country::all();
        return view('editprofile', compact('user','countries' ));
    }

    public function login(Request $request){
        $user = DB::table('users')->where('email', $request->email)->where('password', $request->password)->first();
        if(empty($user)){
            return redirect('/login');
        }
        session(['id_login' => $user->id]);
        session(['name'=>$user->name]);
        session(['premium'=>$user->premium]);
        session(['id_rol'=>$user->id_rol]);
        return redirect('/home');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/home');
    }

    public function datosProfile($id)
    {
        $user = User::find($id);
        $alluser = User::all();
        $userfollow = UserFollow::all();
        $roles = Rol::all();
        if(empty($user)){
            return response()->json([], 204);
        }
        return view('/profile', compact('user','alluser','userfollow','roles'));
    }

    public function showFollowed($id)
    {
        $iduser = User::find($id);    //para el dueño del link
        $alluser = User::all();
        $userfollow = UserFollow::all();
        return view('followed', compact('iduser','alluser','userfollow'));
    }

    public function showFollowers($id)
    {
        $iduser = User::find($id);    //para el dueño del link
        $alluser = User::all();
        $userfollow = UserFollow::all();
        return view('followers', compact('iduser','alluser','userfollow'));
    }

    public function adminEditP()
    {
        $users = User::all();
        $countries = Country::all();
        $songs = Song::all();
        $playlists = Playlist::all();
        $genres = Genre::all();
        return view('editAdmin', compact('users','countries','songs','playlists','genres'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        if ($users->isEmpty()){
            return response()->json([
                'respuesta' => 'No exiten usuarios',
            ],404);
        }
        return response($users, 200);
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
                'name' => 'required|min:3|:max:80',
                'email'=>'required|email', 
                'password'=>'required|min:8|:max:20',
                'date_of_birth'=>'required|date', 
            ],
            [
                'name.required' =>'Debe existir un nombre',
                'name.min' =>'Minimo de caracteres en nombre 3',
                'name.max' =>'Maximo de caracteres en nombre 80',
    
                'email.required' =>'Debe existir el id del usuario',

                'password' =>'debe existir contraseña',
                'password.min' =>'Minimo de caracteres en contraseña 8',
                'password.max' =>'Maximo de caracteres en contraseña 20',
    
                'date_of_birth.required' =>'Debe existir el id del usuario',
                'date_of_birth.date' =>'Debes existir la fecha ',

                'id_rol' =>'Debe existir el id rol',
                'id_country' =>'Debe existir el id pais',
            ]
    
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email ;
            $newUser->password = $request->password;
            $newUser->date_of_birth = $request->date_of_birth;
            $newUser->followed = 0;
            $newUser->followers = 0;
            $newUser->premium = false;
            $newUser->id_rol = 3;   // 1 admin, 2 artista, 3 usuario común
            $newUser->id_country = $request->id_country;
            $newUser->save();
            return view('contenidos.login');
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json([],204);
        }
        return response($user,200);
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
                'name' => 'nullable|min:3|:max:80',
                'email'=>'nullable|email', 
                'password'=>'nullable|min:8|:max:20',
                'date_of_birth'=>'nullable|date', 
                'followed'=>'nullable|integer',
                'followers'=>'nullable|integer',
                'premium'=>'nullable|boolean',
                'id_rol'=>'nullable|integer',
                'id_country'=>'nullable|integer',
            ],
            [
                'name.min' =>'Minimo de caracteres en nombre 3',
                'name.max' =>'Maximo de caracteres en nombre 80',

                'password.min' =>'Minimo de caracteres en contraseña 8',
                'password.max' =>'Maximo de caracteres en contraseña 20',
    
                'date_of_birth.date' =>'Debes existir la fecha ',
            ]
            );
        if ($validator->fails()){
                return response($validator->errors(),400);
        }
        $user =User::find($id);
        if(empty($user)){
            return response()->json([]);
        }
        if ($request->name == $user ->name && $request->email == $user->email && $request->password == $user->password && $request->date_of_birth == $user->date_of_birth 
        && $request->followed == $user->followed && $request->followers == $user->followers && $request->premium == $user->premium && $request->id_rol == $user->id_rol && $request->id_country == $user->id_country && $request->delete == $user->delete ){
            return response()->json([
                "message" => "Los nuevos datos son iguales a los antiguos"
            ], 404);
        }
        if(!empty($request->name)){
        $user->name = $request->name;
        }
        if(!empty( $request->email)){
        $user->email = $request->email ;
        }
        if(!empty($request->password)){
            $user->password = $request->password;
        }
        if(!empty($request->date_of_birth)){
        $user->date_of_birth = $request->date_of_birth;
        }
        if(!empty($request->followed)){
            $user->followed = $request->followed;
        }
        if(!empty($request->followers)){
            $user->followers = $request->followers;
        }
        if(!empty($request->premium)){
            $user->premium = $request->premium;
        }
        if(!empty($request->id_rol)){
            $rol =Rol::find($request->id_rol);
            if(empty($rol)){
                return response()->json([
                    "message" => "ID rol no encontrado"
                ], 404);
            }
        $user->id_rol = $request->id_rol;
        }
        if(!empty($request->id_country)){
            $country =Country::find($request->id_country);
            if(empty($country)){
                return response()->json([
                    "message" => "ID country no encontrado"
                ], 404);
            }
        $user->id_country = $request->id_country;
        }
        if(!empty($request->delete)){
            $user->delete=$request->delete;
        }
        $user->save();
        return redirect('/profile/'.$user->id);
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
        $user = User::find($id);
        $songs=Song::all();
        $follows=UserFollow::all();
        $userPlaylists=UserPlaylist::all();
        $playlists=Playlist::all();
        $likes = UserSongLike::all();
        $tickes = Ticket::all();
        $usras = UserSongRestrictionAge::all(); 
        if(empty($user)){
            return response()->json([],204);
        }
        foreach($songs as $song){
            if($song->id_user == $user->id){
                $song -> delete();
            }
        }
        foreach($follows as $follow){
            if($follow->id_user == $user->id || $follow->id_user1 == $user->id){
                $follow-> delete();
            }
        }
        foreach($userPlaylists as $userPlaylist){
            if($userPlaylist->id_user == $user->id){
                $userPlaylist-> delete();
            }
        }
        foreach($playlists as $playlist){
            if($playlist->id_user == $user->id){
                $playlist-> delete();
            }
        }
        foreach($likes as $like){
            if($like->id_user == $user->id){
                $like-> delete();
            }
        }
        foreach($tickes as $ticke){
            if($ticke->id_user == $user->id){
                $ticke-> delete();
            }
        }
        foreach($usras as $usra){
            if($usra->id_user == $user->id){
                $usra-> delete();
            }
        }
        $user-> delete();
        return redirect('/home');
    }
}
