<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaCare | Tu Salud en Buenas Manos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style/index.css">
    <style>
        /* =========================================
           Estilos Optimizados
           ========================================= */

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            color: #333;
            line-height: 1.6;
        }

        body.landing-page {
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo h1 {
            margin: 0;
            color: #007BFF;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links a {
            text-decoration: none;
            transition: 0.3s;
        }

        /* Botones */
        .btn-outline {
            border: 2px solid #007BFF;
            color: #007BFF;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 600;
            margin-right: 10px;
        }

        .btn-outline:hover {
            background-color: #007BFF;
            color: white;
        }

        .btn-primary {
            background-color: #007BFF;
            color: white !important;
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Hero Section - Usando la imagen generada */
        .hero {
            height: 80vh; /* Más alto para impacto visual */
            min-height: 500px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('/img/hero-bg.png') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 35px;
            opacity: 0.9;
        }

        .hero-btn {
            font-size: 1.1rem;
            padding: 15px 40px;
            text-decoration: none;
            display: inline-block;
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 80px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-box {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
        }

        .feature-box h3 {
            color: #007BFF;
            margin-bottom: 15px;
            font-size: 1.4rem;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 40px 20px;
            background-color: #212529;
            color: #adb5bd;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h2 { font-size: 2rem; }
            .navbar { padding: 15px 20px; }
            .nav-links { display: flex; flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body class="landing-page">

    <header class="navbar">
        <div class="logo">
            <h1>NovaCare</h1>
        </div>
        <nav class="nav-links">
            <a href="login.php" class="btn-outline">Iniciar Sesión</a>
            <a href="registro.php" class="btn-primary">Registrarse</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Tu salud no espera, <br>agenda hoy mismo</h2>
                <p>Gestiona tus citas médicas de forma rápida, segura y desde cualquier dispositivo. El control de tu bienestar en un solo lugar.</p>
                <div class="hero-buttons">
                    <a href="registro.php" class="btn-primary hero-btn">Comenzar ahora</a>
                </div>
            </div>
        </section>

        <section class="features">
            <div class="feature-box">
                <h3>Ahorra Tiempo</h3>
                <p>Agenda en menos de 2 minutos. Sin esperas telefónicas ni traslados innecesarios para un simple turno.</p>
            </div>
            <div class="feature-box">
                <h3>Especialistas</h3>
                <p>Accede a una amplia red de profesionales certificados en diversas áreas de la salud.</p>
            </div>
            <div class="feature-box">
                <h3>Control Total</h3>
                <p>Historial completo, recordatorios automáticos y la posibilidad de reprogramar con un solo clic.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> NovaCare | Sistema de Gestión de Salud</p>
    </footer>

    <script src="/js/index.js"></script>
</body>
</html>