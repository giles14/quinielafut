<?php
namespace App\Controllers;
use App\Models\Usuario;

class AuthController extends BaseController{
    
    public function formLoad(){
        echo $this->renderHTML('login.twig');
    }
    public function authLogin($request){
        $postData = $request->getParsedBody();
        $user = Usuario::where('username', $postData['username'])->first();
        if($user){
            
            if(\password_verify($postData['password'], $user->password)){
                echo 'password coincide';
            }else{
                echo 'El usuario existe pero el password es incorrecto';
            }

        }else{
            echo 'No se encontró usuario';
        }
    }



}