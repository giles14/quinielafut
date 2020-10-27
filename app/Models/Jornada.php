<?php
namespace App\Models;
require_once('Partido.php');
//use App\Models\Partido;

class Jornada {

    public $numTotalPartidos = 1;
    public $numJornada = 16;
    public $partidos = array();
    

    public function __construct($numPartidos){
        $this->numTotalPartidos = $numPartidos;
        echo "es un nuevo partido <br>";
        //$partido = new Partido("Toluca","Atlas",3,1);
        for ($i=1; $i <= $numPartidos ; $i++) { 
            $this->partidos[$i] = new Partido($i);
            echo "Partido: $i <br>";
        }
        
        //var_dump($partido);
    }
    public function setJornada($num){
        $this->numJornada = ($num);
    }

    public function mostrarPartidos(){
        echo "Mostrando Partidos <br><pre> ";
        print_r($this->partidos);
        echo "</pre>";
    }

    public function setNombresEquipos($identificadorPartido, $nombreLocal, $nombreVisitante){
        $this->partidos[$identificadorPartido]->setEquipoLocal($nombreLocal);
        $this->partidos[$identificadorPartido]->setEquipoVisitante($nombreVisitante);
    }

    public function setMarcadorPartido($identificadorPartido,$golesLocal,$golesVisitante){
        $this->partidos[$identificadorPartido]->setGolesLocal($golesLocal);
        $this->partidos[$identificadorPartido]->setGolesVisitante($golesVisitante);
        var_dump($this->partidos[$identificadorPartido]);
    }
    



}
//$partido = new Partido("Toluca","Atlas",3,1);
$quiniela = new Jornada(15);
$quiniela->setMarcadorPartido(3,3,0);
$quiniela->setNombresEquipos(3,"Toluca","Atlas");
$quiniela->mostrarPartidos();
echo "<pre>";
//print_r($quiniela);
echo "</pre>";
//var_dump($quiniela);
