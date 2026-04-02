

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaCare | Tu Salud en Buenas Manos</title>
    <link rel="stylesheet" href="/css/style.css">
<style>
    /* =========================================
   Estilos de la Landing Page (index.php)
   ========================================= */

   .body{
    font-family: 'Inter', sans-serif;
   }
body.landing-page {
    display: block; /* Sobrescribe el display: flex del body original */
    padding: 0;
    background-color: #f8f9fa;
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background-color: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.navbar .logo h1 {
    margin: 0;
    color: #007BFF;
    font-size: 1.5rem;
}

/* Botones genéricos */
.btn-outline {
    border: 2px solid #007BFF;
    color: #007BFF;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: bold;
    margin-right: 10px;
    transition: 0.3s;
}

.btn-outline:hover {
    background-color: #007BFF;
    color: white;
}

.btn-primary {
    background-color: #007BFF;
    color: white;
    padding: 10px 18px;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Hero Section */
.hero {
    height: 300px;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('https://media.istockphoto.com/id/1428114896/es/foto/pasillo-vac%C3%ADo-en-el-hospital-moderno-con-%C3%A1rea-de-espera-y-cama-de-hospital-en-las-habitaciones.jpg?s=612x612&w=0&k=20&c=KsP_Kh10ddRqhp0_R55o8CcM-0Fn0JkGO9GUZ33MNg8=') no-repeat center center/cover;
    text-align: center;
    padding: 100px 20px;
}

.hero-content {
    max-width: 700px;
    margin: 0 auto;
}

.hero h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: white;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    line-height: 1.6;
}

.hero-btn {
    font-size: 1.2rem;
    padding: 15px 30px;
}

/* Features */
.features {
    display: flex;
    justify-content: space-around;
    padding: 60px 20px;
    max-width: 1000px;
    margin: 0 auto;
    gap: 20px;
}

.feature-box {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    text-align: center;
    flex: 1;
}

.feature-box h3 {
    color: #333;
    margin-bottom: 15px;
}

.feature-box p {
    color: #666;
    line-height: 1.5;
}

/* Footer */
footer {
    text-align: center;
    padding: 20px;
    background-color: #343a40;
    color: white;
    margin-top: auto;
}
</style>
</head>
<body class="landing-page">

    <header class="navbar">
        <div class="logo">
            <h1>⚕️ NovaCare</h1>
        </div>
        <nav>
            <a href="login.php" class="btn-outline">Iniciar Sesión</a>
            <a href="registro.php" class="btn-primary">Registrarse</a>
        </nav>
    </header>

    <main class="hero">
        <div class="hero-content">
            <h2>Gestiona tus citas médicas de forma rápida y segura</h2>
            <p>En NovaCare, tu bienestar es nuestra prioridad. Regístrate en nuestro portal de pacientes para agendar, consultar o cancelar tus citas médicas desde la comodidad de tu hogar.</p>
            <div class="hero-buttons">
                <a href="registro.php" class="btn-primary hero-btn">Agendar mi primera cita</a>
            </div>
        </div>
    </main>

    <section class="features">
        <div class="feature-box">
            <h3> Ahorra Tiempo</h3>
            <p>Olvídate de las largas filas y llamadas en espera. Agenda en menos de 2 minutos.</p>
        </div>
        <div class="feature-box">
            <h3>Especialistas</h3>
            <p>Contamos con un equipo médico altamente capacitado en múltiples áreas.</p>
        </div>
        <div class="feature-box">
            <h3>Control Total</h3>
            <p>Revisa tu historial de citas y reprograma o cancela cuando lo necesites.</p>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> NovaCare. Todos los derechos reservados.</p>
    </footer>

</body>
</html>