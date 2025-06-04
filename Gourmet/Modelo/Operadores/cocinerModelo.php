<?php
require_once(__DIR__ . '/../conexion.php');
require_once('Operador.php');

class cocinerModelo
{
    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }

    public function comandas()
    {
     $sql = "
  SELECT 
    c.IdComanda,
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
WHERE c.Estado = 0
ORDER BY c.IdComanda DESC

";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function completarComanda($idComanda)
    {
        $stmt = $this->db->prepare("UPDATE Comanda SET Estado = 1 WHERE IdComanda = :idComanda");
        $stmt->bindParam(':idComanda', $idComanda, PDO::PARAM_INT);
        $stmt->execute();
    }
}
