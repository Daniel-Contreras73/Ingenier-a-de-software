<?php
require_once(__DIR__ . '/../conexion.php');

    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }
class ClienteModelo {
    public function autenticarCliente($email) {
        $db = Conexion::conectar();
        $sql = "SELECT * FROM Clientes WHERE Email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function pedido($email){
       $stmt = $this->db->query("SELECT * FROM Productos ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

