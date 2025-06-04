<?php
require_once(__DIR__ . '/../conexion.php');
require_once('Operador.php');

class cajeroModelo
{
    private $db;

    public function __construct()
    {
        $this->db = conexion::conectar();
    }

    public function comandas()
    {
        $stmt = $this->db->query("
        SELECT 
            Comanda.IdComanda,
            Operadores.Nombres AS Nombre,
            Comanda.IdOperador,
            Comanda.Total
        FROM Comanda
        INNER JOIN Operadores ON Comanda.IdOperador = Operadores.IdOperador
        WHERE Comanda.Estado = 1
        ORDER BY Comanda.IdComanda DESC
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pagoEfectivo($idComanda)
    {
        // 1. Obtener datos de la comanda (monto y operador)
        $stmt = $this->db->prepare("SELECT Total, IdOperador FROM Comanda WHERE IdComanda = :idComanda");
        $stmt->bindParam(':idComanda', $idComanda, PDO::PARAM_INT);
        $stmt->execute();
        $comanda = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$comanda) {
            echo "No se encontró la comanda.";
            return false;
        }

        $monto = $comanda['Total'];
        $idOperador = $comanda['IdOperador'];

        // 2. Validar que el monto sea mayor a 0
        if ($monto <= 0) {
            echo "El monto es cero o negativo. No se puede registrar el pago.";
            return false;
        }

        // 3. Insertar Historial de Pago
        $stmt = $this->db->prepare("INSERT INTO HistorialDePagos (Estado) VALUES ('F')");
        $stmt->execute();
        $idHistorialPago = $this->db->lastInsertId();

        // 4. Insertar en Pago
        $idMetodo = 1; // Efectivo
        $stmt = $this->db->prepare("
        INSERT INTO Pago (IdHistorialPago, IdMetodoDePago, Monto, FechaPago)
        VALUES (:idHistorialPago, :idMetodo, :monto, GETDATE())
    ");
        $stmt->bindParam(':idHistorialPago', $idHistorialPago);
        $stmt->bindParam(':idMetodo', $idMetodo);
        $stmt->bindParam(':monto', $monto);
        $stmt->execute();
        $idPago = $this->db->lastInsertId();

        // 5. Insertar en Transaccion
        $stmt = $this->db->prepare("
        INSERT INTO Transaccion (Estado, Monto, FechaTran, IdPago, IdOperador)
        VALUES ('P', :monto, GETDATE(), :idPago, :idOperador)
    ");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':idPago', $idPago);
        $stmt->bindParam(':idOperador', $idOperador);
        $stmt->execute();

        // 6. Actualizar la comanda como pagada
        $stmt = $this->db->prepare("
        UPDATE Comanda 
        SET  Estado = 2
        WHERE IdComanda = :idComanda
    ");
        $stmt->bindParam(':idComanda', $idComanda, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public function pagoTarjeta($datos)
    {
        // Extraer datos del array
        $idComanda = $datos['idComanda'];
        $nombre = $datos['nombre'];
        $numeroTarjeta = $datos['numeroTarjeta'];
        $expiracion = $datos['expiracion'];
        $cvv = $datos['cvv'];
        $monto = $datos['monto'];

        // 1. Obtener datos del operador
        $stmt = $this->db->prepare("SELECT IdOperador FROM Comanda WHERE IdComanda = :idComanda");
        $stmt->bindParam(':idComanda', $idComanda, PDO::PARAM_INT);
        $stmt->execute();
        $comanda = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$comanda) {
            echo "No se encontró la comanda.";
            return false;
        }

        $idOperador = $comanda['IdOperador'];

        // 2. Validar que el monto sea mayor a 0
        if ($monto <= 0) {
            echo "El monto es cero o negativo. No se puede registrar el pago.";
            return false;
        }

        // 3. Insertar Historial de Pago
        $stmt = $this->db->prepare("INSERT INTO HistorialDePagos (Estado) VALUES ('F')");
        $stmt->execute();
        $idHistorialPago = $this->db->lastInsertId();

        // 4. Insertar en Pago
        $idMetodo = 2; // tarjeta
        $stmt = $this->db->prepare("
        INSERT INTO Pago (IdHistorialPago, IdMetodoDePago, Monto, FechaPago)
        VALUES (:idHistorialPago, :idMetodo, :monto, GETDATE())
    ");
        $stmt->bindParam(':idHistorialPago', $idHistorialPago);
        $stmt->bindParam(':idMetodo', $idMetodo);
        $stmt->bindParam(':monto', $monto);
        $stmt->execute();
        $idPago = $this->db->lastInsertId();

        // 5. Insertar en Transaccion
        $stmt = $this->db->prepare("
        INSERT INTO Transaccion (Estado, Monto, FechaTran, IdPago, IdOperador)
        VALUES ('P', :monto, GETDATE(), :idPago, :idOperador)
    ");
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':idPago', $idPago);
        $stmt->bindParam(':idOperador', $idOperador);
        $stmt->execute();

        // 7. Marcar comanda como pagada
        $stmt = $this->db->prepare("
        UPDATE Comanda 
        SET Total = 0, Estado = 2
        WHERE IdComanda = :idComanda
    ");
        $stmt->bindParam(':idComanda', $idComanda, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
