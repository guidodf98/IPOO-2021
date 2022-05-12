CREATE TABLE IF NOT EXISTS `teatro` (
  `idteatro` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  PRIMARY KEY (`idteatro`)
);

CREATE TABLE IF NOT EXISTS `funcion` (
  `idfuncion` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `horainicio` varchar(5) NOT NULL,
  `duracion` varchar(5) NOT NULL,
  `precio` int(10) NOT NULL,
  `idteatro` int(10) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idteatro`) REFERENCES `teatro` (`idteatro`)
);

CREATE TABLE IF NOT EXISTS `teatroact` (
  `idfuncion` int(10) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);

CREATE TABLE IF NOT EXISTS `musicalact` (
  `idfuncion` int(10) NOT NULL,
  `director` varchar(20) NOT NULL,
  `cantpersonas` int(10) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);

CREATE TABLE IF NOT EXISTS `cineact` (
  `idfuncion` int(10) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `paisorigen` varchar(20) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);

