<?php
// Controlador/Clientes/clienteControlador.php
session_start(); // Añade esto al inicio
require_once('../../Modelo/Clientes/cliente.php');
require_once('../../Modelo/Clientes/crudClientes.php');
require_once('../../Modelo/Clientes/loginClienteModel.php'); // Necesario para el login automático
// Asegúrate de que la ruta es correcta
require_once('../../Modelo/Operadores/cajeroModelo.php'); // Necesario para el login automático
require_once('../../Modelo/Operadores/meseroModelo.php'); // Necesario para el login automático


$crud = new CrudClientes();
$cliente = new Cliente();
$loginModel = new loginClienteModel(); // Instancia del modelo de login
$meseroModelo = new meseroModelo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Configura los datos del cliente
    $cliente->setNombres($_POST['nombres']);
    $cliente->setApellidos($_POST['apellidos']);
    $cliente->setEmail($_POST['email']);
    $cliente->setContrasena($_POST['contrasena']); // Asegúrate de que esto se hashea en el modelo
    $cliente->setIdTipos(1); // tipo cliente fijo
    $cliente->setIdMesas($_POST['idMesas'] ?? null);

    // Intenta insertar el nuevo cliente
    if ($crud->insertar($cliente)) {
        // Login automático después del registro exitoso
        $clienteRegistrado = $loginModel->autenticarCliente($_POST['email']);

        if ($clienteRegistrado) {
            // Verifica la contraseña (debería usar password_verify si está hasheada)
            if ($clienteRegistrado['Contrasena'] === $_POST['contrasena']) {
                $_SESSION['idUsuario'] = $clienteRegistrado['IdClientes'];
                $_SESSION['nombre'] = $clienteRegistrado['Nombres'];
                $_SESSION['tipo'] = 'Cliente';
                header('Location: ../../Vista/Clientes/dashboardCliente.php');
                exit();
            }
        }
    }



    // Si hay algún error, redirige al formulario de registro
    $_SESSION['error_registro'] = 'Error en el proceso de registro';
    header('Location: ../../Vista/Clientes/registrarCliente.php');
    exit();
}

class ClienteControlador
{
    private $crud;
    private $loginModel;
    private $cajeroModelo;
    private $meseroModelo;

    public function __construct()
    {
        $this->crud = new CrudClientes();
        $this->loginModel = new LoginClienteModel();
        $this->cajeroModelo = new cajeroModelo();
        $this->meseroModelo = new meseroModelo();
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
        header('Location: /IGourmet/Gourmet/index.html');
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
        if (isset($_POST['productos_json'])) {
            $datosComanda = json_decode($_POST['productos_json'], true);
            if ($datosComanda) {
                $this->meseroModelo->insertarComanda($datosComanda);
                // Redirigir o mostrar éxito
            }
        }
    }
}

// Manejo de las acciones
$controlador = new ClienteControlador();

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
