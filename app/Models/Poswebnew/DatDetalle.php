<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatDetalle extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'DatDetalle';

    protected $fillable = [
        'IdEncabezado',
        'IdArticulo',
        'CantArticulo',
        'PrecioArticulo',
        'IdListaPrecio',
        'PrecioRecorte',
        'CapturaManual',
        'ImporteArticulo',
        'IvaArticulo',
        'SubTotalArticulo',
        'IdPaquete',
        'IdPedido',
        'IdDatPrecios',
        'Linea'
    ];

    protected $primaryKey = 'IdDetalle';
    public $timestamps = false;
}
