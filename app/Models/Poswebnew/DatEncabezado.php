<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatEncabezado extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'DatEncabezado';

    protected $fillable = [
        'IdEncabezado',
        'IdTienda',
        'IdDatCaja',
        'IdTicket',
        'FechaVenta',
        'IdUsuario',
        'SubTotal',
        'Iva',
        'MonederoDescuento',
        'Promocion',
        'ImporteVenta',
        'MonederoGenerado',
        'StatusVenta',
        'IdUsuarioCancelacion',
        'MotivoCancel',
        'FechaCancelacion',
        'StatusRed',
        'FechaCreacion',
        'SolicitudFE',
        'IdMetodoPago',
        'IdUsoCFDI',
        'IdFormaPago',
        'FolioCupon',
        'NumNomina',
        'IdTipoCliente'
    ];

    // protected $primaryKey = 'IdEncabezado';
    public $timestamps = false;
}
