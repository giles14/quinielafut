<?php
namespace App\Controllers;
use App\Models\Equipo;
use Zend\Diactoros\Response\RedirectResponse;
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
        return $this->renderHTML('formularioAgregarEquipo.twig', [
            'equipos' => $equipos
         ]);
    }
    public function mostrarFormularioFiltrado(){
        $limit = 10;
        $equipos = Equipo::all();
        $filterFunction = function (array $equipos) use ($limit){
            return $equipos['campeonatos'] >=$limit;
        };
        $equipos = array_filter($equipos->toArray(), $filterFunction);
        return $this->renderHTML('formularioAgregarEquipo.twig', [
            'equipos' => $equipos
         ]);
    }


    public function borrarEquipo($request){
        $idEquipo = $request->getAttribute('id');
        Equipo::destroy($idEquipo);
        $equipos = Equipo::all();
        return $this->renderHTML('formularioAgregarEquipo.twig', [
            'successMessages' => 'Equipo Borrado con éxito',
            'equipos' => $equipos
        ]);
        
    }
    public function modificarEquipo($request){
        $idEquipo = $request->getAttribute('id');
        $equipos = Equipo::firstWhere('id_equipo', $idEquipo);
        return $this->renderHTML('formularioModificarEquipo.twig', [
            'successMessages' => '',
            'equipos' => $equipos
        ]);
        
    }
    public function procesaModificarEquipo($request){
        $idEquipo = $request->getAttribute('id');
        if($request->getMethod()=='POST'){
            $postData = $request->getParsedBody();
            $equipo = Equipo::firstWhere('id_equipo', $idEquipo);
            $equipo->equipo = $postData['equipo'];
            $equipo->campeonatos = $postData['campeonatos'];
            $equipo->save();
            $equipos = Equipo::all();
            return new RedirectResponse('/equipos/agregar');
            // return $this->renderHTML('formularioAgregarEquipo.twig', [
            //     'successMessages' => 'Equipo Modificado',
            //     'equipos' => $equipos
            // ]);
        }
    }
    public function procesarFormulario($request){
        
        if($request->getMethod()=='POST'){
            $postData = $request->getParsedBody();
            $equipoValidator = validator::key('equipo', validator::stringType()->notEmpty());

            // if($equipoValidator->validate($postData)){
            //     $equipo = new Equipo();
            //     $equipo->equipo = $postData['equipo'];
            //     $equipo->save();
            //     $equipos = Equipo::all();
            //     echo $this->renderHTML('formularioAgregarEquipo.twig', [
            //         'successMessages' => "Equipo Agregado con éxito",
            //         'equipos' => $equipos
            //     ]);
            //}
            //else{
                try{
                    $equipoValidator->assert($postData);
                    $files = $request->getUploadedFiles();
                    $logo = $files['logo'];

                    if($logo->getError() == UPLOAD_ERR_OK) {
                        $fileName = $logo->getClientFilename();
                        $logo->moveTo("uploads/$fileName");
                    }
                    
                    $equipo = new Equipo();
                    $equipo->equipo = $postData['equipo'];
                    $equipo->logoImg = $fileName;
                    $equipo->save();
                    $equipos = Equipo::all();
                    return $this->renderHTML('formularioAgregarEquipo.twig', [
                        'successMessages' => "Equipo Agregado con éxito",
                        'equipos' => $equipos
                    ]);
                } catch (\Exception $e) {
                    $equipos = Equipo::all();
                    return $this->renderHTML('formularioAgregarEquipo.twig', [
                        'errorMessages' => $e->getMessage(),
                        'equipos' => $equipos
                    ]); 

                }
            
                
           // }
            //$equipoValidator->validate($postData); // true

            
            
            
        }

    }   

}