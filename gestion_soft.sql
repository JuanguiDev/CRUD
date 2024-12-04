-- phpMyAdmin SQL Dump
-- Base de datos: `gestion_soft`
-- Versión corregida con 50 registros

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `gestion_soft`;
USE `gestion_soft`;

-- Tabla `equipos`
CREATE TABLE `equipos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Inserción de datos en `equipos`
INSERT INTO `equipos` (`Nombre`, `Marca`, `Modelo`, `Descripcion`) VALUES
('Laptop Pro Max', 'Dell', 'Inspiron 15', 'Laptop con procesador i7, 16GB RAM y 512GB SSD.'),
('Impresora Laser', 'HP', 'LaserJet Pro', 'Impresora láser con capacidad para impresión a doble cara.'),
('Servidor Rack', 'Lenovo', 'ThinkSystem SR550', 'Servidor optimizado para cargas de trabajo críticas.'),
('Switch de Red', 'Cisco', 'Catalyst 9200', 'Switch administrable con soporte para PoE.'),
('Monitor 4K', 'LG', 'UltraFine', 'Monitor con resolución 4K y tecnología IPS.'),
('Teclado Mecánico', 'Logitech', 'G Pro', 'Teclado mecánico retroiluminado RGB.'),
('Mouse Inalámbrico', 'Microsoft', 'Surface Mouse', 'Mouse ergonómico con conexión Bluetooth.'),
('Proyector LED', 'Epson', 'PowerLite X39', 'Proyector portátil con resolución HD y 3500 lúmenes.'),
('Disco Duro Externo', 'Seagate', 'Backup Plus', 'Disco duro portátil de 2TB.'),
('Auriculares Bluetooth', 'Sony', 'WH-1000XM4', 'Auriculares con cancelación activa de ruido.'),
('Smartphone', 'Samsung', 'Galaxy S23', 'Teléfono inteligente con pantalla AMOLED.'),
('Tablet', 'Apple', 'iPad Pro', 'Tablet con pantalla retina y chip M2.'),
('Router Inalámbrico', 'TP-Link', 'Archer C7', 'Router Wi-Fi de doble banda.'),
('Unidad SSD', 'Kingston', 'A2000', 'SSD NVMe con velocidad de lectura de 2000MB/s.'),
('Cámara de Seguridad', 'Dahua', 'HAC-HFW1200T', 'Cámara de vigilancia con visión nocturna.'),
('Micrófono USB', 'Blue', 'Yeti', 'Micrófono profesional para grabación y streaming.'),
('Altavoz Bluetooth', 'JBL', 'Flip 6', 'Altavoz portátil resistente al agua.'),
('Estación de Carga', 'Anker', 'PowerPort', 'Cargador múltiple con 6 puertos USB.'),
('Impresora 3D', 'Creality', 'Ender 3', 'Impresora 3D de escritorio para modelado personal.'),
('Cámara DSLR', 'Canon', 'EOS Rebel T7', 'Cámara réflex digital con lente de 18-55mm.'),
('Fuente de Poder', 'Corsair', 'RM850x', 'Fuente de poder de 850W con certificación 80+ Gold.'),
('Pantalla Táctil', 'Acer', 'T232HL', 'Monitor táctil con resolución Full HD.'),
('Controlador MIDI', 'Akai', 'MPK Mini', 'Controlador MIDI compacto con 25 teclas.'),
('Equipo de Sonido', 'Bose', 'SoundLink Revolve', 'Altavoz con sonido envolvente de 360 grados.'),
('Lector de Huellas', 'SecuGen', 'Hamster Pro 20', 'Escáner de huellas dactilares compacto.'),
('Cargador Solar', 'Goal Zero', 'Nomad 10', 'Cargador solar portátil con puerto USB.'),
('GPS Portátil', 'Garmin', 'eTrex 32x', 'Dispositivo GPS resistente para exteriores.'),
('Switch KVM', 'Aten', 'CS22U', 'Switch para controlar múltiples computadoras.'),
('Cable de Red', 'Ubiquiti', 'UniFi Cable Pro', 'Cable ethernet Cat6 blindado para exteriores.'),
('Consola de Juegos', 'Nintendo', 'Switch OLED', 'Consola híbrida con pantalla OLED.'),
('Estación de Trabajo', 'HP', 'ZBook Fury', 'Laptop de alto rendimiento para diseño y edición.'),
('Controlador de Video', 'Elgato', 'Stream Deck', 'Controlador para transmisión en vivo.'),
('Ventilador Externo', 'Noctua', 'NF-A12x25', 'Ventilador silencioso para equipos electrónicos.'),
('Cámara Web', 'Logitech', 'C920', 'Cámara web Full HD para videollamadas.'),
('UPS', 'APC', 'Smart-UPS 1500VA', 'Sistema de alimentación ininterrumpida.'),
('Batería Externa', 'Xiaomi', 'Power Bank 3', 'Batería externa de 20,000mAh.'),
('Docking Station', 'Dell', 'WD19', 'Base de expansión para laptops.'),
('Lector de Código', 'Honeywell', 'Voyager 1250g', 'Escáner de código de barras.'),
('Pantalla LED', 'Samsung', 'Smart Monitor M5', 'Monitor inteligente con conexión inalámbrica.'),
('Panel Solar', 'Renogy', '100W Monocrystalline', 'Panel solar portátil para carga de dispositivos.'),
('Placa Base', 'ASUS', 'ROG Strix B550', 'Placa base para procesadores AMD Ryzen.'),
('Tarjeta Gráfica', 'NVIDIA', 'RTX 4070', 'Tarjeta gráfica de última generación.'),
('Sistema de Audio', 'Pioneer', 'DMH-WT8600NEX', 'Receptor multimedia para autos.'),
('Scanner', 'Fujitsu', 'ScanSnap iX1600', 'Escáner de documentos con conectividad inalámbrica.'),
('Cerradura Digital', 'August', 'Smart Lock Pro', 'Cerradura inteligente con control remoto.'),
('Impresora de Etiquetas', 'Brother', 'QL-800', 'Impresora de etiquetas térmica.'),
('Cámara de Acción', 'GoPro', 'Hero 11', 'Cámara compacta resistente al agua.'),
('Conector HDMI', 'Belkin', 'Ultra HD Cable', 'Cable HDMI con soporte para 4K HDR.');

-- Tabla `usuario`
CREATE TABLE `usuario` (
  `Usuario` varchar(30) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  PRIMARY KEY (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Inserción de datos en `usuario`
INSERT INTO `usuario` (`Usuario`, `Contraseña`) VALUES
('admin', 'admin123');
