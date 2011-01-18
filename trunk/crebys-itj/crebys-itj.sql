-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-01-2011 a las 14:53:11
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `crebys-itj`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE IF NOT EXISTS `acciones` (
  `Id_Accion` int(11) NOT NULL,
  `Id_Meta` int(11) NOT NULL,
  `Ac_Descripcion` varchar(300) NOT NULL,
  PRIMARY KEY (`Id_Accion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`Id_Accion`, `Id_Meta`, `Ac_Descripcion`) VALUES
(1, 1, 'Integrar las carpetas de autoevaluación de los programas académicos acreditables.'),
(3, 1, 'Definir líneas de investigación pertinentes al desarrollo económico regional y al avance científico tecnológico.'),
(6, 2, 'Gestionar los recursos para cubrir las actividades docentes de los profesores que se incorporen a estudios de posgrado.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones_poa`
--

CREATE TABLE IF NOT EXISTS `acciones_poa` (
  `Id_Accion` int(11) NOT NULL,
  `Id_POA` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `acciones_poa`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `Id_Departamento` int(11) NOT NULL,
  `Id_Subdireccion` int(11) NOT NULL,
  `De_Nombre` varchar(45) NOT NULL,
  `Di_Clave_Presupuestal` int(11) NOT NULL,
  PRIMARY KEY (`Id_Departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`Id_Departamento`, `Id_Subdireccion`, `De_Nombre`, `Di_Clave_Presupuestal`) VALUES
(300, 220, 'Planeación Programación y Presupuestación', 100),
(306, 220, 'Gestión Tecnológica y Vinculación', 110),
(312, 220, 'Comunicación y Difusión', 120),
(318, 220, 'Centro de Información', 130),
(324, 220, 'Servicios Escolares', 140),
(330, 220, 'Actividades Extraescolares', 150),
(336, 210, 'Ciencias Básicas', 160),
(342, 210, 'Sistemas y Computación', 170),
(348, 210, 'Ciencias de la Tierra', 180),
(254, 210, 'Ingeniería Industrial', 190),
(360, 210, 'División de Estudios Profesionales', 200),
(366, 210, 'Desarrollo Académico', 210),
(372, 210, 'Ciencias Económico-Administrativas', 220),
(278, 210, 'Ingeniería Química y Bioquímica', 230),
(384, 200, 'Recursos Humanos', 240),
(390, 200, 'Recursos Financieros', 250),
(396, 200, 'Centro de Cómputo', 260),
(402, 200, 'Recursos Materiales y Servicios', 270),
(408, 210, 'Sub_Académica', 280),
(414, 200, 'Sub_Administrativa', 290),
(420, 220, 'Sub_Planeación', 300),
(426, 230, 'Dirección', 310),
(432, 240, 'Administrador', 320);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos_puestos`
--

CREATE TABLE IF NOT EXISTS `departamentos_puestos` (
  `Id_Departamento_Puesto` int(11) NOT NULL,
  `Id_Puesto` int(11) NOT NULL,
  `Id_Departamento` int(11) NOT NULL,
  PRIMARY KEY (`Id_Departamento_Puesto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `departamentos_puestos`
--

INSERT INTO `departamentos_puestos` (`Id_Departamento_Puesto`, `Id_Puesto`, `Id_Departamento`) VALUES
(50, 400, 366),
(20, 414, 432);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disminuciones`
--

CREATE TABLE IF NOT EXISTS `disminuciones` (
  `Id_Insumo_Accion` int(11) NOT NULL,
  `Id_Requisicion` int(11) NOT NULL,
  `Di_Disminucion` int(11) NOT NULL,
  `Di_Precio` double NOT NULL,
  `Di_Justificacion` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `disminuciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE IF NOT EXISTS `insumos` (
  `Id_Insumo` int(11) NOT NULL,
  `In_Nombre` varchar(100) NOT NULL,
  `In_Precio` double NOT NULL,
  `Id_Unidad_Medida` int(11) NOT NULL,
  `Id_Partida` int(11) unsigned NOT NULL,
  PRIMARY KEY (`Id_Insumo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`Id_Insumo`, `In_Nombre`, `In_Precio`, `Id_Unidad_Medida`, `Id_Partida`) VALUES
(203, 'Lápiz', 300, 0, 21101),
(202, 'Elemento 1', 400, 0, 13404),
(201, 'Fumigación', 400, 0, 12301),
(200, 'Curso de Actualización', 200, 0, 12101),
(205, 'Franela', 15, 0, 21601),
(475, 'Elemento 2', 34, 0, 12101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_acciones`
--

CREATE TABLE IF NOT EXISTS `insumos_acciones` (
  `Id_Insumo_Accion` int(11) NOT NULL,
  `Id_Insumo` int(11) NOT NULL,
  `Id_Accion` int(11) NOT NULL,
  `Ia_Cantidad` int(11) NOT NULL,
  `Ia_Contemplado` bit(1) NOT NULL,
  PRIMARY KEY (`Id_Insumo_Accion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `insumos_acciones`
--

INSERT INTO `insumos_acciones` (`Id_Insumo_Accion`, `Id_Insumo`, `Id_Accion`, `Ia_Cantidad`, `Ia_Contemplado`) VALUES
(877, 50, 852, 76, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE IF NOT EXISTS `medidas` (
  `Id_Unidad_Medida` int(11) NOT NULL,
  `Un_Nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Unidad_Medida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`Id_Unidad_Medida`, `Un_Nombre`) VALUES
(100, 'Caja'),
(101, 'Rollo'),
(102, 'Pieza'),
(103, 'Bote de 1 Litro'),
(111, 'Tambo de 500 Litros'),
(119, 'Bola de 4m'),
(127, 'Caja con 40 Piezas'),
(135, 'Paquete'),
(143, 'Costal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metas`
--

CREATE TABLE IF NOT EXISTS `metas` (
  `Id_Meta` int(11) NOT NULL,
  `Id_Proc_Clave` int(11) NOT NULL,
  `Me_Nombre` varchar(200) NOT NULL,
  `Me_Unidad_M` varchar(100) NOT NULL,
  `Me_Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`Id_Meta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `metas`
--

INSERT INTO `metas` (`Id_Meta`, `Id_Proc_Clave`, `Me_Nombre`, `Me_Unidad_M`, `Me_Cantidad`) VALUES
(1, 620, 'Para el 2012, incrementar del 0% al 60% los estudiantes en programas educativos de licenciatura reconocidos o acreditados por su calidad.', 'Estudiantes en programas de educación superior que alcancen el nivel 1 o sean acreditados', 403),
(2, 605, 'Lograr al 2012 que el 30% de los profesores de tiempo completo cuenten con estudios de posgrado.', 'Profesores de tiempo completo que cuenten con estudios de posgrado', 22),
(3, 600, 'Alcanzar en el 2012, una eficiencia terminal (Índice de Egreso) del 70% en los programas educativos de licenciatura.', 'Índice de Egreso', 238),
(4, 605, 'Para el 2012, incrementar del 0 al 6 los profesores de tiempo completo con reconocimiento del perfil deseable.', 'Profesor', 1),
(5, 650, 'Para el 2012, el Instituto mantiene certificado su proceso educativo, conforme a la norma ISO 9001:2008. y su certificación en la Norma ISO 14001:2004', 'Certificado', 2),
(6, 605, 'Para el 2012 incrementar del 84.37% al 94% de profesores que participan en eventos de formación docente y profesional', 'Profesores participando en eventos de formación docente y profesional', 108),
(7, 620, 'Para el 2012 lograr que el Instituto Tecnológico cuente con 1 Cuerpo Académico consolidado.', 'Cuerpo Académico', 0),
(8, 675, 'Nada de descripción', 'Ahora si tengo medida', 12),
(9, 660, 'Lograr al 2012, incrementar del 22% al 31% los estudiantes del Instituto que son apoyados en el PRONABES.', 'Alumno Becado ', 400),
(10, 600, 'Lograr para el 2012, incrementar de 1706 a 1900 estudiantes la matrícula de licenciatura.', 'Estudiantes en modalidad escolarizada', 1750),
(11, 600, 'Para el 2012, incrementar a 50 estudiantes la matrícula en programas no presenciales.', 'Alumnos', 0),
(12, 605, 'Alcanzar en el 2012, una matrícula de 15 estudiantes en los programas de posgrado.', 'Estudiantes', 0),
(13, 635, 'Lograr para el 2012, se tengan 40 computadoras conectadas en internet  en el Centro de Información.', 'Computadora ', 10),
(14, 635, 'Incrementar la Infraestructura en Cómputo para lograr un indicador de 10 estudiantes por computadora.', 'Computadora', 15),
(15, 635, 'Para el 2012, incrementar del 18% al 45% las aulas equipadas con TIC´s.', 'Aula Equipada', 17),
(16, 635, 'Lograr que se tengan 200 computadoras conectadas en internet II  en el instituto.', 'Computadoras', 144);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE IF NOT EXISTS `partidas` (
  `Id_Partida` int(11) NOT NULL,
  `Pa_Nombre` varchar(350) NOT NULL,
  PRIMARY KEY (`Id_Partida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`Id_Partida`, `Pa_Nombre`) VALUES
(12101, 'Honorarios'),
(12301, 'Retribuciones por servicios de carácter social'),
(13404, 'Compensaciones por Servicios Eventuales'),
(21101, 'Materiales y Útiles de Oficina'),
(21601, 'Material de Limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poa`
--

CREATE TABLE IF NOT EXISTS `poa` (
  `Id_Poa` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Po_Fecha` datetime NOT NULL,
  PRIMARY KEY (`Id_Poa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `poa`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proc_claves`
--

CREATE TABLE IF NOT EXISTS `proc_claves` (
  `Id_Proc_Clave` int(11) NOT NULL,
  `Id_Proc_Estrategico` int(11) NOT NULL,
  `Pc_Nombre` varchar(60) NOT NULL,
  `Pc_Gf` int(11) NOT NULL,
  `Pc_Fn` int(11) NOT NULL,
  `Pc_Sf` int(11) NOT NULL,
  `Pc_Ai` int(11) NOT NULL,
  `Pc_Pp` varchar(4) NOT NULL,
  `Pc_Codigo` int(11) NOT NULL,
  `Pc_Est_Prog_Co` varchar(11) NOT NULL,
  PRIMARY KEY (`Id_Proc_Clave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `proc_claves`
--

INSERT INTO `proc_claves` (`Id_Proc_Clave`, `Id_Proc_Estrategico`, `Pc_Nombre`, `Pc_Gf`, `Pc_Fn`, `Pc_Sf`, `Pc_Ai`, `Pc_Pp`, `Pc_Codigo`, `Pc_Est_Prog_Co`) VALUES
(600, 1, 'Formación Profesional', 2, 0, 3, 5, 'E008', 11, '2035E00811'),
(605, 1, 'Investigación', 2, 0, 4, 6, 'E008', 12, '2046E008112'),
(610, 1, 'Estudios de Postgrado', 3, 7, 1, 14, 'E021', 12, '37114E02112'),
(615, 1, 'Desarrollo Profesional', 2, 0, 3, 5, 'E008', 13, '2035E00813'),
(620, 2, 'Vinculación Institucional', 2, 0, 3, 5, 'E008', 21, '2035E00821'),
(625, 3, 'Programación Presupuestal e Infraestructura Física', 2, 0, 3, 5, 'E008', 31, '2035E00831'),
(630, 3, 'Planeación Estratégica y Táctica y de Organización', 2, 0, 3, 5, 'E008', 32, '2035E00832'),
(635, 3, 'Soporte Técnico en Cómputo y Telecomunicaciones', 2, 0, 3, 5, 'E008', 33, '2035E00833'),
(640, 3, 'Difusión Cultural y Promoción Deportiva', 2, 0, 3, 5, 'E008', 34, '2035E00834'),
(645, 4, 'Aseguramiento de la Calidad', 2, 0, 3, 5, 'E008', 41, '2035E00841'),
(650, 4, 'Gestión de la Calidad', 2, 0, 3, 5, 'E008', 42, '2035E00842'),
(655, 4, 'Capacitación y Desarrollo', 2, 0, 3, 5, 'E008', 43, '2035E00843'),
(660, 4, 'Servicios Escolares', 2, 0, 3, 5, 'E008', 44, '2035E00844'),
(665, 5, 'Administración de Recursos Financieros', 2, 0, 3, 5, 'E008', 51, '2035E00851'),
(670, 5, 'Administración de Recursos Financieros', 2, 0, 3, 5, 'E008', 52, '2035E00852'),
(675, 5, 'Apoyo Jurídico', 2, 0, 3, 5, 'E008', 53, '2035E00853'),
(680, 5, 'Administración de Recursos Materiales y Servicios', 2, 0, 3, 5, 'E008', 54, '2035E00854');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proc_estrategicos`
--

CREATE TABLE IF NOT EXISTS `proc_estrategicos` (
  `Id_Proc_Estrategico` int(11) NOT NULL,
  `Pe_Nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_Proc_Estrategico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `proc_estrategicos`
--

INSERT INTO `proc_estrategicos` (`Id_Proc_Estrategico`, `Pe_Nombre`) VALUES
(2, 'Vinculación'),
(1, 'Académico'),
(3, 'Planeación'),
(4, 'Calidad'),
(5, 'Administración de Recursos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE IF NOT EXISTS `puestos` (
  `Id_Puesto` int(11) NOT NULL,
  `Pu_Nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`Id_Puesto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`Id_Puesto`, `Pu_Nombre`) VALUES
(400, 'Jefe'),
(407, 'Secretaria'),
(414, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisiciones`
--

CREATE TABLE IF NOT EXISTS `requisiciones` (
  `Id_Requisicion` int(11) NOT NULL,
  `Re_Proposito` varchar(50) NOT NULL,
  `Re_Fecha` datetime NOT NULL,
  `Re_Folio` varchar(30) NOT NULL,
  `Re_FPPP` datetime NOT NULL,
  `Re_Fsubdireccion` datetime NOT NULL,
  `Re_Fdireccion` datetime NOT NULL,
  `Re_Fprocede` datetime NOT NULL,
  PRIMARY KEY (`Id_Requisicion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `requisiciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdirecciones`
--

CREATE TABLE IF NOT EXISTS `subdirecciones` (
  `Id_Subdireccion` int(11) NOT NULL,
  `Su_Nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_Subdireccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `subdirecciones`
--

INSERT INTO `subdirecciones` (`Id_Subdireccion`, `Su_Nombre`) VALUES
(200, 'Administrativa'),
(210, 'Académica'),
(220, 'Planeación y Vinculación'),
(230, 'Direccion'),
(240, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Id_Departamento_Puesto` int(11) NOT NULL,
  `Us_Password` varchar(32) NOT NULL,
  `Us_Nombre` varchar(25) NOT NULL,
  `Us_Apellidop` varchar(15) NOT NULL,
  `Us_Apellidom` varchar(15) NOT NULL,
  `Us_Nick` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Id_Departamento_Puesto`, `Us_Password`, `Us_Nombre`, `Us_Apellidop`, `Us_Apellidom`, `Us_Nick`) VALUES
(723, 20, '9402c145b55315c88e9a84a83f1e15d4', 'sony_karl', 'ordaz', 'crizantos', 'admin'),
(726, 50, '9402c145b55315c88e9a84a83f1e15d4', 'Jose Carlos', 'Ordaz', 'Crizantos', 'sonykarl');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
