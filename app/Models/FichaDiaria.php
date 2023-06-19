<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaDiaria extends Model
{
    protected $table = 'fichadiarias';

    protected $fillable = [
        'idUsuario',
        'inicioCaja',
        'totalVentas',
        'aPozo',
        'cajaChica',
        'descripcion',
    ];

    // Relación con el modelo User (un usuario tiene una ficha diaria)
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    // Relación con el modelo Venta (una ficha diaria puede tener muchas ventas)
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'idFichaDiaria');
    }
}
