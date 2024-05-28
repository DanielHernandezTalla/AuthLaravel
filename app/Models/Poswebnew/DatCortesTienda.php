<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatCortesTienda extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'DatCortesTienda';

    protected $fillable = [
        'IdCortesTienda',
        'IdEncabezado',
        'IdTienda',
        'FechaVenta',
        'ImporteTotal',
        'IdTipoPago',
        'IdDetalle',
        'IdListaPrecio',
        'IdArticulo',
        'CantArticulo',
        'PrecioArticulo',
        'SubTotalArticulo',
        'IvaArticulo',
        'ImporteArticulo',
        'NumNomina',
        'StatusVenta',
        'Bill_To',
        'StatusVenta',
        'FechaVenta'
    ];
    public $timestamps = false;


    public function Empleado()
    {
        return $this->hasOne(CatEmpleados::class, 'NumNomina', 'NumNomina');
    }
}
