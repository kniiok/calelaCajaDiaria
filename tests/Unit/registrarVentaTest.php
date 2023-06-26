<?php

namespace Tests\Unit;

use Tests\TestCase;

class registrarVentaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testRegisterSale()
    {
        $response = $this->post('/ventas', [
            'idTipoProducto' => 1,
            'detalle' => 'Detalle de prueba',
            'montoEfectivo' => 100,
            'montoTransferencia' => 0,
            'montoTarjeta' => 0,
        ]);

        $response->assertRedirect('/fichadiaria');
        $this->assertDatabaseHas('ventas', [
            'idTipoProducto' => 1,
            'idFichaDiaria' => '2',
            'fecha' => '2023-06-26',
            'detalle' => 'Detalle de prueba',
            'montoEfectivo' => 100,
            'montoTarjeta' => 0,
            'montoTransferencia' => 0,
        ]);
    }
}
?>

