-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2025 a las 22:07:09
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
(9, 'laymir', 'chivo', '2025-06-23', 3, 3, 2, 'documentos/1750653545_PRODUCT_DIGITAL_1.pdf'),
(10, 'haber', 'ss', '2025-06-23', 4, 1, 3, 'documentos/1750659267_METODOLOGIA_CRISP_DM.pdf'),
(11, 'haber s', 'ss', '2025-06-23', 8, 1, 3, 'documentos/1750659865_Metodologia_SEMMA_mio.pdf'),
(12, 'asd', 'sad', '2025-06-23', 9, 3, 2, 'documentos/1750661475_Presentación Diapositivas Propuesta de Proyecto Creativo Doodle Rosa y Violeta.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_documento`
--

CREATE TABLE `estados_documento` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_documento`
--

INSERT INTO `estados_documento` (`id_estado`, `nombre_estado`) VALUES
(1, 'Enviado'),
(2, 'En Proceso'),
(3, 'Rechazado'),
(4, 'Finalizado');

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
-- Estructura de tabla para la tabla `flujos_proceso`
--

CREATE TABLE `flujos_proceso` (
  `id_flujo` int(11) NOT NULL,
  `id_tipo_proceso` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `flujos_proceso`
--

INSERT INTO `flujos_proceso` (`id_flujo`, `id_tipo_proceso`, `id_ubicacion`, `orden`) VALUES
(1, 1, 1, 1),
(2, 1, 5, 2),
(3, 1, 4, 3),
(4, 1, 2, 4),
(5, 1, 10, 5),
(6, 1, 1, 6),
(7, 2, 1, 1),
(8, 2, 4, 2),
(9, 2, 9, 3),
(10, 2, 2, 4),
(11, 2, 10, 5),
(12, 2, 1, 6),
(13, 3, 1, 1),
(14, 3, 6, 2),
(15, 3, 9, 3),
(16, 3, 2, 4),
(17, 3, 10, 5),
(18, 3, 1, 6),
(19, 4, 1, 1),
(20, 4, 3, 2),
(21, 4, 4, 3),
(22, 4, 9, 4),
(23, 4, 2, 5),
(24, 4, 10, 6),
(25, 4, 1, 7),
(26, 5, 1, 1),
(27, 5, 8, 2),
(28, 5, 7, 3),
(29, 5, 9, 4),
(30, 5, 10, 5),
(31, 5, 1, 6);

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

--
-- Volcado de datos para la tabla `historial_estado`
--

INSERT INTO `historial_estado` (`id_historial`, `id_documento`, `id_estado`, `fecha_cambio`, `observaciones`) VALUES
(1, 11, 2, '2025-06-23 06:36:53', 'Cambio automático por avance de ubicación.'),
(2, 11, 2, '2025-06-23 06:36:58', 'Cambio automático por avance de ubicación.'),
(3, 11, 2, '2025-06-23 06:37:01', 'Cambio automático por avance de ubicación.'),
(4, 11, 4, '2025-06-23 06:37:03', 'Cambio automático por avance de ubicación.'),
(5, 11, 1, '2025-06-23 06:37:06', 'Cambio automático por avance de ubicación.'),
(6, 11, 2, '2025-06-23 06:37:11', 'Cambio automático por avance de ubicación.'),
(7, 11, 2, '2025-06-23 06:41:33', 'Cambio automático por avance de ubicación.'),
(8, 11, 2, '2025-06-23 06:41:42', 'Cambio automático por avance de ubicación.'),
(9, 11, 4, '2025-06-23 06:41:44', 'Cambio automático por avance de ubicación.'),
(10, 11, 1, '2025-06-23 06:41:47', 'Cambio automático por avance de ubicación.'),
(11, 11, 2, '2025-06-23 06:41:51', 'Cambio automático por avance de ubicación.'),
(12, 11, 2, '2025-06-23 06:41:55', 'Cambio automático por avance de ubicación.'),
(13, 11, 2, '2025-06-23 06:41:56', 'Cambio automático por avance de ubicación.'),
(14, 11, 3, '2025-06-23 06:42:03', 'Rechazado por el administrador'),
(15, 11, 4, '2025-06-23 06:42:07', 'Cambio automático por avance de ubicación.'),
(16, 11, 3, '2025-06-23 06:42:16', 'Rechazado por el administrador'),
(17, 11, 1, '2025-06-23 06:42:58', 'Cambio automático por avance de ubicación.'),
(18, 9, 2, '2025-06-23 06:43:53', 'Cambio automático por avance de ubicación.'),
(19, 11, 2, '2025-06-23 06:50:20', 'Cambio automático por avance de ubicación.'),
(20, 11, 2, '2025-06-23 06:50:24', 'Cambio automático por avance de ubicación.'),
(21, 11, 2, '2025-06-23 06:50:28', 'Cambio automático por avance de ubicación.'),
(22, 11, 4, '2025-06-23 06:50:31', 'Cambio automático por avance de ubicación.'),
(23, 11, 1, '2025-06-23 06:50:34', 'Cambio automático por avance de ubicación.'),
(24, 11, 2, '2025-06-23 06:50:36', 'Cambio automático por avance de ubicación.'),
(25, 12, 1, '2025-06-23 06:51:15', 'Documento creado y enviado desde Mesa de Partes'),
(26, 12, 2, '2025-06-23 06:51:23', 'Cambio automático por avance de ubicación.'),
(27, 12, 2, '2025-06-23 06:51:27', 'Cambio automático por avance de ubicación.'),
(28, 12, 2, '2025-06-23 06:51:29', 'Cambio automático por avance de ubicación.'),
(29, 12, 4, '2025-06-23 06:51:32', 'Cambio automático por avance de ubicación.'),
(30, 12, 1, '2025-06-23 06:51:35', 'Cambio automático por avance de ubicación.'),
(31, 12, 2, '2025-06-23 06:51:44', 'Cambio automático por avance de ubicación.'),
(32, 12, 3, '2025-06-23 06:51:53', 'Rechazado por el administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

CREATE TABLE `tipos_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `nombre_documento` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_documento`
--

INSERT INTO `tipos_documento` (`id_tipo_documento`, `nombre_documento`, `descripcion`) VALUES
(1, 'Solicitud', NULL),
(2, 'Informe Técnico', NULL),
(3, 'Memorándum', NULL),
(4, 'Resolución', NULL),
(5, 'Acta', NULL),
(6, 'Oficio', NULL),
(7, 'Carta', NULL),
(8, 'Reclamo', NULL),
(9, 'Permiso', NULL),
(10, 'Denuncia', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_proceso`
--

CREATE TABLE `tipos_proceso` (
  `id_tipo_proceso` int(11) NOT NULL,
  `nombre_proceso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_proceso`
--

INSERT INTO `tipos_proceso` (`id_tipo_proceso`, `nombre_proceso`, `descripcion`) VALUES
(1, 'Licencia de Funcionamiento', NULL),
(2, 'Solicitud de Constancia de Posesión', NULL),
(3, 'Emisión de Resoluciones', NULL),
(4, 'Permisos de Construcción', NULL),
(5, 'Atención de Quejas y Reclamos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id_ubicacion` int(11) NOT NULL,
  `nombre_ubicacion` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id_ubicacion`, `nombre_ubicacion`, `descripcion`) VALUES
(1, 'Mesa de Partes', NULL),
(2, 'Oficina de Secretaría General', NULL),
(3, 'Gerencia de Obras', NULL),
(4, 'Gerencia de Desarrollo Urbano', NULL),
(5, 'Gerencia de Rentas', NULL),
(6, 'Gerencia de Desarrollo Social', NULL),
(7, 'Oficina de Imagen Institucional', NULL),
(8, 'Gerencia de Servicios Públicos', NULL),
(9, 'Asesoría Legal', NULL),
(10, 'Alcaldía', NULL);

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

--
-- Volcado de datos para la tabla `ubicacion_documento`
--

INSERT INTO `ubicacion_documento` (`id_ubicacion_doc`, `id_documento`, `id_ubicacion`, `fecha_registro`) VALUES
(1, 9, 1, '2025-06-23 04:39:05'),
(2, 9, 4, '2025-06-23 06:01:22'),
(3, 9, 9, '2025-06-23 06:01:28'),
(4, 9, 2, '2025-06-23 06:01:31'),
(5, 9, 10, '2025-06-23 06:01:33'),
(6, 9, 1, '2025-06-23 06:01:35'),
(7, 9, 4, '2025-06-23 06:01:38'),
(8, 9, 9, '2025-06-23 06:15:23'),
(9, 11, 1, '2025-06-23 06:24:25'),
(10, 11, 5, '2025-06-23 06:36:53'),
(11, 11, 4, '2025-06-23 06:36:58'),
(12, 11, 2, '2025-06-23 06:37:01'),
(13, 11, 10, '2025-06-23 06:37:03'),
(14, 11, 1, '2025-06-23 06:37:06'),
(15, 11, 5, '2025-06-23 06:37:11'),
(16, 11, 4, '2025-06-23 06:41:33'),
(17, 11, 2, '2025-06-23 06:41:42'),
(18, 11, 10, '2025-06-23 06:41:44'),
(19, 11, 1, '2025-06-23 06:41:47'),
(20, 11, 5, '2025-06-23 06:41:50'),
(21, 11, 4, '2025-06-23 06:41:55'),
(22, 11, 2, '2025-06-23 06:41:56'),
(23, 11, 10, '2025-06-23 06:42:07'),
(24, 11, 1, '2025-06-23 06:42:58'),
(25, 9, 2, '2025-06-23 06:43:53'),
(26, 11, 5, '2025-06-23 06:50:20'),
(27, 11, 4, '2025-06-23 06:50:24'),
(28, 11, 2, '2025-06-23 06:50:28'),
(29, 11, 10, '2025-06-23 06:50:31'),
(30, 11, 1, '2025-06-23 06:50:34'),
(31, 11, 5, '2025-06-23 06:50:36'),
(32, 12, 1, '2025-06-23 06:51:15'),
(33, 12, 6, '2025-06-23 06:51:23'),
(34, 12, 9, '2025-06-23 06:51:27'),
(35, 12, 2, '2025-06-23 06:51:29'),
(36, 12, 10, '2025-06-23 06:51:32'),
(37, 12, 1, '2025-06-23 06:51:35'),
(38, 12, 6, '2025-06-23 06:51:44');

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
-- Indices de la tabla `flujos_proceso`
--
ALTER TABLE `flujos_proceso`
  ADD PRIMARY KEY (`id_flujo`),
  ADD KEY `id_tipo_proceso` (`id_tipo_proceso`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

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
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estados_documento`
--
ALTER TABLE `estados_documento`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `firmas_digitales`
--
ALTER TABLE `firmas_digitales`
  MODIFY `id_firma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `flujos_proceso`
--
ALTER TABLE `flujos_proceso`
  MODIFY `id_flujo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `historial_estado`
--
ALTER TABLE `historial_estado`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tipos_documento`
--
ALTER TABLE `tipos_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_proceso`
--
ALTER TABLE `tipos_proceso`
  MODIFY `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ubicacion_documento`
--
ALTER TABLE `ubicacion_documento`
  MODIFY `id_ubicacion_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Filtros para la tabla `flujos_proceso`
--
ALTER TABLE `flujos_proceso`
  ADD CONSTRAINT `flujos_proceso_ibfk_1` FOREIGN KEY (`id_tipo_proceso`) REFERENCES `tipos_proceso` (`id_tipo_proceso`),
  ADD CONSTRAINT `flujos_proceso_ibfk_2` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicaciones` (`id_ubicacion`);

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
