-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-05-2018 a las 11:10:22
-- Versión del servidor: 5.7.21
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ajaximagenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE IF NOT EXISTS `imagenes` (
  `id` int(11) NOT NULL,
  `nombreImgBD` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `nombreImgBD`) VALUES
(1, '2017-caliente-vaiana-M-2018-05-24_07-06-44.jpg'),
(2, '10pcs-set-Moana-Maui-Chief-Tui-Sina-5-10cm-vaiana-Action-Figures-Gramma-Tala-Heihei-Statue-2018-05-21_20-11-57-2018-05-24_06-52-05.jpg'),
(3, 'perro-se-comunica-contigo-2018-05-24_07-05-27.jpg'),
(4, '2017-caliente-vaiana-M-2018-05-21_20-11-57-2018-05-24_06-52-05.jpg'),
(5, '461074787677-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(6, '461075660177-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(7, '6201-vaiana-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(8, 'c7520e61c7bd72bba90f1db18b675c5d-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(9, 'CARTEL-VAIANA-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(10, 'conjunto-de-delantal-gorro-vaiana-azul-chica-vu405_1_zc1-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(11, 'critica-vaiana-maui-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(12, 'CzUl2QTWEAAqbDu-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(13, 'd9275f245dcd10d1b55c5913dc4513fe-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(14, 'DI_hero_Moana_easter-eggs-2-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(15, 'download-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(16, 'e957e0be023d3af107e98caf5c6da007-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(17, 'elenadeavalor556756-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(18, 'FDADF-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(19, 'figura-funko-pop-vinyl-disney-vaiana-abuela-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(20, 'francisco-velasquez-pdvsa-Sism-logo-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(21, 'funko-pop-disney-213-moana-pua-vaiana-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(22, 'gallo-2018-05-19_20-38-55-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(23, 'gallo-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(24, 'how_far_i_ll_go___moana_vaiana_by_milaookami-dasdjid-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(25, 'images-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(26, 'La-escena-eliminada-de-Vaiana-en-la-que-conoce-a-su-mascota-de-bebe_landscape-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(27, 'La-escena-eliminada-de-Vaiana-en-la-que-conoce-a-su-mascota-de-bebe_reference-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(28, 'los-cuentos-de-vaiana-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(29, 'maxresdefault-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(30, 'MOANA-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(31, 'moana-haosul-kakamora-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(32, 'Moana-la-nueva-princesa-de-Disney-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(33, 'ninos-brave-01-z-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(34, 'protagonista-proxima-pelicula-dibujos-animados-disney-moana-espana-vaiana-1479581312531-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(35, 's-l300-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(36, 'vaiana moana disney princess princesa oceania 2016 critica clasico parents padres family familia tui sina madre padre father mother dad mom-2018-05-21_20-11-58-2018-05-24_06-52-05.png'),
(37, 'vaiana-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(38, 'vaiana-5-2018-05-21_20-11-58-2018-05-24_06-52-05.jpg'),
(39, 'vaiana-arte-conceptual-ryan-lang-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(40, 'vaiana-disney-pic-pxl2-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(41, 'Vaiana-la-nueva-princesa-Disney-sera-una-heroina-sin-principe_landscape-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(42, 'Vaiana-la-nueva-princesa-Disney-sera-una-heroina-sin-principe_reference-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(43, 'vaiana-moana-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(44, 'VaianaImagen5Critica-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(45, 'vaianaPanda-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(46, 'vaiana_moana_premiere_high_013-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(47, 'vbebe-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg'),
(48, 'wallhave-2018-05-21_20-11-59-2018-05-24_06-52-05.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
