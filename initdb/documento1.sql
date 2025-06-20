-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2025 a las 00:28:37
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
-- Base de datos: `documento1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_tipo_proceso` int(11) DEFAULT NULL,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `titulo`, `descripcion`, `fecha_creacion`, `id_tipo_documento`, `id_tipo_proceso`, `id_usuario_creador`, `archivo`) VALUES
(1, 'documento 1', 'es un documento de trato personal', '2025-06-04', NULL, NULL, 3, NULL),
(2, 'est es', 'ya que', '2025-06-04', NULL, NULL, 3, NULL),
(3, 'este haber', 'jhon elvis', '2025-06-04', NULL, NULL, 3, NULL),
(4, 'haber si o no', 'pr fa', '2025-06-04', NULL, NULL, 3, 'documentos/1749017276_Duolingo.jpeg'),
(5, 'si se logro', 'vamos', '2025-06-04', NULL, NULL, 2, 'documentos/1749018022_Writing Informative or Explanatory Texts English Presentation in Colorful Pastel Doodle Style (1).pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_documento`
--

CREATE TABLE `estados_documento` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas_digitales`
--

CREATE TABLE `firmas_digitales` (
  `id_firma` int(11) NOT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `id_usuario_firmante` int(11) DEFAULT NULL,
  `firma_hash` text NOT NULL,
  `fecha_firma` datetime NOT NULL,
  `observaciones` text DEFAULT NULL,
  `correo_enviado` tinyint(1) DEFAULT 0,
  `fecha_envio_correo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estado`
--

CREATE TABLE `historial_estado` (
  `id_historial` int(11) NOT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_cambio` datetime NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `nombre_documento` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_proceso`
--

CREATE TABLE `tipos_proceso` (
  `id_tipo_proceso` int(11) NOT NULL,
  `nombre_proceso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id_ubicacion` int(11) NOT NULL,
  `nombre_ubicacion` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_documento`
--

CREATE TABLE `ubicacion_documento` (
  `id_ubicacion_doc` int(11) NOT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo_electronico` varchar(150) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo_electronico`, `rol`, `dni`, `password`) VALUES
(1, 'Admin', 'Principal', 'admin@demo.com', 'admin', '12345678', '$2y$12$AjNwwEF1HeQ4stACLbNLZebgBn/howdygQj0FOnNDmcWa6qKDWsh2'),
(2, 'Usuario', 'Regular', 'usuario@demo.com', 'usuario', '87654321', '$2y$12$LUdc7QI0qd919238bS2wDuY1H40fXyosbd/AOfufL8wvgna.AX9rC'),
(3, 'jhon', 'sihuayro', 'jhon@gmail.com', 'usuario', '75573542', '$2y$12$4nprreQcPtOzzRUYd3Bgx.4vUtQ1F7kNRYJ3ra.YK9a72aGrqFHwa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`),
  ADD KEY `id_tipo_proceso` (`id_tipo_proceso`),
  ADD KEY `id_usuario_creador` (`id_usuario_creador`);

--
-- Indices de la tabla `estados_documento`
--
ALTER TABLE `estados_documento`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `firmas_digitales`
--
ALTER TABLE `firmas_digitales`
  ADD PRIMARY KEY (`id_firma`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_usuario_firmante` (`id_usuario_firmante`);

--
-- Indices de la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipos_proceso`
--
ALTER TABLE `tipos_proceso`
  ADD PRIMARY KEY (`id_tipo_proceso`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `ubicacion_documento`
--
ALTER TABLE `ubicacion_documento`
  ADD PRIMARY KEY (`id_ubicacion_doc`),
  ADD KEY `id_documento` (`id_documento`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_documento`
--
ALTER TABLE `estados_documento`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmas_digitales`
--
ALTER TABLE `firmas_digitales`
  MODIFY `id_firma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_proceso`
--
ALTER TABLE `tipos_proceso`
  MODIFY `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicacion_documento`
--
ALTER TABLE `ubicacion_documento`
  MODIFY `id_ubicacion_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documento` (`id_tipo_documento`),
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`id_tipo_proceso`) REFERENCES `tipos_proceso` (`id_tipo_proceso`),
  ADD CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `firmas_digitales`
--
ALTER TABLE `firmas_digitales`
  ADD CONSTRAINT `firmas_digitales_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`),
  ADD CONSTRAINT `firmas_digitales_ibfk_2` FOREIGN KEY (`id_usuario_firmante`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
  ADD CONSTRAINT `historial_estado_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`),
  ADD CONSTRAINT `historial_estado_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados_documento` (`id_estado`);

--
-- Filtros para la tabla `ubicacion_documento`
--
ALTER TABLE `ubicacion_documento`
  ADD CONSTRAINT `ubicacion_documento_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`),
  ADD CONSTRAINT `ubicacion_documento_ibfk_2` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicaciones` (`id_ubicacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
