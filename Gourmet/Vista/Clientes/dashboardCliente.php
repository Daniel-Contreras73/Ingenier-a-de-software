<?php
session_start();

// Verificar autenticación
if (!isset($_SESSION['idUsuario']) || $_SESSION['tipo'] !== 'Cliente') {
    header('Location: loginCliente.php');
    exit();
}

// Mostrar mensajes temporales
$success_message = $_SESSION['success_message'] ?? '';
$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Cliente | Gourmet</title>
    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        
        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .brand {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: white;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .user-name {
            font-weight: 500;
        }
        
        .logout-btn {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #b91c1c;
        }
        
        /* Contenido principal */
        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        /* Alertas */
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 6px;
            font-size: 0.95rem;
        }
        
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border-left: 4px solid #22c55e;
        }
        
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        
        /* Mensaje de bienvenida */
        .welcome-section {
            background-color: white;
            padding: 1.8rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .welcome-title {
            color: #1e40af;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }
        
        .welcome-text {
            color: #475569;
        }
        
        /* Grid de acciones */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .action-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .card-icon {
            padding: 1.8rem;
            text-align: center;
            font-size: 2.2rem;
            color: white;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .card-content h3 {
            margin: 0 0 0.5rem 0;
            color: #1e40af;
            font-size: 1.2rem;
        }
        
        .card-content p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        /* Colores para las tarjetas */
        .menu-card .card-icon { background-color: #2563eb; }
        .order-card .card-icon { background-color: #16a34a; }
        .history-card .card-icon { background-color: #7c3aed; }
        .reserve-card .card-icon { background-color: #ea580c; }
        .profile-card .card-icon { background-color: #0d9488; }
        
        /* Footer */
        .dashboard-footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #1e293b;
            color: white;
            margin-top: 3rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 1rem;
                padding: 1.2rem;
                text-align: center;
            }
            
            .user-info {
                width: 100%;
                justify-content: center;
            }
            
            .main-container {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="brand">Restaurante Gourmet</div>
        <div class="user-info">
            <div class="user-avatar">
                <?php echo strtoupper(substr($_SESSION['nombre'], 0, 1)); ?>
            </div>
            <span class="user-name"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="../../Controlador/Clientes/clienteControlador.php?action=logout" class="logout-btn">
                Salir
            </a>
        </div>
    </header>

    <div class="main-container">
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <section class="welcome-section">
            <h2 class="welcome-title">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
            <p class="welcome-text">Desde aquí puedes gestionar tus pedidos, reservas y preferencias en nuestro restaurante.</p>
        </section>

        <div class="actions-grid">
            <a href="menuCliente.php" class="action-card menu-card">
                <div class="card-icon">
                    🍽️
                </div>
                <div class="card-content">
                    <h3>Ver Menú</h3>
                    <p>Explora nuestra carta y descubre nuestras especialidades</p>
                </div>
            </a>
            
      <a href="/IGourmet/Gourmet/Controlador/Clientes/clienteControlador.php?action=crearComanda" class="action-card order-card">

                <div class="card-icon">
                    🛒
                </div>
                <div class="card-content">
                    <h3>Hacer Pedido</h3>
                    <p>Realiza un nuevo pedido para comer en el local o para llevar</p>
                </div>
            </a>
            
            <a href="/IGourmet/Gourmet/Controlador/Clientes/ClienteController.php?action=mostrarComandas&id=<?= $_SESSION['idUsuario'] ?>" class="action-card history-card">
                <div class="card-icon">
                    📋
                </div>
                <div class="card-content">
                    <h3>Mis Pedidos</h3>
                    <p>Revisa el historial y estado de tus pedidos anteriores</p>
                </div>
            </a>
            
            <a href="reservas.php" class="action-card reserve-card">
                <div class="card-icon">
                    🗓️
                </div>
                <div class="card-content">
                    <h3>Reservar Mesa</h3>
                    <p>Reserva una mesa para disfrutar de nuestra gastronomía</p>
                </div>
            </a>
            
            <a href="perfil.php" class="action-card profile-card">
                <div class="card-icon">
                    👤
                </div>
                <div class="card-content">
                    <h3>Mi Perfil</h3>
                    <p>Actualiza tu información personal y preferencias</p>
                </div>
            </a>
        </div>
    </div>

    <footer class="dashboard-footer">
        © <?php echo date('Y'); ?> Restaurante Gourmet - Todos los derechos reservados
    </footer>
</body>
</html>