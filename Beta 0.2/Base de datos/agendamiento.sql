-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 18:27:21
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
-- Base de datos: `calendario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendamiento`
--

CREATE TABLE `agendamiento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `turnos_disponibles` int(11) DEFAULT 4,
  `turnos_ocupados` int(11) DEFAULT 0,
  `deshabilitado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agendamiento`
--

INSERT INTO `agendamiento` (`id`, `fecha`, `turnos_disponibles`, `turnos_ocupados`, `deshabilitado`) VALUES
(1094, '2024-11-14', 0, 0, 1),
(1095, '2024-11-15', 4, 0, 0),
(1096, '2024-11-16', 0, 0, 1),
(1097, '2024-11-17', 0, 0, 1),
(1098, '2024-11-18', 4, 0, 0),
(1099, '2024-11-19', 4, 0, 0),
(1100, '2024-11-20', 4, 0, 0),
(1101, '2024-11-21', 4, 0, 0),
(1102, '2024-11-22', 4, 0, 0),
(1103, '2024-11-23', 0, 0, 1),
(1104, '2024-11-24', 0, 0, 1),
(1105, '2024-11-25', 4, 0, 0),
(1106, '2024-11-26', 4, 0, 0),
(1107, '2024-11-27', 4, 0, 0),
(1108, '2024-11-28', 4, 0, 0),
(1109, '2024-11-29', 4, 0, 0),
(1110, '2024-11-30', 0, 0, 1),
(1111, '2024-12-01', 0, 0, 1),
(1112, '2024-12-02', 4, 0, 0),
(1113, '2024-12-03', 4, 0, 0),
(1114, '2024-12-04', 4, 0, 0),
(1115, '2024-12-05', 4, 0, 0),
(1116, '2024-12-06', 4, 0, 0),
(1117, '2024-12-07', 0, 0, 1),
(1118, '2024-12-08', 0, 0, 1),
(1119, '2024-12-09', 4, 0, 0),
(1120, '2024-12-10', 4, 0, 0),
(1121, '2024-12-11', 4, 0, 0),
(1122, '2024-12-12', 4, 0, 0),
(1123, '2024-12-13', 4, 0, 0),
(1124, '2024-12-14', 0, 0, 1),
(1125, '2024-12-15', 0, 0, 1),
(1126, '2024-12-16', 4, 0, 0),
(1127, '2024-12-17', 4, 0, 0),
(1128, '2024-12-18', 4, 0, 0),
(1129, '2024-12-19', 4, 0, 0),
(1130, '2024-12-20', 4, 0, 0),
(1131, '2024-12-21', 0, 0, 1),
(1132, '2024-12-22', 0, 0, 1),
(1133, '2024-12-23', 4, 0, 0),
(1134, '2024-12-24', 4, 0, 0),
(1135, '2024-12-25', 4, 0, 0),
(1136, '2024-12-26', 4, 0, 0),
(1137, '2024-12-27', 4, 0, 0),
(1138, '2024-12-28', 0, 0, 1),
(1139, '2024-12-29', 0, 0, 1),
(1140, '2024-12-30', 4, 0, 0),
(1141, '2024-12-31', 4, 0, 0),
(1142, '2025-01-01', 4, 0, 0),
(1143, '2025-01-02', 4, 0, 0),
(1144, '2025-01-03', 4, 0, 0),
(1145, '2025-01-04', 0, 0, 1),
(1146, '2025-01-05', 0, 0, 1),
(1147, '2025-01-06', 4, 0, 0),
(1148, '2025-01-07', 4, 0, 0),
(1149, '2025-01-08', 4, 0, 0),
(1150, '2025-01-09', 4, 0, 0),
(1151, '2025-01-10', 4, 0, 0),
(1152, '2025-01-11', 0, 0, 1),
(1153, '2025-01-12', 0, 0, 1),
(1154, '2025-01-13', 4, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
