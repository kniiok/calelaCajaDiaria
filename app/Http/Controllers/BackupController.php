<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function backupDatabase()
    {
        $command = 'C:\xampp\mysql\bin\mysqldump.exe -u root -p calela > D:\OneDrive\Escritorio\database.sql';

        exec($command, $output, $returnValue);

        if ($returnValue === 0) {
            return "Respaldo de la base de datos realizado correctamente.";
        } else {
            return "Error al realizar el respaldo de la base de datos.";
        }
    }
}

