<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipopagos';

    protected $fillable = [
        'tipo', 'descripcion',
    ];
}
