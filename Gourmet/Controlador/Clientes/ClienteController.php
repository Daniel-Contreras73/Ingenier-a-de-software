<?php
// Controlador/Clientes/clienteControlador.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../../Modelo/Clientes/cliente.php');
require_once('../../Modelo/Clientes/crudClientes.php');
require_once('../../Modelo/Clientes/loginClienteModel.php'); // Necesario para el login automático
// Asegúrate de que la ruta es correcta
require_once('../../Modelo/Operadores/cajeroModelo.php'); // Necesario para el login automático
require_once('../../Modelo/Clientes/ClienteModelo.php');
require_once('../../Modelo/Operadores/meseroModelo.php'); // Necesario para el login automático


$crud = new CrudClientes();
$cliente = new Cliente();
$loginModel = new loginClienteModel(); // Instancia del modelo de login
$clienteModelo = new ClienteModelo();
$meseroModelo = new meseroModelo();



class ClienteController
{
    private $crud;
    private $loginModel;
    private $cajeroModelo;
    private $meseroModelo;
    private $clienteModelo;

    public function __construct()
    {
        $this->crud = new CrudClientes();
        $this->loginModel = new LoginClienteModel();
        $this->cajeroModelo = new cajeroModelo();
        $this->meseroModelo = new meseroModelo();
        $this->clienteModelo = new ClienteModelo();
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = new Cliente();
            $cliente->setNombres($_POST['nombres']);
            $cliente->setApellidos($_POST['apellidos']);
            $cliente->setEmail($_POST['email']);
            $cliente->setContrasena(password_hash($_POST['contrasena'], PASSWORD_BCRYPT));
            $cliente->setIdTipos(1); // tipo cliente fijo
            $cliente->setIdMesas($_POST['idMesas'] ?? null);

            if ($this->crud->insertar($cliente)) {
                $this->autenticarDespuesRegistro($_POST['email'], $_POST['contrasena']);
                exit();
            }

            $_SESSION['error_registro'] = 'Error en el proceso de registro';
            header('Location: ../../Vista/Clientes/registrarCliente.php');
            exit();
        }
    }
    public function menu()
    {
        $productos = $this->meseroModelo->obtenerProductos();
        include('../../Vista/Clientes/menuCliente.php');
        exit();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

            $cliente = $this->loginModel->autenticarCliente($email);

            if ($cliente && password_verify($contrasena, $cliente['Contrasena'])) {
                $_SESSION['idUsuario'] = $cliente['IdClientes'];
                $_SESSION['nombre'] = $cliente['Nombres'];
                $_SESSION['tipo'] = 'Cliente';
                $_SESSION['logged_in'] = true;
                header('Location: ../../Vista/Clientes/dashboardCliente.php');
                exit();
            } else {
                $_SESSION['error_login'] = 'Email o contraseña incorrectos';
                header('Location: ../../Vista/Clientes/loginCliente.php');
                exit();
            }
        }
    }
    public function logout()
    {
        // Limpiar todos los datos de sesión
        $_SESSION = array();

        // Borrar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir al login
        header('Location: /Gourmet/Vista/Clientes/loginCliente.php');
        exit();
    }

    private function autenticarDespuesRegistro($email, $contrasena)
    {
        $cliente = $this->loginModel->autenticarCliente($email);

        if ($cliente && password_verify($contrasena, $cliente['Contrasena'])) {
            $_SESSION = [];
            $_SESSION['idUsuario'] = $cliente['IdClientes'];
            $_SESSION['nombre'] = $cliente['Nombres'];
            $_SESSION['tipo'] = 'Cliente';
            $_SESSION['logged_in'] = true;
            header('Location: ../../Vista/Clientes/dashboardCliente.php');
            return true;
        }

        header('Location: ../../Vista/Clientes/loginCliente.php');
        return false;
    }
    public function crearComanda()
    {
        $productos = $this->meseroModelo->obtenerProductos();
        include('../../Vista/Clientes/comanda.php');
        exit();
    }
    public function insertarComanda()
    {
        $operador = $this->clienteModelo->obtenerOperador($_SESSION['idUsuario']);

        if (!$operador || empty($operador['IdOperador'])) {
            die(" No se encontró un operador relacionado al cliente. Verifica que el cliente tenga mesa asignada y la mesa tenga un operador.");
        }

        var_dump($operador); // Comprobar lo que devuelve
        // exit(); // activa esto si quieres ver el resultado

        if (isset($_POST['carrito'])) {
            $productos = json_decode($_POST['carrito'], true);
            $total = 0;
            foreach ($productos as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }

            $datosComanda = [
                'IdCliente' => $_SESSION['idUsuario'],
                'idOperador' => $operador['IdOperador'],
                'productos' => $productos,
                'total' => $total
            ];

            $this->meseroModelo->insertarComanda($datosComanda);
        } else {
            echo "No se recibió carrito.";
        }

        include('../../Vista/Clientes/dashboardCliente.php');
    }

    public function mostrarComandas()
    {

        $comandas = $this->clienteModelo->mostrarComandas($_SESSION['idUsuario']);
        include('../../Vista/Clientes/pedidos.php');
        exit();
        echo "Función de mostrar comandas no implementada.";
    }
}

// Manejo de las acciones
$controlador = new ClienteController();

if (isset($_GET['action'])) {
    $action = $_GET['action'] ?? '';
    if (method_exists($controlador, $action)) {
        $controlador->$action();
    } else {
        echo "Acción no encontrada.";
    }
} else {
    // Si no se especifica acción, redirigir al login
    header('Location: ../../Vista/Clientes/loginCliente.php');
    exit();
}
