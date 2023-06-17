-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-06-2023 a las 23:04:04
-- Versión del servidor: 10.5.19-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u122942682_LubricentroGat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agg_carrito`
--

CREATE TABLE `agg_carrito` (
  `cliente_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `promocion` char(20) DEFAULT NULL,
  `tipo_promo` char(10) DEFAULT NULL,
  `porcentaje` int(11) DEFAULT NULL,
  `descuento_promo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `agg_carrito`
--

INSERT INTO `agg_carrito` (`cliente_id`, `producto_id`, `cantidad`, `promocion`, `tipo_promo`, `porcentaje`, `descuento_promo`) VALUES
(7, 14, 1, 'No destacado', '0', 0, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agg_servicio`
--

CREATE TABLE `agg_servicio` (
  `id_cliente` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `agg_servicio`
--

INSERT INTO `agg_servicio` (`id_cliente`, `id_servicio`) VALUES
(17, 3),
(18, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `asistencia` char(30) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `rol_pagos` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_empleado`, `fecha`, `hora_ingreso`, `hora_salida`, `asistencia`, `estado`, `rol_pagos`) VALUES
(44, 1, '2022-09-05', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(45, 1, '2022-09-06', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(46, 1, '2022-09-07', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(47, 1, '2022-09-08', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(48, 1, '2022-09-09', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(49, 1, '2022-09-12', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(50, 1, '2022-09-13', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(51, 1, '2022-09-14', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(52, 1, '2022-09-15', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(53, 1, '2022-09-16', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(54, 1, '2022-09-19', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(55, 1, '2022-09-20', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(56, 1, '2022-09-21', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(57, 1, '2022-09-22', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(58, 1, '2022-09-23', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(59, 1, '2022-09-26', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(60, 1, '2022-09-27', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(61, 1, '2022-09-28', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(62, 1, '2022-09-29', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(63, 1, '2022-09-30', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(64, 4, '2022-09-05', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(65, 4, '2022-09-06', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(66, 4, '2022-09-07', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(67, 4, '2022-09-08', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(68, 4, '2022-09-09', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(69, 4, '2022-09-12', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(70, 4, '2022-09-13', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(71, 4, '2022-09-14', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(72, 4, '2022-09-15', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(73, 4, '2022-09-16', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(75, 4, '2022-09-19', '08:00:00', '18:00:00', 'Falto', 1, 0),
(76, 4, '2022-09-20', '08:00:00', '18:00:00', 'Falto', 1, 0),
(77, 4, '2022-09-21', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(78, 4, '2022-09-22', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(79, 4, '2022-09-23', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(80, 4, '2022-09-26', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(81, 4, '2022-09-27', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(82, 4, '2022-09-28', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(83, 4, '2022-09-29', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(84, 4, '2022-09-30', '08:00:00', '18:00:00', 'Asistio', 1, 0),
(85, 3, '2022-09-05', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(86, 3, '2022-09-06', '08:00:00', '17:13:00', 'Asistio', 1, 0),
(87, 3, '2022-09-07', '08:00:00', '17:13:00', 'Asistio', 1, 0),
(88, 3, '2022-09-08', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(89, 3, '2022-09-09', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(90, 3, '2022-09-12', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(91, 3, '2022-09-13', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(92, 3, '2022-09-14', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(93, 3, '2022-09-15', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(94, 3, '2022-09-16', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(95, 3, '2022-09-19', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(96, 3, '2022-09-20', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(97, 3, '2022-09-21', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(98, 3, '2022-09-22', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(99, 3, '2022-09-23', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(100, 3, '2022-09-26', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(101, 3, '2022-09-27', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(102, 3, '2022-09-28', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(103, 3, '2022-09-29', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(104, 3, '2022-09-30', '08:00:00', '17:01:00', 'Asistio', 1, 0),
(105, 1, '2022-10-03', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(106, 1, '2022-10-04', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(107, 1, '2022-10-05', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(108, 1, '2022-10-06', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(109, 1, '2022-10-07', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(110, 1, '2022-10-10', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(111, 1, '2022-10-11', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(112, 1, '2022-10-12', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(113, 1, '2022-10-13', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(114, 1, '2022-10-14', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(115, 1, '2022-10-17', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(116, 1, '2022-10-18', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(117, 1, '2022-10-19', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(118, 1, '2022-10-20', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(119, 1, '2022-10-21', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(120, 1, '2022-10-24', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(121, 1, '2022-10-25', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(122, 1, '2022-10-26', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(123, 1, '2022-10-27', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(124, 1, '2022-10-28', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(125, 1, '2022-10-31', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(126, 2, '2022-10-03', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(127, 2, '2022-10-04', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(128, 2, '2022-10-05', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(129, 2, '2022-10-06', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(130, 2, '2022-10-07', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(131, 2, '2022-10-10', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(132, 2, '2022-10-11', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(133, 2, '2022-10-12', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(134, 2, '2022-10-13', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(135, 2, '2022-10-14', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(136, 2, '2022-10-17', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(137, 2, '2022-10-18', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(138, 2, '2022-10-19', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(139, 2, '2022-10-20', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(140, 2, '2022-10-21', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(141, 2, '2022-10-24', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(142, 2, '2022-10-25', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(143, 2, '2022-10-26', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(144, 2, '2022-10-27', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(145, 2, '2022-10-28', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(146, 2, '2022-10-31', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(147, 3, '2022-10-03', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(148, 3, '2022-10-04', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(149, 3, '2022-10-05', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(150, 3, '2022-10-06', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(151, 3, '2022-10-07', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(152, 3, '2022-10-10', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(153, 3, '2022-10-11', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(154, 3, '2022-10-12', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(155, 3, '2022-10-13', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(156, 3, '2022-10-14', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(157, 3, '2022-10-17', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(158, 3, '2022-10-18', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(159, 3, '2022-10-19', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(160, 3, '2022-10-20', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(161, 3, '2022-10-21', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(162, 3, '2022-10-24', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(163, 3, '2022-10-25', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(164, 3, '2022-10-26', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(165, 3, '2022-10-27', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(166, 3, '2022-10-28', '08:00:00', '17:00:00', 'Asistio', 1, 0),
(167, 3, '2022-10-31', '08:00:00', '17:00:00', 'Asistio', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_compra`
--

CREATE TABLE `auditoria_compra` (
  `id_aud_compra` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `operacion` char(50) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `app` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `n_venta` char(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `auditoria_compra`
--

INSERT INTO `auditoria_compra` (`id_aud_compra`, `id_usuario`, `operacion`, `fecha_hora`, `app`, `ip`, `n_venta`, `cantidad`, `total`) VALUES
(1, 1, 'Inserto compra', '2022-05-25 15:05:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', NULL, 1, '137.76'),
(2, 1, 'Inserto compra', '2022-05-25 15:05:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525150502', 1, '359.52'),
(3, 1, 'Anulo compra', '2022-05-25 15:05:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220507110546', 2, '4977.28'),
(4, 1, 'Inserto compra', '2022-07-06 20:07:56', 'Mozilla/5.0 (Linux; Android 10; SNE-LX3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Mobile Safari/537.36', '179.51.142.37', '20220706200705', 1, '1344.00'),
(5, 1, 'Inserto compra', '2022-07-06 21:07:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '177.234.236.130', '20220706210710', 1, '100.80'),
(6, 1, 'Inserto compra', '2022-07-06 21:07:42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '177.234.236.130', '20220706210706', 1, '554.40'),
(7, 1, 'Inserto compra', '2022-07-12 14:07:26', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36', '200.24.133.241', '20220712140720', 1, '1118.88'),
(8, 1, 'Inserto compra', '2022-07-12 15:07:40', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36', '200.24.133.241', '20220712150720', 1, '19.00'),
(9, 1, 'Inserto compra', '2022-09-29 11:09:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '123456', 1, '168.00'),
(10, 1, 'Inserto compra', '2022-10-01 10:10:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '179.51.142.43', '20220521180556', 1, '224.00'),
(11, 1, 'Inserto compra', '2022-10-05 19:10:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20220705200759', 1, '894.88'),
(12, 1, 'Inserto compra', '2022-10-05 19:10:52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20220706210719', 1, '139.44'),
(13, 1, 'Inserto compra', '2022-10-05 19:10:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20220706210719', 1, '3638.88'),
(14, 1, 'Inserto compra', '2022-10-17 19:10:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '43.68'),
(15, 1, 'Anulo compra', '2022-10-17 22:10:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '43.68'),
(16, 1, 'Inserto compra', '2022-10-18 14:10:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '200.55.251.205', '006901000163079', 1, '44.08'),
(17, 1, 'Inserto compra', '2022-10-18 14:10:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '200.55.251.205', '006901000163079', 1, '174.59'),
(18, 1, 'Inserto compra', '2022-10-18 14:10:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '200.55.251.205', '006901000163079', 1, '94.01'),
(19, 1, 'Inserto compra', '2022-10-28 19:10:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '131.15'),
(20, 1, 'Inserto compra', '2022-10-28 19:10:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '39.54'),
(21, 1, 'Inserto compra', '2022-10-28 19:10:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '1.12'),
(22, 1, 'Inserto compra', '2022-11-02 19:11:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '177.234.236.130', '006901000163079', 1, '82.79'),
(23, 1, 'Inserto compra', '2022-11-02 19:11:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '177.234.236.130', ' 00690100016307', 1, '1.12'),
(24, 1, 'Inserto compra', '2022-11-02 19:11:35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '177.234.236.130', ' 00690100016307', 1, '1.12'),
(25, 1, 'Inserto compra', '2022-11-24 15:11:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100942', 1, '11.20'),
(26, 1, 'Inserto compra', '2023-01-05 12:01:07', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '200.24.133.241', '20220712140728', 1, '13.44'),
(27, 1, 'Anulo compra', '2023-01-05 12:01:23', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '200.24.133.241', '20220712140728', 1, '13.44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_servicios`
--

CREATE TABLE `auditoria_servicios` (
  `id_audi_servicio` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `app` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `n_venta` char(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `operacion` char(40) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `auditoria_servicios`
--

INSERT INTO `auditoria_servicios` (`id_audi_servicio`, `id_usuario`, `app`, `ip`, `n_venta`, `total`, `operacion`, `fecha_hora`) VALUES
(1, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525180508', '0.00', 'Inserto servicio', '2022-05-25 18:05:56'),
(2, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525190559', '100.00', 'Inserto servicio', '2022-05-25 19:05:12'),
(3, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525190559', '100.00', 'Anulo servicio', '2022-05-25 19:05:56'),
(4, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190514', '223.00', 'Inserto servicio', '2022-05-26 19:05:56'),
(5, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190501', '223.00', 'Inserto servicio', '2022-05-26 19:05:32'),
(6, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190524', '223.00', 'Inserto servicio', '2022-05-26 19:05:37'),
(7, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100920', '10.00', 'Inserto servicio', '2022-09-29 10:09:41'),
(8, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100942', '15.00', 'Inserto servicio', '2022-09-29 10:09:40'),
(9, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100920', '10.00', 'Anulo servicio', '2022-09-29 11:09:08'),
(10, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221005191016', '10.00', 'Inserto servicio', '2022-10-05 19:10:48'),
(11, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006191013', '70.00', 'Inserto servicio', '2022-10-06 19:10:54'),
(12, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221056', '30.00', 'Inserto servicio', '2022-10-06 22:10:27'),
(13, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221056', '70.00', 'Inserto servicio', '2022-10-06 22:10:32'),
(14, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221036', '70.00', 'Inserto servicio', '2022-10-06 22:10:01'),
(15, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221006', '70.00', 'Inserto servicio', '2022-10-06 22:10:32'),
(16, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221036', '30.00', 'Inserto servicio', '2022-10-06 22:10:58'),
(17, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221001', '30.00', 'Inserto servicio', '2022-10-06 22:10:28'),
(18, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221034', '30.00', 'Inserto servicio', '2022-10-06 22:10:58'),
(19, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221020', '10.00', 'Inserto servicio', '2022-10-06 22:10:36'),
(20, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221053', '10.00', 'Inserto servicio', '2022-10-06 22:10:13'),
(21, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221018', '10.00', 'Inserto servicio', '2022-10-06 22:10:00'),
(22, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221004', '10.00', 'Inserto servicio', '2022-10-06 22:10:21'),
(23, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221036', '10.00', 'Inserto servicio', '2022-10-06 22:10:51'),
(24, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221006221054', '10.00', 'Inserto servicio', '2022-10-06 22:10:13'),
(25, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '200.55.251.205', '20221006221054', '10.00', 'Anulo servicio', '2022-10-11 15:10:59'),
(26, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20221124151120', '30.00', 'Inserto servicio', '2022-11-24 15:11:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_venta`
--

CREATE TABLE `auditoria_venta` (
  `id_audi_venta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `operacion` char(50) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `app` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `n_venta` char(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `auditoria_venta`
--

INSERT INTO `auditoria_venta` (`id_audi_venta`, `id_usuario`, `operacion`, `fecha_hora`, `app`, `ip`, `n_venta`, `cantidad`, `total`) VALUES
(1, 1, 'Inserto venta', '2022-05-25 15:05:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525150520', 1, '224.78'),
(2, 1, 'Anulo venta', '2022-05-25 15:05:35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220519090551', 2, '364.39'),
(3, 1, 'Inserto venta', '2022-05-26 18:05:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526180555', 1, '112.39'),
(4, 1, 'Inserto venta', '2022-06-28 11:06:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '179.51.142.39', '20220628110639', 1, '101.15'),
(5, 1, 'Inserto venta', '2022-07-09 13:07:26', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '157.100.53.80', '20220709130726', 1, '22.40'),
(6, 1, 'Inserto venta', '2022-07-10 14:07:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '179.51.142.45', '20220710140747', 1, '101.15'),
(7, 1, 'Inserto venta', '2022-07-12 20:07:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '190.63.240.222', '20220712200704', 1, '268.80'),
(8, 1, 'Inserto venta', '2022-09-12 17:09:03', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36', '200.24.133.241', '20220912170951', 1, '16.80'),
(9, 1, 'Inserto venta', '2022-09-29 10:09:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100901', 1, '24.19'),
(10, 1, 'Anulo venta', '2022-09-29 10:09:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929100901', 1, '24.19'),
(11, 1, 'Inserto venta', '2022-09-29 11:09:51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20220929110920', 1, '5.60'),
(12, 1, 'Inserto venta', '2022-10-05 18:10:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', '177.234.236.130', '20221005181052', 1, '26.88'),
(13, 1, 'Inserto venta', '2022-11-24 15:11:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '181.39.5.150', '20221124151148', 1, '15.59'),
(14, 1, 'Inserto venta', '2023-01-05 13:01:24', 'Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '200.24.133.241', '20230105130119', 1, '35.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficio`
--

CREATE TABLE `beneficio` (
  `id_beneficio` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `tipo` char(30) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `beneficio`
--

INSERT INTO `beneficio` (`id_beneficio`, `nombre`, `valor`, `tipo`, `estado`) VALUES
(1, 'IIESS', '9.45', 'Egreso', 1),
(2, 'Horas extras', '10.00', 'Ingreso', 1),
(3, 'almuerzo ', '2.50', 'Ingreso', 1),
(4, 'transporte', '1.05', 'Egreso', 1),
(5, 'Prestamo Quirogra IESS', '8.00', 'Egreso', 1),
(6, 'No tiene beneficios', '0.00', 'Egreso', 0),
(7, 'Decimo Terceros', '10.00', 'Ingreso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `tipo_cargo` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `tipo_cargo`, `estado`) VALUES
(1, 'Guardia', 1),
(2, 'LAVADO DE CARRO', 1),
(3, 'LUBRICADOR', 1),
(4, 'Administradora', 1),
(5, 'bodeguero', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `estado` enum('En espera','Atentido','Inactivo') DEFAULT NULL,
  `color` char(20) DEFAULT NULL,
  `textColor` char(20) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `cliente_id`, `title`, `descripcion`, `start`, `estado`, `color`, `textColor`, `id_reserva`) VALUES
(17, 1, 'aaaaaa', 'vvvvvvvvvv', '2022-05-27 12:15:00', 'Atentido', '#FFFFFF', '#ff0000', 34),
(18, 1, 'servico para cambio de llantas', 'servico para cambio de llantas', '2022-06-14 15:26:00', 'Atentido', '#FFFFFF', '#ff0000', 35),
(19, 1, 'CAMBIO DE LLANTAS', 'CAMBIO DE LLANTAS', '2022-08-28 13:56:00', 'Atentido', '#FFFFFF', '#ff0000', 37),
(20, 7, 'por motivos de viaje', 'me lo dejan bien limpio', '2022-08-29 10:00:00', 'Atentido', '#FFFFFF', '#ff0000', 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `cedula` char(15) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sexo` char(15) DEFAULT NULL,
  `telefono` char(20) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres`, `apellidos`, `cedula`, `correo`, `direccion`, `fecha`, `sexo`, `telefono`, `estado`) VALUES
(1, 'Carlota Belen', 'Berrezueta Peñafiel', '0706651031', 'elgamer-26@hotmail.com', 'MILAGRO', '1996-02-24', 'Femenino', '0934567890', 1),
(2, 'Carolina Elizabeth', 'Bermeo Sanchez', '0703091819', 'carolinabermeo88@gmail.com', 'Av. Colon Tinoco', '1991-01-03', 'Femenino', '0910001971', 1),
(3, 'Jorge Moises', 'ramirez zavala', '0940321855', 'asennifferbarreto88@gmail.com', 'Milagro, av. amazonas', '2022-02-09', 'Masculino', '0987654321', 1),
(4, 'JOSE CARLOS', 'RAMOS LOPES', '0940321851', 'jennifferbarreto88@gmail.com', 'Milagro, av. amazonas', '1994-02-03', 'Masculino', '0987654321', 1),
(5, 'JUAN CARLOS', 'RAMOS LOPES', '0940321850', 'elgamer-260@hotmail.com', 'Milagro, av. amazonas', '2022-02-08', 'Masculino', '0940321854', 1),
(6, 'Jorge Moises', 'jorge', '0940321852', '123jrge@gmail.com', 'malgrosdsd', '2022-04-25', 'Masculino', '0987654321', 0),
(7, 'Jordy', 'Moreno Diaz', '0706426798', 'forcealien-93@hotmail.com', 'zona centrica', '1994-12-05', 'Masculino', '0988692292', 1),
(8, 'Mario Alberto', 'Ibarra Martinez', '0921324935', 'mibarra@uagraria.edu.ec', 'Milagro', '1986-04-09', 'Masculino', '0999999999', 0),
(9, 'Janina Alexandra', 'Bustamante Pardo', '0704635275', 'janina@hotmail.com', 'Av.colon', '1990-03-02', 'Femenino', '0988653345', 1),
(10, 'Andrea Carolina', 'Carrion Zambrano', '0705903011', 'andrea123@gmail.com', 'Av. Santa Elena', '1991-06-05', 'Femenino', '0956345678', 1),
(11, 'Maria Gabriela', 'Chulde Sisalima', '0704723352', 'mariagaby146@gmail.com', 'Av.Rocafuerte y guayas', '1990-06-07', 'Femenino', '0922334587', 1),
(12, 'Jefferson Josue', 'Cruz Alejandro', '0706010782', 'josue342@hotmail.com', 'Napoleon Mera y Pichincha', '1985-01-30', 'Masculino', '0982879788', 1),
(13, 'Marisela Jennifer', 'Cuenca Piedra', '0705429710', 'mariselacuenca23@hotmail.com', 'Av.Rocafuerte y Tinoco', '1989-02-01', 'Femenino', '0977453479', 1),
(14, 'Isabel Arleth ', 'Eras Cordova', '0706737053', 'isabel23@hotmail.com', 'Av. Las palmeras', '1991-06-05', 'Femenino', '0945667712', 1),
(15, 'Ana Elizabeth', 'Flores Ruiz', '0704891175', 'anaflores@yahoo.com', 'Av. Palmeras y colon', '1989-02-01', 'Femenino', '0967452234', 1),
(16, 'Diana Katherine', 'Galarza Ramon', '0706037116', 'dianaramon@hotmail.com', 'Av. santa elena y guayas', '1989-11-16', 'Femenino', '0978456789', 1),
(17, 'Nuvia', 'Beltrán', '0925818577', 'nuviabeltranrobayo@gmail.com', 'Milagro', '1980-02-02', 'Femenino', '0980712913', 1),
(18, 'jorge', 'lopez', '0921906046', 'jlopez@uagria.edu.ec', 'vvvcxv', '2022-11-24', 'Masculino', '0994697956', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `detalle_ingreso_id` int(11) NOT NULL,
  `ingreso_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `detalle_estado` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`detalle_ingreso_id`, `ingreso_id`, `producto_id`, `cantidad`, `unidad`, `precio`, `descuento`, `subtotal`, `detalle_estado`) VALUES
(1, 5, 1, 1, 100, '123.00', '0.00', '123.00', 'ANULADO'),
(2, 5, 2, 1, 100, '4321.00', '0.00', '4321.00', 'ANULADO'),
(3, 6, 1, 10, 100, '123.00', '0.00', '1230.00', 'ANULADO'),
(4, 6, 2, 55, 100, '100.00', '0.00', '5500.00', 'ANULADO'),
(5, 7, 2, 100, 100, '123.00', '0.00', '12300.00', 'INGRESADO'),
(6, 8, 1, 100, 100, '100.00', '0.00', '10000.00', 'INGRESADO'),
(7, 8, 2, 99, 100, '99.00', '0.00', '9801.00', 'INGRESADO'),
(8, 9, 1, 100, 100, '123.00', '0.00', '12300.00', 'INGRESADO'),
(9, 9, 2, 111, 100, '21.00', '0.00', '2331.00', 'INGRESADO'),
(10, 10, 2, 100, 100, '123.00', '0.00', '12300.00', 'INGRESADO'),
(11, 11, 1, 123, 100, '321.00', '0.00', '39483.00', 'INGRESADO'),
(12, 12, 2, 1, 100, '123.00', '0.00', '123.00', 'INGRESADO'),
(13, 13, 2, 1, 100, '321.00', '0.00', '321.00', 'INGRESADO'),
(14, 14, 3, 100, 100, '12.00', '0.00', '1200.00', 'INGRESADO'),
(15, 15, 4, 20, 100, '5.00', '10.00', '90.00', 'INGRESADO'),
(16, 16, 5, 10, 100, '50.00', '5.00', '495.00', 'INGRESADO'),
(17, 17, 6, 10, 100, '100.00', '1.00', '999.00', 'INGRESADO'),
(18, 18, 6, 1, 100, '16.96', '0.00', '16.96', 'INGRESADO'),
(19, 19, 4, 3, 100, '50.00', '0.00', '150.00', 'INGRESADO'),
(20, 20, 7, 10, 200, '20.00', '0.00', '200.00', 'INGRESADO'),
(21, 21, 2, 1, 3, '800.00', '1.00', '799.00', 'INGRESADO'),
(22, 22, 8, 5, 25, '25.00', '0.50', '124.50', 'INGRESADO'),
(23, 23, 9, 5, 10, '650.00', '1.00', '3249.00', 'INGRESADO'),
(24, 24, 10, 1, 1, '39.00', '0.00', '39.00', 'ANULADO'),
(25, 25, 10, 1, 12, '39.36', '0.00', '39.36', 'INGRESADO'),
(26, 26, 11, 2, 6, '77.94', '0.00', '155.88', 'INGRESADO'),
(27, 27, 12, 1, 6, '83.94', '0.00', '83.94', 'INGRESADO'),
(28, 28, 13, 2, 6, '58.80', '0.50', '117.10', 'INGRESADO'),
(29, 29, 14, 1, 12, '35.80', '0.50', '35.30', 'INGRESADO'),
(30, 30, 15, 1, 7, '1.00', '0.00', '1.00', 'INGRESADO'),
(31, 31, 16, 2, 12, '37.23', '0.54', '73.92', 'INGRESADO'),
(32, 32, 17, 1, 8, '1.00', '0.00', '1.00', 'INGRESADO'),
(33, 33, 18, 1, 8, '1.00', '0.00', '1.00', 'INGRESADO'),
(34, 34, 2, 1, 2, '10.00', '0.00', '10.00', 'INGRESADO'),
(35, 35, 2, 1, 12, '12.00', '0.00', '12.00', 'ANULADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_rol_pago_egreso`
--

CREATE TABLE `detalle_rol_pago_egreso` (
  `id_detalle_egreso` int(11) NOT NULL,
  `id_rol_pagos` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_rol_pago_egreso`
--

INSERT INTO `detalle_rol_pago_egreso` (`id_detalle_egreso`, `id_rol_pagos`, `nombre`, `cantidad`, `estado`) VALUES
(1, 4, 'Valor de las multas', '50.00', 1),
(2, 5, 'Valor de las multas', '50.00', 1),
(3, 6, 'Valor de las multas', '50.00', 1),
(4, 7, 'No tiene beneficios', '0.00', 1),
(5, 8, 'Falta por asistencia', '20.00', 1),
(6, 8, 'Valor de las multas', '123.90', 1),
(7, 9, 'No tiene beneficios', '0.00', 1),
(8, 10, 'IIESS', '1.13', 1),
(9, 11, 'Falta por asistencia', '24.00', 1),
(10, 12, 'No tiene beneficios', '0.00', 1),
(11, 13, 'Falta por asistencia', '40.04', 1),
(12, 13, 'Valor de las multas', '10.00', 1),
(13, 13, 'IIESS', '0.00', 1),
(14, 14, 'Valor de las multas', '5.00', 1),
(15, 15, 'No tiene egresos', '0.00', 1),
(16, 16, 'Prestamo Quirogra IESS', '17.60', 1),
(17, 16, 'IIESS', '20.79', 1),
(18, 17, 'Prestamo Quirogra IESS', '28.83', 1),
(19, 18, 'Falta por asistencia', '80.08', 1),
(20, 18, 'IIESS', '68.11', 1),
(21, 18, 'Prestamo Quirogra IESS', '57.66', 1),
(22, 19, 'No tiene egresos', '0.00', 1),
(23, 20, 'Prestamo Quirogra IESS', '40.00', 1),
(24, 21, 'No tiene egresos', '0.00', 1),
(25, 22, 'No tiene egresos', '0.00', 1),
(26, 23, 'No tiene egresos', '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_rol_pago_ingreso`
--

CREATE TABLE `detalle_rol_pago_ingreso` (
  `id_detalle_ingreso` int(11) NOT NULL,
  `id_rol_pagos` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_rol_pago_ingreso`
--

INSERT INTO `detalle_rol_pago_ingreso` (`id_detalle_ingreso`, `id_rol_pagos`, `nombre`, `cantidad`, `estado`) VALUES
(1, 4, 'Sueldo', '30.00', 1),
(2, 5, 'Sueldo', '30.00', 1),
(3, 6, 'Sueldo', '30.00', 1),
(4, 7, 'Sueldo', '30.00', 1),
(5, 8, 'Sueldo', '18.00', 1),
(6, 8, 'Horas extras', '1.80', 1),
(7, 8, 'comisiones', '1.80', 1),
(8, 9, 'Sueldo', '20.00', 1),
(9, 10, 'Sueldo', '12.00', 1),
(10, 10, 'comisiones', '1.20', 1),
(11, 10, 'Horas extras', '1.20', 1),
(12, 11, 'Sueldo', '0.00', 1),
(13, 11, 'Decimo Terceros', '0.00', 1),
(14, 12, 'Sueldo', '24.00', 1),
(15, 13, 'Sueldo', '0.00', 1),
(16, 14, 'Sueldo', '123.76', 1),
(17, 15, 'Sueldo', '167.44', 1),
(18, 16, 'Sueldo', '220.00', 1),
(19, 16, 'almuerzo ', '5.50', 1),
(20, 17, 'Sueldo', '360.36', 1),
(21, 17, 'almuerzo ', '9.01', 1),
(22, 18, 'Sueldo', '720.72', 1),
(23, 18, 'almuerzo ', '18.02', 1),
(24, 19, 'Sueldo', '440.00', 1),
(25, 19, 'almuerzo ', '11.00', 1),
(26, 20, 'Sueldo', '500.00', 1),
(27, 20, 'almuerzo ', '12.50', 1),
(28, 21, 'Sueldo', '420.00', 1),
(29, 22, 'Sueldo', '420.00', 1),
(30, 23, 'Sueldo', '525.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicios_cliente`
--

CREATE TABLE `detalle_servicios_cliente` (
  `id_detalle_sericios` int(11) NOT NULL,
  `id_servicio_cliente` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_servicios_cliente`
--

INSERT INTO `detalle_servicios_cliente` (`id_detalle_sericios`, `id_servicio_cliente`, `id_servicio`, `cantidad`, `precio`, `descuento`, `subtotal`) VALUES
(6, 9, 2, 1, '123.00', '0.00', '123.00'),
(7, 9, 1, 1, '100.00', '0.00', '100.00'),
(8, 10, 1, 1, '100.00', '0.00', '100.00'),
(9, 10, 2, 1, '123.00', '0.00', '123.00'),
(10, 11, 1, 1, '100.00', '0.00', '100.00'),
(11, 12, 2, 1, '123.00', '0.00', '123.00'),
(12, 12, 1, 1, '100.00', '0.00', '100.00'),
(13, 13, 1, 1, '100.00', '0.00', '100.00'),
(14, 13, 2, 1, '123.00', '0.00', '123.00'),
(15, 17, 1, 1, '100.00', '0.00', '100.00'),
(18, 26, 1, 1, '100.00', '0.00', '100.00'),
(19, 27, 2, 1, '123.00', '0.00', '123.00'),
(20, 27, 1, 1, '100.00', '0.00', '100.00'),
(21, 28, 1, 1, '100.00', '0.00', '100.00'),
(22, 28, 2, 1, '123.00', '0.00', '123.00'),
(23, 29, 1, 1, '100.00', '0.00', '100.00'),
(24, 29, 2, 1, '123.00', '0.00', '123.00'),
(25, 30, 1, 1, '100.00', '0.00', '100.00'),
(26, 30, 2, 1, '123.00', '0.00', '123.00'),
(27, 31, 1, 1, '100.00', '0.00', '100.00'),
(28, 32, 1, 1, '100.00', '0.00', '100.00'),
(29, 32, 2, 1, '123.00', '0.00', '123.00'),
(30, 33, 1, 1, '100.00', '0.00', '100.00'),
(31, 33, 2, 1, '123.00', '0.00', '123.00'),
(32, 34, 1, 1, '100.00', '0.00', '100.00'),
(33, 34, 2, 1, '123.00', '0.00', '123.00'),
(34, 35, 1, 1, '100.00', '0.00', '100.00'),
(35, 35, 2, 1, '123.00', '0.00', '123.00'),
(36, 36, 1, 1, '100.00', '0.00', '100.00'),
(37, 37, 6, 1, '70.00', '0.00', '70.00'),
(38, 37, 2, 1, '123.00', '0.00', '123.00'),
(39, 37, 5, 1, '50.00', '0.00', '50.00'),
(40, 38, 1, 1, '10.00', '0.00', '10.00'),
(41, 39, 1, 1, '10.00', '0.00', '10.00'),
(42, 40, 3, 1, '15.00', '0.00', '15.00'),
(43, 41, 1, 1, '10.00', '0.00', '10.00'),
(44, 42, 6, 1, '70.00', '0.00', '70.00'),
(45, 43, 4, 1, '30.00', '0.00', '30.00'),
(46, 44, 6, 1, '70.00', '0.00', '70.00'),
(47, 45, 6, 1, '70.00', '0.00', '70.00'),
(48, 46, 6, 1, '70.00', '0.00', '70.00'),
(49, 47, 4, 1, '30.00', '0.00', '30.00'),
(50, 48, 4, 1, '30.00', '0.00', '30.00'),
(51, 49, 4, 1, '30.00', '0.00', '30.00'),
(52, 50, 1, 1, '10.00', '0.00', '10.00'),
(53, 51, 1, 1, '10.00', '0.00', '10.00'),
(54, 52, 1, 1, '10.00', '0.00', '10.00'),
(55, 53, 1, 1, '10.00', '0.00', '10.00'),
(56, 54, 1, 1, '10.00', '0.00', '10.00'),
(57, 55, 1, 1, '10.00', '0.00', '10.00'),
(58, 56, 5, 1, '50.00', '0.00', '50.00'),
(59, 57, 1, 1, '15.00', '0.00', '15.00'),
(60, 57, 3, 1, '15.00', '0.00', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio_producto`
--

CREATE TABLE `detalle_servicio_producto` (
  `id_detalle_poducto_servcios` int(11) NOT NULL,
  `id_servicio_cliente` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento_oferta` decimal(10,2) DEFAULT NULL,
  `tipo_promo` char(50) DEFAULT NULL,
  `descuento_moneda` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_servicio_producto`
--

INSERT INTO `detalle_servicio_producto` (`id_detalle_poducto_servcios`, `id_servicio_cliente`, `producto_id`, `cantidad`, `precio`, `descuento_oferta`, `tipo_promo`, `descuento_moneda`, `subtotal`) VALUES
(5, 10, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35'),
(6, 10, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00'),
(7, 11, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00'),
(8, 12, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35'),
(9, 13, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00'),
(11, 26, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00'),
(12, 26, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35'),
(13, 27, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31'),
(14, 28, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31'),
(15, 33, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31'),
(16, 33, 2, 1, '300.00', '150.00', 'Descuento', '0.00', '150.00'),
(17, 34, 1, 2, '100.35', '10.04', 'Descuento', '0.00', '180.63'),
(18, 34, 2, 3, '300.00', '150.00', 'Descuento', '0.00', '450.00'),
(19, 35, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31'),
(20, 36, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35'),
(21, 57, 13, 1, '5.57', '2.79', 'Descuento', '0.00', '2.78');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento_oferta` decimal(10,2) DEFAULT NULL,
  `tipo_promo` char(40) DEFAULT NULL,
  `descuento_moneda` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `estado_detalle` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_venta`, `producto_id`, `cantidad`, `precio`, `descuento_oferta`, `tipo_promo`, `descuento_moneda`, `subtotal`, `estado_detalle`) VALUES
(1, 2, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 0),
(2, 2, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 0),
(3, 3, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(4, 3, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(5, 4, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(6, 4, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(33, 11, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(34, 11, 2, 1, '300.00', '0.00', 'No tiene', '0.00', '300.00', 1),
(35, 12, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(36, 12, 2, 1, '300.00', '0.00', 'No tiene', '0.00', '300.00', 1),
(37, 13, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(38, 13, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(39, 14, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(40, 15, 1, 2, '100.35', '0.00', 'No tiene', '0.00', '200.70', 1),
(41, 16, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(42, 17, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(43, 18, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(44, 19, 1, 2, '100.35', '0.00', 'No tiene', '0.00', '200.70', 1),
(45, 19, 2, 3, '300.00', '75.00', 'Descuento', '0.00', '675.00', 1),
(46, 20, 1, 1, '100.35', '0.00', 'No tiene', '0.00', '100.35', 1),
(47, 20, 2, 1, '300.00', '75.00', 'Descuento', '0.00', '225.00', 1),
(48, 21, 1, 2, '100.35', '0.00', 'No tiene', '0.00', '200.70', 1),
(49, 21, 2, 2, '300.00', '0.00', 'No tiene', '0.00', '600.00', 1),
(50, 22, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31', 1),
(51, 23, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31', 1),
(52, 24, 2, 1, '300.00', '0.00', 'No tiene', '0.00', '300.00', 1),
(53, 25, 3, 2, '10.00', '0.00', 'No tiene', '0.00', '20.00', 1),
(54, 26, 2, 1, '300.00', '0.00', 'No tiene', '0.00', '300.00', 1),
(55, 26, 3, 1, '10.00', '0.00', 'No tiene', '0.00', '10.00', 1),
(56, 26, 4, 1, '5.00', '0.00', 'No tiene', '0.00', '5.00', 1),
(57, 27, 3, 2, '10.00', '0.00', 'No tiene', '0.00', '20.00', 1),
(58, 28, 1, 1, '100.35', '10.04', 'Descuento', '0.00', '90.31', 1),
(59, 29, 2, 1, '300.00', '60.00', 'Descuento', '0.00', '240.00', 1),
(60, 30, 3, 2, '10.00', '5.00', 'Descuento', '0.00', '15.00', 1),
(61, 31, 6, 1, '24.00', '0.00', 'No tiene', '2.40', '21.60', 1),
(62, 32, 4, 1, '5.00', '0.00', 'No tiene', '0.00', '5.00', 1),
(63, 33, 6, 1, '24.00', '0.00', 'No tiene', '0.00', '24.00', 1),
(64, 34, 13, 3, '5.57', '2.79', 'Descuento', '0.00', '13.92', 1),
(65, 35, 7, 5, '123.00', '61.50', 'Descuento', '0.00', '307.50', 1),
(66, 36, 2, 2, '15.85', '0.00', 'No tiene', '0.00', '31.70', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `estado_civil` char(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `fecha_n` date DEFAULT NULL,
  `sexo` char(10) DEFAULT NULL,
  `cedula` char(13) DEFAULT NULL,
  `nivel_es` varchar(255) DEFAULT NULL,
  `totulo` varchar(255) DEFAULT NULL,
  `experiencia` varchar(255) DEFAULT NULL,
  `fech_i` date DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `valor_hora` decimal(10,2) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombres`, `apellidos`, `estado_civil`, `direccion`, `telefono`, `correo`, `fecha_n`, `sexo`, `cedula`, `nivel_es`, `totulo`, `experiencia`, `fech_i`, `id_cargo`, `valor_hora`, `estado`) VALUES
(1, 'Jordy ', 'Moreno Diaz', 'Soltero', 'Napoleon Mera', '0988692292', 'forcealien-93@hotmail.com', '1994-12-05', 'Masculino', '0706426798', 'TERCER_NIVEL', 'Ing. en Computacion e Informatica', 'De todo un poco', '2022-05-02', 3, '2.00', 1),
(2, 'Jorge moises', 'Ramirez zavala', 'Soltera', 'Mialgro, amazonas', '0985906677', 'elgamer1-26@hotmail.com', '2006-02-01', 'Masculino', '0940321855', 'TERCER_NIVEL', 'Ing. en sistemas', 'Porgramador', '2022-05-02', 2, '2.00', 1),
(3, 'JUAN GABRIEL', 'HECTOR DIAS', 'Viudo', 'NARANJAL ', '0987654321', 'JUAN@HOTMAIL.COM', '2002-01-01', 'Masculino', '0987654321', 'BACHILLERATO', 'Sociales', 'Guardia', '2022-05-02', 1, '2.50', 1),
(4, 'Johanna', 'Ramos Holguin', 'Soltero', 'Av. Tumbez Callejon sin nombre', '0988959286', 'kevinmoreno32@hotmail.com', '1997-01-29', 'Masculino', '0958987455', 'BACHILLERATO', 'Quimico', 'Lavado de Vehiculos', '2020-06-15', 2, '3.64', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empleda` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `ruc` char(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `lema` text DEFAULT NULL,
  `atividad` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empleda`, `nombre`, `direccion`, `telefono`, `ruc`, `email`, `fecha`, `lema`, `atividad`, `foto`) VALUES
(1, 'EL GATO EDITADO', 'MILAGRO EDIT', '0985906677', '0940321854', 'email@HOTMIL.COM', '1999-12-27', 'Lema de la empresa    ', 'Actividades comerciles ', 'img/empresa/IMG1372022182219.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `ingreso_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `ingreso_porcentaje` int(11) DEFAULT NULL,
  `ingreso_ticomprobante` char(50) DEFAULT NULL,
  `ingreso_seriecomprobante` char(50) DEFAULT NULL,
  `ingreso_numcomrpobante` char(50) DEFAULT NULL,
  `ingreso_total` decimal(10,2) DEFAULT NULL,
  `ingreso_impusto` decimal(10,2) DEFAULT NULL,
  `ingreso_impuestototal` decimal(10,2) DEFAULT NULL,
  `ingreso_cantidad` int(11) DEFAULT NULL,
  `ingreso_estado` char(10) DEFAULT NULL,
  `ingreso_fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`ingreso_id`, `usuario_id`, `proveedor_id`, `ingreso_porcentaje`, `ingreso_ticomprobante`, `ingreso_seriecomprobante`, `ingreso_numcomrpobante`, `ingreso_total`, `ingreso_impusto`, `ingreso_impuestototal`, `ingreso_cantidad`, `ingreso_estado`, `ingreso_fecha`) VALUES
(5, 1, 1, 12, 'FACTURA', '110546-07052022', '20220507110546', '4444.00', '533.28', '4977.28', 2, 'ANULADO', '2022-05-07'),
(6, 1, 1, 12, 'FACTURA', '110500-07052022', '20220507110500', '6730.00', '807.60', '7537.60', 2, 'ANULADO', '2022-05-07'),
(7, 1, 2, 12, 'FACTURA', '090512-12052022', '20220512090512', '12300.00', '1476.00', '13776.00', 1, 'INGRESADO', '2022-05-12'),
(8, 1, 2, 12, 'FACTURA', '210554-12052022', '20220512210554', '19801.00', '2376.12', '22177.12', 2, 'INGRESADO', '2022-05-12'),
(9, 1, 2, 0, 'BOLETA', '190530-22052022', '20220522190530', '14631.00', '0.00', '14631.00', 2, 'INGRESADO', '2022-05-22'),
(10, 1, 1, 12, 'FACTURA', '190532-22052022', '20220522190532', '12300.00', '1476.00', '13776.00', 1, 'INGRESADO', '2022-05-22'),
(11, 1, 2, 12, 'FACTURA', '190545-22052022', '20220522190545', '39483.00', '4737.96', '44220.96', 1, 'INGRESADO', '2022-05-22'),
(12, 1, 1, 12, 'FACTURA', '150549-25052022', '20220525150549', '123.00', '14.76', '137.76', 1, 'INGRESADO', '2022-05-25'),
(13, 1, 2, 12, 'FACTURA', '150502-25052022', '20220525150502', '321.00', '38.52', '359.52', 1, 'INGRESADO', '2022-05-25'),
(14, 1, 1, 12, 'FACTURA', '200705-06072022', '20220706200705', '1200.00', '144.00', '1344.00', 1, 'INGRESADO', '2022-07-07'),
(15, 1, 2, 12, 'FACTURA', '210710-06072022', '20220706210710', '90.00', '10.80', '100.80', 1, 'INGRESADO', '2022-07-07'),
(16, 1, 3, 12, 'FACTURA', '210706-06072022', '20220706210706', '495.00', '59.40', '554.40', 1, 'INGRESADO', '2022-07-07'),
(17, 1, 4, 12, 'FACTURA', '140720-12072022', '20220712140720', '999.00', '119.88', '1118.88', 1, 'INGRESADO', '2022-07-12'),
(18, 1, 1, 12, 'FACTURA', '150720-12072022', '20220712150720', '16.96', '2.04', '19.00', 1, 'INGRESADO', '2022-07-12'),
(19, 1, 5, 12, 'FACTURA', '110908-29092022', '123456', '150.00', '18.00', '168.00', 1, 'INGRESADO', '2022-09-29'),
(20, 1, 5, 12, 'FACTURA', '101043-01102022', '20220521180556', '200.00', '24.00', '224.00', 1, 'INGRESADO', '2022-10-01'),
(21, 1, 2, 12, 'FACTURA', '191018-05102022', '20220705200759', '799.00', '95.88', '894.88', 1, 'INGRESADO', '2022-10-06'),
(22, 1, 3, 12, 'FACTURA', '191051-05102022', '20220706210719', '124.50', '14.94', '139.44', 1, 'INGRESADO', '2022-10-06'),
(23, 1, 4, 12, 'FACTURA', '191019-05102022', '20220706210719', '3249.00', '389.88', '3638.88', 1, 'INGRESADO', '2022-10-06'),
(24, 1, 1, 12, 'FACTURA', '191000-17102022', '006901000163079', '39.00', '4.68', '43.68', 1, 'ANULADO', '2022-10-18'),
(25, 1, 1, 12, 'FACTURA', '131021-18102022', '006901000163079', '39.36', '4.72', '44.08', 1, 'INGRESADO', '2022-10-18'),
(26, 1, 1, 12, 'FACTURA', '141008-18102022', '006901000163079', '155.88', '18.71', '174.59', 1, 'INGRESADO', '2022-10-18'),
(27, 1, 1, 12, 'FACTURA', '141014-18102022', '006901000163079', '83.94', '10.07', '94.01', 1, 'INGRESADO', '2022-10-18'),
(28, 1, 1, 12, 'FACTURA', '191041-28102022', '006901000163079', '117.10', '14.05', '131.15', 1, 'INGRESADO', '2022-10-29'),
(29, 1, 1, 12, 'FACTURA', '191034-28102022', '006901000163079', '35.30', '4.24', '39.54', 1, 'INGRESADO', '2022-10-29'),
(30, 1, 1, 12, 'FACTURA', '191046-28102022', '006901000163079', '1.00', '0.12', '1.12', 1, 'INGRESADO', '2022-10-29'),
(31, 1, 1, 12, 'FACTURA', '191142-02112022', '006901000163079', '73.92', '8.87', '82.79', 1, 'INGRESADO', '2022-11-03'),
(32, 1, 1, 12, 'FACTURA', '191153-02112022', ' 00690100016307', '1.00', '0.12', '1.12', 1, 'INGRESADO', '2022-11-03'),
(33, 1, 1, 12, 'FACTURA', '191119-02112022', ' 00690100016307', '1.00', '0.12', '1.12', 1, 'INGRESADO', '2022-11-03'),
(34, 1, 1, 12, 'FACTURA', '151145-24112022', '20220929100942', '10.00', '1.20', '11.20', 1, 'INGRESADO', '2022-11-24'),
(35, 1, 6, 12, 'FACTURA', '120142-05012023', '20220712140728', '12.00', '1.44', '13.44', 1, 'ANULADO', '2023-01-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`, `estado`) VALUES
(1, 'Amalie', 1),
(2, 'Motorex', 1),
(3, 'Chevron', 1),
(4, 'Golden Bear', 1),
(5, 'MICHELIN', 1),
(6, 'HAVOLINE', 1),
(7, 'TOTAL', 1),
(8, 'ADHEPLAST', 1),
(9, 'TITAN', 1),
(10, 'TURTLE WAX', 1),
(11, 'WAGNER', 1),
(12, 'ATE', 1),
(13, 'SIMONZ', 1),
(14, 'WD-40', 1),
(15, 'URSA', 1),
(16, 'ENI', 1),
(17, 'FRE', 1),
(18, 'Liqui Moly', 1),
(19, 'Ipone', 1),
(20, 'Walker', 1),
(21, 'HP PLUS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_vehiculo`
--

CREATE TABLE `marca_vehiculo` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `marca_vehiculo`
--

INSERT INTO `marca_vehiculo` (`id_marca`, `marca`, `estado`) VALUES
(1, 'Hyundai', 1),
(2, 'Honda', 1),
(3, 'Ford', 1),
(4, 'KIA', 1),
(5, 'chevrolet', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `id_multa` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` char(15) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `fecha_paga_multa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `multas`
--

INSERT INTO `multas` (`id_multa`, `id_empleado`, `fecha`, `tipo`, `monto`, `observacion`, `estado`, `fecha_paga_multa`) VALUES
(2, 2, '2022-05-03', 'Media', '123.90', 'Observacion', 0, '2022-05-03 18:54:34'),
(4, 3, '2022-05-04', 'Alta', '50.00', 'se durmio en el trabajo', 0, '2022-05-03 18:45:13'),
(5, 1, '2022-07-04', 'Leve', '50.00', 'Se daño una pieza', 0, '2022-07-11 13:36:03'),
(6, 4, '2022-09-29', 'Leve', '10.00', 'daño de manguera', 0, '2022-09-12 15:53:08'),
(7, 4, '2022-09-12', 'Leve', '5.00', 'Bien', 0, '2022-09-12 16:35:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id_ofertas` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `fecha_inic` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `nombre_oferta` varchar(255) DEFAULT NULL,
  `procentaje` int(11) DEFAULT NULL,
  `tipo_descue` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_ofertas`, `producto_id`, `fecha_inic`, `fecha_fin`, `nombre_oferta`, `procentaje`, `tipo_descue`) VALUES
(22, 13, '2023-01-05', '2023-02-01', 'BOMBA', 10, 'Descuento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` char(20) DEFAULT NULL,
  `motivo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `id_empleado`, `fecha`, `tipo`, `motivo`) VALUES
(1, 3, '2022-05-05', 'Estudios', 'Observacion'),
(2, 4, '2022-06-27', 'Enfermedad', 'Gripe y Tos'),
(3, 3, '2022-09-12', 'Enfermedad', 'Fuerte gripe'),
(4, 3, '2022-09-26', 'Otros', 'Tuve que hacer unos tramites');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permido_id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `configuracion` char(10) DEFAULT NULL,
  `emples` char(10) DEFAULT NULL,
  `asistens` char(10) DEFAULT NULL,
  `mults` char(10) DEFAULT NULL,
  `bens` char(10) DEFAULT NULL,
  `rols` char(10) DEFAULT NULL,
  `creat_pords` char(10) DEFAULT NULL,
  `provees` char(10) DEFAULT NULL,
  `comps` char(10) DEFAULT NULL,
  `list_comps` char(10) DEFAULT NULL,
  `ofertas` char(10) DEFAULT NULL,
  `servs` char(10) DEFAULT NULL,
  `creat_cliens` char(10) DEFAULT NULL,
  `crea_vehs` char(10) DEFAULT NULL,
  `vents` char(10) DEFAULT NULL,
  `cret_sers` char(10) DEFAULT NULL,
  `list_reser` char(10) DEFAULT NULL,
  `reports` char(10) DEFAULT NULL,
  `segurs` char(10) DEFAULT NULL,
  `prods` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`permido_id`, `id_usuario`, `configuracion`, `emples`, `asistens`, `mults`, `bens`, `rols`, `creat_pords`, `provees`, `comps`, `list_comps`, `ofertas`, `servs`, `creat_cliens`, `crea_vehs`, `vents`, `cret_sers`, `list_reser`, `reports`, `segurs`, `prods`) VALUES
(1, 7, 'true', 'true', 'false', 'true', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'),
(2, 1, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(3, 8, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'),
(4, 9, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'),
(5, 12, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'),
(6, 10, 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'true', 'false'),
(7, 11, 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'),
(8, 13, 'true', 'true', 'true', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'true', 'false', 'false', 'true'),
(9, 14, 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `poducto_codigo` char(50) DEFAULT NULL,
  `producto_nombre` varchar(255) DEFAULT NULL,
  `tipo_producto_id` int(11) DEFAULT NULL,
  `marca_producto_id` int(11) DEFAULT NULL,
  `producto_detalle` text DEFAULT NULL,
  `producto_precio_venta` decimal(10,2) DEFAULT NULL,
  `producto_foto` varchar(255) DEFAULT NULL,
  `estado` char(20) DEFAULT NULL,
  `producto_destacar` int(11) DEFAULT 0,
  `_eliminado` int(11) DEFAULT 1,
  `stock` int(11) DEFAULT NULL,
  `especificacion` varchar(255) DEFAULT NULL,
  `equivalente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `poducto_codigo`, `producto_nombre`, `tipo_producto_id`, `marca_producto_id`, `producto_detalle`, `producto_precio_venta`, `producto_foto`, `estado`, `producto_destacar`, `_eliminado`, `stock`, `especificacion`, `equivalente`) VALUES
(1, '768009', 'Aceite Havoline 10w30', 4, 6, 'llantas de carroAceite Havoline 10w30 con deposit shield para gasolina. Para 5000 km. Contenido: 1/4 de Galón', '9.10', 'img/producto/IMG5102022192835.png', 'activo', 0, 1, 284, 'Galon', '1/4'),
(2, '8267255', 'LIQUIDO REFRIGERANTE', 2, 17, 'LIQUIDO REFRIGERANTE ANTICORROSIVO 1 GALON\n\n\nEvita las incrustaciones que dificultan el flujo del refrigerante y pueden llegar a obstruir el sistema de enfriamiento.\nMejora la transferencia de calor, haciendo que el motor funcione con menor esfuerzo.\nEvita la oxidación y corrosión, alargando la vida útil del motor.\nTransfiere uniformemente el calor del motor al radiador.\nProtege las mangueras, empaques y metales de todo el sistema de enfriamiento.\nActúa como mantenimiento preventivo a largo plazo contra la obstrucción de los conductos.\nEl color característico verde fluorescente del FREEZETONE, sirve como un eficiente detector de fugas, dejando un rastro de color rojizo en las zonas en las que haya escapes del líquido refrigerante, el cual se transforma en verde fluorescente al entrar en contacto con el agua, indicando el lugar exacto de la fuga.\nCumple con norma técnica internacional ASTM D 1384.\n', '15.85', 'img/producto/IMG2102022204152.jpg', 'activo', 0, 1, 288, 'Galon', '10'),
(3, '930123', 'Aditivo ', 5, 2, 'Tratamiento para aceite de motor\r\n- Limpiador de inyectores para motores a gasolina.', '10.00', 'img/producto/IMG47202218152.jpg', 'activo', 0, 1, 93, NULL, NULL),
(4, '7948053', 'Grasa GOLDEN BEAR ZIRIUX', 5, 4, 'grasa multiuso grado NGLI 2 de complejo de litio.\r\nResistente a elevadas temperaturas.\r\nExcelente protección contra el desgaste', '5.00', 'img/producto/IMG47202218127.jpg', 'activo', 0, 1, 21, NULL, NULL),
(5, '550104', 'Llanta', 1, 5, 'Llanta Direccional Tornel ha sido desarrollada para brindar más comodidad al manejo. Su tecnología permite mejor agarre y menos ruido a la hora de rodar a altas velocidades. BENEFICIOS: Realza el confort al tomar curvas. Menor reacción al magnetismo. Reduce el ruido de la llanta. Conducción suave. Mayor durabilidad. Características: Robustos bloques en el hombro. Estructura de diseño especial. Dibujo de piso con secuencia de modulación optimizada. Perfil de cavidad optimizado. Costado flexible.', '50.00', 'img/producto/IMG672022124528.jpg', 'activo', 0, 1, 10, NULL, NULL),
(6, '3872012', '10w30', 4, 4, 'Aceite semi sintectico 8k', '24.00', 'img/producto/IMG1272022142647.jpg', 'activo', 0, 1, 9, NULL, NULL),
(7, '8684457', 'AGUA', 4, 15, 'detalle del producto', '123.00', 'img/producto/producto.jpg', 'activo', 0, 1, 195, 'GALON', '1/2'),
(8, '2119664', 'Liqui Moly Kühler Reiniger: Limpia Radiadores 300ml', 10, 18, 'Limpia radiadores y circuitos de calefacción, eliminando depósitos y costras calcáreas, las cuales obstruyen el intercambio de calor y elevan la temperatura del motor. Aplicarlo preventivamente antes del verano.', '15.36', 'img/producto/IMG5102022191451.jpg', 'activo', 0, 1, 25, '1 lata', '300ml'),
(9, '4648398', 'Aceite Dexron 6 Transmisión Automática Full Sintético', 4, 19, 'Disponemos de toda la línea eléctrica para su auto\r\nBendix', '15.00', 'img/producto/IMG510202219333.png', 'activo', 0, 1, 10, '1 galon', '946ml'),
(10, '01012F.3.4T', 'ACEITE MOTO 4T HAVOLINE MOTORCYCLE 4T 20W50', 4, 6, 'Havoline Motorcycle Oil 4T API SF SAE 20W-50 está recomendado para uso en motores de cuatro tiempos de motocicletas, cuando se requiere un aceite que cumpla con la clasificación API SF. Proporciona suaves cambios de marchas y el adecuado funcionamiento del embrague.', '3.72', 'img/producto/IMG17102022193138.jpg', 'activo', 0, 1, 12, 'Galon', '12 1/4'),
(11, '01007F.3.40', 'Aceite Motor Gasolina', 4, 6, 'HAVOLINE® MOTOR OIL SAE 40 Es un aceite lubricante para motores a gasolina diseñado para mantener el motor libre de depósitos en operaciones severas como el pare-arranque en el tráfico de la ciudad. Formulado con aceites básicos de calidad y un paquete de aditivos de alta tecnología.', '77.94', 'img/producto/IMG1810202214832.jpg', 'activo', 0, 1, 6, 'Galon', '6/1'),
(12, '01007HSYNB10W30', 'Aceite de motor', 4, 6, 's un aceite de primera calidad con tecnología sintética y Deposit Shield® Technology, que contiene una mayor gama de aditivos de limpieza y antidesgaste para brindar protección avanzada en el funcionamiento eficiente de motores modernos. Supera la clasificación API SP más reciente.', '83.94', 'img/producto/IMG18102022142710.jpg', 'activo', 0, 1, 6, 'Galon', '6/1'),
(13, '75007REF.R50-50', 'WALKER  REFRIGERANTE', 2, 20, 'El ????????????????????????????????????????????????????????/???????????????????????????????????????????????? #Walker está ???????????????????? ???????????????? ????????????????✅ en:\n- Camiones????\n- Buses????\n- Motores estacionarios⚙️\n- Autmóviles????', '5.57', 'img/producto/IMG28102022185630.jpg', 'activo', 1, 1, 2, 'Galon', '6/1'),
(14, '75012REF.R50-50', 'WALKER REFRIGERANTE', 2, 20, 'El refrigerante / anticongelante MOTOREX\nno contiene nitritos, aminas ni fosfatos.', '2.00', 'img/producto/IMG28102022191518.jpg', 'activo', 0, 1, 12, 'Galon', '1/4'),
(15, '9A080ECOVAL', 'SERVICIO DE GESTION', 12, 21, 'El aceite lubricante usado es considerado un residuo con riesgos por su contenido elevado de metales pesados como plomo, cadmio, cromo, solventes clorados, entre otros contaminantes, según datos del Ministerio del Ambiente.', '0.75', 'img/producto/IMG28102022193018.jpg', 'activo', 0, 1, 7, 'Galon', '6/1'),
(16, '05012GEAR90GL4', 'Aceite  transmision manual motorex gear EP 90 GL-4', 13, 2, 'Es un aceite lubricante para engranajes automotrices manufacturado con aceites básicos y aditivos de extrema presión.\r\n\r\n', '18.00', 'img/producto/IMG211202219717.png', 'activo', 0, 0, 12, 'Galon', '1/4'),
(17, '9A080ECOVAL121', ' SERVICIO DE  AMBIENTAL DE ACEITES', 12, 21, 'Recoil es el nombre del modelo de gestión de residuos del sector lubricantes de la empresas miembro de la Asociación Ecuatoriana de Lubricantes APEL', '1.00', 'img/producto/IMG2112022192211.jpg', 'activo', 0, 1, 8, 'Galon', '1/4'),
(18, '9A080ECOVAL5GLS', 'servicio de gestion de ambiente', 12, 21, 'Recoil es el nombre del modelo de gestión de residuos del sector lubricantes de la empresas miembro de la Asociación Ecuatoriana de Lubricantes APEL', '1.00', 'img/producto/IMG2112022192844.jpg', 'activo', 0, 1, 8, 'Galon', '1/2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proveedor_id` int(11) NOT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `ruc` char(15) DEFAULT NULL,
  `proveedor_direccion` varchar(255) DEFAULT NULL,
  `provincia_id` varchar(100) DEFAULT NULL,
  `ciudad_id` varchar(100) DEFAULT NULL,
  `proveedor_telefono` char(15) DEFAULT NULL,
  `proveedor_correo` varchar(150) DEFAULT NULL,
  `proveedor_actividad` text DEFAULT NULL,
  `encargado` varchar(255) DEFAULT NULL,
  `encargado_sexo` char(20) DEFAULT NULL,
  `encargado_telefono` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedor_id`, `razon_social`, `ruc`, `proveedor_direccion`, `provincia_id`, `ciudad_id`, `proveedor_telefono`, `proveedor_correo`, `proveedor_actividad`, `encargado`, `encargado_sexo`, `encargado_telefono`, `estado`) VALUES
(1, 'CONAUTO', '0990018685001', 'Av. Juan Tanca Marengo , km.  1.8', 'GUAYAS', 'Guayaquil', '092121789', 'DONASAS@HOTMAIL.COM', 'VENTA DE CARROS', 'Simbal', 'Masculino', 92121789, 1),
(2, 'Filtrocorp', '0991466177001', 'MILAGRO', 'GUAYAS', 'Guayaquil', '2040711', 'retencionelectronica@filtrocorp.com', 'VENTA DE RESPUESTOS DE VEHICULOS', 'JORGE RAMIREZ', 'Masculino', 985906677, 1),
(3, 'Etafas', '2345678877', 'guayas y olmedo', 'El Oro', 'Machala', '982879788', 'xxxxxx@hotmail.com', 'vende de todo', 'Juan Andres Batista', 'Masculino', 982879788, 1),
(4, 'LUBRISA', '0990133174001', 'avenida juan tanca marengo', 'Guayas', 'Guayaquil', '2658490', 'ventas@lubrilaca.com', 'Ventas de Lubricante', 'Exon Parraga', 'Masculino', 983935584, 1),
(5, 'PROVEEDOR SA', '1800872329', 'Milagro', 'Guayas', 'Milagro', '0999999999', 'm@m.com', 'Venta de aceites', 'Nelson Mendieta', 'Masculino', 999999999, 1),
(6, 'INVERNEG S.A', '0990658498001', 'AV DE LAS AMERICAS  #807 Y CALLE SEGUNDA', 'Guayas', 'Daule', '0994561682', 'inverneg@hotmail.com', 'Filtros y Lubricantes', 'Luis Segundo Chabla', 'Masculino', 994561682, 1),
(7, 'L.HENRIQUE &amp; CIA S.A.', '0990331928001', 'Av. Juan Tanca Marengo Esq. s/n y Av. Rodrigo', 'Guayas', 'Guayaquil', '0976512334', 'henrrique@hotmail.com', 'Produccion', 'Daniel Bustamente Villamar', 'Masculino', 988066299, 1),
(8, 'OIL SUPER ', '0992989955001', 'Via Duran - Boliche Kilometro 4 v2 Frente al Shopping de Duran', 'Guayas', 'Duran', '0969824681', 'elturcobustamante@gmail.com', 'Fabricación de Grasas y Aceites Lubricantes de Petróleo', 'Juan Torres Valdiviezo', 'Masculino', 969824681, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo`
--

CREATE TABLE `respaldo` (
  `id_respaldo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `respaldo`
--

INSERT INTO `respaldo` (`id_respaldo`, `id_usuario`, `fecha_hora`, `ruta`) VALUES
(1, 1, '2022-05-24 20:17:54', 'img/backup/20220524201754_don_gato.zip'),
(2, 1, '2022-05-24 20:24:15', 'img/backup/20220524202415_don_gato.zip'),
(3, 1, '2022-09-29 11:28:00', 'img/backup/20220929112800_u122942682_LubricentroGat.zip'),
(4, 1, '2023-01-05 14:00:38', 'img/backup/20230105140038_u122942682_LubricentroGat.zip');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `tipo_rol` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `tipo_rol`, `estado`) VALUES
(1, 'administrador', 1),
(2, 'secretaria', 1),
(3, 'Bodega', 1),
(4, 'Guardia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_pagos`
--

CREATE TABLE `rol_pagos` (
  `id_rol_pagos` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `valor_hora` decimal(10,2) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `total_ingreso` decimal(10,2) DEFAULT NULL,
  `total_egreso` decimal(10,2) DEFAULT NULL,
  `txtneto_pagar` decimal(10,2) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `rol_pagos`
--

INSERT INTO `rol_pagos` (`id_rol_pagos`, `id_empleado`, `fecha_pago`, `valor_hora`, `monto`, `total_ingreso`, `total_egreso`, `txtneto_pagar`, `estado`) VALUES
(3, 3, '2022-05-03 18:34:00', '2.50', '30.00', '30.00', '50.00', '-20.00', 1),
(4, 3, '2022-05-03 18:34:00', '2.50', '30.00', '30.00', '50.00', '-20.00', 1),
(5, 3, '2022-05-03 18:39:00', '2.50', '30.00', '30.00', '50.00', '-20.00', 1),
(6, 3, '2022-05-03 18:45:00', '2.50', '30.00', '30.00', '50.00', '-20.00', 1),
(7, 3, '2022-05-03 18:49:00', '2.50', '30.00', '30.00', '0.00', '30.00', 1),
(8, 2, '2022-05-03 18:54:00', '2.00', '18.00', '21.60', '143.90', '-122.30', 1),
(9, 1, '2022-05-03 18:55:00', '2.00', '20.00', '20.00', '0.00', '20.00', 1),
(10, 2, '2022-05-21 20:59:00', '2.00', '12.00', '14.40', '1.13', '13.27', 1),
(11, 4, '2022-07-05 19:44:00', '2.00', '0.00', '0.00', '24.00', '-24.00', 1),
(12, 1, '2022-07-11 13:35:00', '2.00', '24.00', '24.00', '0.00', '24.00', 1),
(13, 4, '2022-09-12 15:51:00', '3.64', '0.00', '0.00', '50.04', '-50.04', 1),
(14, 4, '2022-09-12 16:35:00', '3.64', '123.76', '123.76', '5.00', '118.76', 1),
(15, 4, '2022-10-01 11:22:00', '3.64', '167.44', '167.44', '0.00', '167.44', 1),
(16, 1, '2022-10-06 17:43:00', '2.00', '220.00', '225.50', '38.39', '187.11', 1),
(17, 4, '2022-10-06 17:48:00', '3.64', '360.36', '369.37', '28.83', '340.54', 1),
(18, 4, '2022-10-06 19:32:00', '3.64', '720.72', '738.74', '205.85', '532.89', 1),
(19, 1, '2022-10-06 19:35:00', '2.00', '440.00', '451.00', '0.00', '451.00', 1),
(20, 3, '2022-10-06 22:18:00', '2.50', '500.00', '512.50', '40.00', '472.50', 1),
(21, 1, '2022-11-22 19:32:00', '2.00', '420.00', '420.00', '0.00', '420.00', 1),
(22, 2, '2022-11-22 19:36:00', '2.00', '420.00', '420.00', '0.00', '420.00', 1),
(23, 3, '2022-11-22 19:36:00', '2.50', '525.00', '525.00', '0.00', '525.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `servicio` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `servicio`, `precio`, `detalle`, `foto`, `estado`) VALUES
(1, 'Cambio de aceite par auto', '27.00', 'Un galon de aceite 20w50 mas filtro 3387', 'img/servicio/IMG11102022102010.png', 1),
(2, 'cambio de aceite', '123.00', 'deatlle del servicio', 'img/servicio/servicio.jpg', 1),
(3, 'Lavado De Carro', '15.00', 'deatlle del servicio', 'img/servicio/servicio.jpg', 1),
(4, 'Lavado De Camioneta', '30.00', 'deatlle del servicio', 'img/servicio/servicio.jpg', 1),
(5, 'Lavado de Bus', '50.00', 'deatlle del servicio', 'img/servicio/servicio.jpg', 1),
(6, 'Lavado de Volqueta', '70.00', 'deatlle del servicio', 'img/servicio/servicio.jpg', 1),
(7, 'Tipo de servicio', '123.00', 'Detalle', 'img/servicio/IMG11102022102045.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_cliente`
--

CREATE TABLE `servicio_cliente` (
  `id_servicio_cliente` int(11) NOT NULL,
  `id_vehiculo_cliente` int(11) DEFAULT NULL,
  `inpuesto` int(11) DEFAULT NULL,
  `tipo_comprobante` char(40) DEFAULT NULL,
  `num_compro` char(40) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `total_servico` decimal(10,2) DEFAULT NULL,
  `totalneto_pro` decimal(10,2) DEFAULT NULL,
  `impuesto_pro` decimal(10,2) DEFAULT NULL,
  `total_pago_pro` decimal(10,2) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `tipo_pago` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `servicio_cliente`
--

INSERT INTO `servicio_cliente` (`id_servicio_cliente`, `id_vehiculo_cliente`, `inpuesto`, `tipo_comprobante`, `num_compro`, `fecha`, `total_servico`, `totalneto_pro`, `impuesto_pro`, `total_pago_pro`, `estado`, `tipo_pago`) VALUES
(9, 4, 12, 'FACTURA', '20220522190503', '2022-05-22', '223.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(10, 2, 12, 'FACTURA', '20220523190527', '2022-05-23', '223.00', '325.35', '39.04', '364.39', 1, 'Caja'),
(11, 3, 12, 'FACTURA', '20220523190524', '2022-05-23', '100.00', '225.00', '27.00', '252.00', 0, 'Caja'),
(12, 3, 12, 'FACTURA', '20220523190541', '2022-05-23', '223.00', '100.35', '12.04', '112.39', 0, 'Caja'),
(13, 2, 12, 'FACTURA', '20220525150535', '2022-05-25', '223.00', '225.00', '27.00', '252.00', 1, 'Caja'),
(14, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', '100.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(15, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', '100.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(16, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', '100.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(17, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', '100.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(26, 3, 12, 'FACTURA', '20220526130536', '2022-05-26', '100.00', '325.35', '39.04', '364.39', 1, 'PayPal'),
(27, 1, 12, 'FACTURA', '20220526190514', '2022-05-26', '223.00', '90.31', '10.84', '101.15', 1, 'Caja'),
(28, 1, 12, 'FACTURA', '20220526190501', '2022-05-26', '223.00', '90.31', '10.84', '101.15', 1, 'Caja'),
(29, 1, 12, 'FACTURA', '20220526190524', '2022-05-26', '223.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(30, 7, 12, 'FACTURA', '20220526190537', '2022-05-26', '223.00', '0.00', '0.00', '0.00', 1, 'PayPal'),
(31, 1, 12, 'FACTURA', '20220526200550', '2022-05-26', '100.00', '0.00', '0.00', '0.00', 1, 'PayPal'),
(32, 1, 12, 'FACTURA', '20220526200508', '2022-05-26', '223.00', '0.00', '0.00', '0.00', 1, 'PayPal'),
(33, 1, 12, 'FACTURA', '20220526200512', '2022-05-26', '223.00', '240.31', '28.84', '269.15', 1, 'PayPal'),
(34, 1, 12, 'FACTURA', '20220526200542', '2022-05-26', '223.00', '630.63', '75.68', '706.31', 1, 'PayPal'),
(35, 1, 12, 'FACTURA', '20220613150631', '2022-06-13', '223.00', '90.31', '10.84', '101.15', 1, 'PayPal'),
(36, 1, 12, 'FACTURA', '20220613150646', '2022-06-13', '100.00', '100.35', '12.04', '112.39', 0, 'PayPal'),
(37, 1, 12, 'FACTURA', '20220827130850', '2022-08-27', '243.00', '0.00', '0.00', '0.00', 1, 'PayPal'),
(38, 9, 12, 'FACTURA', '20220827140833', '2022-08-27', '10.00', '0.00', '0.00', '0.00', 1, 'PayPal'),
(39, 10, 12, 'FACTURA', '20220929100920', '2022-09-29', '10.00', '0.00', '0.00', '0.00', 0, 'Caja'),
(40, 10, 12, 'FACTURA', '20220929100942', '2022-09-29', '15.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(41, 3, 12, 'FACTURA', '20221005191016', '2022-10-05', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(42, 8, 12, 'FACTURA', '20221006191013', '2022-10-06', '70.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(43, 2, 12, 'FACTURA', '20221006221056', '2022-09-05', '30.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(44, 8, 12, 'FACTURA', '20221006221056', '2022-09-07', '70.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(45, 8, 12, 'FACTURA', '20221006221036', '2022-09-09', '70.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(46, 8, 12, 'FACTURA', '20221006221006', '2022-09-11', '70.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(47, 2, 12, 'FACTURA', '20221006221036', '2022-10-06', '30.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(48, 2, 12, 'FACTURA', '20221006221001', '2022-09-15', '30.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(49, 2, 12, 'FACTURA', '20221006221034', '2022-09-18', '30.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(50, 3, 12, 'FACTURA', '20221006221020', '2022-09-19', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(51, 3, 12, 'FACTURA', '20221006221053', '2022-09-21', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(52, 3, 12, 'FACTURA', '20221006221018', '2022-09-23', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(53, 3, 12, 'FACTURA', '20221006221004', '2022-09-24', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(54, 3, 12, 'FACTURA', '20221006221036', '2022-09-25', '10.00', '0.00', '0.00', '0.00', 1, 'Caja'),
(55, 3, 12, 'FACTURA', '20221006221054', '2022-09-26', '10.00', '0.00', '0.00', '0.00', 0, 'Caja'),
(56, 9, 12, 'FACTURA', '20221123131113', '2022-11-23', '50.00', '0.00', '0.00', '0.00', 0, 'PayPal'),
(57, 1, 12, 'FACTURA', '20221124151120', '2022-11-24', '30.00', '2.78', '0.33', '3.11', 1, 'Caja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `tipo_producto` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `tipo_producto`, `estado`) VALUES
(1, 'LLANTAS di', 1),
(2, 'Liquido Refrigerantes', 1),
(3, 'Diesel', 1),
(4, 'Aceite de moto', 1),
(5, 'Grasa', 1),
(6, 'ADITIVO PARA ACEITE DE MOTOR', 1),
(7, 'AGUA DE BATERIA', 1),
(8, 'ACEITE HIDRAULICO', 1),
(9, 'FILTROS DE ACEITE', 1),
(10, 'Liquido', 1),
(11, 'Walker', 1),
(12, 'Aceite Usados', 1),
(13, 'Aceite  transmision', 1),
(14, 'xian', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `sexo` char(10) DEFAULT NULL,
  `cedual` char(11) DEFAULT NULL,
  `telefono` char(13) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `foto`, `sexo`, `cedual`, `telefono`, `direccion`, `id_rol`, `usuario`, `pass`, `estado`, `correo`) VALUES
(1, 'Jordy kevin', 'Diaz reyes', 'img/usuarios/IMG1052022212323.png', 'Masculino', '1234567890', '0988692292', 'Naranjal', 1, 'admin', '123', 1, 'email@hotmail.com'),
(7, 'jose rojaa', 'andel yojo', 'img/usuarios/user.jpg', 'Masculino', '0940321854', '1234567890', 'mialgro', 3, 'admite', '233', 0, 'elgamer-26@gamil.com'),
(8, 'BACILIO TONTO', 'jorge aaa', 'img/usuarios/user.jpg', 'Masculino', '0940321855', '1112', 'aaaaa', 3, 'admin1', '123', 1, 'elgame123r-26@gamil.com'),
(9, 'aaaaaa', 'bbbbbbbb', 'img/usuarios/user.jpg', 'Femenino', '22222222', '111111', 'cccccc', 3, 'xxxxxx', 'cccccccccccc', 1, 'abc@otmil.com'),
(10, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321852', '0987654321', 'DURAN', 2, 'MARIA123', '3214', 1, 'MARIA@hotmail.com'),
(11, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321850', '0987654321', 'DURAN', 2, 'MARIA1231', '3214', 1, 'MA1RIA@hotmail.com'),
(12, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321859', '0987654321', 'DURAN', 2, 'MARIA12391', '3214', 1, 'MA19RIA@hotmail.com'),
(13, 'Jordy Andres', 'Moreno Diaz', 'img/usuarios/IMG2462022163623.png', 'Masculino', '0706426798', '0988692292', 'Napoleon Mera y Guayas', 1, 'Jordy', '123', 0, 'forcealien-93@hotmail.com'),
(14, 'Enrique', 'Ferruzola', 'img/usuarios/user.jpg', 'Masculino', '4534534534', '0090345345', 'milagro', 1, 'eferruzola', '123456', 0, 'enriqueperito@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `vehiculo` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `vehiculo`, `estado`) VALUES
(1, 'Carro', 1),
(2, 'Moto', 1),
(3, 'Camioneta', 1),
(4, 'Volqueta', 1),
(5, 'Bus', 1),
(6, 'Suv', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_cliente`
--

CREATE TABLE `vehiculo_cliente` (
  `id_clie_vehi` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo_vehoculo` int(11) DEFAULT NULL,
  `tipo_marca` int(11) DEFAULT NULL,
  `matrcula` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `vehiculo_cliente`
--

INSERT INTO `vehiculo_cliente` (`id_clie_vehi`, `cliente`, `fecha`, `tipo_vehoculo`, `tipo_marca`, `matrcula`, `color`, `detalle`, `ruta`, `estado`) VALUES
(1, 1, '2022-05-14', 2, 2, '1las12', 'negro, blqnco', ' qqqqqqqqqqq', 'img/vehiculo/IMG1652022194031.png', 1),
(2, 3, '2022-05-10', 3, 2, 'qwq12', 'roso, negro', ' aaaaaaaaaaa', 'img/vehiculo/IMG1452022193044.png', 1),
(3, 2, '2022-05-17', 6, 1, '12wee', 'Blanco', 'Accent 1.8 2016\nAmalie 10w30 1 galon mas 1 litro\nFiltro 3593AH\nFiltro aire \n', 'img/vehiculo/vehiculo.jpg', 1),
(4, 2, '2022-05-20', 2, 2, '123fda', 'BLANCO, NEGRO', ' MOTO DE CARRERA PARA CORRER', 'img/vehiculo/vehiculo.jpg', 1),
(7, 1, '2022-05-26', 3, 2, '12EWQ', 'AMARILLO, ROJO', ' CAMIONTA DE FORMULA ONE', 'img/vehiculo/IMG216202220390.png', 1),
(8, 7, '2022-07-06', 4, 3, 'XXX-0121', 'PLATEADO', ' XXXXXXXXXXXXXX', 'img/vehiculo/IMG672022183441.jpg', 1),
(9, 7, '2022-07-12', 3, 3, 'GSY2560', 'PLATEADO', ' CAMIONETA DOBLE CABINA', 'img/vehiculo/IMG127202216622.jpg', 1),
(10, 8, '2022-09-29', 1, 4, 'GSQ4900', 'PLATEADO', ' NINGUNO', 'img/vehiculo/IMG2992022105254.jpg', 1),
(11, 17, '2022-11-24', 1, 1, 'aaaaaaaaaaaaaa', 'gris', ' abc', 'img/vehiculo/IMG22112022225854.jpg', 1),
(12, 7, '2022-11-24', 1, 1, 'pqn0722', 'rojo', ' xxxxxxxxxxxxxxx', 'img/vehiculo/vehiculo.jpg', 1),
(13, 18, '2022-11-24', 1, 2, 'pqn0721', 'rojo', ' xxxxxxxxxx', 'img/vehiculo/vehiculo.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `impuesto` int(11) DEFAULT NULL,
  `tipo_doc` char(40) DEFAULT NULL,
  `numero_comprob` char(40) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `impuesto_sub` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` char(40) DEFAULT NULL,
  `tipo_pago` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `cliente_id`, `impuesto`, `tipo_doc`, `numero_comprob`, `fecha`, `cantidad`, `subtotal`, `impuesto_sub`, `total`, `estado`, `tipo_pago`) VALUES
(2, 1, 12, 'FACTURA', '20220518200529', '2022-05-18', 2, '325.35', '39.04', '364.39', 'Anulado', 'Caja'),
(3, 2, 12, 'FACTURA', '20220518200534', '2022-05-18', 2, '325.35', '39.04', '364.39', 'Anulado', 'Caja'),
(4, 3, 12, 'FACTURA', '20220519090551', '2022-05-19', 2, '325.35', '39.04', '364.39', 'Anulado', 'Caja'),
(7, 2, 12, 'FACTURA', '20220519090555', '2022-05-20', 2, '123.00', '12.00', '21.00', 'Vendido', 'PayPal'),
(11, 2, 12, 'FACTURA', '20220520200547', '2022-05-20', 2, '400.35', '48.04', '448.39', 'Vendido', 'PayPal'),
(12, 2, 12, 'FACTURA', '20220520200503', '2022-05-20', 2, '400.35', '48.04', '448.39', 'Vendido', 'PayPal'),
(13, 1, 12, 'FACTURA', '20220522200550', '2022-05-22', 2, '325.35', '39.04', '364.39', 'Vendido', 'Caja'),
(14, 1, 12, 'FACTURA', '20220523190552', '2022-05-23', 1, '225.00', '27.00', '252.00', 'Vendido', 'Caja'),
(15, 1, 12, 'FACTURA', '20220525150520', '2022-05-25', 1, '200.70', '24.08', '224.78', 'Vendido', 'Caja'),
(16, 1, 12, 'FACTURA', '20220526180555', '2022-05-26', 1, '100.35', '12.04', '112.39', 'Vendido', 'Caja'),
(17, 2, 12, 'FACTURA', '20220526190508', '2022-05-26', 1, '225.00', '27.00', '252.00', 'Vendido', 'PayPal'),
(18, 2, 12, 'FACTURA', '20220526190516', '2022-05-26', 1, '225.00', '27.00', '252.00', 'Vendido', 'PayPal'),
(19, 2, 12, 'FACTURA', '20220526190553', '2022-05-26', 2, '875.70', '105.08', '980.78', 'Vendido', 'PayPal'),
(20, 1, 12, 'FACTURA', '20220526190533', '2022-05-26', 2, '325.35', '39.04', '364.39', 'Vendido', 'PayPal'),
(21, 1, 12, 'FACTURA', '20220526190536', '2022-05-26', 2, '800.70', '96.08', '896.78', 'Vendido', 'PayPal'),
(22, 1, 12, 'FACTURA', '20220618130605', '2022-06-18', 1, '90.31', '10.84', '101.15', 'Vendido', 'PayPal'),
(23, 1, 12, 'FACTURA', '20220628110639', '2022-06-28', 1, '90.31', '10.84', '101.15', 'Vendido', 'Caja'),
(24, 7, 12, 'FACTURA', '20220706180733', '2022-07-06', 1, '300.00', '36.00', '336.00', 'Vendido', 'PayPal'),
(25, 7, 12, 'FACTURA', '20220706200727', '2022-07-06', 1, '20.00', '2.40', '22.40', 'Vendido', 'PayPal'),
(26, 7, 12, 'FACTURA', '20220709130734', '2022-07-09', 3, '315.00', '37.80', '352.80', 'Vendido', 'PayPal'),
(27, 7, 12, 'FACTURA', '20220709130726', '2022-07-09', 1, '20.00', '2.40', '22.40', 'Vendido', 'Caja'),
(28, 1, 12, 'FACTURA', '20220710140747', '2022-07-10', 1, '90.31', '10.84', '101.15', 'Vendido', 'Caja'),
(29, 5, 12, 'FACTURA', '20220712200704', '2022-07-12', 1, '240.00', '28.80', '268.80', 'Vendido', 'Caja'),
(30, 3, 12, 'FACTURA', '20220912170951', '2022-09-12', 1, '15.00', '1.80', '16.80', 'Vendido', 'Caja'),
(31, 8, 12, 'FACTURA', '20220929100901', '2022-09-29', 1, '21.60', '2.59', '24.19', 'Anulado', 'Caja'),
(32, 8, 12, 'FACTURA', '20220929110920', '2022-09-29', 1, '5.00', '0.60', '5.60', 'Vendido', 'Caja'),
(33, 7, 12, 'FACTURA', '20221005181052', '2022-10-05', 1, '24.00', '2.88', '26.88', 'Vendido', 'Caja'),
(34, 1, 12, 'FACTURA', '20221124151148', '2022-11-24', 1, '13.92', '1.67', '15.59', 'Vendido', 'Caja'),
(35, 7, 12, 'FACTURA', '20221124161134', '2022-11-24', 1, '307.50', '36.90', '344.40', 'Vendido', 'PayPal'),
(36, 1, 12, 'FACTURA', '20230105130119', '2023-01-05', 1, '31.70', '3.80', '35.50', 'Vendido', 'Caja');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agg_carrito`
--
ALTER TABLE `agg_carrito`
  ADD KEY `producto_id` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `agg_servicio`
--
ALTER TABLE `agg_servicio`
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD KEY `id_servicio` (`id_servicio`) USING BTREE;

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`) USING BTREE,
  ADD KEY `id_empleado` (`id_empleado`) USING BTREE;

--
-- Indices de la tabla `auditoria_compra`
--
ALTER TABLE `auditoria_compra`
  ADD PRIMARY KEY (`id_aud_compra`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `auditoria_servicios`
--
ALTER TABLE `auditoria_servicios`
  ADD PRIMARY KEY (`id_audi_servicio`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `auditoria_venta`
--
ALTER TABLE `auditoria_venta`
  ADD PRIMARY KEY (`id_audi_venta`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  ADD PRIMARY KEY (`id_beneficio`) USING BTREE;

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`) USING BTREE;

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`) USING BTREE,
  ADD KEY `cliente_id` (`cliente_id`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`) USING BTREE;

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`detalle_ingreso_id`) USING BTREE,
  ADD KEY `ingreso_id` (`ingreso_id`) USING BTREE,
  ADD KEY `producto_id` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `detalle_rol_pago_egreso`
--
ALTER TABLE `detalle_rol_pago_egreso`
  ADD PRIMARY KEY (`id_detalle_egreso`) USING BTREE,
  ADD KEY `id_rol_pagos` (`id_rol_pagos`) USING BTREE;

--
-- Indices de la tabla `detalle_rol_pago_ingreso`
--
ALTER TABLE `detalle_rol_pago_ingreso`
  ADD PRIMARY KEY (`id_detalle_ingreso`) USING BTREE,
  ADD KEY `id_rol_pagos` (`id_rol_pagos`) USING BTREE;

--
-- Indices de la tabla `detalle_servicios_cliente`
--
ALTER TABLE `detalle_servicios_cliente`
  ADD PRIMARY KEY (`id_detalle_sericios`) USING BTREE,
  ADD KEY `id_servicio_cliente` (`id_servicio_cliente`) USING BTREE,
  ADD KEY `id_servicio` (`id_servicio`) USING BTREE;

--
-- Indices de la tabla `detalle_servicio_producto`
--
ALTER TABLE `detalle_servicio_producto`
  ADD PRIMARY KEY (`id_detalle_poducto_servcios`) USING BTREE,
  ADD KEY `id_servicio_cliente` (`id_servicio_cliente`) USING BTREE,
  ADD KEY `producto_id` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`) USING BTREE,
  ADD KEY `id_venta` (`id_venta`) USING BTREE,
  ADD KEY `producto_id` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`) USING BTREE,
  ADD KEY `id_cargo` (`id_cargo`) USING BTREE;

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empleda`) USING BTREE;

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`ingreso_id`) USING BTREE,
  ADD KEY `usuario_id` (`usuario_id`) USING BTREE,
  ADD KEY `proveedor_id` (`proveedor_id`) USING BTREE;

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`) USING BTREE;

--
-- Indices de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id_marca`) USING BTREE;

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`id_multa`) USING BTREE,
  ADD KEY `id_empleado` (`id_empleado`) USING BTREE;

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id_ofertas`) USING BTREE,
  ADD KEY `producto_id` (`producto_id`) USING BTREE;

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`) USING BTREE,
  ADD KEY `id_empleado` (`id_empleado`) USING BTREE;

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permido_id`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`) USING BTREE,
  ADD KEY `tipo_producto_id` (`tipo_producto_id`) USING BTREE,
  ADD KEY `marca_producto_id` (`marca_producto_id`) USING BTREE;

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proveedor_id`) USING BTREE;

--
-- Indices de la tabla `respaldo`
--
ALTER TABLE `respaldo`
  ADD PRIMARY KEY (`id_respaldo`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`) USING BTREE;

--
-- Indices de la tabla `rol_pagos`
--
ALTER TABLE `rol_pagos`
  ADD PRIMARY KEY (`id_rol_pagos`) USING BTREE,
  ADD KEY `id_empleado` (`id_empleado`) USING BTREE;

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`) USING BTREE;

--
-- Indices de la tabla `servicio_cliente`
--
ALTER TABLE `servicio_cliente`
  ADD PRIMARY KEY (`id_servicio_cliente`) USING BTREE,
  ADD KEY `id_vehiculo_cliente` (`id_vehiculo_cliente`) USING BTREE;

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`) USING BTREE,
  ADD KEY `id_rol` (`id_rol`) USING BTREE;

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`) USING BTREE;

--
-- Indices de la tabla `vehiculo_cliente`
--
ALTER TABLE `vehiculo_cliente`
  ADD PRIMARY KEY (`id_clie_vehi`) USING BTREE,
  ADD KEY `cliente` (`cliente`) USING BTREE,
  ADD KEY `tipo_vehoculo` (`tipo_vehoculo`) USING BTREE,
  ADD KEY `tipo_marca` (`tipo_marca`) USING BTREE;

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`) USING BTREE,
  ADD KEY `cliente_id` (`cliente_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `auditoria_compra`
--
ALTER TABLE `auditoria_compra`
  MODIFY `id_aud_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `auditoria_servicios`
--
ALTER TABLE `auditoria_servicios`
  MODIFY `id_audi_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `auditoria_venta`
--
ALTER TABLE `auditoria_venta`
  MODIFY `id_audi_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `beneficio`
--
ALTER TABLE `beneficio`
  MODIFY `id_beneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `detalle_ingreso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detalle_rol_pago_egreso`
--
ALTER TABLE `detalle_rol_pago_egreso`
  MODIFY `id_detalle_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `detalle_rol_pago_ingreso`
--
ALTER TABLE `detalle_rol_pago_ingreso`
  MODIFY `id_detalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `detalle_servicios_cliente`
--
ALTER TABLE `detalle_servicios_cliente`
  MODIFY `id_detalle_sericios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `detalle_servicio_producto`
--
ALTER TABLE `detalle_servicio_producto`
  MODIFY `id_detalle_poducto_servcios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empleda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `ingreso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `id_multa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id_ofertas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `respaldo`
--
ALTER TABLE `respaldo`
  MODIFY `id_respaldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_pagos`
--
ALTER TABLE `rol_pagos`
  MODIFY `id_rol_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio_cliente`
--
ALTER TABLE `servicio_cliente`
  MODIFY `id_servicio_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculo_cliente`
--
ALTER TABLE `vehiculo_cliente`
  MODIFY `id_clie_vehi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agg_servicio`
--
ALTER TABLE `agg_servicio`
  ADD CONSTRAINT `agg_servicio_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agg_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auditoria_compra`
--
ALTER TABLE `auditoria_compra`
  ADD CONSTRAINT `auditoria_compra_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auditoria_servicios`
--
ALTER TABLE `auditoria_servicios`
  ADD CONSTRAINT `auditoria_servicios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auditoria_venta`
--
ALTER TABLE `auditoria_venta`
  ADD CONSTRAINT `auditoria_venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `detalle_ingreso_ibfk_1` FOREIGN KEY (`ingreso_id`) REFERENCES `ingreso` (`ingreso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ingreso_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_rol_pago_egreso`
--
ALTER TABLE `detalle_rol_pago_egreso`
  ADD CONSTRAINT `detalle_rol_pago_egreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_rol_pago_ingreso`
--
ALTER TABLE `detalle_rol_pago_ingreso`
  ADD CONSTRAINT `detalle_rol_pago_ingreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_servicios_cliente`
--
ALTER TABLE `detalle_servicios_cliente`
  ADD CONSTRAINT `detalle_servicios_cliente_ibfk_1` FOREIGN KEY (`id_servicio_cliente`) REFERENCES `servicio_cliente` (`id_servicio_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_servicios_cliente_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_servicio_producto`
--
ALTER TABLE `detalle_servicio_producto`
  ADD CONSTRAINT `detalle_servicio_producto_ibfk_1` FOREIGN KEY (`id_servicio_cliente`) REFERENCES `servicio_cliente` (`id_servicio_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_servicio_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multas`
--
ALTER TABLE `multas`
  ADD CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_producto_id`) REFERENCES `tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`marca_producto_id`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respaldo`
--
ALTER TABLE `respaldo`
  ADD CONSTRAINT `respaldo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_pagos`
--
ALTER TABLE `rol_pagos`
  ADD CONSTRAINT `rol_pagos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_cliente`
--
ALTER TABLE `servicio_cliente`
  ADD CONSTRAINT `servicio_cliente_ibfk_1` FOREIGN KEY (`id_vehiculo_cliente`) REFERENCES `vehiculo_cliente` (`id_clie_vehi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo_cliente`
--
ALTER TABLE `vehiculo_cliente`
  ADD CONSTRAINT `vehiculo_cliente_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_cliente_ibfk_2` FOREIGN KEY (`tipo_vehoculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_cliente_ibfk_3` FOREIGN KEY (`tipo_marca`) REFERENCES `marca_vehiculo` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
