-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2025 a las 22:31:53
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `barberia`
--
CREATE DATABASE IF NOT EXISTS `barberia` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `barberia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int(5) NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(5) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time_expected` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  `cancellation_reason` text,
  PRIMARY KEY (`appointment_id`),
  KEY `FK_client_appointment` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date_created`, `client_id`, `start_time`, `end_time_expected`, `canceled`, `cancellation_reason`) VALUES
(12, '2022-09-20 04:32:00', 15, '2022-09-24 14:15:00', '2022-09-24 14:25:00', 0, NULL),
(13, '2022-09-20 22:11:00', 16, '2022-09-21 14:15:00', '2022-09-21 14:35:00', 0, NULL),
(14, '2022-09-21 04:34:00', 17, '2022-09-22 14:45:00', '2022-09-22 15:00:00', 0, NULL),
(15, '2025-03-09 03:55:00', 18, '2025-03-14 12:45:00', '2025-03-14 13:20:00', 0, NULL),
(16, '2025-03-10 22:51:00', 19, '2025-03-14 20:30:00', '2025-03-14 20:50:00', 0, NULL),
(27, '2025-03-12 20:03:40', 25, '2025-03-20 17:02:00', '2025-03-20 17:02:00', 0, NULL),
(29, '2025-03-12 20:04:32', 26, '2025-04-04 18:04:00', '2025-04-04 18:04:00', 0, NULL),
(30, '2025-03-12 20:25:07', 26, '2025-04-04 18:04:00', '2025-04-04 18:04:00', 0, NULL),
(31, '2025-03-12 20:25:47', 22, '2025-03-18 18:25:00', '2025-03-18 18:25:00', 0, NULL),
(32, '2025-03-12 20:45:56', 22, '2025-03-18 18:25:00', '2025-03-18 18:25:00', 0, NULL),
(39, '2025-03-18 01:38:22', 24, '2025-03-28 23:29:00', '2025-03-28 23:49:00', 0, NULL),
(40, '2025-03-18 01:40:02', 24, '2025-03-18 03:00:00', '2025-03-18 03:40:00', 0, NULL),
(41, '2025-03-18 01:45:45', 24, '2025-03-18 03:00:00', '2025-03-18 03:40:00', 0, NULL),
(42, '2025-03-18 01:47:23', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(43, '2025-03-18 01:56:58', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(44, '2025-03-18 01:58:28', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(45, '2025-03-18 01:58:48', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(46, '2025-03-18 01:59:19', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(47, '2025-03-18 01:59:59', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(48, '2025-03-18 02:02:49', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(49, '2025-03-18 02:51:45', 27, '2025-03-28 04:00:00', '2025-03-28 04:25:00', 0, NULL),
(50, '2025-03-18 02:52:25', 21, '2025-03-22 23:52:00', '2025-03-23 00:12:00', 0, NULL),
(51, '2025-03-18 02:55:23', 21, '2025-03-22 23:52:00', '2025-03-23 00:12:00', 0, NULL),
(52, '2025-03-18 16:45:58', 21, '2025-03-22 15:45:00', '2025-03-22 15:55:00', 0, NULL),
(53, '2025-03-18 22:56:18', 27, '2025-03-22 23:00:00', '2025-03-22 23:15:00', 0, NULL),
(54, '2025-03-18 23:06:22', 27, '2025-03-22 23:00:00', '2025-03-22 23:15:00', 0, NULL),
(55, '2025-03-18 23:07:08', 22, '2025-03-22 23:06:00', '2025-03-22 23:26:00', 0, NULL),
(56, '2025-03-19 21:19:40', 26, '2025-04-03 22:19:00', '2025-04-03 22:44:00', 0, NULL),
(57, '2025-03-20 20:10:44', 21, '2025-03-21 21:13:00', '2025-03-21 21:38:00', 0, NULL),
(58, '2025-03-23 19:49:49', 25, '2025-03-24 16:52:00', '2025-03-24 17:17:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email` (`client_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `phone_number`, `client_email`) VALUES
(1, 'Juan', 'Cliente', '3052589741', 'jcliente@cweb.com'),
(2, 'Andres', 'Cliente', '3125896471', 'acliente@cweb.com'),
(3, 'Diego', 'Cliente', '3052467194', 'dcliente@cweb.com'),
(4, 'Adriana', 'Cliente', '3064589741', 'adcliente@cweb.com'),
(5, 'Demetrio', 'Clemente', '3125467141', 'dclemente@cweb.com'),
(7, 'Artemio', 'Lucian', '3236205984', 'alucian@cweb.com'),
(8, 'Emiliano', 'Sanchez', '3069857431', 'esanchez@cweb.com'),
(11, 'Carlos', 'Garcia', '3159874161', 'cgarcia@cweb.com'),
(12, 'Jhon', 'Juan', '3056489721', 'jjuan@cweb.com'),
(15, 'Pedro', 'Usuario', '3025897410', 'pusuario@cweb.com'),
(16, 'Martin', 'Estudiante', '3052659784', 'mestudiante@cweb.com'),
(17, 'Rafael', 'Pereira', '3062589437', 'rpereira@cweb.com'),
(18, 'jua', 'asd', '3052589743', 'ajs@as.com'),
(19, 'lol', 'sdaasd', '1124343213', 'asd@s.com'),
(20, '', '', '', ''),
(21, 'juan', 'aaaaaaaaaa', '1235667890', 'ssd@fdsd.com'),
(22, 'lolll', 'ss', '9877223436', 'ajkasjsjss@gmail.com'),
(24, 'andre', 'fd', '2294985844', 'ande@df.com'),
(25, 'fer', 'fer', '2294966677', 'anssde@df.com'),
(26, 'f', 'dfas', '2294985844', 'ade@df.com'),
(27, 'nando', 'nando', '2294985473', 'nando@df.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(2) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`) VALUES
(1, 'Juan', 'Peluquero', '3025894671', 'jpeluquero@cweb.com'),
(2, 'Pedro', 'Peluquero', '3052589741', 'ppeluquero@cweb.com'),
(3, 'Adriana', 'Peluquera', '3052589741', 'apeluquera@cweb.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `losadmin`
--

CREATE TABLE IF NOT EXISTS `losadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `losadmin`
--

INSERT INTO `losadmin` (`id`, `nombre`, `apellido`, `usuario`, `clave`) VALUES
(4, 'juampa', 'Verón', 'admin@admin.com', '56287755'),
(5, 'ju', 'ju', 'ju', '123'),
(6, 'bia', 'bia', 'bia', '$2y$10$74211a659126924685ca4ul/22CqNgmrOItL2gAIFNAl3WMBIsC9i'),
(7, 'bia', 'bia', 'bia', '$2y$10$b1db14c2cefce68c96979enwrGWY28h00UQnCCxRG0Z7twIsJ0S.K');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(5) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(6,2) NOT NULL,
  `service_duration` int(5) NOT NULL,
  `category_id` int(2) NOT NULL,
  PRIMARY KEY (`service_id`),
  KEY `FK_service_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `category_id`) VALUES
(1, 'Corte de Cabello Personalizado', 'Un corte diseñado según la forma del rostro y el tipo de cabello, asegurando un look favorecedor y fácil de mantener.', '21.00', 20, 6),
(2, 'Peinado para Eventos Especiales', 'Recogidos, semirecogidos o peinados con ondas, ideales para bodas, graduaciones o cualquier ocasión especial.', '9.00', 15, 6),
(3, 'Corte Bob o Long Bob', 'Un estilo versátil y elegante que se adapta a diferentes tipos de cabello y longitudes, dando un look sofisticado.', '10.00', 10, 6),
(4, 'Maquillaje para Novias', 'Un maquillaje elegante y duradero diseñado para resaltar la belleza natural de la novia, utilizando productos de alta calidad para un acabado impecable en fotos y en persona.', '20.00', 0, 2),
(5, 'Maquillaje para Eventos Especiales', 'Perfecto para fiestas, galas o cenas importantes, este maquillaje se adapta a la ocasión con técnicas que realzan los rasgos y garantizan un look sofisticado.', '20.00', 15, 2),
(6, 'Maquillaje de Fotografía y Video', 'Diseñado para sesiones fotográficas y producciones audiovisuales, este maquillaje tiene un acabado mate y de alta definición para evitar brillos en cámara.', '15.00', 20, 2),
(7, 'Limpieza Facial Profunda', 'Tratamiento que elimina impurezas, puntos negros y células muertas, dejando la piel fresca y renovada. Incluye exfoliación, extracción y mascarilla hidratante.', '16.00', 15, 3),
(8, 'Hidratación Facial Intensiva', 'Un tratamiento diseñado para restaurar la humedad de la piel, ideal para pieles secas o deshidratadas. Utiliza productos ricos en ácido hialurónico y vitaminas.', '20.00', 20, 3),
(9, 'Facial Iluminador con Vitamina C', 'Tratamiento antioxidante que revitaliza la piel, reduciendo la opacidad y dándole un brillo saludable. Ideal para pieles cansadas o apagadas.', '14.00', 20, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_booked`
--

CREATE TABLE IF NOT EXISTS `services_booked` (
  `appointment_id` int(5) NOT NULL,
  `service_id` int(5) NOT NULL,
  PRIMARY KEY (`appointment_id`,`service_id`),
  KEY `FK_SB_service` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services_booked`
--

INSERT INTO `services_booked` (`appointment_id`, `service_id`) VALUES
(13, 1),
(15, 1),
(14, 2),
(15, 2),
(31, 2),
(32, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(53, 2),
(54, 2),
(56, 2),
(57, 2),
(58, 2),
(12, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(52, 3),
(56, 3),
(57, 3),
(58, 3),
(27, 8),
(40, 8),
(41, 8),
(16, 9),
(29, 9),
(30, 9),
(39, 9),
(40, 9),
(41, 9),
(50, 9),
(51, 9),
(55, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_categories`
--

CREATE TABLE IF NOT EXISTS `service_categories` (
  `category_id` int(2) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`) VALUES
(2, 'Maquillaje Profesional'),
(3, 'Cuidados faciales'),
(6, 'Peluqueria');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_service_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `services_booked`
--
ALTER TABLE `services_booked`
  ADD CONSTRAINT `FK_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`),
  ADD CONSTRAINT `FK_SB_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_SB_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
