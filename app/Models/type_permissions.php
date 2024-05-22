<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class type_permissions extends Model
{
    use HasFactory;

    protected $table = 'type_permissions';

    protected $fillable = [
        'id',
        'name'
    ];

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'id', 'type_permissions_id');
    }
}
