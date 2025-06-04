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
        $stmt = $this->db->prepare("
        INSERT INTO Comanda (IdOperador, Estado, Total,IdCliente) 
        VALUES (:idOperador, '0', :Total,:IdCliente)
    ");
        $stmt->bindParam(':idOperador', $datosComanda['idOperador']); //  operador correcto
        $stmt->bindValue(':Total', $datosComanda['total'] ?? 0);
        $stmt->bindParam(':IdCliente', $datosComanda['IdCliente']);
        $stmt->execute();

        $idComanda = $this->db->lastInsertId();

        foreach ($datosComanda['productos'] as $producto) {
            $stmt = $this->db->prepare("
            INSERT INTO DetalleComandaProducto (IdComanda, IdProductos, Precio, Cantidad) 
            VALUES (:idComanda, :idProducto, :precio, :cantidad)
        ");
            $stmt->bindParam(':idComanda', $idComanda);
            $stmt->bindParam(':idProducto', $producto['id']);
            $stmt->bindParam(':precio', $producto['precio']);
            $stmt->bindParam(':cantidad', $producto['cantidad']);
            $stmt->execute();
        }
    }

    public function obtenerComandas($idOperador)
    {
        $sql = "
        SELECT 
            c.IdComanda,
            c.Estado,
            o.IdMesas,
            o.Nombres AS NombreOperador,
            p.Nombre,
            p.Descripcion,
            d.Precio,
            d.Cantidad,
            (d.Precio * d.Cantidad) AS Subtotal,
            c.Total
        FROM Comanda c
        INNER JOIN Operadores o ON c.IdOperador = o.IdOperador
        INNER JOIN DetalleComandaProducto d ON c.IdComanda = d.IdComanda
        INNER JOIN Productos p ON d.IdProductos = p.IdProducto
        WHERE c.IdOperador = :idOperador
        ORDER BY c.IdComanda DESC
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idOperador', $idOperador, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    public function obtenerMesas($idOperador)
    {
        $stmt = $this->db->query("SELECT * FROM Mesa LEFT JOIN Operadores ON Mesa.Id_Operador = Operadores.IdOperador");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
