<?php
require_once(__DIR__ . '/../conexion.php');
require_once('Operador.php');

class GerenteModelo
{
    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }

    public function obtenerTodosLosOperadores()
    {
        $stmt = $this->db->query("SELECT * FROM Operadores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTiposOperador()
    {
        $stmt = $this->db->query("SELECT * FROM TiposOperadores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function actualizarOperador($idOperador, $nombres, $apellidos, $email, $contrasena, $idTiposOperador)
    {
        $stmt = $this->db->prepare("UPDATE Operadores SET Nombres = :nombres, Apellidos = :apellidos, 
            Email = :email, Contrasena = :contrasena, IdTiposOperador = :idTiposOperador WHERE IdOperador = :idOperador");

        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':idTiposOperador', $idTiposOperador);
        $stmt->bindParam(':idOperador', $idOperador);

        $stmt->execute();
    }
    public function borrarOperador($idOperador)
    {
        $stmt = $this->db->prepare("DELETE FROM Operadores WHERE IdOperador = :idOperador");
        $stmt->bindParam(':idOperador', $idOperador);
        $stmt->execute();
    }

    public function insertar($operador)
    {
        $stmt = $this->db->prepare("INSERT INTO Operadores (Nombres, Apellidos, Email, Contrasena, IdTiposOperador) 
            VALUES (:nombres, :apellidos, :email, :contrasena, :idTiposOperador)");

        $stmt->bindParam(':nombres', $operador['nombres']);
        $stmt->bindParam(':apellidos', $operador['apellidos']);
        $stmt->bindParam(':email', $operador['email']);
        $stmt->bindParam(':contrasena', $operador['contrasena']);
        $stmt->bindParam(':idTiposOperador', $operador['idTiposOperador']);

        $stmt->execute();
    }

    public function obtenerVentas()
    {
        return $this->db->query("
        SELECT * 
        FROM Comanda c
        INNER JOIN DetalleComandaProducto d ON c.IdComanda = d.IdComanda
        WHERE c.Estado = 2
    ")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerProductos(){
        $stmt = $this->db->query("SELECT * FROM Productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function borrarProducto($idProducto)
    {
        $stmt = $this->db->prepare("DELETE FROM Productos WHERE IdProducto = :idProducto");
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();
    }
    public function actualizarProducto($idProducto, $descripcion, $precio)
    {
        $stmt = $this->db->prepare("UPDATE Productos SET Descripcion = :descripcion, Precio = :precio WHERE IdProducto = :idProducto");
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();
    }
    public function insertarProducto($descripcion, $precio)
    {
        $stmt = $this->db->prepare("INSERT INTO Productos (Descripcion, Precio) VALUES (:descripcion, :precio)");
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->execute();
    }
}
