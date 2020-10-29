<?php 
namespace App\Controllers;
use App\Models\Jornada;

class JornadaController extends BaseController{
    public function verJornadas(){
        
        $jornada = new Jornada(5);

        echo $this->renderHTML('verJornadas.twig' ,[
            'job' => 'jobe',
            'jornadas' => $jornada               ]);
    }

}
