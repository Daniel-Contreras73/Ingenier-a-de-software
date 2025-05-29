<?php
require_once(__DIR__ . '/../conexion.php');
require_once('Operador.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class meseroModelo
{
    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }

    public function obtenerProductos()
    {
        $stmt = $this->db->query("SELECT * FROM Productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarComanda($datosComanda)
    {
        $stmt = $this->db->prepare("INSERT INTO Comanda (IdOperador, Estado, Total) VALUES (:idMesero, '0',:Total )");
        $stmt->bindParam(':idMesero', $_SESSION['idUsuario']);
        $stmt->bindValue(':Total', $datosComanda['total'] ?? 0);
        $stmt->execute();
        $idComanda = $this->db->lastInsertId();

        foreach ($datosComanda['productos'] as $producto) {
            $stmt = $this->db->prepare("INSERT INTO DetalleComandaProducto (IdComanda, IdProductos, Precio) VALUES (:idComanda, :idProducto, :precio)");
            $stmt->bindParam(':idComanda', $idComanda);
            $stmt->bindParam(':idProducto', $producto['id']);
            $stmt->bindParam(':precio', $producto['precio']);
            $stmt->execute();
        }
    }
    public function obtenerComandas($idOperador)
    {
        $stmt = $this->db->prepare("SELECT * FROM Comanda WHERE IdOperador = :idOperador");
        $stmt->bindParam(':idOperador', $idOperador); // ✅ uso correcto del parámetro
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerMesas()
    {
        $stmt = $this->db->query("SELECT * FROM Mesa LEFT JOIN Reservaciones ON Mesa.IdMesa = Reservaciones.IdMesa LEFT JOIN Operadores ON Mesa.Id_Operador = Operadores.IdOperador");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
