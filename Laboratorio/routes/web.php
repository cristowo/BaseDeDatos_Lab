<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CountryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
});

//Edicion de perfiles
Route::get('/profile/{id}', 'App\Http\Controllers\UserController@datosProfile');
Route::get('/editprofile/{id}', 'App\Http\Controllers\UserController@editProfile');
Route::get('/admineditp', 'App\Http\Controllers\UserController@adminEditP');

//suscripciones
Route::get('/profile/subs/{id}', 'App\Http\Controllers\TicketController@viewSubs');
Route::get('/paysub/{id}', 'App\Http\Controllers\TicketController@paySubs');
Route::get('/paysub/confirm/{id_pay}/{id_u}', 'App\Http\Controllers\TicketController@paySubConfirm');

//especiales admins
Route::get('/adminedits', 'App\Http\Controllers\SongController@adminEditS');
Route::get('/editcountry/{id}', 'App\Http\Controllers\CountryController@forEdit');

//General Playlist
Route::get('/playlist/newplaylist/{id}', 'App\Http\Controllers\PlaylistController@forPlaylist');
Route::get('/playlist/addcolplaylist/{id}', 'App\Http\Controllers\PlaylistController@toAddColPlaylist');
Route::get('/myplaylist/{id}', 'App\Http\Controllers\UserPlaylistController@viewUserPlaylist');
Route::get('/playlist/editplaylist/{id}', 'App\Http\Controllers\PlaylistController@editPlaylist');
Route::get('/playlist/editplaylist/deletecolab/{p_id}/{u_id}', 'App\Http\Controllers\UserPlaylistController@deleteColab');
Route::get('/playlist/deleteplaylist/{id}', 'App\Http\Controllers\PlaylistController@deletePlaylist');
Route::get('/playlist/addSongPlaylist/{id_u}/{id_s}', 'App\Http\Controllers\PlaylistSongController@addSP');
Route::get('/oneplaylist/{id}', 'App\Http\Controllers\PlaylistSongController@viewPlaylistSong');

//followed and followers
Route::get('/profile/followed/{id}', 'App\Http\Controllers\UserController@showFollowed');
Route::get('/profile/followers/{id}', 'App\Http\Controllers\UserController@showFollowers');

//Login
Route::get('/login', function () {return view('contenidos.login');});
Route::post('/validar', 'App\Http\Controllers\UserController@login');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');

//nombres de las canciones
Route::get('/music', 'App\Http\Controllers\SongController@ListSong');
Route::get('/music/top10', 'App\Http\Controllers\SongController@TopSong');
Route::get('/music/categoria', 'App\Http\Controllers\SongController@GenreSong');
Route::get('/music/categoria/{id}', 'App\Http\Controllers\SongController@CatSong');
Route::get('/music/fav', 'App\Http\Controllers\SongController@FavSong');

//General Canción
Route::get('/listsong/{id}', 'App\Http\Controllers\SongController@showsongs');
Route::get('/listsong/newsong/{id}', 'App\Http\Controllers\SongController@newsong');
Route::get('/song/updaterep/{id}', 'App\Http\Controllers\SongController@onlyRep');
Route::get('/song/updatelike/{page}/{idp}/{id_user}/{id_song}', 'App\Http\Controllers\UserSongLikeController@boolLike');
Route::get('/editsong/{id}', 'App\Http\Controllers\SongController@editSong');

//los paises disponibles
Route::get('/register', 'App\Http\Controllers\UserController@CountryRegister');
Route::get('/newcountry', function () {return view('contenidos.newcountry');});

//generos
Route::get('/editgenre/{id}', 'App\Http\Controllers\GenreController@forEdit');
Route::get('/newgenre', function () {return view('contenidos.newgenre');});

Route::get('/countries', 'App\Http\Controllers\CountryController@index');
Route::get('/country/{id}', 'App\Http\Controllers\CountryController@show');
Route::post('/country/create', 'App\Http\Controllers\CountryController@store');
Route::put('/country/update/{id}', 'App\Http\Controllers\CountryController@update');
Route::delete('/country/delete/{id}', 'App\Http\Controllers\CountryController@destroy');

Route::get('/countrysongrestrictions', 'App\Http\Controllers\CountrySongRestrictionController@index');
Route::get('/countrysongrestriction/{id}', 'App\Http\Controllers\CountrySongRestrictionController@show');
Route::post('/countrysongrestriction/create', 'App\Http\Controllers\CountrySongRestrictionController@store');
Route::put('/countrysongrestriction/update/{id}', 'App\Http\Controllers\CountrySongRestrictionController@update');
Route::delete('/countrysongrestriction/delete/{id}', 'App\Http\Controllers\CountrySongRestrictionController@destroy');

Route::get('/genres', 'App\Http\Controllers\GenreController@index');
Route::get('/genre/{id}', 'App\Http\Controllers\GenreController@show');
Route::post('/genre/create', 'App\Http\Controllers\GenreController@store');
Route::put('/genre/update/{id}', 'App\Http\Controllers\GenreController@update');
Route::delete('/genre/delete/{id}', 'App\Http\Controllers\GenreController@destroy');

Route::get('/payments', 'App\Http\Controllers\PaymentController@index');
Route::get('/payment/{id}', 'App\Http\Controllers\PaymentController@show');
Route::post('/payment/create', 'App\Http\Controllers\PaymentController@store');
Route::put('/payment/update/{id}', 'App\Http\Controllers\PaymentController@update');
Route::delete('/payment/delete/{id}', 'App\Http\Controllers\PaymentController@destroy');

Route::get('/permissions', 'App\Http\Controllers\PermissionController@index');
Route::get('/permission/{id}', 'App\Http\Controllers\PermissionController@show');
Route::post('/permission/create', 'App\Http\Controllers\PermissionController@store');
Route::put('/permission/update/{id}', 'App\Http\Controllers\PermissionController@update');
Route::delete('/permission/delete/{id}', 'App\Http\Controllers\PermissionController@destroy');

Route::get('/songs', 'App\Http\Controllers\SongController@index');
Route::get('/song/{id}', 'App\Http\Controllers\SongController@show');
Route::post('/song/create', 'App\Http\Controllers\SongController@store');
Route::put('/song/update/{id}', 'App\Http\Controllers\SongController@update');
//Route::delete('/song/delete/{id}', 'App\Http\Controllers\SongController@destroy');
Route::put('/song/delete/{id}', 'App\Http\Controllers\SongController@destroy');

Route::get('/playlists', 'App\Http\Controllers\PlaylistController@index');
Route::get('/playlist/{id}', 'App\Http\Controllers\PlaylistController@show');
Route::post('/playlist/create', 'App\Http\Controllers\PlaylistController@store');
Route::put('/playlist/update/{id}', 'App\Http\Controllers\PlaylistController@update');
//Route::delete('/playlist/delete/{id}', 'App\Http\Controllers\PlaylistController@destroy');
Route::put('/playlist/delete/{id}', 'App\Http\Controllers\PlaylistController@destroy');

Route::get('/playlistsongs', 'App\Http\Controllers\PlaylistSongController@index');
Route::get('/playlistsong/{id}', 'App\Http\Controllers\PlaylistSongController@show');
Route::post('/playlistsong/create', 'App\Http\Controllers\PlaylistSongController@store');
Route::put('/playlistsong/update/{id}', 'App\Http\Controllers\PlaylistSongController@update');
//Route::delete('/playlistsong/delete/{id}', 'App\Http\Controllers\PlaylistSongController@destroy');
Route::put('/playlistsong/delete/{id}', 'App\Http\Controllers\PlaylistSongController@destroy');

Route::get('/registers', 'App\Http\Controllers\RegisterController@index');
Route::get('/register/{id}', 'App\Http\Controllers\RegisterController@show');
Route::post('/register/create', 'App\Http\Controllers\RegisterController@store');
Route::put('/register/update/{id}', 'App\Http\Controllers\RegisterController@update');
Route::delete('/register/delete/{id}', 'App\Http\Controllers\RegisterController@destroy');

Route::get('/rols', 'App\Http\Controllers\RolController@index');
Route::get('/rol/{id}', 'App\Http\Controllers\RolController@show');
Route::post('/rol/create', 'App\Http\Controllers\RolController@store');
Route::put('/rol/update/{id}', 'App\Http\Controllers\RolController@update');
Route::delete('/rol/delete/{id}', 'App\Http\Controllers\RolController@destroy');

Route::get('/rolpermissions', 'App\Http\Controllers\RolPermissionController@index');
Route::get('/rolpermission/{id}', 'App\Http\Controllers\RolPermissionController@show');
Route::post('/rolpermission/create', 'App\Http\Controllers\RolPermissionController@store');
Route::put('/rolpermission/update/{id}', 'App\Http\Controllers\RolPermissionController@update');
Route::delete('/rolpermission/delete/{id}', 'App\Http\Controllers\RolPermissionController@destroy');

Route::get('/tickets', 'App\Http\Controllers\TicketController@index');
Route::get('/ticket/{id}', 'App\Http\Controllers\TicketController@show');
Route::post('/ticket/create', 'App\Http\Controllers\TicketController@store');
Route::put('/ticket/update/{id}', 'App\Http\Controllers\TicketController@update');
Route::delete('/ticket/delete/{id}', 'App\Http\Controllers\TicketController@destroy');

Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');
Route::post('/user/create', 'App\Http\Controllers\UserController@store');
Route::put('/user/update/{id}', 'App\Http\Controllers\UserController@update');
//Route::delete('/user/delete/{id}', 'App\Http\Controllers\UserController@destroy');
Route::put('/user/delete/{id}', 'App\Http\Controllers\UserController@destroy');

Route::get('/userfollows', 'App\Http\Controllers\UserFollowController@index');
Route::get('/userfollow/{id}', 'App\Http\Controllers\UserFollowController@show');
Route::post('/userfollow/create', 'App\Http\Controllers\UserFollowController@store');
Route::put('/userfollow/update/{id}', 'App\Http\Controllers\UserFollowController@update');
Route::put('/userfollow/delete/{id}', 'App\Http\Controllers\UserFollowController@destroy');

Route::get('/userplaylists', 'App\Http\Controllers\UserPlaylistController@index');
Route::get('/userplaylist/{id}', 'App\Http\Controllers\UserPlaylistController@show');
Route::post('/userplaylist/create', 'App\Http\Controllers\UserPlaylistController@store');
Route::put('/userplaylist/update/{id}', 'App\Http\Controllers\UserPlaylistController@update');
//Route::delete('/userplaylist/delete/{id}', 'App\Http\Controllers\UserPlaylistController@destroy');
Route::put('/userplaylist/delete/{id}', 'App\Http\Controllers\UserPlaylistController@destroy');

Route::get('/usersongrestrictionages', 'App\Http\Controllers\UserSongRestrictionAgeController@index');
Route::get('/usersongrestrictionage/{id}', 'App\Http\Controllers\UserSongRestrictionAgeController@show');
Route::post('/usersongrestrictionage/create', 'App\Http\Controllers\UserSongRestrictionAgeController@store');
Route::put('/usersongrestrictionage/update/{id}', 'App\Http\Controllers\UserSongRestrictionAgeController@update');
Route::delete('/usersongrestrictionage/delete/{id}', 'App\Http\Controllers\UserSongRestrictionAgeController@destroy');

Route::get('/usersonglikes', 'App\Http\Controllers\UserSongLikeController@index');
Route::get('/usersonglike/{id}', 'App\Http\Controllers\UserSongLikeController@show');
Route::post('/usersonglike/create', 'App\Http\Controllers\UserSongLikeController@store');
Route::put('/usersonglike/update/{id}', 'App\Http\Controllers\UserSongLikeController@update');
//Route::delete('/usersonglike/delete/{id}', 'App\Http\Controllers\UserSongLikeController@destroy');
Route::put('/usersonglike/delete/{id}/{page}/{idp}/{id_song}', 'App\Http\Controllers\UserSongLikeController@destroy');

Route::get('/usersonglistens', 'App\Http\Controllers\UserSongListenController@index');
Route::get('/usersonglisten/{id}', 'App\Http\Controllers\UserSongListenController@show');
Route::post('/usersonglisten/create', 'App\Http\Controllers\UserSongListenController@store');
Route::put('/usersonglisten/update/{id}', 'App\Http\Controllers\UserSongListenController@update');
Route::delete('/usersonglisten/delete/{id}', 'App\Http\Controllers\UserSongListenController@destroy');