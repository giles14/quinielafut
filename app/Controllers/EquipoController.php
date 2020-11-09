<?php
namespace App\Controllers;
use App\Models\Equipo;
use Respect\Validation\Validator as validator;

class EquipoController extends BaseController{
    public function agregarEquipo($request){
        
        if($request->getMethod()=='POST'){
            $postData = $request->getParsedBody();
            var_dump($postData);
        }

    } 
    public function mostrarFormulario(){
        $equipos = Equipo::all();
                echo $this->renderHTML('formularioAgregarEquipo.twig', [
                    'equipos' => $equipos
                ]);
    }
    public function procesarFormulario($request){
        
        if($request->getMethod()=='POST'){
            $postData = $request->getParsedBody();
            $equipoValidator = validator::key('equipo', validator::stringType()->notEmpty());

            if($equipoValidator->validate($postData)){
                $equipo = new Equipo();
                $equipo->equipo = $postData['equipo'];
                $equipo->save();
                $equipos = Equipo::all();
                echo $this->renderHTML('formularioAgregarEquipo.twig', [
                    'successMessages' => "Equipo Agregado con éxito",
                    'equipos' => $equipos
                ]);
            }else{
                $equipos = Equipo::all();
                echo $this->renderHTML('formularioAgregarEquipo.twig', [
                    'errorMessages' => "Lo enviado no pasó la validación",
                    'equipos' => $equipos
                ]);
            }
            //$equipoValidator->validate($postData); // true

            
            
            
        }

    }
    public function borrarEquipo($request){
        $postData = $request->getParsedBody();
        // $equipo = Equipo::find(1);
        // $equipo->delete();
        //echo $request->getAttribute('id');
        echo '<pre>';
         var_dump($postData);
        echo '</pre>';
        //$id = $request->getAttribute('id');
        //echo "Equipo con: $id";
    }
    

}