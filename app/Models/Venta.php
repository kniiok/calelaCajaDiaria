<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'idTipoProducto',
        'idTipoPago',
        'idFichaDiaria',
        'fecha',
        'detalle',
        'monto',
    ];

    // Relación con el modelo FichaDiaria (una venta pertenece a una ficha diaria)
    public function fichaDiaria()
    {
        return $this->belongsTo(FichaDiaria::class, 'idFichaDiaria');
    }

    // Relación con el modelo TipoProducto (una venta tiene un tipo de producto)
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'idTipoProducto');
    }

    // Relación con el modelo TipoPago (una venta tiene un tipo de pago)
    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'idTipoPago');
    }
}
