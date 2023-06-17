/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3306
 Source Schema         : don_gato

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 13/06/2022 16:49:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agg_carrito
-- ----------------------------
DROP TABLE IF EXISTS `agg_carrito`;
CREATE TABLE `agg_carrito`  (
  `cliente_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `promocion` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_promo` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `porcentaje` int NULL DEFAULT NULL,
  `descuento_promo` decimal(10, 2) NULL DEFAULT NULL,
  INDEX `producto_id`(`producto_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of agg_carrito
-- ----------------------------

-- ----------------------------
-- Table structure for agg_servicio
-- ----------------------------
DROP TABLE IF EXISTS `agg_servicio`;
CREATE TABLE `agg_servicio`  (
  `id_cliente` int NULL DEFAULT NULL,
  `id_servicio` int NULL DEFAULT NULL,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  INDEX `id_servicio`(`id_servicio`) USING BTREE,
  CONSTRAINT `agg_servicio_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agg_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of agg_servicio
-- ----------------------------

-- ----------------------------
-- Table structure for asistencia
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia`  (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `hora_ingreso` time(0) NULL DEFAULT NULL,
  `hora_salida` time(0) NULL DEFAULT NULL,
  `asistencia` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `rol_pagos` int NULL DEFAULT 1,
  PRIMARY KEY (`id_asistencia`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asistencia
-- ----------------------------
INSERT INTO `asistencia` VALUES (1, 3, '2022-05-03', '09:00:00', '14:55:00', 'Asistio', 1, 0);
INSERT INTO `asistencia` VALUES (2, 3, '2022-05-03', '09:00:00', '14:55:00', 'Asistio', 1, 0);
INSERT INTO `asistencia` VALUES (5, 2, '2022-05-03', '09:00:00', '17:00:00', 'Asistio', 1, 0);
INSERT INTO `asistencia` VALUES (6, 2, '2022-05-05', '08:00:00', '17:00:00', 'Falto', 1, 0);
INSERT INTO `asistencia` VALUES (7, 1, '2022-05-02', '09:00:00', '18:00:00', 'Asistio', 1, 0);
INSERT INTO `asistencia` VALUES (8, 2, '2022-05-21', '09:00:00', '14:00:00', 'Asistio', 1, 0);

-- ----------------------------
-- Table structure for auditoria_compra
-- ----------------------------
DROP TABLE IF EXISTS `auditoria_compra`;
CREATE TABLE `auditoria_compra`  (
  `id_aud_compra` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `operacion` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_hora` datetime(0) NULL DEFAULT NULL,
  `app` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `n_venta` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_aud_compra`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `auditoria_compra_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auditoria_compra
-- ----------------------------
INSERT INTO `auditoria_compra` VALUES (1, 1, 'Inserto compra', '2022-05-25 15:05:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', NULL, 1, 137.76);
INSERT INTO `auditoria_compra` VALUES (2, 1, 'Inserto compra', '2022-05-25 15:05:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525150502', 1, 359.52);
INSERT INTO `auditoria_compra` VALUES (3, 1, 'Anulo compra', '2022-05-25 15:05:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220507110546', 2, 4977.28);

-- ----------------------------
-- Table structure for auditoria_servicios
-- ----------------------------
DROP TABLE IF EXISTS `auditoria_servicios`;
CREATE TABLE `auditoria_servicios`  (
  `id_audi_servicio` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `app` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `n_venta` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `operacion` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_hora` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_audi_servicio`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `auditoria_servicios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auditoria_servicios
-- ----------------------------
INSERT INTO `auditoria_servicios` VALUES (1, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525180508', 0.00, 'Inserto servicio', '2022-05-25 18:05:56');
INSERT INTO `auditoria_servicios` VALUES (2, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525190559', 100.00, 'Inserto servicio', '2022-05-25 19:05:12');
INSERT INTO `auditoria_servicios` VALUES (3, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525190559', 100.00, 'Anulo servicio', '2022-05-25 19:05:56');
INSERT INTO `auditoria_servicios` VALUES (4, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190514', 223.00, 'Inserto servicio', '2022-05-26 19:05:56');
INSERT INTO `auditoria_servicios` VALUES (5, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190501', 223.00, 'Inserto servicio', '2022-05-26 19:05:32');
INSERT INTO `auditoria_servicios` VALUES (6, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526190524', 223.00, 'Inserto servicio', '2022-05-26 19:05:37');

-- ----------------------------
-- Table structure for auditoria_venta
-- ----------------------------
DROP TABLE IF EXISTS `auditoria_venta`;
CREATE TABLE `auditoria_venta`  (
  `id_audi_venta` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `operacion` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_hora` datetime(0) NULL DEFAULT NULL,
  `app` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `n_venta` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_audi_venta`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `auditoria_venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auditoria_venta
-- ----------------------------
INSERT INTO `auditoria_venta` VALUES (1, 1, 'Inserto venta', '2022-05-25 15:05:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220525150520', 1, 224.78);
INSERT INTO `auditoria_venta` VALUES (2, 1, 'Anulo venta', '2022-05-25 15:05:35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '::1', '20220519090551', 2, 364.39);
INSERT INTO `auditoria_venta` VALUES (3, 1, 'Inserto venta', '2022-05-26 18:05:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.62 Safari/537.36', '::1', '20220526180555', 1, 112.39);

-- ----------------------------
-- Table structure for beneficio
-- ----------------------------
DROP TABLE IF EXISTS `beneficio`;
CREATE TABLE `beneficio`  (
  `id_beneficio` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `valor` decimal(10, 2) NULL DEFAULT NULL,
  `tipo` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_beneficio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of beneficio
-- ----------------------------
INSERT INTO `beneficio` VALUES (1, 'IIESS', 9.45, 'Egreso', 1);
INSERT INTO `beneficio` VALUES (2, 'Horas extras', 10.00, 'Ingreso', 1);
INSERT INTO `beneficio` VALUES (3, 'comisiones', 10.00, 'Ingreso', 1);
INSERT INTO `beneficio` VALUES (4, 'transporte', 5.00, 'Egreso', 1);
INSERT INTO `beneficio` VALUES (5, 'Prestamo Quirogra IESS', 8.00, 'Egreso', 1);
INSERT INTO `beneficio` VALUES (6, 'No tiene beneficios', 0.00, 'Egreso', 1);

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo`  (
  `id_cargo` int NOT NULL AUTO_INCREMENT,
  `tipo_cargo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_cargo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES (1, 'LIMPIEZA DE MOTO', 1);
INSERT INTO `cargo` VALUES (2, 'LABADO DE CARRO', 1);
INSERT INTO `cargo` VALUES (3, 'LUBRICADO', 1);

-- ----------------------------
-- Table structure for cita
-- ----------------------------
DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita`  (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `start` datetime(0) NULL DEFAULT NULL,
  `estado` enum('En espera','Atentido','Inactivo') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `color` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `textColor` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_reserva` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_cita`) USING BTREE,
  INDEX `cliente_id`(`cliente_id`) USING BTREE,
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cita
-- ----------------------------
INSERT INTO `cita` VALUES (17, 1, 'aaaaaa', 'vvvvvvvvvv', '2022-05-27 12:15:00', 'Atentido', '#FFFFFF', '#ff0000', 34);
INSERT INTO `cita` VALUES (18, 1, 'servico para cambio de llantas', 'servico para cambio de llantas', '2022-06-14 15:26:00', 'Atentido', '#FFFFFF', '#ff0000', 35);

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cedula` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `sexo` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 'NOMBRES', 'APELLIDOS', '0940321854', 'elgamer-26@hotmail.com', 'MILAGRO', '2022-05-24', 'Femenino', '1234567890', 1);
INSERT INTO `cliente` VALUES (2, 'aaaaaaaaaaa', 'bbbbbbbbbb', '0940321856', 'aennifferbarreto88@gmail.com', 'ssds', '2022-05-02', 'Femenino', '212121', 1);
INSERT INTO `cliente` VALUES (3, 'Jorge Moises', 'ramirez zavala', '0940321855', 'asennifferbarreto88@gmail.com', 'Milagro, av. amazonas', '2022-02-09', 'Masculino', '0987654321', 1);
INSERT INTO `cliente` VALUES (4, 'JOSE CARLOS', 'RAMOS LOPES', '0940321851', 'jennifferbarreto88@gmail.com', 'Milagro, av. amazonas', '1994-02-03', 'Masculino', '0987654321', 1);
INSERT INTO `cliente` VALUES (5, 'JUAN CARLOS', 'RAMOS LOPES', '0940321850', 'elgamer-260@hotmail.com', 'Milagro, av. amazonas', '2022-02-08', 'Masculino', '0940321854', 1);
INSERT INTO `cliente` VALUES (6, 'Jorge Moises', 'jorge', '0940321852', '123jrge@gmail.com', 'malgrosdsd', '2022-04-25', 'Masculino', '0987654321', 1);

-- ----------------------------
-- Table structure for detalle_ingreso
-- ----------------------------
DROP TABLE IF EXISTS `detalle_ingreso`;
CREATE TABLE `detalle_ingreso`  (
  `detalle_ingreso_id` int NOT NULL AUTO_INCREMENT,
  `ingreso_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `detalle_estado` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`detalle_ingreso_id`) USING BTREE,
  INDEX `ingreso_id`(`ingreso_id`) USING BTREE,
  INDEX `producto_id`(`producto_id`) USING BTREE,
  CONSTRAINT `detalle_ingreso_ibfk_1` FOREIGN KEY (`ingreso_id`) REFERENCES `ingreso` (`ingreso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_ingreso_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_ingreso
-- ----------------------------
INSERT INTO `detalle_ingreso` VALUES (1, 5, 1, 1, 123.00, 0.00, 123.00, 'ANULADO');
INSERT INTO `detalle_ingreso` VALUES (2, 5, 2, 1, 4321.00, 0.00, 4321.00, 'ANULADO');
INSERT INTO `detalle_ingreso` VALUES (3, 6, 1, 10, 123.00, 0.00, 1230.00, 'ANULADO');
INSERT INTO `detalle_ingreso` VALUES (4, 6, 2, 55, 100.00, 0.00, 5500.00, 'ANULADO');
INSERT INTO `detalle_ingreso` VALUES (5, 7, 2, 100, 123.00, 0.00, 12300.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (6, 8, 1, 100, 100.00, 0.00, 10000.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (7, 8, 2, 99, 99.00, 0.00, 9801.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (8, 9, 1, 100, 123.00, 0.00, 12300.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (9, 9, 2, 111, 21.00, 0.00, 2331.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (10, 10, 2, 100, 123.00, 0.00, 12300.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (11, 11, 1, 123, 321.00, 0.00, 39483.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (12, 12, 2, 1, 123.00, 0.00, 123.00, 'INGRESADO');
INSERT INTO `detalle_ingreso` VALUES (13, 13, 2, 1, 321.00, 0.00, 321.00, 'INGRESADO');

-- ----------------------------
-- Table structure for detalle_rol_pago_egreso
-- ----------------------------
DROP TABLE IF EXISTS `detalle_rol_pago_egreso`;
CREATE TABLE `detalle_rol_pago_egreso`  (
  `id_detalle_egreso` int NOT NULL AUTO_INCREMENT,
  `id_rol_pagos` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_egreso`) USING BTREE,
  INDEX `id_rol_pagos`(`id_rol_pagos`) USING BTREE,
  CONSTRAINT `detalle_rol_pago_egreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_rol_pago_egreso
-- ----------------------------
INSERT INTO `detalle_rol_pago_egreso` VALUES (1, 4, 'Valor de las multas', 50.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (2, 5, 'Valor de las multas', 50.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (3, 6, 'Valor de las multas', 50.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (4, 7, 'No tiene beneficios', 0.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (5, 8, 'Falta por asistencia', 20.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (6, 8, 'Valor de las multas', 123.90, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (7, 9, 'No tiene beneficios', 0.00, 1);
INSERT INTO `detalle_rol_pago_egreso` VALUES (8, 10, 'IIESS', 1.13, 1);

-- ----------------------------
-- Table structure for detalle_rol_pago_ingreso
-- ----------------------------
DROP TABLE IF EXISTS `detalle_rol_pago_ingreso`;
CREATE TABLE `detalle_rol_pago_ingreso`  (
  `id_detalle_ingreso` int NOT NULL AUTO_INCREMENT,
  `id_rol_pagos` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_ingreso`) USING BTREE,
  INDEX `id_rol_pagos`(`id_rol_pagos`) USING BTREE,
  CONSTRAINT `detalle_rol_pago_ingreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_rol_pago_ingreso
-- ----------------------------
INSERT INTO `detalle_rol_pago_ingreso` VALUES (1, 4, 'Sueldo', 30.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (2, 5, 'Sueldo', 30.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (3, 6, 'Sueldo', 30.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (4, 7, 'Sueldo', 30.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (5, 8, 'Sueldo', 18.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (6, 8, 'Horas extras', 1.80, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (7, 8, 'comisiones', 1.80, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (8, 9, 'Sueldo', 20.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (9, 10, 'Sueldo', 12.00, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (10, 10, 'comisiones', 1.20, 1);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (11, 10, 'Horas extras', 1.20, 1);

-- ----------------------------
-- Table structure for detalle_servicio_producto
-- ----------------------------
DROP TABLE IF EXISTS `detalle_servicio_producto`;
CREATE TABLE `detalle_servicio_producto`  (
  `id_detalle_poducto_servcios` int NOT NULL AUTO_INCREMENT,
  `id_servicio_cliente` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento_oferta` decimal(10, 2) NULL DEFAULT NULL,
  `tipo_promo` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descuento_moneda` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_poducto_servcios`) USING BTREE,
  INDEX `id_servicio_cliente`(`id_servicio_cliente`) USING BTREE,
  INDEX `producto_id`(`producto_id`) USING BTREE,
  CONSTRAINT `detalle_servicio_producto_ibfk_1` FOREIGN KEY (`id_servicio_cliente`) REFERENCES `servicio_cliente` (`id_servicio_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_servicio_producto_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_servicio_producto
-- ----------------------------
INSERT INTO `detalle_servicio_producto` VALUES (5, 10, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35);
INSERT INTO `detalle_servicio_producto` VALUES (6, 10, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00);
INSERT INTO `detalle_servicio_producto` VALUES (7, 11, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00);
INSERT INTO `detalle_servicio_producto` VALUES (8, 12, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35);
INSERT INTO `detalle_servicio_producto` VALUES (9, 13, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00);
INSERT INTO `detalle_servicio_producto` VALUES (11, 26, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00);
INSERT INTO `detalle_servicio_producto` VALUES (12, 26, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35);
INSERT INTO `detalle_servicio_producto` VALUES (13, 27, 1, 1, 100.35, 10.04, 'Descuento', 0.00, 90.31);
INSERT INTO `detalle_servicio_producto` VALUES (14, 28, 1, 1, 100.35, 10.04, 'Descuento', 0.00, 90.31);
INSERT INTO `detalle_servicio_producto` VALUES (15, 33, 1, 1, 100.35, 10.04, 'Descuento', 0.00, 90.31);
INSERT INTO `detalle_servicio_producto` VALUES (16, 33, 2, 1, 300.00, 150.00, 'Descuento', 0.00, 150.00);
INSERT INTO `detalle_servicio_producto` VALUES (17, 34, 1, 2, 100.35, 10.04, 'Descuento', 0.00, 180.63);
INSERT INTO `detalle_servicio_producto` VALUES (18, 34, 2, 3, 300.00, 150.00, 'Descuento', 0.00, 450.00);
INSERT INTO `detalle_servicio_producto` VALUES (19, 35, 1, 1, 100.35, 10.04, 'Descuento', 0.00, 90.31);
INSERT INTO `detalle_servicio_producto` VALUES (20, 36, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35);

-- ----------------------------
-- Table structure for detalle_servicios_cliente
-- ----------------------------
DROP TABLE IF EXISTS `detalle_servicios_cliente`;
CREATE TABLE `detalle_servicios_cliente`  (
  `id_detalle_sericios` int NOT NULL AUTO_INCREMENT,
  `id_servicio_cliente` int NULL DEFAULT NULL,
  `id_servicio` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_sericios`) USING BTREE,
  INDEX `id_servicio_cliente`(`id_servicio_cliente`) USING BTREE,
  INDEX `id_servicio`(`id_servicio`) USING BTREE,
  CONSTRAINT `detalle_servicios_cliente_ibfk_1` FOREIGN KEY (`id_servicio_cliente`) REFERENCES `servicio_cliente` (`id_servicio_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_servicios_cliente_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_servicios_cliente
-- ----------------------------
INSERT INTO `detalle_servicios_cliente` VALUES (6, 9, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (7, 9, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (8, 10, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (9, 10, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (10, 11, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (11, 12, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (12, 12, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (13, 13, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (14, 13, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (15, 17, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (18, 26, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (19, 27, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (20, 27, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (21, 28, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (22, 28, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (23, 29, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (24, 29, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (25, 30, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (26, 30, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (27, 31, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (28, 32, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (29, 32, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (30, 33, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (31, 33, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (32, 34, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (33, 34, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (34, 35, 1, 1, 100.00, 0.00, 100.00);
INSERT INTO `detalle_servicios_cliente` VALUES (35, 35, 2, 1, 123.00, 0.00, 123.00);
INSERT INTO `detalle_servicios_cliente` VALUES (36, 36, 1, 1, 100.00, 0.00, 100.00);

-- ----------------------------
-- Table structure for detalle_venta
-- ----------------------------
DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE `detalle_venta`  (
  `id_detalle_venta` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento_oferta` decimal(10, 2) NULL DEFAULT NULL,
  `tipo_promo` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descuento_moneda` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado_detalle` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_venta`) USING BTREE,
  INDEX `id_venta`(`id_venta`) USING BTREE,
  INDEX `producto_id`(`producto_id`) USING BTREE,
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_venta
-- ----------------------------
INSERT INTO `detalle_venta` VALUES (1, 2, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 0);
INSERT INTO `detalle_venta` VALUES (2, 2, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 0);
INSERT INTO `detalle_venta` VALUES (3, 3, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (4, 3, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (5, 4, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (6, 4, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (33, 11, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (34, 11, 2, 1, 300.00, 0.00, 'No tiene', 0.00, 300.00, 1);
INSERT INTO `detalle_venta` VALUES (35, 12, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (36, 12, 2, 1, 300.00, 0.00, 'No tiene', 0.00, 300.00, 1);
INSERT INTO `detalle_venta` VALUES (37, 13, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (38, 13, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (39, 14, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (40, 15, 1, 2, 100.35, 0.00, 'No tiene', 0.00, 200.70, 1);
INSERT INTO `detalle_venta` VALUES (41, 16, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (42, 17, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (43, 18, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (44, 19, 1, 2, 100.35, 0.00, 'No tiene', 0.00, 200.70, 1);
INSERT INTO `detalle_venta` VALUES (45, 19, 2, 3, 300.00, 75.00, 'Descuento', 0.00, 675.00, 1);
INSERT INTO `detalle_venta` VALUES (46, 20, 1, 1, 100.35, 0.00, 'No tiene', 0.00, 100.35, 1);
INSERT INTO `detalle_venta` VALUES (47, 20, 2, 1, 300.00, 75.00, 'Descuento', 0.00, 225.00, 1);
INSERT INTO `detalle_venta` VALUES (48, 21, 1, 2, 100.35, 0.00, 'No tiene', 0.00, 200.70, 1);
INSERT INTO `detalle_venta` VALUES (49, 21, 2, 2, 300.00, 0.00, 'No tiene', 0.00, 600.00, 1);

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado`  (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_civil` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_n` date NULL DEFAULT NULL,
  `sexo` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cedula` char(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `nivel_es` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `totulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `experiencia` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fech_i` date NULL DEFAULT NULL,
  `id_cargo` int NULL DEFAULT NULL,
  `valor_hora` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_empleado`) USING BTREE,
  INDEX `id_cargo`(`id_cargo`) USING BTREE,
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES (1, 'Jorge moises', 'Ramirez zavala', 'Soltero', 'Mialgro, amazonas', '0985906677', 'elgamer-26@hotmail.com', '2006-02-01', 'Masculino', '0940321854', 'TERCER_NIVEL', 'Ing. en sistemas', 'Porgramador', '2022-05-02', 3, 2.00, 1);
INSERT INTO `empleado` VALUES (2, 'Jorge moises', 'Ramirez zavala', 'Soltera', 'Mialgro, amazonas', '0985906677', 'elgamer1-26@hotmail.com', '2006-02-01', 'Masculino', '0940321855', 'TERCER_NIVEL', 'Ing. en sistemas', 'Porgramador', '2022-05-02', 2, 2.00, 1);
INSERT INTO `empleado` VALUES (3, 'JUAN GABRIEL', 'HECTOR DIAS', 'Viudo', 'NARANJAL ', '0987654321', 'JUAN@HOTMAIL.COM', '2002-01-01', 'Masculino', '0987654321', 'POSTGRADO', 'ING E ROBOTICA', 'CREAR ROBOT', '2022-05-02', 3, 2.50, 1);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `id_empleda` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ruc` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `lema` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `atividad` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_empleda`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'EL GATO EDITADO', 'MILAGRO EDIT', '0985906677', '0940321854', 'email@HOTMIL.COM', '1999-12-27', 'Lema de la empresa    ', 'Actividades comerciles ', 'img/empresa/IMG2652022182110.jpg');

-- ----------------------------
-- Table structure for ingreso
-- ----------------------------
DROP TABLE IF EXISTS `ingreso`;
CREATE TABLE `ingreso`  (
  `ingreso_id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NULL DEFAULT NULL,
  `proveedor_id` int NULL DEFAULT NULL,
  `ingreso_porcentaje` int NULL DEFAULT NULL,
  `ingreso_ticomprobante` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ingreso_seriecomprobante` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ingreso_numcomrpobante` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ingreso_total` decimal(10, 2) NULL DEFAULT NULL,
  `ingreso_impusto` decimal(10, 2) NULL DEFAULT NULL,
  `ingreso_impuestototal` decimal(10, 2) NULL DEFAULT NULL,
  `ingreso_cantidad` int NULL DEFAULT NULL,
  `ingreso_estado` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ingreso_fecha` date NULL DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`) USING BTREE,
  INDEX `usuario_id`(`usuario_id`) USING BTREE,
  INDEX `proveedor_id`(`proveedor_id`) USING BTREE,
  CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ingreso
-- ----------------------------
INSERT INTO `ingreso` VALUES (5, 1, 1, 12, 'FACTURA', '110546-07052022', '20220507110546', 4444.00, 533.28, 4977.28, 2, 'ANULADO', '2022-05-07');
INSERT INTO `ingreso` VALUES (6, 1, 1, 12, 'FACTURA', '110500-07052022', '20220507110500', 6730.00, 807.60, 7537.60, 2, 'ANULADO', '2022-05-07');
INSERT INTO `ingreso` VALUES (7, 1, 2, 12, 'FACTURA', '090512-12052022', '20220512090512', 12300.00, 1476.00, 13776.00, 1, 'INGRESADO', '2022-05-12');
INSERT INTO `ingreso` VALUES (8, 1, 2, 12, 'FACTURA', '210554-12052022', '20220512210554', 19801.00, 2376.12, 22177.12, 2, 'INGRESADO', '2022-05-12');
INSERT INTO `ingreso` VALUES (9, 1, 2, 0, 'BOLETA', '190530-22052022', '20220522190530', 14631.00, 0.00, 14631.00, 2, 'INGRESADO', '2022-05-22');
INSERT INTO `ingreso` VALUES (10, 1, 1, 12, 'FACTURA', '190532-22052022', '20220522190532', 12300.00, 1476.00, 13776.00, 1, 'INGRESADO', '2022-05-22');
INSERT INTO `ingreso` VALUES (11, 1, 2, 12, 'FACTURA', '190545-22052022', '20220522190545', 39483.00, 4737.96, 44220.96, 1, 'INGRESADO', '2022-05-22');
INSERT INTO `ingreso` VALUES (12, 1, 1, 12, 'FACTURA', '150549-25052022', '20220525150549', 123.00, 14.76, 137.76, 1, 'INGRESADO', '2022-05-25');
INSERT INTO `ingreso` VALUES (13, 1, 2, 12, 'FACTURA', '150502-25052022', '20220525150502', 321.00, 38.52, 359.52, 1, 'INGRESADO', '2022-05-25');

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca`  (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_marca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES (1, 'havoline edit', 1);
INSERT INTO `marca` VALUES (2, 'modal_marcas', 1);
INSERT INTO `marca` VALUES (3, 'Chevron', 1);

-- ----------------------------
-- Table structure for marca_vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `marca_vehiculo`;
CREATE TABLE `marca_vehiculo`  (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_marca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marca_vehiculo
-- ----------------------------
INSERT INTO `marca_vehiculo` VALUES (1, 'marcah_vehiculo', 1);
INSERT INTO `marca_vehiculo` VALUES (2, 'NUEVA MARCA', 1);

-- ----------------------------
-- Table structure for multas
-- ----------------------------
DROP TABLE IF EXISTS `multas`;
CREATE TABLE `multas`  (
  `id_multa` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tipo` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `monto` decimal(10, 2) NULL DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  `fecha_paga_multa` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_multa`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of multas
-- ----------------------------
INSERT INTO `multas` VALUES (2, 2, '2022-05-03', 'Media', 123.90, 'Observacion', 0, '2022-05-03 18:54:34');
INSERT INTO `multas` VALUES (4, 3, '2022-05-04', 'Alta', 50.00, 'se durmio en el trabajo', 0, '2022-05-03 18:45:13');

-- ----------------------------
-- Table structure for ofertas
-- ----------------------------
DROP TABLE IF EXISTS `ofertas`;
CREATE TABLE `ofertas`  (
  `id_ofertas` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NULL DEFAULT NULL,
  `fecha_inic` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `nombre_oferta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `procentaje` int NULL DEFAULT NULL,
  `tipo_descue` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_ofertas`) USING BTREE,
  INDEX `producto_id`(`producto_id`) USING BTREE,
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ofertas
-- ----------------------------
INSERT INTO `ofertas` VALUES (15, 1, '2022-05-26', '2022-07-28', 'NUEVO PRODUCTO', 10, 'Descuento');

-- ----------------------------
-- Table structure for permiso
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso`  (
  `id_permiso` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tipo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `motivo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  PRIMARY KEY (`id_permiso`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES (1, 3, '2022-05-05', 'Estudios', 'Observacion');

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos`  (
  `permido_id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `configuracion` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `emples` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `asistens` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `mults` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `bens` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `rols` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `creat_pords` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `provees` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `comps` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `list_comps` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ofertas` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `servs` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `creat_cliens` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `crea_vehs` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `vents` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cret_sers` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `list_reser` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `reports` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `segurs` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `prods` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`permido_id`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES (1, 7, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');
INSERT INTO `permisos` VALUES (2, 1, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (3, 8, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');
INSERT INTO `permisos` VALUES (4, 9, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');
INSERT INTO `permisos` VALUES (5, 12, 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');
INSERT INTO `permisos` VALUES (6, 10, 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'true', 'false', 'false', 'true', 'false');
INSERT INTO `permisos` VALUES (7, 11, 'true', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `poducto_codigo` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `producto_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_producto_id` int NULL DEFAULT NULL,
  `marca_producto_id` int NULL DEFAULT NULL,
  `producto_detalle` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `producto_precio_venta` decimal(10, 2) NULL DEFAULT NULL,
  `producto_foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `producto_destacar` int NULL DEFAULT 0,
  `_eliminado` int NULL DEFAULT 1,
  `stock` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_producto`) USING BTREE,
  INDEX `tipo_producto_id`(`tipo_producto_id`) USING BTREE,
  INDEX `marca_producto_id`(`marca_producto_id`) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_producto_id`) REFERENCES `tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`marca_producto_id`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, '768009', 'llantas', 1, 2, 'llantas de carro', 100.35, 'img/producto/IMG2652022192742.png', 'activo', 1, 1, 287);
INSERT INTO `producto` VALUES (2, '8267255', 'CARRO EDITADO', 2, 3, 'CARRO PARA MANEJAR EDITADO', 300.00, 'img/producto/producto.jpg', 'activo', 0, 1, 277);

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `proveedor_id` int NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ruc` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `proveedor_direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `provincia_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ciudad_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `proveedor_telefono` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `proveedor_correo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `proveedor_actividad` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `encargado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `encargado_sexo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `encargado_telefono` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`proveedor_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (1, 'DONASAS editado', '12121212', 'MILAGRO', 'GUAYAS', 'MILAGRO', '212121', 'DONASAS@HOTMAIL.COM', 'VENTA DE CARROS', 'DONASAS', 'Masculino', 1212, 1);
INSERT INTO `proveedor` VALUES (2, 'CLARO S.A.', '0940321854', 'MILAGRO', 'GUAYAS', 'MILAGRO', '0985906677', 'MILAGRO@HOTMAIL.COM', 'VENTA DE RESPUESTOS DE VEHICULOS', 'JORGE RAMIREZ', 'Femenino', 985906677, 1);

-- ----------------------------
-- Table structure for respaldo
-- ----------------------------
DROP TABLE IF EXISTS `respaldo`;
CREATE TABLE `respaldo`  (
  `id_respaldo` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `fecha_hora` datetime(0) NULL DEFAULT NULL,
  `ruta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_respaldo`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `respaldo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of respaldo
-- ----------------------------
INSERT INTO `respaldo` VALUES (1, 1, '2022-05-24 20:17:54', 'img/backup/20220524201754_don_gato.zip');
INSERT INTO `respaldo` VALUES (2, 1, '2022-05-24 20:24:15', 'img/backup/20220524202415_don_gato.zip');

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `tipo_rol` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_rol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'administrador', 1);
INSERT INTO `rol` VALUES (2, 'secretaria', 1);
INSERT INTO `rol` VALUES (3, 'bodega EDITADO', 1);

-- ----------------------------
-- Table structure for rol_pagos
-- ----------------------------
DROP TABLE IF EXISTS `rol_pagos`;
CREATE TABLE `rol_pagos`  (
  `id_rol_pagos` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha_pago` datetime(0) NULL DEFAULT NULL,
  `valor_hora` decimal(10, 2) NULL DEFAULT NULL,
  `monto` decimal(10, 2) NULL DEFAULT NULL,
  `total_ingreso` decimal(10, 2) NULL DEFAULT NULL,
  `total_egreso` decimal(10, 2) NULL DEFAULT NULL,
  `txtneto_pagar` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_rol_pagos`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `rol_pagos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol_pagos
-- ----------------------------
INSERT INTO `rol_pagos` VALUES (3, 3, '2022-05-03 18:34:00', 2.50, 30.00, 30.00, 50.00, -20.00, 1);
INSERT INTO `rol_pagos` VALUES (4, 3, '2022-05-03 18:34:00', 2.50, 30.00, 30.00, 50.00, -20.00, 1);
INSERT INTO `rol_pagos` VALUES (5, 3, '2022-05-03 18:39:00', 2.50, 30.00, 30.00, 50.00, -20.00, 1);
INSERT INTO `rol_pagos` VALUES (6, 3, '2022-05-03 18:45:00', 2.50, 30.00, 30.00, 50.00, -20.00, 1);
INSERT INTO `rol_pagos` VALUES (7, 3, '2022-05-03 18:49:00', 2.50, 30.00, 30.00, 0.00, 30.00, 1);
INSERT INTO `rol_pagos` VALUES (8, 2, '2022-05-03 18:54:00', 2.00, 18.00, 21.60, 143.90, -122.30, 1);
INSERT INTO `rol_pagos` VALUES (9, 1, '2022-05-03 18:55:00', 2.00, 20.00, 20.00, 0.00, 20.00, 1);
INSERT INTO `rol_pagos` VALUES (10, 2, '2022-05-21 20:59:00', 2.00, 12.00, 14.40, 1.13, 13.27, 1);

-- ----------------------------
-- Table structure for servicio
-- ----------------------------
DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio`  (
  `id_servicio` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_servicio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of servicio
-- ----------------------------
INSERT INTO `servicio` VALUES (1, 'lavado editado', 100.00, 1);
INSERT INTO `servicio` VALUES (2, 'cambio de aceite', 123.00, 1);

-- ----------------------------
-- Table structure for servicio_cliente
-- ----------------------------
DROP TABLE IF EXISTS `servicio_cliente`;
CREATE TABLE `servicio_cliente`  (
  `id_servicio_cliente` int NOT NULL AUTO_INCREMENT,
  `id_vehiculo_cliente` int NULL DEFAULT NULL,
  `inpuesto` int NULL DEFAULT NULL,
  `tipo_comprobante` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `num_compro` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `total_servico` decimal(10, 2) NULL DEFAULT NULL,
  `totalneto_pro` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto_pro` decimal(10, 2) NULL DEFAULT NULL,
  `total_pago_pro` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `tipo_pago` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_servicio_cliente`) USING BTREE,
  INDEX `id_vehiculo_cliente`(`id_vehiculo_cliente`) USING BTREE,
  CONSTRAINT `servicio_cliente_ibfk_1` FOREIGN KEY (`id_vehiculo_cliente`) REFERENCES `vehiculo_cliente` (`id_clie_vehi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of servicio_cliente
-- ----------------------------
INSERT INTO `servicio_cliente` VALUES (9, 4, 12, 'FACTURA', '20220522190503', '2022-05-22', 223.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (10, 2, 12, 'FACTURA', '20220523190527', '2022-05-23', 223.00, 325.35, 39.04, 364.39, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (11, 3, 12, 'FACTURA', '20220523190524', '2022-05-23', 100.00, 225.00, 27.00, 252.00, 0, 'Caja');
INSERT INTO `servicio_cliente` VALUES (12, 3, 12, 'FACTURA', '20220523190541', '2022-05-23', 223.00, 100.35, 12.04, 112.39, 0, 'Caja');
INSERT INTO `servicio_cliente` VALUES (13, 2, 12, 'FACTURA', '20220525150535', '2022-05-25', 223.00, 225.00, 27.00, 252.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (14, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', 100.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (15, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', 100.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (16, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', 100.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (17, 3, 12, 'FACTURA', '20220525180508', '2022-05-25', 100.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (26, 3, 12, 'FACTURA', '20220526130536', '2022-05-26', 100.00, 325.35, 39.04, 364.39, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (27, 1, 12, 'FACTURA', '20220526190514', '2022-05-26', 223.00, 90.31, 10.84, 101.15, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (28, 1, 12, 'FACTURA', '20220526190501', '2022-05-26', 223.00, 90.31, 10.84, 101.15, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (29, 1, 12, 'FACTURA', '20220526190524', '2022-05-26', 223.00, 0.00, 0.00, 0.00, 1, 'Caja');
INSERT INTO `servicio_cliente` VALUES (30, 7, 12, 'FACTURA', '20220526190537', '2022-05-26', 223.00, 0.00, 0.00, 0.00, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (31, 1, 12, 'FACTURA', '20220526200550', '2022-05-26', 100.00, 0.00, 0.00, 0.00, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (32, 1, 12, 'FACTURA', '20220526200508', '2022-05-26', 223.00, 0.00, 0.00, 0.00, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (33, 1, 12, 'FACTURA', '20220526200512', '2022-05-26', 223.00, 240.31, 28.84, 269.15, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (34, 1, 12, 'FACTURA', '20220526200542', '2022-05-26', 223.00, 630.63, 75.68, 706.31, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (35, 1, 12, 'FACTURA', '20220613150631', '2022-06-13', 223.00, 90.31, 10.84, 101.15, 1, 'PayPal');
INSERT INTO `servicio_cliente` VALUES (36, 1, 12, 'FACTURA', '20220613150646', '2022-06-13', 100.00, 100.35, 12.04, 112.39, 0, 'PayPal');

-- ----------------------------
-- Table structure for tipo_producto
-- ----------------------------
DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE `tipo_producto`  (
  `id_tipo_producto` int NOT NULL AUTO_INCREMENT,
  `tipo_producto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_producto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_producto
-- ----------------------------
INSERT INTO `tipo_producto` VALUES (1, 'LLANTAS di', 1);
INSERT INTO `tipo_producto` VALUES (2, 'RUEDAS', 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `sexo` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cedual` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_rol` int NULL DEFAULT NULL,
  `usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `id_rol`(`id_rol`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'JOGE MOISES', 'RAMREZ ZAVALA', 'img/usuarios/IMG1052022212323.png', 'Femenino', '1234567890', '0985906677', 'GUAYAQUIL', 1, 'admin', '123', 1, 'email@hotmail.com');
INSERT INTO `usuario` VALUES (7, 'jose rojaa', 'andel yojo', 'img/usuarios/user.jpg', 'Masculino', '0940321854', '1234567890', 'mialgro', 3, 'admite', '233', 1, 'elgamer-26@gamil.com');
INSERT INTO `usuario` VALUES (8, 'BACILIO TONTO', 'jorge aaa', 'img/usuarios/user.jpg', 'Masculino', '0940321855', '1112', 'aaaaa', 3, 'admin1', '123', 1, 'elgame123r-26@gamil.com');
INSERT INTO `usuario` VALUES (9, 'aaaaaa', 'bbbbbbbb', 'img/usuarios/user.jpg', 'Femenino', '22222222', '111111', 'cccccc', 3, 'xxxxxx', 'cccccccccccc', 1, 'abc@otmil.com');
INSERT INTO `usuario` VALUES (10, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321852', '0987654321', 'DURAN', 2, 'MARIA123', '3214', 1, 'MARIA@hotmail.com');
INSERT INTO `usuario` VALUES (11, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321850', '0987654321', 'DURAN', 2, 'MARIA1231', '3214', 1, 'MA1RIA@hotmail.com');
INSERT INTO `usuario` VALUES (12, 'MARIA JUANA', 'BARZOLA BONILLA', 'img/usuarios/user.jpg', 'Femenino', '0940321859', '0987654321', 'DURAN', 2, 'MARIA12391', '3214', 1, 'MA19RIA@hotmail.com');

-- ----------------------------
-- Table structure for vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE `vehiculo`  (
  `id_vehiculo` int NOT NULL AUTO_INCREMENT,
  `vehiculo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_vehiculo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehiculo
-- ----------------------------
INSERT INTO `vehiculo` VALUES (1, 'carro', 1);
INSERT INTO `vehiculo` VALUES (2, 'moto', 1);
INSERT INTO `vehiculo` VALUES (3, 'camioneta', 1);

-- ----------------------------
-- Table structure for vehiculo_cliente
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo_cliente`;
CREATE TABLE `vehiculo_cliente`  (
  `id_clie_vehi` int NOT NULL AUTO_INCREMENT,
  `cliente` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `tipo_vehoculo` int NULL DEFAULT NULL,
  `tipo_marca` int NULL DEFAULT NULL,
  `matrcula` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `ruta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_clie_vehi`) USING BTREE,
  INDEX `cliente`(`cliente`) USING BTREE,
  INDEX `tipo_vehoculo`(`tipo_vehoculo`) USING BTREE,
  INDEX `tipo_marca`(`tipo_marca`) USING BTREE,
  CONSTRAINT `vehiculo_cliente_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehiculo_cliente_ibfk_2` FOREIGN KEY (`tipo_vehoculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehiculo_cliente_ibfk_3` FOREIGN KEY (`tipo_marca`) REFERENCES `marca_vehiculo` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehiculo_cliente
-- ----------------------------
INSERT INTO `vehiculo_cliente` VALUES (1, 1, '2022-05-14', 2, 2, '1las12', 'negro, blqnco', ' qqqqqqqqqqq', 'img/vehiculo/IMG1652022194031.png', 1);
INSERT INTO `vehiculo_cliente` VALUES (2, 3, '2022-05-10', 3, 2, 'qwq12', 'roso, negro', ' aaaaaaaaaaa', 'img/vehiculo/IMG1452022193044.png', 1);
INSERT INTO `vehiculo_cliente` VALUES (3, 2, '2022-05-17', 2, 1, '12wee', 'Blanco', ' aaaaaaaaaaaa', 'img/vehiculo/vehiculo.jpg', 1);
INSERT INTO `vehiculo_cliente` VALUES (4, 2, '2022-05-20', 2, 2, '123fda', 'BLANCO, NEGRO', ' MOTO DE CARRERA PARA CORRER', 'img/vehiculo/vehiculo.jpg', 1);
INSERT INTO `vehiculo_cliente` VALUES (7, 1, '2022-05-26', 3, 2, '12EWQ', 'AMARILLO, ROJO', ' CAMIONTA DE FORMULA ONE', 'img/vehiculo/IMG265202219579.png', 1);

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `impuesto` int NULL DEFAULT NULL,
  `tipo_doc` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `numero_comprob` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto_sub` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_pago` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_venta`) USING BTREE,
  INDEX `cliente_id`(`cliente_id`) USING BTREE,
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venta
-- ----------------------------
INSERT INTO `venta` VALUES (2, 1, 12, 'FACTURA', '20220518200529', '2022-05-18', 2, 325.35, 39.04, 364.39, 'Anulado', 'Caja');
INSERT INTO `venta` VALUES (3, 2, 12, 'FACTURA', '20220518200534', '2022-05-18', 2, 325.35, 39.04, 364.39, 'Anulado', 'Caja');
INSERT INTO `venta` VALUES (4, 3, 12, 'FACTURA', '20220519090551', '2022-05-19', 2, 325.35, 39.04, 364.39, 'Anulado', 'Caja');
INSERT INTO `venta` VALUES (7, 2, 12, 'FACTURA', '20220519090555', '2022-05-20', 2, 123.00, 12.00, 21.00, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (11, 2, 12, 'FACTURA', '20220520200547', '2022-05-20', 2, 400.35, 48.04, 448.39, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (12, 2, 12, 'FACTURA', '20220520200503', '2022-05-20', 2, 400.35, 48.04, 448.39, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (13, 1, 12, 'FACTURA', '20220522200550', '2022-05-22', 2, 325.35, 39.04, 364.39, 'Vendido', 'Caja');
INSERT INTO `venta` VALUES (14, 1, 12, 'FACTURA', '20220523190552', '2022-05-23', 1, 225.00, 27.00, 252.00, 'Vendido', 'Caja');
INSERT INTO `venta` VALUES (15, 1, 12, 'FACTURA', '20220525150520', '2022-05-25', 1, 200.70, 24.08, 224.78, 'Vendido', 'Caja');
INSERT INTO `venta` VALUES (16, 1, 12, 'FACTURA', '20220526180555', '2022-05-26', 1, 100.35, 12.04, 112.39, 'Vendido', 'Caja');
INSERT INTO `venta` VALUES (17, 2, 12, 'FACTURA', '20220526190508', '2022-05-26', 1, 225.00, 27.00, 252.00, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (18, 2, 12, 'FACTURA', '20220526190516', '2022-05-26', 1, 225.00, 27.00, 252.00, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (19, 2, 12, 'FACTURA', '20220526190553', '2022-05-26', 2, 875.70, 105.08, 980.78, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (20, 1, 12, 'FACTURA', '20220526190533', '2022-05-26', 2, 325.35, 39.04, 364.39, 'Vendido', 'PayPal');
INSERT INTO `venta` VALUES (21, 1, 12, 'FACTURA', '20220526190536', '2022-05-26', 2, 800.70, 96.08, 896.78, 'Vendido', 'PayPal');

SET FOREIGN_KEY_CHECKS = 1;
