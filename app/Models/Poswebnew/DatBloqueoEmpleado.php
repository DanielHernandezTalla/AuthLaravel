<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;
use App\Models\Usuario;

class DatBloqueoEmpleado extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'DatBloqueoEmpleado';

    protected $fillable = [
        'NumNomina',
        'FechaBloqueo',
        'MotivoBloqueo',
        'IdUsuario',
        'FechaDesbloqueo',
        'Status'
    ];
    public $timestamps = false;
    protected $primaryKey = 'IdBloqueo';

    public function Empleado()
    {
        return $this->hasOne(CatEmpleados::class, 'NumNomina', 'NumNomina');
    }
}
