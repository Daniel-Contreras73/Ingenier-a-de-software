<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Completo | Gourmet</title>
    <style>
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
        .menu-header {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            position: relative;
        }
        
        .back-btn {
            position: absolute;
            left: 2rem;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
        }
        
        .back-btn:hover {
            background-color: rgba(255,255,255,0.3);
        }
        
        .menu-header h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }
        
        .menu-header p {
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
        }
        
        /* Contenedor principal */
        .main-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 2rem 3rem;
        }
        
        /* Categorías */
        .category {
            margin-bottom: 3.5rem;
        }
        
        .category-title {
            color: #1e40af;
            margin-bottom: 2rem;
            padding-bottom: 0.6rem;
            border-bottom: 2px solid #dbeafe;
            font-size: 1.6rem;
            text-align: center;
        }
        
        /* Grid de platos */
        .dishes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            justify-items: center;
        }
        
        @media (min-width: 1200px) {
            .dishes-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Tarjeta de plato */
        .dish-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            width: 100%;
            max-width: 380px;
        }
        
        .dish-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }
        
        .dish-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        
        .dish-info {
            padding: 1.8rem;
        }
        
        .dish-name {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #1e293b;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .dish-name:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #2563eb;
        }
        
        .dish-description {
            color: #4b5563;
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .dish-details {
            margin-top: 1.2rem;
            padding-top: 1rem;
            border-top: 1px dashed #e5e7eb;
        }
        
        .detail-item {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: flex-start;
        }
        
        .detail-label {
            font-weight: 600;
            color: #374151;
            min-width: 100px;
        }
        
        .detail-content {
            color: #4b5563;
            flex: 1;
        }
        
        .dish-price {
            font-weight: bold;
            color: #1e40af;
            font-size: 1.3rem;
            margin-top: 1rem;
            text-align: right;
        }
        
        .dish-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 1rem 0;
        }
        
        .tag {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .vegetarian {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .gluten-free {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }
        
        .spicy {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .vegan {
            background-color: #ccfbf1;
            color: #0d9488;
            border: 1px solid #99f6e4;
        }
        
        .cold {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        
        .hot {
            background-color: #ffedd5;
            color: #9a3412;
            border: 1px solid #fed7aa;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dishes-grid {
                grid-template-columns: 1fr;
            }
            
            .menu-header {
                padding: 1.5rem;
            }
            
            .back-btn {
                position: static;
                transform: none;
                margin-bottom: 1rem;
                justify-content: center;
                width: 100%;
            }
            
            .menu-header h1 {
                font-size: 1.8rem;
            }
            
            .main-container {
                padding: 0 1.5rem 2rem;
            }
            
            .dish-card {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="menu-header">
        <button class="back-btn" onclick="window.location.href='../Clientes/dashboardCliente.php'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Volver al Dashboard
        </button>
        <h1>Menú Completo</h1>
        <p>Descubre nuestra selección de platos exquisitos con información detallada</p>
    </header>
    
    <!-- Contenido principal -->
    <div class="main-container">
        <!-- Entradas -->
        <section class="category">
            <h2 class="category-title">Entradas</h2>
            <div class="dishes-grid">
                <!-- Plato 1 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947" alt="Ensalada César" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Ensalada César</h3>
                        <p class="dish-description">Una versión clásica de la ensalada César preparada con los ingredientes más frescos. Nuestra lechuga romana crujiente se combina con croutons dorados, láminas de queso parmesano añejo y nuestra exclusiva salsa César casera.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                            <span class="tag gluten-free">Sin gluten</span>
                        </div>
                        
                        <div class="dish-price">$9.50</div>
                    </div>
                </div>
                
                <!-- Plato 2 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd" alt="Bruschettas" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Bruschettas Clásicas</h3>
                        <p class="dish-description">Nuestras bruschettas son preparadas al momento con pan rústico tostado al punto perfecto, cubierto con una mezcla de tomates frescos, albahaca aromática, ajo y el mejor aceite de oliva virgen extra.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                        </div>
                        
                        <div class="dish-price">$8.25</div>
                    </div>
                </div>
                
                <!-- Plato 3 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1607532941433-304659e8198a" alt="Carpaccio" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Carpaccio de Res</h3>
                        <p class="dish-description">Finas láminas de res de primera calidad marinadas con aceite de oliva virgen extra, jugo de limón, alcaparras y queso parmesano, acompañadas de rúcula fresca.</p>
                        
                        <div class="dish-tags">
                            <span class="tag gluten-free">Sin gluten</span>
                        </div>
                        
                        <div class="dish-price">$11.75</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Platos principales -->
        <section class="category">
            <h2 class="category-title">Platos principales</h2>
            <div class="dishes-grid">
                <!-- Plato 1 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1559847844-5315695dadae" alt="Pasta Carbonara" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Pasta Carbonara</h3>
                        <p class="dish-description">Preparada según la tradición romana con spaghetti al dente, huevos de corral, queso pecorino romano, panceta italiana y abundante pimienta negra recién molida.</p>
                        
                        <div class="dish-price">$12.99</div>
                    </div>
                </div>
                
                <!-- Plato 2 -->
                 <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641" alt="Tacos al Pastor" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Tacos al Pastor</h3>
                        <p class="dish-description">Preparados con la auténtica técnica del trompo, nuestra carne marinada por 24 horas se sirve en tortillas de maíz hechas a mano, acompañadas de piña, cebolla y cilantro.</p>
                        
                        <div class="dish-tags">
                            <span class="tag spicy">Picante</span>
                        </div>
                        
                        <div class="dish-price">$10.75</div>
                    </div>
                </div>
                
                <!-- Plato 3 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8" alt="Salmón" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Salmón a la Parrilla</h3>
                        <p class="dish-description">Filete de salmón fresco con costra de hierbas provenzales, acompañado de espárragos trigueros y puré de coliflor.</p>
                        
                        <div class="dish-tags">
                            <span class="tag gluten-free">Sin gluten</span>
                        </div>
                        
                        <div class="dish-price">$18.50</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Postres -->
        <section class="category">
            <h2 class="category-title">Postres</h2>
            <div class="dishes-grid">
                <!-- Postre 1 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb" alt="Tiramisú" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Tiramisú Clásico</h3>
                        <p class="dish-description">El auténtico postre italiano en su versión tradicional con capas de bizcocho empapado en café y crema de mascarpone.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                        </div>
                        
                        <div class="dish-price">$7.99</div>
                    </div>
                </div>
                
                <!-- Postre 2 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1497034825429-c343d7c6a68f" alt="Cheesecake" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Cheesecake de Frutos Rojos</h3>
                        <p class="dish-description">Nuestra versión cremosa de la tarta de queso neoyorquina con coulis de frutos rojos naturales y frambuesas frescas.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                        </div>
                        
                        <div class="dish-price">$8.50</div>
                    </div>
                </div>
                
                <!-- Postre 3 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1571115177098-24ec42ed204d" alt="Volcán de Chocolate" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Volcán de Chocolate</h3>
                        <p class="dish-description">Delicioso pastel de chocolate con corazón líquido, acompañado de helado de vainilla y frutos rojos frescos.</p>
                        
                        <div class="dish-price">$8.50</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Bebidas -->
        <section class="category">
            <h2 class="category-title">Bebidas</h2>
            <div class="dishes-grid">
                <!-- Bebida 1 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1551029506-0807df4e2031" alt="Limonada" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Limonada Artesanal</h3>
                        <p class="dish-description">Refrescante limonada natural preparada al momento con limones frescos, azúcar de caña y hierbabuena.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                            <span class="tag vegan">Vegana</span>
                            <span class="tag gluten-free">Sin gluten</span>
                            <span class="tag cold">Fría</span>
                        </div>
                        
                        <div class="dish-price">$4.50</div>
                    </div>
                </div>
                
                <!-- Bebida 2 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5" alt="Café" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Café Especialidad</h3>
                        <p class="dish-description">Nuestro café premium de grano arábica, tostado localmente y preparado con métodos de extracción cuidadosos.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                            <span class="tag vegan">Vegana</span>
                            <span class="tag gluten-free">Sin gluten</span>
                            <span class="tag hot">Caliente</span>
                        </div>
                        
                        <div class="dish-price">$3.75 - $5.50</div>
                    </div>
                </div>
                
                <!-- Bebida 3 -->
                <div class="dish-card">
                    <img src="https://images.unsplash.com/photo-1437419764061-2473afe69fc2" alt="Jugo Natural" class="dish-image">
                    <div class="dish-info">
                        <h3 class="dish-name">Jugos Naturales</h3>
                        <p class="dish-description">Selección de jugos naturales preparados al momento con frutas frescas de temporada.</p>
                        
                        <div class="dish-tags">
                            <span class="tag vegetarian">Vegetariana</span>
                            <span class="tag vegan">Vegana</span>
                            <span class="tag gluten-free">Sin gluten</span>
                            <span class="tag cold">Fría</span>
                        </div>
                        
                        <div class="dish-price">$5.00</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Función para retroceder al dashboard
        function goToDashboard() {
            // Cambia 'dashboard.html' por la ruta correcta de tu dashboard
            window.location.href = 'dashboard.html';
        }
    </script>
</body>
</html>