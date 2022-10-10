<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),[
                'name'=>'required|min:3|:max:80',
                'email'=>'required|email',
                'password'=>'required|min:8|:max:20',
                'date_of_birth'=>'required|date', 
    
            ],
            [
                'name.required' =>'Debe ingresar un nombre',
                'name.min' =>'El nombre debe tener minimo 3 caracteres',
                'name.max' =>'El nombre puede tener maximo 80 caracteres',
    
                'email.required' =>'Debe ingresar un correo',
    
                'password.required' =>'Debe ingresar una contraseña',
                'password.min' =>'La contraseña debe tener un largo mínimo de 8 ',
                'password.max' =>'La contraseña tener un largo máximo de 20 ',     

                'date_of_birth.required' =>'Debe ingresar un fecha de nacimiento',
                'date_of_birth.date' =>'Debe existir la fecha ',   
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
            $newUser->id_role = 3;
            $newUser->id_country =$request->id_country;
            $newUser->save();
            return redirect()->to('/ingresarP');
            
        //
    }
}
