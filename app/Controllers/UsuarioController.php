<?php 
namespace App\Controllers;
use Respect\Validation\Validator as validator;
use App\Models\Usuario;

class usuarioController extends BaseController {
    public function addUser($request){
        $postData = $request->getParsedBody();

        $usuario = new Usuario;
        $usuario->username = $postData['username'];
        $password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $usuario->password = $password;
        $usuario->save();

        return $this->renderHTML('agregaUsuario.twig', [
            'successMessages' => "Equipo Agregado con éxito"
        ]);
    }
    public function indexAction(){
        return $this->renderHTML('agregaUsuario.twig', [
            'successMessages' => " "
        ]);
    }
}