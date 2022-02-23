-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2022 a las 17:33:25
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectobiblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `titulo`, `autor`, `url`) VALUES
(5, 'Babel Dos ', ' Juan Jose Plans', 'Babel-Dos-Juan-Jose-Plans-6213bafd2deaa.epub'),
(8, 'libro1', 'autor1', 'libro1'),
(9, 'libro2', 'autor2', 'libro2'),
(10, 'A contraluz ', ' Rachel Cusk', 'A-contraluz-Rachel-Cusk-621656956a397.epub'),
(11, 'A ciegas ', ' Claudio Magris', 'A-ciegas-Claudio-Magris-6216578286703.epub'),
(12, 'A flor de piel ', ' Javier Moro', 'A-flor-de-piel-Javier-Moro-621657829937a.epub'),
(13, 'A Higher Loyalty ', ' James Comey', 'A-Higher-Loyalty-James-Comey-621657829bf61.epub'),
(14, 'Bajos fondos', 'Vachss, Andrew', 'Bajos-fondos-Vachss-Andrew-621658f623441.epub'),
(15, 'Belfondo ', ' Jenn Diaz', 'Belfondo-Jenn-Diaz-62165975dd90e.epub'),
(16, 'Belgravia ', ' Julian Fellowes ', 'Belgravia-Julian-Fellowes-35062-spa-62165975ec878.epub'),
(17, 'Belleza al natural ', ' Margarita Chavez Martínez', 'Belleza-al-natural-Margarita-Chavez-Martinez-62165976154c2.epub');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
