<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {

    // API servicios
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    // API citas
    public static function guardar() {
        
        // Almacena la cita y devuelve el ID del registro que se almacena
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $citaId = $resultado['id'];

        // Almacena los Servicios con el ID de la cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $citaId,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        // Retornamos el resultado para lo lea el frontend
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();

            // Redireccionamos hacia la url de donde venimos
            header('Location:' . $_SERVER['HTTP_REFERER']); 
        }
    }


}


