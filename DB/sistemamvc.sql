-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2018 a las 03:35:28
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemamvc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `pel_id` int(11) NOT NULL,
  `pel_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pel_des` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pel_clase` char(3) COLLATE utf8_bin NOT NULL,
  `pel_img` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`pel_id`, `pel_nombre`, `pel_des`, `pel_clase`, `pel_img`) VALUES
(31, 'La vida es bella ', 'Unos años antes de que comience la Segunda Guerra Mundial, un joven llamado Guido llega a una ciudad de la Toscana (Arezzo)con la intención de abrir una librería. Allí conoce a Dora y, a pesar de que es la prometida del fascista Ferruccio, se casa con ella y tiene un hijo.', 'AA', '20181230104641.jpg'),
(32, 'Forrest Gump', 'Forrest Gump \'Tom Hanks\' es un chico que sufre un cierto retraso mental. \r\nA pesar de todo, gracias a su tenacidad y a su buen corazón será protagonista.', 'AA', '20181228100044.jpg'),
(33, 'EL rey león', 'La sabana africana es el escenario en el que tienen lugar las aventuras de Simba, un pequeño león que es el heredero del trono. Sin embargo, al ser injustamente acusado por el malvado Scar de la muerte de su padre, se ve obligado a exiliarse. ', 'AA', '20181228100223.jpg'),
(34, 'Titanic', 'JAMES CAMERON, 1997 Jack DiCaprio, un joven artista, gana en una partida de cartas un pasaje para viajar a América en el Titanic, el trasatlántico más grande y seguro jamás construido.', 'B15', '20181228101103.jpg'),
(46, 'Eduardo Manostijeras', 'Durante una noche de Navidad, una anciana le cuenta a su nieta la historia de Eduardo Manostijeras Johnny Depp, un muchacho creado por un extravagante inventor Vincent Priceque', 'AA', '20181228101209.jpg'),
(54, 'Batman Returns', 'Batman Returns es una película estadounidense dirigida por Tim Burton.La película está basada en el personaje de DC Comics Batman, es una secuela de la exitosa película de 1989, con Michael Keaton repitiendo el papel de Bruce Wayne Batman. ', 'C', '20181231033303.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`pel_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `pel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
