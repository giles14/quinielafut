<?php
namespace App\Controllers;

class EquipoController extends BaseController{
    public function agregarEquipo($equipo){

    } 
    public function mostrarFormulario(){
        echo $this->renderHTML('formularioAgregarEquipo.twig');
    }
    public function procesarFormulario(){
        echo "futuro proceso de Formulario";
    }
    

}