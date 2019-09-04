SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `rplayer` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rplayer`;

CREATE TABLE `archivos` (
  `idarchivo` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `archivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `identificacion` text NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cliente` (`idcliente`, `nombre`, `identificacion`, `fecha`) VALUES
(10, 'Test', '1567627872825', '2019-09-04 00:00:00');

CREATE TABLE `clientexgrupo` (
  `idcliente` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `clientexgrupo` (`idcliente`, `idgrupo`, `status`) VALUES
(10, 1, 0);

CREATE TABLE `config` (
  `nombre` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `config` (`nombre`, `logo`) VALUES
('rPlayer', 'iStock-636156852.jpg');

CREATE TABLE `grupo` (
  `idgrupo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `imagen` text NOT NULL,
  `archivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `grupo` (`idgrupo`, `nombre`, `imagen`, `archivo`) VALUES
(1, 'Grupo de Prueba', 'testGroup.jpg', 'testAudio.mp3');


ALTER TABLE `archivos`
  ADD PRIMARY KEY (`idarchivo`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idgrupo`);


ALTER TABLE `archivos`
  MODIFY `idarchivo` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `grupo`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
