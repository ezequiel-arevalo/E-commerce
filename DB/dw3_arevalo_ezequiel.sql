-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2024 a las 16:40:38
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
-- Base de datos: `dw3_arevalo_ezequiel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `carrito_id` int(10) UNSIGNED NOT NULL,
  `usuarios_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`carrito_id`, `usuarios_id`) VALUES
(2, 1),
(4, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` tinyint(3) UNSIGNED NOT NULL,
  `categoria_nombre` varchar(15) NOT NULL
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
(1, 1, 4, 2, 0, 'Voopoo Drag 2 - Isla', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag ISLA es el dispositivo perfecto para aquellos que buscan un diseño elegante y una gran experiencia de vapeo! Con su estilo exclusivo y su rendimiento mejorado, este dispositivo es la combinación perfecta de moda y funcionalidad.', 100.26, '20230715174343_voopoo-drag-2-1.webp', 'Voopoo Drag 2 - Isla'),
(2, 1, 3, 2, 0, 'Voopoo Drag 2 - Fuego', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag FUEGO es el dispositivo perfecto para los amantes de la potencia y la intensidad! Con su aspecto imponente y su rendimiento mejorado, este dispositivo es la combinación perfecta de estilo y fuerza.', 100.00, '20230715174352_voopoo-drag-2-2.webp', 'Voopoo Drag 2 - Fuego'),
(3, 1, 1, 2, 0, 'Voopoo Drag 2 - Aurora', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Aurora es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo colorida y vibrante! Con su diseño dinámico y su rendimiento mejorado, este dispositivo es la combinación perfecta de diversión y rendimiento.', 100.05, '20230715174359_voopoo-drag-2-3.webp', 'Voopoo Drag 2 - Aurora'),
(4, 1, 2, 2, 0, 'Voopoo Drag 2 - Escarlata', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Escarlata es el dispositivo perfecto para aquellos que buscan un aspecto impresionante y un rendimiento excepcional! Con su estilo exclusivo y su potencia mejorada, este dispositivo es la combinación perfecta de forma y función.', 100.45, '20230715174405_voopoo-drag-2-4.webp', 'Voopoo Drag 2 - Aurora'),
(5, 1, 2, 2, 0, 'Voopoo Drag 2 - Nube de Fuego', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Nube de Fuego es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo intensa y emocionante! Con su aspecto ardiente y su rendimiento mejorado, este dispositivo es la combinación perfecta de fuego y fuerza.', 100.55, '20230715174412_voopoo-drag-2-5.webp', 'Voopoo Drag 2 - Nube de Fuego'),
(6, 1, 2, 2, 0, 'Voopoo Drag 2 - Rompecabezas', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Nube de Fuego es el dispositivo perfecto para aquellos que buscan una experiencia de vapeo intensa y emocionante! Con su aspecto ardiente y su rendimiento mejorado, este dispositivo es la combinación perfecta de fuego y fuerza.', 100.65, '20230715174419_voopoo-drag-2-6.webp', 'Voopoo Drag 2 - Rompecabezas'),
(7, 1, 2, 2, 0, 'Voopoo Drag 2 - Amanecer', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Amanecer es el dispositivo perfecto para los amantes del amanecer y los tonos cálidos! Con su aspecto impresionante y su rendimiento mejorado, este dispositivo es la combinación perfecta de forma y función.', 100.00, '20230715174424_voopoo-drag-2-7.webp', 'Voopoo Drag 2 - Amanecer'),
(8, 1, 1, 2, 0, 'Voopoo Drag 2 - Tinta', 'El Voopoo Drag 2 es un Kit de inicio de vapeo avanzado con una apariencia llamativa. Con una potencia máxima de salida de 177W y una variedad de modos de operación, este kit de inicio ofrece un rendimiento excepcional. Además, cuenta con el icónico diseño Drag y una batería dual 18650 (no incluida) para una mayor duración de la batería. El kit incluye el tanque UFORCE T2 con capacidad de 5ml y la bobina U2 y N3.', '¡El Voopoo Drag Tinta es el dispositivo perfecto para aquellos que buscan un estilo elegante y sofisticado! Con su diseño de tinta y su rendimiento mejorado, este dispositivo es la combinación perfecta de elegancia y potencia.', 99.99, '20230715174432_voopoo-drag-2-8.webp', 'Voopoo Drag 2 - Tinta'),
(79, 3, 4, 2, 0, 'Smok Pen 22', 'Sumérgete en una experiencia de vapeo excepcional con el Smok Pen 22. Descubre cómo este dispositivo potente y elegante eleva tus momentos de vapeo a nuevas alturas. Con un diseño compacto y ergonómico, este vapeador se adapta perfectamente a tu mano, brindándote horas de satisfacción sin esfuerzo.\r\n\r\nEl Smok Pen 22 ha sido diseñado pensando en tu comodidad y disfrute. Equipado con una batería de larga duración y un sistema de flujo de aire ajustable, te permite personalizar cada bocanada según tus preferencias. Disfruta de una experiencia duradera sin preocuparte por recargas frecuentes gracias a su capacidad de 2 ml de líquido.\r\n\r\nEste vapeador no solo te ofrece un rendimiento excepcional, sino que también produce nubes densas y sabrosas, realzando los matices de tus líquidos favoritos. Su construcción de alta calidad garantiza un vapeo confiable y duradero.\r\n\r\nTanto si eres un vapeador experimentado como si estás dando tus primeros pasos en el mundo del vapeo, el Smok Pen 22 es una elección inigualable. Descubre la comodidad, el sabor y el estilo con este dispositivo imprescindible para cualquier amante del vapeo.', 'Smok Pen 22. Un dispositivo compacto y poderoso que te brinda sabores intensos y nubes densas. Ideal para principiantes y intermedios', 20000.00, '20230725232350_colors-2.webp', ''),
(80, 3, 4, 2, 0, 'Smok Pen 22 (Light Edition)', 'Este Smok Pen 22 Light presenta un diseño elegante y compacto que se adapta cómodamente a tu mano, lo que lo convierte en el compañero perfecto para vapear sobre la marcha. Su tamaño portátil te permite llevarlo fácilmente en el bolsillo o en tu bolso, para disfrutar de un vapeo sin complicaciones en cualquier momento y lugar.\r\n\r\nEquipado con una batería integrada de 1650 mAh, el Smok Pen 22 Light Edition te proporciona una potencia constante y duradera para que puedas disfrutar de largas sesiones de vapeo sin preocupaciones. Además, cuenta con protecciones de seguridad avanzadas, como cortocircuito y protección de baja resistencia, para garantizar un vapeo seguro y fiable.\r\n\r\nEste dispositivo incluye un tanque de 2 ml de capacidad, lo que significa que puedes disfrutar de tus líquidos favoritos sin tener que recargar con frecuencia. Su sistema de flujo de aire ajustable te permite personalizar tu experiencia de vapeo, desde una calada más restrictiva para sabores intensos hasta una calada más abierta para producir densas nubes de vapor.\r\n\r\nPero lo que realmente destaca en el Smok Pen 22 Light Edition son las luces LED ubicadas en la parte inferior del dispositivo. Puedes elegir entre varios colores vibrantes y modos de iluminación, como el modo flash o el modo de respiración, para añadir un toque visual llamativo a tu vapeo. Estas luces LED se encienden con cada inhalación, creando una experiencia visualmente cautivadora y única.\r\n\r\nDisfruta de sabores intensos y nubes densas con el Smok Pen 22 Light Edition. Combina estilo, rendimiento y diversión en un solo dispositivo compacto y potente. ¡Sumérgete en el mundo del vapeo con este elegante dispositivo y vive una experiencia inigualable!', 'Smok Pen 22 Light Edition: Sabores intensos, nubes densas y luces LED coloridas para llamar la atención en un dispositivo compacto y potente.', 25000.50, '20230725232519_colors.webp', ''),
(81, 3, 2, 2, 0, 'Smok Stick V9', 'Este Smok Stick V9 está diseñado meticulosamente para ofrecerte potencia, portabilidad y un sabor inigualable en cada inhalación. Tanto si eres principiante como vapeador experimentado, este dispositivo te proporcionará una satisfacción incomparable.\r\n\r\nCon una batería integrada de alta capacidad, el Smok Stick V9 ofrece una potencia de salida de hasta 60 vatios, lo que te permitirá disfrutar de nubes densas y sabores intensos, brindándote una experiencia de vapeo realmente gratificante. Además, su diseño delgado y ergonómico se adapta perfectamente a tu mano, permitiéndote llevarlo contigo a cualquier lugar: en casa, en el trabajo o de viaje. Se convertirá en tu compañero perfecto para disfrutar de un vapeo placentero en todo momento.', 'Smok Stick V9 ofrece un vapeo potente y una capacidad de líquido generosa. Disfruta de una experiencia de vapeo excepcional con nubes densas.', 30000.25, '20230725232710_colors-1.webp', ''),
(82, 3, 4, 2, 0, 'Smok Stick Prince', 'El Smok Stick Prince es el dispositivo de vapeo ideal para aquellos que buscan un rendimiento excepcional y una experiencia de vapeo satisfactoria. Diseñado con los estándares más altos de calidad, este kit de inicio te brinda todo lo que necesitas para disfrutar al máximo del vapeo.\r\n\r\nCon un diseño elegante y ergonómico, el Smok Stick Prince se adapta cómodamente a tu mano y es fácil de transportar. Su batería de gran capacidad te garantiza una duración prolongada, lo que significa que podrás vapear durante más tiempo sin preocuparte por quedarte sin energía.\r\n\r\nEquipado con un tanque de 8 ml de capacidad, este dispositivo te permite disfrutar de un vapeo continuo sin necesidad de recargas frecuentes. Además, su sistema de flujo de aire ajustable te permite personalizar la cantidad de vapor y el sabor según tus preferencias.\r\n\r\nEl Smok Stick Prince también cuenta con una variedad de protecciones de seguridad integradas, como protección contra cortocircuitos, protección de baja resistencia y protección contra sobrecargas. Esto te brinda tranquilidad mientras disfrutas de tu experiencia de vapeo.\r\n\r\nNo dudes en elegirlo si buscas un kit de inicio de vapeo de alto rendimiento que combine con tu estilo tienes muchos tipos de colores y combinaciones de estilo desde colores simples, combinados y especiales y su durabilidad y una experiencia de vapeo satisfactoria del mismo. ¡Descubre la calidad y el rendimiento excepcional!', 'Smok Stick Prince: un vaper de alto rendimiento con diseño elegante, batería de gran capacidad y tanque de 8 ml. Experimenta lo duradero con este vaper', 28000.25, '20230725232813_colors-3.webp', ''),
(83, 3, 4, 2, 0, 'Smok Stick V8', 'El Smok Stick V8 cuente con una calidad y precisión, este dispositivo es ideal para aquellos que buscan un vapeo potente y satisfactorio.\r\n\r\nPotencia y rendimiento: Con una batería integrada de gran capacidad y una potencia de salida constante, el Smok Stick V8 ofrece una experiencia de vapeo potente y consistente. Disfruta de nubes densas y sabores intensos con cada inhalación.\r\n\r\nDiseño portátil y fácil de usar: El Smok Stick V8 cuenta con un diseño ergonómico y compacto, lo que lo hace cómodo de sostener y fácil de llevar contigo a todas partes. Su botón de un solo clic permite un uso sencillo y sin complicaciones.\r\n\r\nTanque de 5 ml de capacidad: Equipado con un tanque de gran capacidad, el Smok Stick V8 te permite disfrutar de sesiones de vapeo prolongadas sin la necesidad de recargas constantes. Su diseño de llenado superior facilita el proceso de recarga de líquido, con este dispositivo los usuarios principiantes e intermedios pueden aprender todos los vape tricks que deseen sin tener problemas con la capacidad del tanque, batería y el humo que requieran.\r\n\r\nResistencias de alto rendimiento: El dispositivo utiliza resistencias de alta calidad que garantizan un calentamiento rápido y una producción de vapor suave y consistente. Experimenta un sabor puro y una satisfactoria liberación de vapor con cada vapeo.\r\n\r\nProtecciones de seguridad: El dispositivo cuenta con múltiples protecciones de seguridad, incluyendo protección contra cortocircuitos y protección contra el uso excesivo. Esto asegura un vapeo seguro y confiable en todo momento.', 'Smok Stick V8: dispositivo de alto rendimiento con potencia constante. Disfruta de un vapeo potente y satisfactorio en cualquier momento.', 19550.99, '20230725232856_colors-4.webp', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_en_carrito`
--

CREATE TABLE `productos_en_carrito` (
  `productos_id` int(10) UNSIGNED NOT NULL,
  `carrito_id` int(10) UNSIGNED NOT NULL,
  `usuarios_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 1, 'test@gmail.com', '$2y$10$k7Qjekb8TOjjPrebhc9XmeNoyLHBQU3WQeakSqyfwWKt3ygmTCZca', 'Tester Usere'),
(47, 2, 'FlowFugaz@gmail.com', '$2y$10$LyYvqcGq2c3Fi9siCxsPo.TWOnqVF2YQSaOXcxc2Wwoxt7UwgMIii', 'FlowFugaz@gmail.com'),
(48, 2, 'asdasd@gmail.com', '$2y$10$xrotVxnar7PCH7Zt950nb.Gg1bBtJU2d/cn0lDjo06748z2aeB1WC', 'asdasd@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`carrito_id`,`usuarios_id`),
  ADD KEY `fk_carrito_usuarios1_idx` (`usuarios_id`);

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
  ADD KEY `fk_productos_estados_publicacion1_idx` (`estados_publicacion_fk`),
  ADD KEY `fk_productos_precio_simbolo1_idx` (`precio_simbolo_fk`),
  ADD KEY `fk_productos_productos_categorias1_idx` (`categorias_fk`);

--
-- Indices de la tabla `productos_en_carrito`
--
ALTER TABLE `productos_en_carrito`
  ADD PRIMARY KEY (`productos_id`,`carrito_id`,`usuarios_id`),
  ADD KEY `fk_productos_has_carrito_carrito1_idx` (`carrito_id`,`usuarios_id`),
  ADD KEY `fk_productos_has_carrito_productos1_idx` (`productos_id`);

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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `carrito_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `productos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_estados_publicacion1` FOREIGN KEY (`estados_publicacion_fk`) REFERENCES `estados_publicacion` (`estado_publicacion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_precio_simbolo1` FOREIGN KEY (`precio_simbolo_fk`) REFERENCES `precio_simbolo` (`precio_simbolo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_productos_categorias1` FOREIGN KEY (`categorias_fk`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`usuario_fk`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_en_carrito`
--
ALTER TABLE `productos_en_carrito`
  ADD CONSTRAINT `fk_productos_has_carrito_carrito1` FOREIGN KEY (`carrito_id`,`usuarios_id`) REFERENCES `carrito` (`carrito_id`, `usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_carrito_productos1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`productos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles1` FOREIGN KEY (`roles_fk`) REFERENCES `roles` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
