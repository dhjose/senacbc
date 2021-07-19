-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2021 a las 00:18:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `ID_Centro` int(11) NOT NULL,
  `Centro` varchar(45) NOT NULL,
  `Telefono` double DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `Ciudad_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`ID_Centro`, `Centro`, `Telefono`, `Direccion`, `Ciudad_ID`) VALUES
(1, 'Biotecnologico del Caribe', 355587342, 'Km 7 Vía a la Paz', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_tiene_dependencia`
--

CREATE TABLE `centro_tiene_dependencia` (
  `ID_Centro_tiene_dependencia` int(11) NOT NULL,
  `Centro_ID` int(11) NOT NULL,
  `Dependencia_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_Ciudad` int(11) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Departamento_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_Ciudad`, `Ciudad`, `Departamento_ID`) VALUES
(1, 'Valledupar', 1),
(2, 'Aguachica', 1),
(3, 'Agustin Codazzi', 1),
(4, 'San Diego', 1),
(5, 'La Paz', 1),
(6, 'Manaure Balcón del Cesar', 1),
(7, 'San Alberto', 1),
(8, 'San Martín', 1),
(9, 'San Martín', 1),
(10, 'San Martín', 1),
(11, 'San Alberto', 1),
(12, 'La Paz', 1),
(13, 'La Paz', 1),
(14, 'La Paz', 1),
(15, 'La Paz', 1),
(16, 'La Paz', 1),
(17, 'Manaure Balcón del Cesar', 1),
(18, 'Manaure Balcón del Cesar', 1),
(19, 'Manaure Balcón del Cesar', 1),
(20, 'Manaure Balcón del Cesar', 1),
(21, 'Manaure Balcón del Cesar', 1),
(22, 'Manaure Balcón del Cesar', 1),
(23, 'Manaure Balcón del Cesar', 1),
(24, 'La Paz', 1),
(25, 'Gamarra', 1),
(26, 'Gamarra', 1),
(27, 'San Martín', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `ID_Departamento` int(11) NOT NULL,
  `Departamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`ID_Departamento`, `Departamento`) VALUES
(1, 'Cesar'),
(2, 'Cundinamarca'),
(3, 'Santander'),
(4, 'Risaralda'),
(5, 'Magdalena'),
(6, 'cesar'),
(7, 'cesar'),
(8, 'cesar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `ID_Dependencia` int(11) NOT NULL,
  `Dependencia` varchar(30) NOT NULL,
  `Telefono` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia_subsede`
--

CREATE TABLE `dependencia_subsede` (
  `ID_Dependencia_subsede` int(11) NOT NULL,
  `Sub_sede_ID` int(11) NOT NULL,
  `Dependencia_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `ID_Documento` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Tipo_documento` enum('Entrada','Salida') NOT NULL,
  `Asunto` varchar(200) NOT NULL,
  `Evidencia` blob DEFAULT NULL,
  `Persona_Identificacion` varchar(20) NOT NULL,
  `Usuario_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_rec_env`
--

CREATE TABLE `doc_rec_env` (
  `ID` int(11) NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Dependencia_ID` int(11) NOT NULL,
  `Documento_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `ID_Permisos` int(11) NOT NULL,
  `Permiso` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Identificacion` varchar(20) NOT NULL,
  `Nombre_y_apellido` varchar(45) NOT NULL,
  `Telefono` double DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Tipo` enum('Natural','Juridica') NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Ciudad_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_Rol` int(11) NOT NULL,
  `Rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_Rol`, `Rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_tiene_permisos`
--

CREATE TABLE `rol_tiene_permisos` (
  `ID_Rol_tiene_permisos` int(11) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Permisos_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_sede`
--

CREATE TABLE `sub_sede` (
  `ID_Sub_sede` int(11) NOT NULL,
  `Sub_sede` varchar(20) NOT NULL,
  `Telefono` double DEFAULT NULL,
  `Centro_ID` int(11) NOT NULL,
  `Ciudad_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_y_apellido` varchar(45) DEFAULT NULL,
  `Telefono` double DEFAULT NULL,
  `Correo` varchar(45) NOT NULL,
  `Direccion` varchar(30) DEFAULT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Centro_ID` int(11) NOT NULL,
  `Rol_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre_y_apellido`, `Telefono`, `Correo`, `Direccion`, `Username`, `Password`, `Centro_ID`, `Rol_ID`) VALUES
(1, 'JOSE DAVID DORIA HERNANDEZ', 3126069159, 'josedor1@gmail.com', 'Cll 19#19c -24', 'jdoria', 'grupo02*', 1, 1),
(2, 'JOSE ALFREDO RADA ZAPATA', 3046702395, 'joserada0411@gmail.com', 'Cll 8 # 8 - 18', 'jrada', 'grupo02*', 1, 2),
(4, 'JACKKELIN RIBON', 3182607639, 'jackelineribon@gmail.com', 'calle casa 19', 'jribon', 'grupo02*', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`ID_Centro`),
  ADD KEY `Ciudad_ID` (`Ciudad_ID`);

--
-- Indices de la tabla `centro_tiene_dependencia`
--
ALTER TABLE `centro_tiene_dependencia`
  ADD PRIMARY KEY (`ID_Centro_tiene_dependencia`),
  ADD KEY `Centro_ID` (`Centro_ID`),
  ADD KEY `Dependencia_ID` (`Dependencia_ID`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_Ciudad`),
  ADD KEY `Departamento_ID` (`Departamento_ID`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`ID_Departamento`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`ID_Dependencia`);

--
-- Indices de la tabla `dependencia_subsede`
--
ALTER TABLE `dependencia_subsede`
  ADD PRIMARY KEY (`ID_Dependencia_subsede`),
  ADD KEY `Sub_sede_ID` (`Sub_sede_ID`),
  ADD KEY `Dependencia_ID` (`Dependencia_ID`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`ID_Documento`),
  ADD KEY `Persona_Identificacion` (`Persona_Identificacion`),
  ADD KEY `Usuario_ID` (`Usuario_ID`);

--
-- Indices de la tabla `doc_rec_env`
--
ALTER TABLE `doc_rec_env`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Dependencia_ID` (`Dependencia_ID`),
  ADD KEY `Documento_ID` (`Documento_ID`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID_Permisos`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Identificacion`),
  ADD KEY `Ciudad_ID` (`Ciudad_ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `rol_tiene_permisos`
--
ALTER TABLE `rol_tiene_permisos`
  ADD PRIMARY KEY (`ID_Rol_tiene_permisos`),
  ADD KEY `Rol_ID` (`Rol_ID`),
  ADD KEY `Permisos_ID` (`Permisos_ID`);

--
-- Indices de la tabla `sub_sede`
--
ALTER TABLE `sub_sede`
  ADD PRIMARY KEY (`ID_Sub_sede`),
  ADD KEY `Centro_ID` (`Centro_ID`),
  ADD KEY `Ciudad_ID` (`Ciudad_ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `Centro_ID` (`Centro_ID`),
  ADD KEY `Rol_ID` (`Rol_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `ID_Centro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `centro_tiene_dependencia`
--
ALTER TABLE `centro_tiene_dependencia`
  MODIFY `ID_Centro_tiene_dependencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ID_Ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `ID_Departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `ID_Dependencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dependencia_subsede`
--
ALTER TABLE `dependencia_subsede`
  MODIFY `ID_Dependencia_subsede` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `ID_Documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doc_rec_env`
--
ALTER TABLE `doc_rec_env`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `ID_Permisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol_tiene_permisos`
--
ALTER TABLE `rol_tiene_permisos`
  MODIFY `ID_Rol_tiene_permisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sub_sede`
--
ALTER TABLE `sub_sede`
  MODIFY `ID_Sub_sede` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `centro`
--
ALTER TABLE `centro`
  ADD CONSTRAINT `centro_ibfk_1` FOREIGN KEY (`Ciudad_ID`) REFERENCES `ciudad` (`ID_Ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `centro_tiene_dependencia`
--
ALTER TABLE `centro_tiene_dependencia`
  ADD CONSTRAINT `centro_tiene_dependencia_ibfk_1` FOREIGN KEY (`Centro_ID`) REFERENCES `centro` (`ID_Centro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `centro_tiene_dependencia_ibfk_2` FOREIGN KEY (`Dependencia_ID`) REFERENCES `dependencia` (`ID_Dependencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`Departamento_ID`) REFERENCES `departamento` (`ID_Departamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dependencia_subsede`
--
ALTER TABLE `dependencia_subsede`
  ADD CONSTRAINT `dependencia_subsede_ibfk_1` FOREIGN KEY (`Sub_sede_ID`) REFERENCES `sub_sede` (`ID_Sub_sede`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dependencia_subsede_ibfk_2` FOREIGN KEY (`Dependencia_ID`) REFERENCES `dependencia` (`ID_Dependencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`Persona_Identificacion`) REFERENCES `persona` (`Identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`Usuario_ID`) REFERENCES `usuario` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `doc_rec_env`
--
ALTER TABLE `doc_rec_env`
  ADD CONSTRAINT `doc_rec_env_ibfk_1` FOREIGN KEY (`Dependencia_ID`) REFERENCES `dependencia` (`ID_Dependencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doc_rec_env_ibfk_2` FOREIGN KEY (`Documento_ID`) REFERENCES `documento` (`ID_Documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`Ciudad_ID`) REFERENCES `ciudad` (`ID_Ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_tiene_permisos`
--
ALTER TABLE `rol_tiene_permisos`
  ADD CONSTRAINT `rol_tiene_permisos_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`ID_Rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_tiene_permisos_ibfk_2` FOREIGN KEY (`Permisos_ID`) REFERENCES `permisos` (`ID_Permisos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub_sede`
--
ALTER TABLE `sub_sede`
  ADD CONSTRAINT `sub_sede_ibfk_1` FOREIGN KEY (`Centro_ID`) REFERENCES `centro` (`ID_Centro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_sede_ibfk_2` FOREIGN KEY (`Ciudad_ID`) REFERENCES `ciudad` (`ID_Ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Centro_ID`) REFERENCES `centro` (`ID_Centro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`ID_Rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
