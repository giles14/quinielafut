<?php
namespace App\Controllers;
use App\Models\Equipo;

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
            $equipo = new Equipo();
            $equipo->equipo = $postData['equipo'];
            $equipo->save();
            echo "Equipo " . $postData['equipo'] . " Agregado con éxito";
        }

    }
    public function borrarEquipo($id){
        $equipo = Equipo::find(1);
        $equipo->delete();
        echo "Equipo con: $id";
    }
    

}