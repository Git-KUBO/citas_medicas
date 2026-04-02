CREATE DATABASE IF NOT EXISTS citas_medicas;
USE citas_medicas;

-- Tabla de Usuarios (Pacientes y Administradores)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'paciente') DEFAULT 'paciente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- 1. Insertar Usuarios (1 Administrador y 3 Pacientes)
-- La contraseña para todos es: password
INSERT INTO usuarios (id, nombre, email, password, rol) VALUES
(1, 'Admin NovaCare', 'admin@novacare.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(2, 'Rosa Abreu', 'rosa@correo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'paciente'),
(3, 'Carlos Mateo', 'carlos@correo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'paciente'),
(4, 'Laura Polanco', 'laura@correo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'paciente');

-- 2. Insertar Citas Médicas de prueba para los pacientes 
INSERT INTO citas (id_usuario, fecha, hora, especialidad, estado) VALUES
-- Citas de Rosa (ID 2)
(2, '2026-04-10', '09:00:00', 'Medicina General', 'confirmada'),
(2, '2026-04-15', '14:30:00', 'Ginecología', 'pendiente'),

-- Citas de Carlos (ID 3)
(3, '2026-04-12', '10:00:00', 'Cardiología', 'pendiente'),
(3, '2026-04-20', '16:00:00', 'Medicina General', 'cancelada'),

-- Citas de Laura (ID 4)
(4, '2026-04-08', '08:30:00', 'Pediatría', 'confirmada'),
(4, '2026-04-25', '11:00:00', 'Pediatría', 'pendiente');