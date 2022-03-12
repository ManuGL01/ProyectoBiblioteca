-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2022 a las 20:33:56
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

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
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `aprobado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `autor_id`, `libro_id`, `comentario`, `fecha_publicacion`, `aprobado`) VALUES
(1, 2, 5, 'HELLO THERE', '2022-03-09 16:50:40', 1),
(2, 2, 10, 'asd', '2022-03-11 18:06:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviatura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edicion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `abreviatura`, `edicion`) VALUES
(1, 'curso1', 'c1', '21/22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220221155704', '2022-02-21 17:16:39', 4658);

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
(10, 'A contraluz ', ' Rachel Cusk', 'A-contraluz-Rachel-Cusk-621656956a397.epub'),
(12, 'A flor de piel ', ' Javier Moro', 'A-flor-de-piel-Javier-Moro-621657829937a.epub'),
(13, 'A Higher Loyalty ', ' James Comey', 'A-Higher-Loyalty-James-Comey-621657829bf61.epub'),
(14, 'Bajos fondos', 'Vachss, Andrew', 'Bajos-fondos-Vachss-Andrew-621658f623441.epub'),
(15, 'Belfondo ', ' Jenn Diaz', 'Belfondo-Jenn-Diaz-62165975dd90e.epub'),
(16, 'Belgravia ', ' Julian Fellowes ', 'Belgravia-Julian-Fellowes-35062-spa-62165975ec878.epub'),
(17, 'Belleza al natural ', ' Margarita Chavez Martínez', 'Belleza-al-natural-Margarita-Chavez-Martinez-62165976154c2.epub');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `curso_id`, `username`, `roles`, `password`, `dni`, `email`) VALUES
(2, 1, 'admin', '[\"ALUMNO\",\"ROLE_ADMIN\"]', '$2y$13$DxZPX0EgrrNlq8TggPoIouSLfE6vJIh0mbdTyLhRtVv/HZ5MCXMXC', '11111111a', 'admin@admin.com'),
(3, 1, 'user1', '[\"ALUMNO\"]', '$2y$13$QGk8HINRTFkRAdGA.1mDPeHUKp0QFNwuMXWzWPK.nWzTHQYC0GRp2', '11111111b', 'user1@user11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_libro`
--

CREATE TABLE `user_libro` (
  `user_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id` int(11) NOT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `libro_id` int(11) DEFAULT NULL,
  `puntuacion` double NOT NULL,
  `fecha_publicacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id`, `autor_id`, `libro_id`, `puntuacion`, `fecha_publicacion`) VALUES
(1, 2, 5, 4, '2022-03-09 19:39:48'),
(3, 3, 5, 3, '2022-03-09 19:40:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B91E70214D45BBE` (`autor_id`),
  ADD KEY `IDX_4B91E702C0238522` (`libro_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D64987CB4A1F` (`curso_id`);

--
-- Indices de la tabla `user_libro`
--
ALTER TABLE `user_libro`
  ADD PRIMARY KEY (`user_id`,`libro_id`),
  ADD KEY `IDX_B55B5673A76ED395` (`user_id`),
  ADD KEY `IDX_B55B5673C0238522` (`libro_id`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6D3DE0F414D45BBE` (`autor_id`),
  ADD KEY `IDX_6D3DE0F4C0238522` (`libro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E70214D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_4B91E702C0238522` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64987CB4A1F` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`);

--
-- Filtros para la tabla `user_libro`
--
ALTER TABLE `user_libro`
  ADD CONSTRAINT `FK_B55B5673A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B55B5673C0238522` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `FK_6D3DE0F414D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6D3DE0F4C0238522` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
