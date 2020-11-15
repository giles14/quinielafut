<?php
namespace App\Controllers;
use App\Models\Usuario;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{
    
    public function formLoad(){
        echo $this->renderHTML('login.twig');
    }
    public function authLogin($request){
        $postData = $request->getParsedBody();
        $user = Usuario::where('username', $postData['username'])->first();
        if($user){
            
            if(\password_verify($postData['password'], $user->password)){
                return new RedirectResponse('/admin');
            }else{
                echo $this->renderHTML('login.twig', [
                    'errorMessages' => "El usuario existe pero el password es incorrecto"
                ]);
                
            }

        }else{
            echo $this->renderHTML('login.twig', [
                'errorMessages' => "No se encontró usuario"
            ]);
        }
    }



}