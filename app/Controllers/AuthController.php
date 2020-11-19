<?php
namespace App\Controllers;
use App\Models\Usuario;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{
    
    public function formLoad(){
        return $this->renderHTML('login.twig');
    }
    public function authLogin($request){
        $postData = $request->getParsedBody();
        $user = Usuario::where('username', $postData['username'])->first();
        if($user){
            
            if(\password_verify($postData['password'], $user->password)){
                $_SESSION['userId'] = $user->id_user;
                return new RedirectResponse('/admin');
            }else{
                return $this->renderHTML('login.twig', [
                    'errorMessages' => "El usuario existe pero el password es incorrecto"
                ]);
                
            }

        }else{
            return $this->renderHTML('login.twig', [
                'errorMessages' => "No se encontró usuario"
            ]);
        }
    }
    public function authLogout(){
        unset($_SESSION['userId']);
        return new RedirectResponse('/login');
    }



}