-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: remis
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `calles`
--

DROP TABLE IF EXISTS `calles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calles` (
  `idcalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`idcalle`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calles`
--

LOCK TABLES `calles` WRITE;
/*!40000 ALTER TABLE `calles` DISABLE KEYS */;
INSERT INTO `calles` VALUES (1,17,'montesano'),(2,19,'orsali'),(3,21,'alberdi'),(4,23,'pourtale'),(5,25,'guisasola'),(6,27,'junin'),(7,29,'tacuari'),(8,31,'piedras'),(9,33,'ituzaingo'),(10,35,'ayacucho'),(11,37,'san lorenzo'),(12,39,'independencia'),(13,41,'chacabuco'),(14,43,'maipu'),(15,45,'cerrito'),(16,47,'riobamba'),(17,49,'brown'),(18,51,'lavalle'),(19,53,'alsina'),(20,55,'vicente lopez'),(21,57,'rivadavia'),(22,59,'moreno'),(23,61,'lamadrid'),(24,63,'españa'),(25,65,'25 de mayo'),(26,67,'9 de julio'),(27,69,'pringles'),(28,71,'amparo castro'),(29,73,'aguilar'),(30,75,'saavedra'),(31,77,'laprida'),(32,79,'dean funes'),(33,81,'urquiza'),(34,83,'beruti'),(35,85,'chiclana'),(36,87,'muñoz'),(37,89,'leal'),(38,91,'moya'),(39,93,'pellegrini'),(40,95,'antartida arg'),(41,97,'islas malvinas'),(42,99,'tierra fuego'),(43,101,'sta cruz'),(44,103,'elena fortabat'),(45,105,'rio negro'),(46,107,'la pampa '),(47,109,'la rioja'),(48,111,'buenos aires'),(49,113,'santa fe'),(50,115,'entre rios'),(51,117,'corrientes'),(52,119,'mendoza'),(53,121,'cordoba'),(54,123,'san juan'),(55,125,'circunvalacion'),(56,116,'perito moreno'),(57,114,'newberi '),(58,112,'carretero'),(59,110,'rivas '),(60,108,'machado'),(61,106,'Ruta 226'),(62,104,'rocha '),(63,102,'De la torre'),(64,100,'Gonzales'),(65,98,'Juan 23'),(66,96,'lebenson'),(67,94,'trabajadores'),(68,92,'fassina'),(69,90,'grimaldi'),(70,88,'merlo'),(71,86,'rufino fal'),(72,84,'estrada'),(73,82,'sarmiento'),(74,80,'mitre'),(75,78,'libano'),(76,76,'luis torres'),(77,74,'Yrigoyen'),(78,72,'saenz peña'),(79,70,'colon'),(80,68,'a. barros'),(81,66,'cabral'),(82,64,'necochea'),(83,62,'dorrego'),(84,60,'belgrano'),(85,58,'san martin'),(86,56,'gral paz'),(87,54,'Coronel suarez'),(88,52,'hornos'),(89,50,'bolivar'),(90,48,'velez sarfield'),(91,46,'del valle'),(92,44,'pellegrino'),(93,42,'balcarce'),(94,40,'las heras'),(95,38,'buchardo '),(96,36,'azopardo'),(97,34,'pueyrredon'),(98,32,'collinet'),(99,30,'cortes'),(100,28,'rendon '),(101,26,'canaveri'),(102,24,'giovanelli'),(103,22,'avellaneda'),(104,20,'juan mazucchi'),(105,18,'peron'),(106,16,'esquivel '),(107,14,'guadalupe'),(108,12,'maestro');
/*!40000 ALTER TABLE `calles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `choferes`
--

DROP TABLE IF EXISTS `choferes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `choferes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechanac` date NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numlicencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otorgamiento` date NOT NULL,
  `vencimiento` date NOT NULL,
  `clases` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grupofactor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restricciones` text COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '1 activo 0 inactivo',
  `asignado` tinyint(1) NOT NULL COMMENT '1 asigando 0 noasignado',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `choferes`
--

LOCK TABLES `choferes` WRITE;
/*!40000 ALTER TABLE `choferes` DISABLE KEYS */;
INSERT INTO `choferes` VALUES (1,'PEPE PAPA','11553366','2014-11-02','','123456','123456','31381304','2014-04-15','2019-04-15','B1 B2','FB POSITIVO','CONDUCE CON ANTEOJOS',1,1,'0000-00-00 00:00:00','2015-03-01 00:31:32',NULL),(2,'MARIANO MORENO','56546465','1966-02-25','','32156131','32156131','312313156','2014-07-06','2012-03-06','A','ASDASAS','',1,1,'0000-00-00 00:00:00','2015-02-28 00:09:20',NULL),(3,'JUAN PAGANUZZI','31381304','1985-01-09','','418135','418135','31381304','2014-04-15','2019-04-15','B1 B2','FBPOSITIVO','CONDUCE CON ANTEOJOS',1,1,'0000-00-00 00:00:00','2015-02-28 00:17:56',NULL);
/*!40000 ALTER TABLE `choferes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches`
--

DROP TABLE IF EXISTS `coches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aseguradora` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vencimiento` date NOT NULL,
  `numhabilitacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vencehabilitacion` date NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '1 activo 0 inactivo',
  `asignado` tinyint(1) NOT NULL COMMENT '1 asigando 0 noasignado',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches`
--

LOCK TABLES `coches` WRITE;
/*!40000 ALTER TABLE `coches` DISABLE KEYS */;
INSERT INTO `coches` VALUES (1,'RENAULT','MEGANE','CCW111','SANCOR','2017-12-01','NUMERO DE LICENCIA','2015-12-06',1,1,'0000-00-00 00:00:00','2015-02-28 00:17:56'),(3,'RENAULT','21','CCW333','AKJSDJAKSJDAKSH','2015-02-05','AJSDAKHSJKHASHAHS','2020-05-17',1,1,'0000-00-00 00:00:00','2015-03-01 00:31:32'),(4,'FERRARI','LA FERRARI','CCW222','ASASS','2014-10-25','AHSDAHSDHJAGS','2018-12-10',1,1,'0000-00-00 00:00:00','2015-02-28 00:09:20'),(5,'BMW','COMPRESSOR','111AAAA','NOSE','2015-04-08','','0000-00-00',0,0,'2015-02-18 05:14:31','2015-02-18 06:08:09');
/*!40000 ALTER TABLE `coches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `porcentaje_remisera` double NOT NULL,
  `tiempomaxviaje` time NOT NULL,
  `avisovenceseguro` int(11) NOT NULL,
  `avisovencechofer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones`
--

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
INSERT INTO `configuraciones` VALUES (1,20,'00:02:00',50,50,'0000-00-00 00:00:00','2015-02-28 00:11:17');
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logmoviles`
--

DROP TABLE IF EXISTS `logmoviles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logmoviles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobil_id` int(11) NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `gastos` double NOT NULL COMMENT 'cargos al mobil',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logmoviles`
--

LOCK TABLES `logmoviles` WRITE;
/*!40000 ALTER TABLE `logmoviles` DISABLE KEYS */;
INSERT INTO `logmoviles` VALUES (1,1,'se fue a comprar nafta',0,'2014-12-17 01:33:14','2014-12-17 01:33:14'),(2,1,'para para comer',0,'2014-12-17 01:34:03','2014-12-17 01:34:03'),(3,1,'volvio de comer',0,'2014-12-17 01:34:23','2014-12-17 01:34:23'),(4,1,'fue a comer',0,'2015-01-03 23:59:13','2015-01-03 23:59:13'),(5,1,'volvio de comer',0,'2015-01-03 23:59:35','2015-01-03 23:59:35'),(6,1,'',0,'2015-01-05 00:25:27','2015-01-05 00:25:27'),(7,1,'',0,'2015-01-05 00:26:15','2015-01-05 00:26:15'),(8,1,'fue a cargar nafta',0,'2015-01-07 16:26:11','2015-01-07 16:26:11'),(9,1,'pago 400 de nafta',0,'2015-01-07 16:26:38','2015-01-07 16:26:38'),(10,1,'',0,'2015-01-07 16:37:50','2015-01-07 16:37:50'),(11,1,'volvio de cargar nafta',0,'2015-01-07 16:38:20','2015-01-07 16:38:20'),(12,1,'se fue a comer',0,'2015-01-07 16:39:14','2015-01-07 16:39:14'),(13,1,'comio en el chato carreras',0,'2015-01-07 16:39:32','2015-01-07 16:39:32'),(14,1,'se va a cargar nafta',0,'2015-01-07 16:40:04','2015-01-07 16:40:04'),(15,1,'volvio de cargar',965,'2015-01-07 16:40:17','2015-01-07 16:40:17'),(16,1,'se fue a comer',0,'2015-01-07 16:40:52','2015-01-07 16:40:52'),(17,1,'volvio de vomer',0,'2015-01-07 16:41:20','2015-01-07 16:41:20'),(18,1,'demodmeo',0,'2015-01-07 16:46:22','2015-01-07 16:46:22'),(19,1,'demodemo',55,'2015-01-07 16:46:34','2015-01-07 16:46:34'),(20,1,'',0,'2015-01-15 02:55:18','2015-01-15 02:55:18'),(21,1,'',0,'2015-01-16 16:20:56','2015-01-16 16:20:56'),(22,1,'',0,'2015-01-16 16:21:05','2015-01-16 16:21:05'),(23,1,'se fue a comer',0,'2015-01-16 16:21:34','2015-01-16 16:21:34'),(24,1,'volvio',0,'2015-01-16 16:21:50','2015-01-16 16:21:50'),(25,1,'',0,'2015-02-16 05:19:18','2015-02-16 05:19:18'),(26,1,'',0,'2015-02-16 05:21:01','2015-02-16 05:21:01'),(27,1,'',0,'2015-02-18 05:41:32','2015-02-18 05:41:32'),(28,1,'',0,'2015-02-18 23:35:23','2015-02-18 23:35:23'),(29,1,'',0,'2015-02-18 23:35:31','2015-02-18 23:35:31'),(30,1,'fue a cargar',0,'2015-02-18 23:35:42','2015-02-18 23:35:42'),(31,1,'volvio',56,'2015-02-18 23:36:03','2015-02-18 23:36:03');
/*!40000 ALTER TABLE `logmoviles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_11_233224_viajes_database',1),('2014_10_18_003946_usuarios_table',1),('2014_10_19_195157_config_migrate',1),('2014_10_24_135205_create_coches_table',1),('2014_11_02_190809_choferes_database',2),('2014_11_03_144938_mobiles_table',3),('2014_12_16_221712_create_log_mobil_database',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobiles`
--

DROP TABLE IF EXISTS `mobiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coches_id` int(11) NOT NULL,
  `choferes_id` int(11) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `estado` enum('libre','ocupado','pausado') COLLATE utf8_unicode_ci NOT NULL,
  `numerocoche` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `liquidado` tinyint(1) NOT NULL COMMENT 'si se liquido el auto',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobiles`
--

LOCK TABLES `mobiles` WRITE;
/*!40000 ALTER TABLE `mobiles` DISABLE KEYS */;
INSERT INTO `mobiles` VALUES (0,0,0,1,'libre','Sin Asignar',0,'0000-00-00 00:00:00','2014-12-16 01:10:09','0000-00-00 00:00:00'),(1,3,1,1,'libre','1',0,'2015-03-01 00:31:32','2015-03-01 01:26:54','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `mobiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programados`
--

DROP TABLE IF EXISTS `programados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programados` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `origen` varchar(255) NOT NULL,
  `fecha_despacho` datetime NOT NULL,
  `despachado` tinyint(1) NOT NULL,
  `notas` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programados`
--

LOCK TABLES `programados` WRITE;
/*!40000 ALTER TABLE `programados` DISABLE KEYS */;
INSERT INTO `programados` VALUES (1,'ssadas','2015-02-28 02:33:00',1,'','2015-02-28 05:33:34','2015-02-28 05:36:40','2015-02-28 05:36:40'),(2,'ultimo','2015-02-28 02:36:00',1,'','2015-02-28 05:36:54','2015-02-28 05:37:23','2015-02-28 05:37:23'),(3,'s','2015-02-28 02:47:00',0,'','2015-02-28 05:37:46','2015-02-28 05:37:46','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `programados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombreapellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'demo','JUAN PAGANUZZI','ADMIN@ADMIN.COM','$2y$10$PU.oR.kiKAevpuZmFtF4p.I3bPWMRbjoqRilrmPCLuGsdVofucw3u',1,'2rn4KuhXfKZWJMgty4C3yfZceiWRja26zi68bs1oDem9pUO0t3UKxsAo0MBd','2014-10-28 20:44:36','2015-03-01 01:30:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viajes`
--

DROP TABLE IF EXISTS `viajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viajes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobiles_id` int(11) NOT NULL,
  `origen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destino` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monto` double NOT NULL,
  `notas` text COLLATE utf8_unicode_ci NOT NULL,
  `terminado` tinyint(1) NOT NULL,
  `programado` tinyint(1) NOT NULL COMMENT 'si viene de un programado',
  `adeuda` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'creo viaje/asigno viaje',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'termino viaje',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viajes`
--

LOCK TABLES `viajes` WRITE;
/*!40000 ALTER TABLE `viajes` DISABLE KEYS */;
INSERT INTO `viajes` VALUES (1,1,'demo','ahsg',50,'',1,0,0,'2015-03-01 00:34:30','2015-03-01 00:34:37'),(2,1,'A','123',55,'',1,0,0,'2015-03-01 00:46:06','2015-03-01 00:46:12'),(3,1,'as','asd',30,'',1,0,0,'2015-03-01 01:26:45','2015-03-01 01:26:54');
/*!40000 ALTER TABLE `viajes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-05 14:11:28
