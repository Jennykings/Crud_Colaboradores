-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2025 a las 17:04:18
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
-- Base de datos: `capacitacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `puesto` enum('Diseño Web','Diseño Gráfico','Community Manager') NOT NULL,
  `edad` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nombre`, `cargo`, `puesto`, `edad`, `fecha_ingreso`) VALUES
(1, 'Ana López', 'Diseñadora UX', 'Diseño Web', 28, '2022-03-15'),
(2, 'Carlos Martínez', 'Ilustrador', 'Diseño Web', 20, '2021-07-22'),
(5, 'Laura Gómez', 'Content Creator', 'Community Manager', 25, '2023-01-10'),
(7, 'Patricia Ramírez', 'Diseñadora Senior', 'Diseño Gráfico', 35, '2019-06-05'),
(9, 'Jorge Salinas', 'Social Media Strategist', 'Community Manager', 27, '2022-09-01'),
(10, 'Diana Pérez', 'Diseñadora Web Junior', 'Diseño Web', 23, '2024-02-20'),
(18, 'Luis Herrera', 'Diseñadora UX', 'Diseño Gráfico', 32, '2025-07-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
