<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatCreditos extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'DatCreditos';

    protected $fillable = [
        'IdTienda',
        'IdEncabezado',
        'FechaVenta',
        'NumNomina',
        'ImporteCredito',
        'StatusCredito',
        'StatusVenta'
    ];
    public $timestamps = false;
    protected $primaryKey = 'IdDatCreditos';

    public function Empleado()
    {
        return $this->hasOne(CatEmpleados::class, 'NumNomina', 'NumNomina');
    }
}
