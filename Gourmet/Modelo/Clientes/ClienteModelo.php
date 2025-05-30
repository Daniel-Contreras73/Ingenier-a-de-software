<?php
require_once(__DIR__ . '/../conexion.php');

class ClienteModelo {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function autenticarCliente($email) {
        $sql = "SELECT * FROM Clientes WHERE Email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function pedido() {
        $stmt = $this->db->query("SELECT * FROM Productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarComandas($idCliente)
{
    $stmt = $this->db->prepare("
        SELECT * FROM Comanda
        WHERE IdOperador = :idCliente
    ");
    $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
