<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DefaultImages;

class Equipo extends Model{
    use DefaultImages;
    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    protected $equipo;
    protected $campeonatos;
    
}
