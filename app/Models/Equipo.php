<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model{
    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    protected $equipo;
    protected $logoImg;
    protected $campeonatos;
    
}
