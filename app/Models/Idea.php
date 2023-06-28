<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // Aquí puedes definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'idUsuario',
        'fecha',
        'descripcion',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
