<?php

namespace Tests\Unit;

use Tests\TestCase;

class buscarFichaPorFechaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testSearchRecord()
{
    $response = $this->get('/buscada?fecha=2023-06-25');

    $response->assertStatus(200);
}

}
?>

