<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LimiteCredito;
use App\Models\CorteTienda;
use App\Models\CreditoEmpleado;
use App\Models\MovimientoMonederoElectronico;

class CatEmpleados extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'CatEmpleados';

    protected $fillable = [
        'TipoNomina',
        'NumNomina',
        'Nombre',
        'Apellidos',
        'Fecha_Ingreso',
        'Empresa',
        'Status'
    ];
    public $timestamps = false;

    public function LimiteCredito()
    {
        return $this->hasOne(CatLimiteCredito::class, 'TipoNomina', 'TipoNomina');
    }

    public function Adeudos()
    {
        return $this->hasMany(DatCreditos::class, 'NumNomina', 'NumNomina');
    }

    public function Ventas()
    {
        return $this->hasMany(DatCortesTienda::class, 'NumNomina', 'NumNomina');
    }

    public function Monedero()
    {
        return $this->hasMany(DatMovimientosMonederoElectronico::class, 'NumNomina', 'NumNomina');
    }

    public function BloqueoEmpleado()
    {
        return $this->hasOne(DatBloqueoEmpleado::class, 'NumNomina', 'NumNomina');
    }
}
