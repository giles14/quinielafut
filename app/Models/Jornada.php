<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
require_once('Partido.php');
//use App\Models\Partido;

class Jornada extends Model{

    public $numTotalPartidos = 1;
    public $numJornada = 16;
    public $partidos = array();
    

    public function __construct($numPartidos){
        $this->numTotalPartidos = $numPartidos;
        //$partido = new Partido("Toluca","Atlas",3,1);
        for ($i=1; $i <= $numPartidos ; $i++) { 
            $this->partidos[$i] = new Partido($i);
        }
        //echo "Objetos Generados:" . count($this->partidos)." <br>";
        $this->setNombreEquipo(3,"Toluca","Atlas");
        $this->setMarcadorPartido(3,3,0);
        
        //var_dump($partido);
    }
    public function setJornada($num){
        $this->numJornada = ($num);
    }

    public function mostrarPartidos(){
        foreach ($this->partidos as $partido) {
            foreach ($partido as $match => $value) {
                echo $match . ":" . " " . $value . "<br>";
            }
        }
    }

    public function mostrarResultado($id){
        if($this->partidos[$id]){

        }
        
    }

    public function setNombreEquipo($identificadorPartido, $nombreLocal, $nombreVisitante){
        $this->partidos[$identificadorPartido]->setEquipoLocal($nombreLocal);
        $this->partidos[$identificadorPartido]->setEquipoVisitante($nombreVisitante);
    }

    public function setMarcadorPartido($identificadorPartido,$golesLocal,$golesVisitante){
        $this->partidos[$identificadorPartido]->setGolesLocal($golesLocal);
        $this->partidos[$identificadorPartido]->setGolesVisitante($golesVisitante);
        //var_dump($this->partidos[$identificadorPartido]);
    }
    



}
//$partido = new Partido("Toluca","Atlas",3,1);
// $quiniela = new Jornada(15);
// $quiniela->setNombreEquipo(3,"Toluca","Atlas");
// $quiniela->setMarcadorPartido(3,3,0);
// $quiniela->mostrarResultado(3);
// $quiniela->mostrarPartidos();
// echo "<pre>";
// //print_r($quiniela);
// echo "</pre>";
// //var_dump($quiniela);
