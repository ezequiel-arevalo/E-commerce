-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2023 a las 21:38:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dw3_arevalo_ezequiel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` tinyint(3) UNSIGNED NOT NULL,
  `categoria_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_nombre`) VALUES
(1, 'no definido'),
(2, 'Mod'),
(3, 'Pod'),
(4, 'Pen'),
(5, 'Desechables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_publicacion`
--

CREATE TABLE `estados_publicacion` (
  `estado_publicacion_id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_publicacion`
--

INSERT INTO `estados_publicacion` (`estado_publicacion_id`, `nombre`) VALUES
(1, 'Drag'),
(2, 'Publicado'),
(3, 'Deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_simbolo`
--

CREATE TABLE `precio_simbolo` (
  `precio_simbolo_id` tinyint(3) UNSIGNED NOT NULL,
  `precio_simbolo_nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precio_simbolo`
--

INSERT INTO `precio_simbolo` (`precio_simbolo_id`, `precio_simbolo_nombre`) VALUES
(0, '$'),
(1, 'u$d'),
(2, '€'),
(3, '₤'),
(4, '£'),
(5, '¥'),
(6, '฿');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productos_id` int(10) UNSIGNED NOT NULL,
  `usuario_fk` int(10) UNSIGNED NOT NULL,
  `categorias_fk` tinyint(3) UNSIGNED NOT NULL,
  `estados_publicacion_fk` tinyint(3) UNSIGNED NOT NULL,
  `precio_simbolo_fk` tinyint(3) UNSIGNED NOT NULL,
  `productos_title` varchar(100) NOT NULL,
  `productos_description` text NOT NULL,
  `productos_sinopsis` varchar(255) NOT NULL,
  `productos_price` decimal(10,2) NOT NULL,
  `productos_img` varchar(120) DEFAULT NULL,
  `productos_img_alt` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productos_id`, `usuario_fk`, `categorias_fk`, `estados_publicacion_fk`, `precio_simbolo_fk`, `productos_title`, `productos_description`, `productos_sinopsis`, `productos_price`, `productos_img`, `productos_img_alt`) VALUES
(1, 1, 4, 2, 2, 'Voopoo Drag 2 - Isla', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag ISLA es el dispositivo perfecto para aquellos que buscan un diseño elegante y una gran experiencia de vapeo! Con su estilo exclusivo y su rendimiento mejorado, este dispositivo es la combinación perfecta de moda y funcionalidad.', 100.26, '20230715174343_voopoo-drag-2-1.webp', 'Voopoo Drag 2 - Isla'),
(2, 1, 3, 2, 6, 'Voopoo Drag 2 - Fuego', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag FUEGO es el dispositivo perfecto para los amantes de la potencia y la intensidad! Con su aspecto imponente y su rendimiento mejorado, este dispositivo es la combinación perfecta de estilo y fuerza.', 100.00, '20230715174352_voopoo-drag-2-2.webp', 'Voopoo Drag 2 - Fuego'),
(3, 1, 1, 2, 5, 'Voopoo Drag 2 - Aurora', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Aurora es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo colorida y vibrante! Con su diseño dinámico y su rendimiento mejorado, este dispositivo es la combinación perfecta de diversión y rendimiento.', 100.05, '20230715174359_voopoo-drag-2-3.webp', 'Voopoo Drag 2 - Aurora'),
(4, 1, 2, 2, 3, 'Voopoo Drag 2 - Escarlata', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Escarlata es el dispositivo perfecto para aquellos que buscan un aspecto impresionante y un rendimiento excepcional! Con su estilo exclusivo y su potencia mejorada, este dispositivo es la combinación perfecta de forma y función.', 100.45, '20230715174405_voopoo-drag-2-4.webp', 'Voopoo Drag 2 - Aurora'),
(5, 1, 2, 2, 1, 'Voopoo Drag 2 - Nube de Fuego', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Nube de Fuego es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo intensa y emocionante! Con su aspecto ardiente y su rendimiento mejorado, este dispositivo es la combinación perfecta de fuego y fuerza.', 100.55, '20230715174412_voopoo-drag-2-5.webp', 'Voopoo Drag 2 - Nube de Fuego'),
(6, 1, 2, 2, 0, 'Voopoo Drag 2 - Rompecabezas', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Nube de Fuego es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo intensa y emocionante! Con su aspecto ardiente y su rendimiento mejorado, este dispositivo es la combinación perfecta de fuego y fuerza.', 100.65, '20230715174419_voopoo-drag-2-6.webp', 'Voopoo Drag 2 - Rompecabezas'),
(7, 1, 2, 2, 4, 'Voopoo Drag 2 - Amanecer', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Amanecer es el dispositivo perfecto para los amantes del amanecer y los tonos cálidos! Con su aspecto impresionante y su rendimiento mejorado, este dispositivo es la combinación perfecta de forma y función.', 100.00, '20230715174424_voopoo-drag-2-7.webp', 'Voopoo Drag 2 - Amanecer'),
(8, 1, 1, 2, 0, 'Voopoo Drag 2 - Tinta', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Tinta es el dispositivo perfecto para aquellos que buscan un estilo elegante y sofisticado! Con su diseño de tinta y su rendimiento mejorado, este dispositivo es la combinación perfecta de elegancia y potencia.', 99.99, '20230715174432_voopoo-drag-2-8.webp', 'Voopoo Drag 2 - Tinta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(10) UNSIGNED NOT NULL,
  `roles_fk` tinyint(3) UNSIGNED NOT NULL,
  `usuarios_email` varchar(255) NOT NULL,
  `usuarios_password` varchar(255) NOT NULL,
  `usuarios_username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `roles_fk`, `usuarios_email`, `usuarios_password`, `usuarios_username`) VALUES
(1, 1, 'ezequiel.arevalo@davinci.edu.ar', '$2y$10$k7Qjekb8TOjjPrebhc9XmeNoyLHBQU3WQeakSqyfwWKt3ygmTCZca', 'Ezequiel Thomas Arevalo'),
(3, 1, 'test@gmail.com', '$2y$10$k7Qjekb8TOjjPrebhc9XmeNoyLHBQU3WQeakSqyfwWKt3ygmTCZca', 'Tester User');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `estados_publicacion`
--
ALTER TABLE `estados_publicacion`
  ADD PRIMARY KEY (`estado_publicacion_id`);

--
-- Indices de la tabla `precio_simbolo`
--
ALTER TABLE `precio_simbolo`
  ADD PRIMARY KEY (`precio_simbolo_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productos_id`),
  ADD KEY `fk_productos_usuarios_idx` (`usuario_fk`),
  ADD KEY `fk_productos_categorias1_idx` (`categorias_fk`),
  ADD KEY `fk_productos_estados_publicacion1_idx` (`estados_publicacion_fk`),
  ADD KEY `fk_productos_precio_simbolo1_idx` (`precio_simbolo_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`),
  ADD UNIQUE KEY `usuarios_email_UNIQUE` (`usuarios_email`),
  ADD KEY `fk_usuarios_roles1_idx` (`roles_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_publicacion`
--
ALTER TABLE `estados_publicacion`
  MODIFY `estado_publicacion_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`categorias_fk`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_estados_publicacion1` FOREIGN KEY (`estados_publicacion_fk`) REFERENCES `estados_publicacion` (`estado_publicacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_precio_simbolo1` FOREIGN KEY (`precio_simbolo_fk`) REFERENCES `precio_simbolo` (`precio_simbolo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_fk`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
