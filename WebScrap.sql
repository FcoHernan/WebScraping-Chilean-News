-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2015 at 12:19 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `WebScrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE IF NOT EXISTS `newspapers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `site` varchar(40) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `localized` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `name`, `site`, `enabled`, `localized`) VALUES
(1, 'El Mercurio', 'http://www.emol.com/', 1, 'Santiago'),
(2, 'LA TERCERA', 'http://www.latercera.com', 1, 'Santiago'),
(3, 'LAS ÚLTIMAS NOTICIAS', 'http://www.lun.com', 1, 'Santiago'),
(4, 'LA CUARTA', 'http://www.lacuarta.cl', 1, 'Santiago'),
(5, 'LA SEGUNDA', 'http://www.lasegunda.com', 1, 'Santiago'),
(6, 'PUBLIMETRO', 'http://www.publimetro.cl', 1, 'Santiago'),
(7, 'LA HORA', 'http://www.lahora.cl', 1, 'Santiago'),
(8, 'HOYXHOY', 'http://www.hoyxhoy.cl', 1, 'Santiago'),
(9, 'EL GRÁFICO', 'http://www.elgraficochile.cl', 1, 'Santiago'),
(10, 'ESTRATEGIA', 'http://www.estrategia.cl', 1, 'Santiago'),
(11, 'DIARIO FINANCIERO', 'http://www.df.cl', 1, 'Santiago'),
(12, 'PULSO', 'http://www.pulso.cl', 1, 'Santiago'),
(13, 'LABRADOR', 'http://www.diariolabrador.cl/v2/', 1, 'Melipilla'),
(14, 'LA ESTRELLA DE IQUIQUE', 'http://www.estrellaiquique.cl', 1, 'Iquique'),
(15, 'EL LONGINO', 'http://www.diariolongino.cl', 1, 'Iquique'),
(16, 'EL MERCURIO DE ANTOFAGASTA', 'http://www.mercurioantofagasta.cl', 1, 'Antofagasta'),
(17, 'LA ESTRELLA DE ANTOFAGASTA', 'http://www.estrellaantofagasta.cl', 1, 'Antofagasta'),
(18, 'EL MERCURIO DE CALAMA', 'http://www.mercuriocalama.cl', 1, 'Calama'),
(19, 'LA ESTRELLA DEL LOA', 'http://www.estrellaloa.cl', 1, 'Calama'),
(20, 'LA ESTRELLA DE TOCOPILLA', 'http://www.estrellatocopilla.cl', 1, 'Tocopilla'),
(21, 'DIARIO CHAÑARCILLO', 'http://www.chanarcillo.cl', 1, 'Chañaral'),
(22, 'EL DIARIO DE ATACAMA', 'http://www.diarioatacama.cl', 1, 'Copiapó'),
(23, 'EL DÍA', 'http://www.diarioeldia.cl', 1, 'La Serena'),
(24, 'EL OVALLINO', 'http://www.elovallino.cl', 1, 'Ovalle'),
(25, 'LA REGIÓN', 'http://www.diariolaregion.cl', 1, 'Coquimbo'),
(26, 'EL MERCURIO DE VALPARAÍSO', 'http://www.mercuriovalpo.cl', 1, 'Valparaíso'),
(27, 'LA ESTRELLA DE VALPARAÍSO', 'http://www.estrellavalpo.cl', 1, 'Valparaíso'),
(28, 'EL OBSERVADOR', 'http://www.diarioelobservador.cl', 1, 'Quillota'),
(29, 'EL TRABAJO', 'http://www.eltrabajo.cl', 1, 'San Felipe'),
(30, 'EL LÍDER', 'http://www.lidersanantonio.cl', 1, 'San Antonio'),
(31, 'EL PROA', 'http://www.elproa.cl', 1, 'San Antonio'),
(32, 'EL ANDINO', 'http://www.elandino.cl', 1, 'Los Andes'),
(33, 'EL RANCAGÜINO', 'http://www.elrancaguino.cl', 1, 'Rancagua'),
(34, 'EL TIPÓGRAFO', 'http://www.eltipografo.cl', 1, 'Rancagua'),
(35, 'EL LIBERTADOR', 'http://www.diariolibertador.com', 1, 'Rancagua'),
(36, 'DIARIO VI REGIÓN', 'http://www.diarioviregion.cl', 1, 'San Fernando'),
(37, 'EL CENTRO', 'http://www.diarioelcentro.cl', 1, 'Talca'),
(38, 'EL HERALDO', 'http://www.diarioelheraldo.cl', 1, 'Linares'),
(39, 'EL LECTOR', 'http://www.lectoronline.cl', 1, 'Linares'),
(40, 'LA PRENSA', 'http://www.diariolaprensa.cl', 1, 'Curicó'),
(41, 'EL SUR', 'http://www.elsur.cl', 1, 'Concepción'),
(42, 'LA ESTRELLA DE CONCEPCIÓN', 'http://www.estrellaconce.cl', 1, 'Concepción'),
(43, 'DIARIO CONCEPCIÓN', 'http://www.diarioconcepcion.cl', 1, 'Concepción'),
(44, 'LA DISCUSIÓN', 'http://www.diarioladiscusion.cl', 1, 'Chillán'),
(45, 'CRÓNICA CHILLÁN', 'http://www.cronicachillan.cl', 1, 'Chillán'),
(46, 'LA TRIBUNA', 'http://www.diariolatribuna.cl', 1, 'Los Ángeles'),
(47, 'EL SANCARLINO', 'http://www.elsancarlino.cl', 1, 'San Carlos'),
(48, 'EL AUSTRAL', 'http://www.australtemuco.cl', 1, 'Temuco'),
(49, 'LAS NOTICIAS', 'http://www.lasnoticiasdemalleco.cl', 1, 'Victoria'),
(50, 'EL CORREO DEL LAGO', 'http://www.correodellago.com', 1, 'Villarrica'),
(51, 'EL LLANQUIHUE', 'http://www.diariollanquihue.cl', 1, 'Puerto Montt'),
(52, 'EL AUSTRAL DE OSORNO', 'http://www.australosorno.cl', 1, 'Osorno'),
(53, 'LA ESTRELLA DE CHILOÉ', 'http://www.laestrellachiloe.cl', 1, 'Castro'),
(54, 'EL INSULAR', 'http://www.elinsular.cl', 1, 'Castro'),
(55, 'EL HERALDO AUSTRAL', 'http://www.elheraldoaustral.cl', 1, 'Puerto Varas'),
(56, 'EL DIARIO DE AYSEN', 'http://www.diarioaysen.cl', 1, 'Coyhaique'),
(57, 'EL DIVISADERO', 'http://www.eldivisadero.cl', 1, 'Coyhaique'),
(58, 'LA PRENSA AUSTRAL', 'http://www.laprensaaustral.cl', 1, 'Punta Arenas'),
(59, 'EL PINGÜINO', 'http://www.elpinguino.com', 1, 'Punta Arenas'),
(60, 'DIARIO AUSTRAL', 'http://www.australdelosrios.cl', 1, 'Valdivia'),
(61, 'LA ESTRELLA DE ARICA', 'http://www.estrellaarica.cl', 1, 'Arica');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
