-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 04:22:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `emprendeduros_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `documento`, `telefono`, `email`, `nombre_empresa`, `sector`, `descripcion`, `departamento`, `ciudad`, `clave`, `fecha_registro`) VALUES
(1, 'Daniel', 'Ramirez', '1020428928', '3117830883', 'jhonda429@gmail.com', 'Atila Seguridad Ltda', 'Telecomunicaciones y Tecnología de la Información', 'Empresa de seguridad privada, ofrecemos servicio de consultoría en seguridad electrónica', 'Antioquia', 'Medellín', '$2y$10$kTzzHHpilCUnKZq0vJ4Tue7PhLGZWXmu8oG1P1yZOjnoP/XulD1nu', '2024-12-02 02:25:54'),
(2, 'Vanessa', 'Arzuza', '1041262456', '3152113366', 'vane.arz@hotmail.com', 'VyD aromas', 'Comercio y Venta al por Menor', 'Venta y distribución de velas artesanales con variedad de aromas', 'Antioquia', 'Medellín', '$2y$10$.HNUBenl55CNdI2DygCm4u8p0xCqtqbES7/KSXiYpn20DWpLWsWJe', '2024-12-02 02:48:21'),
(3, 'Laura', 'Valencia', '1132912267', '3001234587', 'lunakanela@gmail.com', 'LunaKanela', 'Moda y Textiles', 'empresa dedicada al diseño y elaboración de prendas intimas femeninas.', 'Antioquia', 'Medellín', '$2y$10$wc.nPTgJgPsa6mSaNlxtvufyctPB90RLfs3M5nO3.UuSJ8vcreORK', '2024-12-02 02:53:17'),
(4, 'Manuel', 'Castrillon', '70380245', '3046451243', 'manuel45@hotmail.com', 'Servi Laptops', 'Telecomunicaciones y Tecnología de la Información', 'Venta de equipos de computo (laptops y desktops), servicio de mantenimiento e importación de hardware.', 'Cundinamarca', 'Bogotá', '$2y$10$EY5rd/TgePu2ydiMd6ovUegzRxBdj9n1SRDe.Htx0PgwZaQUcy1ZK', '2024-12-02 03:03:06'),
(5, 'Maria', 'Yepes', '55834010', '3008120932', 'linaspeed@gmail.com', 'Lina Speed Logic', 'Telecomunicaciones y Tecnología de la Información', 'Venta de hardware, equipos de mesa ensamblados, equipos corporativos, periféricos y laptops.', 'Valle del Cauca', 'Cali', '$2y$10$AxIoj9Lxd0MJrd6OR/ZzyuVf6Q3ZsTLddemDqMzOrfUuoXK5OAnIW', '2024-12-02 03:21:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
