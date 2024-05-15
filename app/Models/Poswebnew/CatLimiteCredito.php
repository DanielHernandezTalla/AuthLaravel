<?php

namespace App\Models\Poswebnew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatLimiteCredito extends Model
{
    use HasFactory;
    protected $connection = 'POSWEBNEW';
    protected $table = 'CatLimiteCredito';

    protected $fillable = [
        'TipoNomina',
        'NomTipoNomina',
        'Limite',
        'TotalVentaDiaria'
    ];
    public $timestamps = false;
    protected $primaryKey = 'IdCatLimiteCredito';
}
