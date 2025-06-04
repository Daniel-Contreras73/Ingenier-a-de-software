<?php
session_start();
require_once('../../Modelo/Operadores/recepcionistaModelo.php');

$mensaje = '';

class RecepcionistaController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new RecepcionistaModelo();
    }

    public function reservaciones()
    {
        $mesas = $this->modelo->obtenerMesas();
        include('../../Vista/Operadores/Recepcionista/reservaciones.php');
        exit();
    }
    public function reservar()
    {

        $clientes = $this->modelo->obtenerClientes();
        $operadores = $this->modelo->obtenerOperadores();
        $idMesa = $_GET['idmesa'] ?? null;
        include('../../Vista/Operadores/Recepcionista/reservar_mesa.php');
    }
    public function insertarReservacion()
    {
        $datos_reservacion = [
            'IdMesa' => $_POST['idmesa'],
            'IdCliente' => $_POST['IdUsuario'],
            'IdOperador' => $_POST['IdOperador'],
            'Fecha' => $_POST['Fecha'],
            'Hora_Inicio' => $_POST['Hora_Inicio'],
            'Hora_Fin' => $_POST['Hora_Fin'],
            'Estado' => $_POST['Estado']
        ];

        $this->modelo->insertarReservacion($datos_reservacion);

        $this->reservaciones();
    }
    public function eliminarRecervacion()
    {
        $idMesa = $_GET['idmesa'] ?? null;

        if ($idMesa) {
            
            $this->modelo->eliminar($idMesa);
            $mensaje = "Reservación eliminada correctamente.";
        } else {
            $mensaje = "No se especificó una mesa válida.";
        }

        // Redirigir a la página de reservaciones después de eliminar
        $this->reservaciones();
    }
}

// Instancia del controlador
$controller = new RecepcionistaController();

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if (method_exists($controller, $accion)) {
        $controller->$accion();
    } else {
        echo "Función no encontrada.";
    }
} else {
    echo "Ninguna acción especificada.";
}
