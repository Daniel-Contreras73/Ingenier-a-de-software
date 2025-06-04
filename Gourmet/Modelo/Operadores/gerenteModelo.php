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
        INNER JOIN Operadores o ON c.IdOperador = o.IdOperador
        WHERE c.Estado = 2
    ")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerProductos()
    {
        $stmt = $this->db->query("SELECT * FROM Productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerProductoPorId($idProducto)
    {
        $stmt = $this->db->prepare("SELECT * FROM Productos WHERE IdProducto = :idProducto");
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function borrarProducto($idProducto)
    {
        $stmt = $this->db->prepare("DELETE FROM Productos WHERE IdProducto = :idProducto");
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();
    }
    public function actualizarProducto($datosProducto)
    {
        $stmt = $this->db->prepare("UPDATE Productos SET Nombre = :nombre, Descripcion = :descripcion, Precio = :precio,Imagen = :imagen WHERE IdProducto = :idProducto");
        $stmt->bindParam(':nombre', $datosProducto['nombre']);
        $stmt->bindParam(':descripcion', $datosProducto['descripcion']);
        $stmt->bindParam(':precio', $datosProducto['precio']);
        $stmt->bindParam(':imagen', $datosProducto['imagen']);
        $stmt->bindParam(':idProducto', $datosProducto['idProducto']);

        $stmt->execute();
    }
    public function insertarProducto($descripcion, $precio, $imagen)
    {
        $stmt = $this->db->prepare("INSERT INTO Productos (Descripcion, Precio, Imagen) VALUES (:descripcion, :precio, :imagen)");
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->execute();
    }
}
