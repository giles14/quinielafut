<?php
namespace App\Models;

class Partido {

    public $identificadorPartido;
    public $equipoLocal;
    public $equipoVisitante;
    public $golesLocal;
    public $golesVisitante;

    // $local, $visitante,$golesLocal,$golesVisitante
    public function __construct($identificador){
        $this->identificadorPartido = $identificador;
        // $this->equipoLocal = $local;
        // $this->equipoVisitante = $visitante;
        // $this->golesLocal= $golesLocal;
        // $this->golesVisitante = $golesVisitante;
    }

    function setEquipoLocal($equipo){
        $this->equipoLocal = $equipo;
    }

    function setEquipoVisitante($equipo){
        $this->equipoVisitante = $equipo;
    }

    function setGolesLocal($goles){
        $this->golesLocal = $goles;

    }function setGolesVisitante($goles){
        $this->golesVisitante = $goles;
    }

}


