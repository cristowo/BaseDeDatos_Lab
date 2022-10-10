<?php

namespace App\Http\Controllers;

use App\Models\Genre;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function forEdit($id){
        $genre = Genre::find($id);
        return view('editgenre', compact('genre'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $genres = Genre::all();
        if ($genres->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentra genero',
            ],404);
        }
        return response($genres);
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
        //
        $validator = Validator::make(
            $request->all(),[
                'name'=> 'required|min:3|:max:40',
                'description'=> 'required|min:0|:max:200',
                'delete'=> 'boolean',
            ],
            [
                'name.required' =>'Genero no existente',
                'name.min' =>'Minimo 3 caracteres para el nombre',
                'name.max' =>'Maximo 40 caracteres para el nombre',

                'description.required' =>'Genero no existente',
                'description.max' =>'Maximo 200 caracteres para la descripción',
            ]
    
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
            $newGenre = new Genre();
            $newGenre ->name = $request->name;
            $newGenre ->description = $request->description;
            $newGenre->save();
            return redirect('/admineditp/');
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
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([],204);
        }
        return response($genre,200);
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
        //
        $validator = Validator::make(
            $request->all(),[
            'name'=> 'nullable|min:3|:max:40',
                'description'=> 'nullable|min:0|:max:200',
                'delete'=> 'boolean',
            ],
            [
                'name.required' =>'Genero no existente',
                'name.min' =>'Minimo 3 caracteres para el nombre',
                'name.max' =>'Maximo 40 caracteres para el nombre',

                'description.required' =>'Genero no existente',
                'description.max' =>'Maximo 200 caracteres para la descripción',
            ]
            );
            if ($validator->fails()){
                return response($validator->errors(),400);
            }
        $genre =Genre::find($id);
        if(empty($genre)){
            return response()->json([],204);
        }

        if ($request->name == $genre ->name && $request->description == $genre ->description && $request->delete == $genre ->delete ){
            return response()->json([
                "message" => "Los nuevos datos son identicos a los anteriores"
            ], 404);
        }
        if(!empty($request->name)){
        $genre->name = $request->name;
        }
        if(!empty($request->description)){
            $genre->description = $request->description;
            }
        if(!empty($request->delete)){
        $genre->delete=$request->delete;
        }
        $genre->save();
        return redirect('/admineditp/');
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
        $genre =Genre::find($id);
        if(empty($genre)){
            return response()->json([],204);
        }
        $genre -> delete();
        return response()->json([
        'respuesta'=> 'Genero borrado',
            'id'=> $genre->id],200);
    }
}
