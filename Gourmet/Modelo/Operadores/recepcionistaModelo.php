<?php
require_once(__DIR__ . '/../conexion.php');
require_once('Operador.php');

class RecepcionistaModelo
{
    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }

    public function obtenerMesas()
    {
        $stmt = $this->db->query("SELECT * FROM Mesa LEFT JOIN Operadores ON Mesa.IdOperador = Operadores.IdOperador");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerClientes()
    {
        $stmt = $this->db->query("SELECT * FROM Clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerOperadores()
    {
        $stmt = $this->db->query("SELECT * FROM Operadores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertarReservacion($datosReservacion)
    {

        $sql = "INSERT INTO Reservaciones 
            (Id_Operator, IdMesa, Fecha, Hora_Inicio, Hora_Fin, Estado, IdCliente) 
            VALUES 
            (:IdOperador, :IdMesa, :Fecha, :Hora_Inicio, :Hora_Fin, :Estado, :IdCliente)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':IdOperador', $datosReservacion['IdOperador']);
        $stmt->bindParam(':IdMesa', $datosReservacion['IdMesa']);
        $stmt->bindParam(':Fecha', $datosReservacion['Fecha']);
        $stmt->bindParam(':Hora_Inicio', $datosReservacion['Hora_Inicio']);
        $stmt->bindParam(':Hora_Fin', $datosReservacion['Hora_Fin']);
        $stmt->bindParam(':Estado', $datosReservacion['Estado']);
        $stmt->bindParam(':IdCliente', $datosReservacion['IdCliente']);

        $stmt->execute();
        // Ahora actualiza la mesa para asignar el operador
        $estadoPendiente = 'P'; // Letra que representa 'Pendiente'

        $update = $this->db->prepare("
    UPDATE Mesa 
    SET IdOperador = :IdOperador, Estado = :Estado 
    WHERE IdMesa = :IdMesa
");

        $update->bindParam(':IdOperador', $datosReservacion['IdOperador']);
        $update->bindParam(':IdMesa', $datosReservacion['IdMesa']);
        $update->bindParam(':Estado', $estadoPendiente);

        $update->execute();
        $updatecliente = $this->db->prepare("Update Clientes SET IDMesas = :IdMesa WHERE IdClientes = :IdCliente");
        $updatecliente->bindParam(':IdMesa', $datosReservacion['IdMesa']);
        $updatecliente->bindParam(':IdCliente', $datosReservacion['IdCliente']);
        $updatecliente->execute();

        $updateOperador = $this->db->prepare("UPDATE Operadores SET IdMesas = :IdMesa WHERE IdOperador = :IdOperador");
        $updateOperador->bindParam(':IdMesa', $datosReservacion['IdMesa']);
        $updateOperador->bindParam(':IdOperador', $datosReservacion['IdOperador']);
        $updateOperador->execute();
        
    }
    public function eliminar($idMesa)
    {
        // Eliminar la reservación de la mesa
        $sql = "DELETE FROM Reservaciones WHERE IdMesa = :IdMesa";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':IdMesa', $idMesa);
        $stmt->execute();

        // Actualizar el estado de la mesa a 'Disponible' y eliminar el operador asignado
        $update = $this->db->prepare("UPDATE Mesa SET IdOperador = NULL, Estado = 'D' WHERE IdMesa = :IdMesa");
        $update->bindParam(':IdMesa', $idMesa);
        $update->execute();

        // Actualizar el cliente para eliminar la referencia a la mesa
        $updateCliente = $this->db->prepare("UPDATE Clientes SET IdMesas = NULL WHERE IdMesas = :IdMesa");
        $updateCliente->bindParam(':IdMesa', $idMesa);
        $updateCliente->execute();

        //acualiza el operador para eliminar la referencia a la mesa
        $updateOperador = $this->db->prepare("UPDATE Operadores SET IdMesas = NULL WHERE IdMesas = :IdMesa");
    }
}
