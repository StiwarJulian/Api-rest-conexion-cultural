-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-04-2019 a las 03:46:44
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portalxn_aes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_tecnica`
--

CREATE TABLE `area_tecnica` (
  `idarea_tecnica` int(10) NOT NULL,
  `etiqueta_area_tecnica` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion_area_tecnica` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` int(10) NOT NULL,
  `idempresas_ancla_auditoria` int(10) DEFAULT NULL,
  `idempresa_asociada_auditoria` int(10) DEFAULT NULL,
  `idsede_auditoria` int(10) DEFAULT NULL,
  `fecha_programada_auditoria` date DEFAULT NULL,
  `fecha_cierre_auditoria` date DEFAULT NULL,
  `idusuario_auditoria` int(11) DEFAULT NULL,
  `idplantilla_madre_auditoria` int(11) DEFAULT NULL,
  `idusuario_crea_auditoria` int(11) DEFAULT NULL,
  `estado_auditoria` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_item`
--

CREATE TABLE `auditoria_item` (
  `idauditoria_item` int(10) NOT NULL,
  `iditem_grupo_platilla_auditoria_item` int(11) DEFAULT NULL,
  `observacion_empresa` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion_auditor` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivo_evidencia` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_auditoria_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='referencia el item que se va auditar con sus observaciones y';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_item_plan_accion`
--

CREATE TABLE `detalle_item_plan_accion` (
  `iddetalle_item_plan_accion` int(11) NOT NULL,
  `idauditoria_item_detalle_item` int(11) DEFAULT NULL,
  `idplan_accion_detalle_item` int(11) DEFAULT NULL,
  `accion_realizar` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_realizar` date DEFAULT NULL,
  `porcentaje_avance` int(11) DEFAULT NULL,
  `adjunto_evidencia` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='se especifica el plan de accion de un item de auditoria en c';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresarial` int(10) NOT NULL,
  `idgrupo_empresarial` int(10) DEFAULT NULL,
  `nombre_empresa` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nit_empresa` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad_principal_empresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_empresa` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais_empresa` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_empresa` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idarea_tecnica_empresa` int(10) DEFAULT NULL,
  `representante_legal_empresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_representante_empresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_movil_representante_empresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sitio_web_empresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_corte_facturacion_empresa` date DEFAULT NULL,
  `correo_facturacion_empresa` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idsesion_empresa` int(10) DEFAULT NULL,
  `estado_empresa` int(2) DEFAULT NULL,
  `representante_sistema_gestion` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_representante_sistema_gestion_empresa` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_movil_representante_sistema_gestion_empresa` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_sistema_gestion_empresa` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_asociadas`
--

CREATE TABLE `empresas_asociadas` (
  `idempresa_ancla` int(10) NOT NULL DEFAULT '0',
  `idempresa_asociada` int(11) NOT NULL DEFAULT '0',
  `estado_empresas_asociadas` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_empresarial`
--

CREATE TABLE `grupo_empresarial` (
  `idgrupo_empresarial` int(10) NOT NULL,
  `nombre_grupo_empresarial` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_grupo_empresarial` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_plantilla`
--

CREATE TABLE `grupo_plantilla` (
  `idgrupo_plantilla` int(11) NOT NULL,
  `idplantilla_maestra_grupo` int(10) DEFAULT NULL,
  `etiqueta_grupo_plantilla` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_conjunto` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_grupo_plantilla`
--

CREATE TABLE `item_grupo_plantilla` (
  `iditem_grupo_plantilla` int(10) NOT NULL,
  `idgrupo_plantilla_item` int(10) DEFAULT NULL,
  `etiqueta_item_grupo_plantilla` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion_item_grupo_plantilla` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla_maestra`
--

CREATE TABLE `plantilla_maestra` (
  `idplantilla_maestra` int(10) NOT NULL,
  `idarea_tecnica_plantilla` int(10) DEFAULT NULL,
  `etiqueta_plantila` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais_plantilla` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_plantilla` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_accion`
--

CREATE TABLE `plan_accion` (
  `idplan_accion` int(11) NOT NULL,
  `idauditoria_plan_accion` int(11) DEFAULT NULL,
  `fecha_realizacion` date DEFAULT NULL,
  `estado_plan_accion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `idsede` int(10) NOT NULL,
  `idempresa` int(10) DEFAULT NULL,
  `ciudad_sede` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_empleados` int(10) DEFAULT NULL,
  `direccion_sede` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad_procesos_sede` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacto_sede` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo_Sede` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_movil_contacto_sede` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_empresarial_sede` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `idsesion` int(10) NOT NULL,
  `usuario_sesion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave_sesion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_sesion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ultima_conexion_sesion` datetime DEFAULT NULL,
  `estado_sesion` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(10) NOT NULL,
  `idsesion_usuario` int(10) DEFAULT NULL,
  `tipo_usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_usuario` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_usuario` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_usuario` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area_tecnica`
--
ALTER TABLE `area_tecnica`
  ADD PRIMARY KEY (`idarea_tecnica`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`),
  ADD KEY `idempresas_ancla_auditoria` (`idempresas_ancla_auditoria`),
  ADD KEY `idempresa_asociada_auditoria` (`idempresa_asociada_auditoria`),
  ADD KEY `idsede_auditoria` (`idsede_auditoria`),
  ADD KEY `idusuario_auditoria` (`idusuario_auditoria`),
  ADD KEY `idplantilla_madre_auditoria` (`idplantilla_madre_auditoria`),
  ADD KEY `idusuario_crea_auditoria` (`idusuario_crea_auditoria`);

--
-- Indices de la tabla `auditoria_item`
--
ALTER TABLE `auditoria_item`
  ADD PRIMARY KEY (`idauditoria_item`),
  ADD KEY `iditem_grupo_platilla_auditoria_item` (`iditem_grupo_platilla_auditoria_item`);

--
-- Indices de la tabla `detalle_item_plan_accion`
--
ALTER TABLE `detalle_item_plan_accion`
  ADD PRIMARY KEY (`iddetalle_item_plan_accion`),
  ADD KEY `idauditoria_item_detalle_item` (`idauditoria_item_detalle_item`),
  ADD KEY `idplan_accion_detalle_item` (`idplan_accion_detalle_item`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresarial`),
  ADD KEY `idgrupo_empresarial` (`idgrupo_empresarial`),
  ADD KEY `idarea_tecnica_empresa` (`idarea_tecnica_empresa`),
  ADD KEY `idsesion_empresa` (`idsesion_empresa`);

--
-- Indices de la tabla `empresas_asociadas`
--
ALTER TABLE `empresas_asociadas`
  ADD PRIMARY KEY (`idempresa_ancla`,`idempresa_asociada`),
  ADD KEY `idempresa_asociada` (`idempresa_asociada`);

--
-- Indices de la tabla `grupo_empresarial`
--
ALTER TABLE `grupo_empresarial`
  ADD PRIMARY KEY (`idgrupo_empresarial`);

--
-- Indices de la tabla `grupo_plantilla`
--
ALTER TABLE `grupo_plantilla`
  ADD PRIMARY KEY (`idgrupo_plantilla`),
  ADD KEY `idplantilla_maestra_grupo` (`idplantilla_maestra_grupo`);

--
-- Indices de la tabla `item_grupo_plantilla`
--
ALTER TABLE `item_grupo_plantilla`
  ADD PRIMARY KEY (`iditem_grupo_plantilla`),
  ADD KEY `idgrupo_plantilla_item` (`idgrupo_plantilla_item`);

--
-- Indices de la tabla `plantilla_maestra`
--
ALTER TABLE `plantilla_maestra`
  ADD PRIMARY KEY (`idplantilla_maestra`),
  ADD KEY `idarea_tecnica_plantilla` (`idarea_tecnica_plantilla`);

--
-- Indices de la tabla `plan_accion`
--
ALTER TABLE `plan_accion`
  ADD PRIMARY KEY (`idplan_accion`),
  ADD KEY `idauditoria_plan_accion` (`idauditoria_plan_accion`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`idsede`),
  ADD KEY `idempresa` (`idempresa`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`idsesion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idsesion_usuario` (`idsesion_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area_tecnica`
--
ALTER TABLE `area_tecnica`
  MODIFY `idarea_tecnica` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria_item`
--
ALTER TABLE `auditoria_item`
  MODIFY `idauditoria_item` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_item_plan_accion`
--
ALTER TABLE `detalle_item_plan_accion`
  MODIFY `iddetalle_item_plan_accion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresarial` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo_empresarial`
--
ALTER TABLE `grupo_empresarial`
  MODIFY `idgrupo_empresarial` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo_plantilla`
--
ALTER TABLE `grupo_plantilla`
  MODIFY `idgrupo_plantilla` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item_grupo_plantilla`
--
ALTER TABLE `item_grupo_plantilla`
  MODIFY `iditem_grupo_plantilla` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plantilla_maestra`
--
ALTER TABLE `plantilla_maestra`
  MODIFY `idplantilla_maestra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_accion`
--
ALTER TABLE `plan_accion`
  MODIFY `idplan_accion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `idsede` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `idsesion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`idempresas_ancla_auditoria`) REFERENCES `empresas_asociadas` (`idempresa_ancla`),
  ADD CONSTRAINT `auditoria_ibfk_2` FOREIGN KEY (`idempresa_asociada_auditoria`) REFERENCES `empresas_asociadas` (`idempresa_asociada`),
  ADD CONSTRAINT `auditoria_ibfk_3` FOREIGN KEY (`idsede_auditoria`) REFERENCES `sede` (`idsede`),
  ADD CONSTRAINT `auditoria_ibfk_4` FOREIGN KEY (`idusuario_auditoria`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `auditoria_ibfk_5` FOREIGN KEY (`idplantilla_madre_auditoria`) REFERENCES `plantilla_maestra` (`idplantilla_maestra`),
  ADD CONSTRAINT `auditoria_ibfk_6` FOREIGN KEY (`idusuario_crea_auditoria`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `auditoria_item`
--
ALTER TABLE `auditoria_item`
  ADD CONSTRAINT `auditoria_item_ibfk_1` FOREIGN KEY (`idauditoria_item`) REFERENCES `auditoria` (`idauditoria`),
  ADD CONSTRAINT `auditoria_item_ibfk_2` FOREIGN KEY (`iditem_grupo_platilla_auditoria_item`) REFERENCES `item_grupo_plantilla` (`iditem_grupo_plantilla`);

--
-- Filtros para la tabla `detalle_item_plan_accion`
--
ALTER TABLE `detalle_item_plan_accion`
  ADD CONSTRAINT `detalle_item_plan_accion_ibfk_1` FOREIGN KEY (`idauditoria_item_detalle_item`) REFERENCES `auditoria_item` (`idauditoria_item`),
  ADD CONSTRAINT `detalle_item_plan_accion_ibfk_2` FOREIGN KEY (`idplan_accion_detalle_item`) REFERENCES `plan_accion` (`idplan_accion`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`idgrupo_empresarial`) REFERENCES `grupo_empresarial` (`idgrupo_empresarial`),
  ADD CONSTRAINT `empresa_ibfk_2` FOREIGN KEY (`idarea_tecnica_empresa`) REFERENCES `area_tecnica` (`idarea_tecnica`),
  ADD CONSTRAINT `empresa_ibfk_3` FOREIGN KEY (`idsesion_empresa`) REFERENCES `sesion` (`idsesion`);

--
-- Filtros para la tabla `empresas_asociadas`
--
ALTER TABLE `empresas_asociadas`
  ADD CONSTRAINT `empresas_asociadas_ibfk_1` FOREIGN KEY (`idempresa_ancla`) REFERENCES `empresa` (`idempresarial`),
  ADD CONSTRAINT `empresas_asociadas_ibfk_2` FOREIGN KEY (`idempresa_asociada`) REFERENCES `empresa` (`idempresarial`);

--
-- Filtros para la tabla `grupo_plantilla`
--
ALTER TABLE `grupo_plantilla`
  ADD CONSTRAINT `grupo_plantilla_ibfk_1` FOREIGN KEY (`idplantilla_maestra_grupo`) REFERENCES `plantilla_maestra` (`idplantilla_maestra`);

--
-- Filtros para la tabla `item_grupo_plantilla`
--
ALTER TABLE `item_grupo_plantilla`
  ADD CONSTRAINT `item_grupo_plantilla_ibfk_1` FOREIGN KEY (`idgrupo_plantilla_item`) REFERENCES `grupo_plantilla` (`idgrupo_plantilla`);

--
-- Filtros para la tabla `plantilla_maestra`
--
ALTER TABLE `plantilla_maestra`
  ADD CONSTRAINT `plantilla_maestra_ibfk_1` FOREIGN KEY (`idarea_tecnica_plantilla`) REFERENCES `area_tecnica` (`idarea_tecnica`);

--
-- Filtros para la tabla `plan_accion`
--
ALTER TABLE `plan_accion`
  ADD CONSTRAINT `plan_accion_ibfk_1` FOREIGN KEY (`idauditoria_plan_accion`) REFERENCES `auditoria` (`idauditoria`);

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `sede_ibfk_1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresarial`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idsesion_usuario`) REFERENCES `sesion` (`idsesion`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idsesion_usuario`) REFERENCES `sesion` (`idsesion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
