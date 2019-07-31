-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2019 a las 05:33:03
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlaso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_aportantes`
--

CREATE TABLE `tabla_aportantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proceso` enum('NOMINA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sueldo` decimal(8,2) NOT NULL DEFAULT '0.00',
  `tipo` enum('APORTANTE','SOCIO') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_mes_aportacion`
--

CREATE TABLE `tabla_mes_aportacion` (
  `c_codigo` bigint(20) UNSIGNED NOT NULL,
  `aportante` int(10) UNSIGNED NOT NULL,
  `anual` year(4) NOT NULL,
  `mensual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `aporte` decimal(8,2) NOT NULL,
  `ahorro` decimal(8,2) NOT NULL DEFAULT '0.00',
  `estado` enum('NORMAL','SOBREGIRO','CUBRE SOBREGIRO') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla_aportantes`
--
ALTER TABLE `tabla_aportantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_mes_aportacion`
--
ALTER TABLE `tabla_mes_aportacion`
  ADD PRIMARY KEY (`c_codigo`),
  ADD KEY `tabla_mes_aportacion_aportante_foreign` (`aportante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla_aportantes`
--
ALTER TABLE `tabla_aportantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tabla_mes_aportacion`
--
ALTER TABLE `tabla_mes_aportacion`
  ADD CONSTRAINT `tabla_mes_aportacion_aportante_foreign` FOREIGN KEY (`aportante`) REFERENCES `tabla_aportantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
