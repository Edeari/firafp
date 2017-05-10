-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.19-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5167
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para firafp
CREATE DATABASE IF NOT EXISTS `firafp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `firafp`;

-- Volcando estructura para tabla firafp.centers
CREATE TABLE IF NOT EXISTS `centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codicentre` varchar(10) DEFAULT NULL COMMENT 'Codi del centre',
  `name` varchar(100) NOT NULL DEFAULT '0' COMMENT 'Nom',
  `logo` varchar(50) DEFAULT NULL COMMENT 'Logo del centre',
  `location` varchar(100) NOT NULL DEFAULT '0' COMMENT 'Localització',
  PRIMARY KEY (`id`),
  UNIQUE KEY `codicentre` (`codicentre`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.centers: ~37 rows (aproximadamente)
/*!40000 ALTER TABLE `centers` DISABLE KEYS */;
INSERT INTO `centers` (`id`, `codicentre`, `name`, `logo`, `location`) VALUES
	(6, 'A0001', 'Acser ', NULL, 'Balaguer'),
	(7, 'A0002', 'Centre Tècnic Ilerdense ', NULL, 'Lleida'),
	(8, 'A0003', 'EA de les Borges Blanques', NULL, 'Borges Blanques'),
	(9, 'A0004', 'EA de Tàrrega', NULL, 'Tarrega'),
	(10, 'A0005', 'EA de Vallfogona de Balaguer', NULL, 'Vallfogona de Balaguer'),
	(11, 'A0006', 'EA del Pallars ', NULL, 'Talarn'),
	(12, 'A0007', 'EA del Pirineu ', NULL, 'Montferrer i Castellbò'),
	(13, 'A0008', 'ECA d’Alfarràs', NULL, 'Alfarràs'),
	(14, 'A0009', 'Episcopal Mare de Déu de l’Acadèmia ', NULL, 'Lleida'),
	(15, 'A0010', 'Escolade Sobreestants', NULL, 'Tàrrega'),
	(16, 'A0011', 'Espiscopal  Mare de Déu de l’Acadèmia ', NULL, 'LLeida'),
	(17, 'A0012', 'Ilerna ', NULL, 'Lleida'),
	(18, 'A0013', 'INS Alfons Costafreda ', NULL, 'Tàrrega'),
	(19, 'A0014', 'INS Almatà ', NULL, 'Balaguer'),
	(20, 'A0015', 'INS Aubenç', NULL, 'Aubenç'),
	(21, 'A0016', 'INS Caparrella ', NULL, 'Lleida'),
	(22, 'A0017', 'INS d’Almenar', NULL, 'Almenar'),
	(23, 'A0018', 'INS d’Aran ', NULL, 'Vielha e Mijaran'),
	(24, 'A0019', 'INS d’Hoteleria i Turisme ', NULL, 'Lleida'),
	(25, 'A0020', 'INS d’Ostalaria de LesVal d’Aran ', NULL, 'Les'),
	(26, 'A0021', 'INS de Guissona', NULL, 'Guissona'),
	(27, 'A0022', 'INS de Pontde Suert', NULL, 'Pont de Suert'),
	(28, 'A0023', 'INS de Tremp ', NULL, 'Tremp'),
	(29, 'A0024', 'INS Els Planells ', NULL, 'Artesa de Segre'),
	(30, 'A0025', 'INS Escola del Treball ', NULL, 'Lleida'),
	(31, 'A0026', 'INS Guindàvols ', NULL, 'Lleida'),
	(32, 'A0027', 'INS Hug Roger III ', NULL, 'Sort'),
	(33, 'A0028', 'INS Joan Brudieu ', NULL, 'La Seu d’Urgell'),
	(34, 'A0029', 'INS Joan Oró ', NULL, 'Lleida'),
	(35, 'A0030', 'INS Josep Vallverdú ', NULL, 'Les Borges Blanques'),
	(36, 'A0031', 'INS La Segarra ', NULL, 'Cervera'),
	(37, 'A0032', 'INS Mollerussa', NULL, 'Mollerussa'),
	(38, 'A0033', 'INS Ronda ', NULL, 'Lleida'),
	(39, 'A0034', 'INS Torre Vicens ', NULL, 'Lleida'),
	(40, 'A0035', 'La Salle ', NULL, 'La Seu d’Urgell'),
	(41, 'A0036', 'La Salle ', NULL, 'Mollerussa'),
	(42, 'A0037', 'Sant Josep ', NULL, 'Tàrrega');
/*!40000 ALTER TABLE `centers` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.centers_studies
CREATE TABLE IF NOT EXISTS `centers_studies` (
  `idcenter` int(11) NOT NULL,
  `idstudy` int(11) NOT NULL,
  `observation` text,
  `dual` char(1) DEFAULT NULL,
  PRIMARY KEY (`idcenter`,`idstudy`),
  KEY `FK_centers-studies_studies` (`idstudy`),
  CONSTRAINT `FK_centers-studies_centers` FOREIGN KEY (`idcenter`) REFERENCES `centers` (`id`),
  CONSTRAINT `FK_centers-studies_studies` FOREIGN KEY (`idstudy`) REFERENCES `studies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.centers_studies: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `centers_studies` DISABLE KEYS */;
INSERT INTO `centers_studies` (`idcenter`, `idstudy`, `observation`, `dual`) VALUES
	(21, 9, NULL, NULL),
	(21, 18, NULL, NULL),
	(21, 48, NULL, NULL),
	(21, 49, NULL, NULL),
	(21, 50, NULL, NULL),
	(21, 58, NULL, NULL),
	(21, 78, NULL, NULL);
/*!40000 ALTER TABLE `centers_studies` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.contests
CREATE TABLE IF NOT EXISTS `contests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0' COMMENT 'Nom del concurs',
  `description` text COMMENT 'Descripció',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.contests: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contests` DISABLE KEYS */;
/*!40000 ALTER TABLE `contests` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.diary
CREATE TABLE IF NOT EXISTS `diary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Data',
  `hora` float DEFAULT '0' COMMENT 'Hora',
  `durada` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Durada',
  `horari_mida` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Rang d''horari',
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom',
  `organitza` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Organitza',
  `ubicacio` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT 'Ubicació',
  `observacions` text COLLATE utf8_unicode_ci COMMENT 'Observacions',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla firafp.diary: ~141 rows (aproximadamente)
/*!40000 ALTER TABLE `diary` DISABLE KEYS */;
INSERT INTO `diary` (`id`, `data`, `hora`, `durada`, `horari_mida`, `nom`, `organitza`, `ubicacio`, `observacions`) VALUES
	(9, '20160414', 0, '', 'Tot el dia', 'Interprets de llengua de signes', 'INS Ronda', 'Totes les xerrades de la fira', 'L\'alumnat de llengua de signes interpretarà totes les xerrades de la fira. 2n ILS'),
	(10, '20160415', 0, '', 'Tot el dia', 'Interprets de llengua de signes', 'INS Ronda', 'Totes les xerrades de la fira', 'L’alumnat de llengua de signes interpretarà totes les xerrades de la Fira. 2n d’ILS'),
	(11, '20160414', 0, '', 'De 10h a 12h', 'Jocs de destresa', 'Episcopal', 'Estand serveis socioculturals i a la comunitat', 'Jocs de destresa per part de l’alumnat d’educació infantil'),
	(12, '20160415', 0, '', 'De 10h a 12h', 'Jocs de destresa', 'Episcopal', 'Estand serveis socioculturals i a la comunitat ', 'Jocs de destresa per part de l’alumnat d’educació infantil'),
	(13, '20160416', 0, '', 'De 10h a 12h', 'Jocs de destresa', 'Episcopal', 'Estand serveis socioculturals i a la comunitat', 'Jocs de destresa per part de l’alumnat d’educació infantil'),
	(14, '20160415', 0, '', 'De 11h a 14h', 'El teu nom en signes', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'El teu nom en llengua de signes, per part de l’alumnat de 1r d’atenció a persones en situació de dependència.'),
	(15, '20160414', 0, '', 'De 12.00h a 14.00h', 'Performance mediació', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'Performance per part de l’alumnat de mediació comunicativa.'),
	(16, '20160415', 0, '', 'De 16h a 18h', 'Performance mediació', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'Performance per part de l’alumnat de mediació comunicativa.'),
	(17, '20160416', 0, '', 'De 10.30h a 13h', 'Performance mediació', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'Performance per part de l’alumnat de Mediació comunicativa.'),
	(18, '20160414', 0, '', 'De 12h a 14h', 'Treballem els drets dels infants', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', ''),
	(19, '20160415', 0, '', 'De 12h a 14h', 'Treballem els drets dels infants', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', ''),
	(20, '20160414', 0, '', 'De 15h a 19h', 'El circ de l\'animació', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'El circ de l’Animació, per part de l’alumnat de primer d’Animació sociocultural i turística.'),
	(21, '20160415', 0, '', 'De 15h a 19h', 'El circ de l\'animació', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'El circ de l’Animació, per part de l’alumnat de primer d’Animació sociocultural i turística.'),
	(23, '20160414', 10, '30min', '', 'Conviu i aprèn', 'Departament de treball, afers socials i famílies-Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', 'Conviu i aprèn: Camps de treball a Catalunya i a l\'estranger. A càrrec de Victor Saló.'),
	(24, '20160414', 0, '', 'De 13h a 15h', 'Manteniment i ajustaments bàsics d’una BTT', 'Família activitats fisico esportives', 'Estand físico esportives', 'Manteniment i ajustaments bàsics d’una BTT (Peticions a demanda).'),
	(25, '20160414', 10.3, '30min', '', 'Servei voluntariat europeu', 'Departament de treball, afers socials i famílies-Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', 'A càrrec de Jaume Solsona.'),
	(26, '20160414', 11.3, '30min', '', 'Garantia Juvenil', 'Departament de treball, afers socials i famílies-Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', 'A càrrec de Glòria Mor.'),
	(27, '20160414', 11, '30min', '', 'El Carnet Jove: CONEIX-LO!', 'Departament de treball, afers socials i famílies-Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', 'Beques, descomptes, convocatòries, apps… A càrrec de Glòria Mor.'),
	(28, '20160414', 12, '1h', '', 'Com podem sobreviure els millennials?', 'IMO (Institut Municipal d\'Ocupació de l\'Ajuntament de Lleida) i GLOBALleida. Amb la col•laboració del SOC, Generalitat de Catalunya i SEPE.', 'Sala de presentacions del pavelló 3', 'A càrrec de Belena Gaynor, jove youtuber.'),
	(29, '20160414', 13.45, '45min', '', 'Alimentació i nutrició', 'Família de sanitàries. Departament d’Ensenyament – Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', 'A càrrec de Guillermo Peña Sáez.'),
	(30, '20160414', 17, '1h', '', 'Com salvar una vida en un minut', 'Família de sanitàries. Departament d’Ensenyament – Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', 'A càrrec de Benjamí Hueso.'),
	(31, '20160414', 15, '1h', '', 'De la FP a la competició', 'Família de Transport i Manteniment de Vehicles. Departament d’Ensenyament – Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', 'A càrrec de Joel Guerrero.'),
	(32, '20160414', 18, '1h', '', 'Vols treballar a Europa?', 'SOC (Servei Públic d\'Ocupació)', 'Sala de presentacions del pavelló 3', 'A càrrec de Silvia Esteve, assessora Heures.'),
	(33, '20160415', 11, '1h', '', 'Serà la integració de l\'FP una mesura d\'èxit?', 'CCOO', 'Sala de presentacions del pavelló 3', 'A càrrec d\'Eduard Requena, responsable de FP de CCOO.'),
	(34, '20160415', 12.3, '30min', '', 'Conviu i aprèn', 'Departament de Treball, Afers Socials i Famílies – Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', 'Conviu i aprèn: camps de treball a Catalunya i a l\'estranger. A càrrec de Victor Saló.'),
	(35, '20160415', 10, '1h', '', 'El camí per trobar feina', 'IMO (Institut Municipal d\'Ocupació de l\'Ajuntament de Lleida) i GLOBALleida. Amb la col•laboració del SOC, Generalitat de Catalunya i SEPE', 'Sala de presentacions del pavelló 3', 'A càrrec de Jaume Gurt, director d\'Organització i Desenvolupament de Persones de Schibsted Spain (Infojobs, Vibbo, Fotocasa, coche.net i milanuncios).'),
	(36, '20160415', 14, '1h', '', 'Com et poden ajudar les xarxes socials a trobar feina', 'Família de sanitàries. Departament d’Ensenyament – Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', 'A càrrec d’Esther Barqué.'),
	(37, '20160415', 17, '1h', '', 'Marca personal', 'Família comerç i màrqueting. Departament d’Ensenyament – Generalitat de Catalunya', 'Sala de presentacions del pavelló 3', ''),
	(38, '20160414', 0, '', 'De 9.45h a 13.30h', 'Jornada al Palau de Vidre', 'SSTT Ensenyament , InnovaFP i la Xarxa d’Emprenedoria', 'Saló Segrià. Palau de Vidre', '**Programa del Palau de Vidre**\r\n- 9.45 h. **Acreditacions**.\r\n- 10.00 h. **Ponència marc: “Procés de generació d’un model de negoci i posada en marxa”**. A càrrec del Sr. Joel Joli, fundador de Blackpier i del Sr. Àlex Surroca, de Useit i Cardiolive.\r\n- 10.50 h. **Presentació programes relació Escola-Empreses**.\r\n- 11.30 h. **Bones pràctiques**.\r\n- 12.30 h.  **Presentació de projectes dels alumnes del campament**.\r\n- 13.00 h. **Ponència: “Cas d’èxit emprenedor”**. A càrrec de la Sra. Maria Saldaña, fundadora de Prettyrumour.\r\n- 13.30 h. **Lliurament de premis i cloenda**.'),
	(39, '20160415', 16, '1h', '', 'Les estacions d\'esquí com no les has vist mai', 'Família d’activitats físico esportives. Departament d’Ensenyament – Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', 'A càrrec de Carles Hidalgo.'),
	(40, '20160415', 12, '30min', '', 'Servei Voluntariat Europeu', 'Departament de treball, afers socials i famílies-Generalitat de Catalunya.', 'Sala de presentacions del pavelló 3', ''),
	(41, '20160415', 13, '1h', '', 'Presentació projecte mSchools', 'Departament d\'Ensenyament-Serveis Centrals (BCN)', 'Sala de presentacions del pavelló 3', 'A càrrec de Josep Formenti (assessor tècnic docent d\'organització curricular d\'informàtica, imatge i so i arts gràfiques) i Roser Cussó (tècnica docent Àrea TAC).'),
	(42, '20160414', 0, '', 'De 9h a 12.30h', 'Programa al Col·legi Camps Elisis', 'Col·legi camps elisis', 'Saló Segrià. Palau de Vidre', '- 9:00 **Presentació model Canvas i proposta de repte d’innovació**.\r\n- 10:00 **Creació d’una idea.**\r\n- 10:50 **Prototipatge amb model Canvas i preparació de la presentació**.\r\n- 12:00 **Refrigeri**.\r\n- 12:30 **Presentació de projectes** (unificació de jornada al Palau de Vidre).'),
	(43, '20160415', 0, '', 'De 13h a 15h', 'Manteniment i ajustaments bàsics d’una BTT', 'Família activitats físico esportives', 'Estands de les families professionals', 'Manteniment i ajustaments bàsics d’una BTT (Peticions a demanda).'),
	(44, '20160414', 0, '', 'Tot el matí', 'Intervenció/performance d’animació i dinamització', 'Família activitats físico esportives', 'Estands de les families professionals', 'Pels passadissos de la fira.'),
	(47, '20160414', 0, '', 'Tot el dia', 'Demostracions amb suport informàtic', 'Família arts gràfiques', 'Estand arts gràfiques', 'Demostracions amb suport informàtic per fer treballs de composició i retoc d’imatge amb l’ajuda dels nostres alumnes.'),
	(48, '20160415', 0, '', 'Tot el dia', 'Demostracions amb suport informàtic', 'Família arts gràfiques', 'Estand arts gràfiques', 'Demostracions amb suport informàtic per fer treballs de composició i retoc d’imatge amb l’ajuda dels nostres alumnes.'),
	(49, '20160416', 0, '', 'Tot el dia', 'Demostracions amb suport informàtic', 'Família arts gràfiques', 'Estand arts gràfiques', 'Demostracions amb suport informàtic per fer treballs de composició i retoc d’imatge amb l’ajuda dels nostres alumnes.'),
	(50, '20160414', 0, '', 'Tot el dia', 'Taller: Quin és el teu rànquing social?', 'Família comerç i màrqueting', 'Estand comerç i màrqueting', ''),
	(51, '20160415', 0, '', 'Tot el dia', 'Taller: Quin és el teu rànquing social?', 'Família comerç i màrqueting', 'Estand comerç i màrqueting', ''),
	(52, '20160416', 0, '', 'Tot el dia', 'Taller: Quin és el teu rànquing social?', 'Família comerç i màrqueting', 'Estand comerç i màrqueting', ''),
	(53, '20160414', 0, '', 'Tot el dia', 'Demostracions de funcionament de fabricació mecànica', 'Família fabricació mecànica', 'Estand fabricació mecànica', '- Demostració del funcionament d’un centre de mecanitzat amb CNC.\r\n- Demostració del funcionament d’una impressora 3D.'),
	(54, '20160415', 0, '', 'Tot el dia', 'Demostracions de funcionament de fabricació mecànica', 'Família fabricació mecànica', 'Estand fabricació mecànica', '- Demostració del funcionament d’un centre de mecanitzat amb CNC.\r\n- Demostració del funcionament d’una impressora 3D.'),
	(55, '20160416', 0, '', 'Tot el dia', 'Demostracions de funcionament de fabricació mecànica', 'Família fabricació mecànica', 'Estand fabricació mecànica', '- Demostració del funcionament d’un centre de mecanitzat amb CNC.\r\n- Demostració del funcionament d’una impressora 3D.'),
	(56, '20160414', 0, '', 'Tot el dia', 'Elaboració de cervesa artesana', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(57, '20160415', 0, '', 'Tot el dia', 'Elaboració de cervesa artesana', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(58, '20160416', 0, '', 'Tot el dia', 'Elaboració de cervesa artesana', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(59, '20160414', 0, '', 'Tot el dia', 'Tallers', 'Família imatge personal', 'Estand imatge personal', 'Taller de maquillatge, decoració d’ungles, extensions i recollits.'),
	(60, '20160415', 0, '', 'Tot el dia', 'Tallers', 'Família imatge personal', 'Estand imatge personal', 'Taller de maquillatge, decoració d’ungles, extensions i recollits.'),
	(61, '20160416', 0, '', 'Tot el dia', 'Taller de maquillatge, decoració d’ungles, extensions i recollits', 'Família imatge personal', 'Estand imatge personal', 'Taller de maquillatge, decoració d’ungles, extensions i recollits.'),
	(63, '20160414', 0, '', 'De 15h a 17h', 'Simulador i demostracio', 'Família indústries extractives', 'Estand indústries extractives', '**Estand** \r\nSimulador de maquinària de moviment de terres. Demostració amb màquines petites per radio control. Proves amb simulador de 4 màquines: Retro Mixta, Retro Giratòria de rodes, Retro Giratòria de cadenes, Pala carregadora.\r\n\r\n**Zona Exterior del pavelló**\r\nDemostracions de maquinària realitzades per professorat i alumnat de: retroexcavadora giratòria, tractor, carretons elevadors industrials i manipuladores telescòpiques.\r\nProva de tractor acompanyat per operador. Fer-se fotos amb la maquinària.'),
	(64, '20160415', 0, '', 'De 9.30h a 14h', 'Simulador i demostracio', 'Família indústries extractives', 'Estand indústries extractives', '**Estand** \r\nSimulador de maquinària de moviment de terres. Demostració amb màquines petites per radio control. Proves amb simulador de 4 màquines: Retro Mixta, Retro Giratòria de rodes, Retro Giratòria de cadenes, Pala carregadora.\r\n\r\n**Zona Exterior del pavelló**\r\nDemostracions de maquinària realitzades per professorat i alumnat de: retroexcavadora giratòria, tractor, carretons elevadors industrials i manipuladores telescòpiques.\r\nProva de tractor acompanyat per operador. Fer-se fotos amb la maquinària.'),
	(65, '20160414', 0, '', 'Tot el dia', 'Elaboració de pastisseria i rebosteria', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(66, '20160416', 0, '', 'De 9.30h a 14.00h', 'Simulador i demostració', 'Família indústries extractives', 'Estand indústries extractives', '**Estand** \r\nSimulador de maquinària de moviment de terres. Demostració amb màquines petites per radio control. Proves amb simulador de 4 màquines: Retro Mixta, Retro Giratòria de rodes, Retro Giratòria de cadenes, Pala carregadora.\r\n\r\n**Zona Exterior del pavelló**\r\nDemostracions de maquinària realitzades per professorat i alumnat de: retroexcavadora giratòria, tractor, carretons elevadors industrials i manipuladores telescòpiques.\r\nProva de tractor acompanyat per operador. Fer-se fotos amb la maquinària.'),
	(67, '20160414', 0, '', 'Tot el dia', 'Taller telefonia VolP', 'Família informàtica', 'Estand informàtica', 'Taller telefonia VolP sobre Asterisk.'),
	(68, '20160415', 0, '', 'Tot el dia', 'Taller telefonia VolP', 'Família informàtica', 'Estand informàtica', 'Taller telefonia VolP sobre Asterisk.'),
	(69, '20160415', 0, '', 'Tot el dia', 'Elaboració de pastisseria i rebosteria', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(70, '20160416', 0, '', 'Tot el dia', 'Taller telefonia VolP', 'Família informàtica', 'Estand informàtica', 'Taller telefonia VolP sobre Asterisk.'),
	(71, '20160416', 0, '', 'Tot el dia', 'Elaboració de pastisseria i rebosteria', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', ''),
	(72, '20160414', 0, '', 'Tot el dia', 'Tallers diversos', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', '- Decoració amb fruites i verdures.\r\n- Cocteleria sense alcohol.\r\n- Malabars de baristes.\r\n- Composicions singulars de cocteleria.'),
	(73, '20160415', 0, '', 'Tot el dia', 'Tallers diversos', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', '- Decoració amb fruites i verdures.\r\n- Cocteleria sense alcohol.\r\n- Malabars de baristes.\r\n- Composicions singulars de cocteleria.'),
	(74, '20160416', 0, '', 'Tot el dia', 'Tallers diversos', 'Família hoteleria i turisme', 'Estand hoteleria i turisme', '- Decoració amb fruites i verdures.\r\n- Cocteleria sense alcohol.\r\n- Malabars de baristes.\r\n- Composicions singulars de cocteleria.'),
	(75, '20160414', 0, '', 'Tot el dia', 'Taller de mecanitzat', 'Família instal·lació i manteniment', 'Estand instal·lació i manteniment', 'Taller de mecanitzat i soldadura de canonades.'),
	(76, '20160415', 0, '', 'Tot el dia', 'Taller de mecanitzat', 'Familía instal·lació i manteniment', 'Estand instal·lació i manteniment', 'Taller de mecanitzat i soldadura de canonades.'),
	(77, '20160416', 0, '', 'Tot el dia', 'Taller de mecanitzat', 'Família instal·lació i manteniment', 'Estand instal·lació i manteniment', 'Taller de mecanitzat i soldadura de canonades.'),
	(86, '20160414', 0, '', 'Tot el dia', 'Anàlisi sensorial de productes alimentaris', 'Família industria alimentària', 'Estand industria alimentària', '-Dolçor i acidesa de begudes\r\n-Textura dels aliments\r\n-Flavor\r\n-Contingut de sucre'),
	(87, '20160415', 0, '', 'Tot el dia', 'Anàlisi sensorial de productes alimentaris', 'Família industria alimentària', 'Estand industria alimentària', '-Dolçor i acidesa de begudes\r\n-Textura dels aliments\r\n-Flavor\r\n-Contingut de sucre'),
	(88, '20160416', 0, '', 'Tot el dia', 'Anàlisi sensorial de productes alimentaris', 'Família industria alimentària', 'Estand industria alimentària', '-Dolçor i acidesa de begudes\r\n-Textura dels aliments\r\n-Flavor\r\n-Contingut de sucre'),
	(89, '20160414', 0, '', 'Tot el dia', 'Tallers de tast d’olis', 'Família industria alimentària', 'Estand industria alimentària', ''),
	(90, '20160415', 0, '', 'Tot el dia', 'Tallers de tast d’olis', 'Família industria alimentària', 'Estand industria alimentària', ''),
	(91, '20160416', 0, '', 'Tot el dia', 'Tallers de tast d’olis', 'Família industria alimentària', 'Estand industria alimentària', ''),
	(95, '20160414', 0, '', 'Tot el dia', 'Per que hi ha roques amb carbonats?', 'Família química', 'Estand química', ''),
	(96, '20160415', 0, '', 'Tot el dia', 'Per que hi ha roques amb carbonats?', 'Família química', 'Estand química', ''),
	(97, '20160416', 0, '', 'Tot el dia', 'Per que hi ha roques amb carbonats?', 'Família química', 'Estand química', ''),
	(98, '20160414', 0, '', 'Tot el dia', 'Química quotidiana', 'Família química', 'Estand química', '- Per que exploten les palometes?\r\n- Fer una truita?\r\n -Experiments amb activitats casolanes.'),
	(99, '20160415', 0, '', 'Tot el dia', 'Química quotidiana', 'Família química', 'Estand química', '- Per que exploten les palometes?\r\n- Fer una truita?\r\n -Experiments amb activitats casolanes.'),
	(100, '20160416', 0, '', 'Tot el dia', 'Química quotidiana', 'Família química', 'Estand química', '- Per que exploten les palometes?\r\n- Fer una truita?\r\n -Experiments amb activitats casolanes.'),
	(101, '20160414', 0, '', 'Tot el dia', 'Fabricació de biodièsel', 'Família química', 'Estand química', ''),
	(102, '20160415', 0, '', 'Tot el dia', 'Fabricació de biodièsel', 'Família química', 'Estand química', ''),
	(103, '20160416', 0, '', 'Tot el dia', 'Fabricació de biodièsel', 'Família química', 'Estand química', ''),
	(104, '20160414', 0, '', 'De 10h a 13h', 'Carnet de Salut', 'Família sanitàries', 'Estand sanitàries', ''),
	(105, '20160414', 0, '', 'De 10h a 13h', 'Demostració de llit hospitalari', 'Família sanitàries', 'Estand sanitàries', ''),
	(107, '20160414', 0, '', 'De 15.30h a 18.30h', 'Simulador de ressonància', 'Família sanitàries', 'Estand sanitàries', ''),
	(108, '20160414', 0, '', 'De 15.30h a 18.30h', 'Demostració llit hospitalari', 'Família sanitàries', 'Estand sanitàries', ''),
	(109, '20160414', 0, '', 'De 15.30h a 18.30h', 'Elaboració de dietes fisiopatològiques', 'Família sanitàries', 'Estand sanitàries', ''),
	(111, '20160414', 0, '', 'De 17h a 18h', 'Taller “Fem complements”.', 'Família tèxtil, confecció i pell', 'Estand de tèxtil, confecció i pell', ''),
	(112, '20160415', 0, '', 'De 11h a 13h', 'Taller “Fem complements”.', 'Família tèxtil, confecció i pell', 'Estand de tèxtil, confecció i pell', ''),
	(113, '20160414', 0, '', 'Tot el dia', 'Activitats pels alumnes en carrosseria i electromecànica', 'Família de transport i manteniment de vehicles', 'Estand transport i manteniment de vehicles', ''),
	(114, '20160415', 0, '', 'Tot el dia', 'Activitats pels alumnes en carrosseria i electromecànica', 'Família de transport i manteniment de vehicles', 'Estand transport i manteniment de vehicles', ''),
	(115, '20160416', 0, '', 'Tot el dia', 'Activitats pels alumnes en carrosseria i electromecànica', 'Família de transport i manteniment de vehicles', 'Estand transport i manteniment de vehicles', ''),
	(117, '20160414', 0, '', 'De 11.00h a 14.00h', 'Coneix el servei de teleassistència', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'Per part de l’alumnat de 2n d’Atenció a	persones en situació de dependència.'),
	(121, '20160414', 0, '', 'De 15.30h a 19h', 'Servei de ludoteca', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', ''),
	(126, '20160415', 0, '', 'De 12h a 15h', 'Photocall de les famílies professionals', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', 'A càrrec de l’alumnat d’Animació Sociocultural i Turística.'),
	(128, '20160415', 0, '', 'De 16h a 18h', 'Servei de ludoteca', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', ''),
	(132, '20160415', 0, '', 'De 9.30h a 13.00h', 'Presa de constants i Prevenció', 'Família sanitàries', 'Estand sanitàries', '- Activitats de prevenció i educació per la salut. \r\n- Higiene de mans.'),
	(133, '20160415', 0, '', 'De 9.30h a 13.00h', 'Taller de revelat de placa dental', 'Família sanitàries', 'Estand sanitàries', '- Higiene bucal. \r\n- Impressions. \r\n- Tècniques estèrils.'),
	(134, '20160415', 0, '', 'De 10.00h a 13.00h', 'Demostració fabricació crema', 'Família sanitàries', 'Estand sanitàries', ''),
	(135, '20160414', 0, '', 'De 15.30h a 18.30h', 'Carnet de salut', 'Família sanitàries', 'Estand sanitàries', ''),
	(136, '20160415', 0, '', 'De 10.00h a 13.00h', 'Visualització imatges en 3D', 'Família sanitàries', 'Estand sanitàries', ''),
	(137, '20160415', 0, '', 'De 10.00h a 13.00h', 'Electroforesi', 'Família sanitàries', 'Estand sanitàries', ''),
	(138, '20160415', 0, '', 'De 10.30h a 14.30h', 'Presa de constants vitals', 'Família sanitàries', 'Estand sanitàries', 'Presa de constants vitals i recomanacions per la salut.'),
	(139, '20160415', 0, '', 'De 15.00h a 19.00h', 'Taller de revelat de placa dental', 'Família sanitàries', 'Estand sanitàries', ''),
	(140, '20160415', 0, '', 'De 15.00h a 19.00h', 'Presa de contants i activitats de prevenció', 'Família sanitàries', 'Estand sanitàries', '- Presa de constants. \r\n- Activitats de prevenció\r\n- Educació per la salut. \r\n- Higiene de mans.'),
	(141, '20160415', 0, '', 'De 15.00h a 19.00h', 'Taller de revelat de placa dental', 'Família sanitàries', 'Estand sanitàries', '- Taller de revelat de placa dental.\r\n- Higiene bucal.\r\n- Impressions.\r\n- Tècniques estèrils.'),
	(142, '20160414', 0, '', 'De 9.30h a 14h', 'Simulador i demostracio', 'Família indústries extractives', 'Estand indústries extractives', '**Estand** \r\nSimulador de maquinària de moviment de terres. Demostració amb màquines petites per radio control. Proves amb simulador de 4 màquines: Retro Mixta, Retro Giratòria de rodes, Retro Giratòria de cadenes, Pala carregadora.\r\n\r\n**Zona Exterior del pavelló**\r\nDemostracions de maquinària realitzades per professorat i alumnat de: retroexcavadora giratòria, tractor, carretons elevadors industrials i manipuladores telescòpiques.\r\nProva de tractor acompanyat per operador. Fer-se fotos amb la maquinària.'),
	(143, '20160415', 0, '', 'De 15h a 17h', 'Simulador i demostracio', 'Família indústries extractives', 'Estand indústries extractives', '**Estand** \r\nSimulador de maquinària de moviment de terres. Demostració amb màquines petites per radio control. Proves amb simulador de 4 màquines: Retro Mixta, Retro Giratòria de rodes, Retro Giratòria de cadenes, Pala carregadora.\r\n\r\n**Zona Exterior del pavelló**\r\nDemostracions de maquinària realitzades per professorat i alumnat de: retroexcavadora giratòria, tractor, carretons elevadors industrials i manipuladores telescòpiques.\r\nProva de tractor acompanyat per operador. Fer-se fotos amb la maquinària.'),
	(144, '20160414', 0, '', 'Tot el dia', 'Zona de jocs', 'Família informàtica', 'Estand informàtica', ''),
	(145, '20160415', 0, '', 'Tot el dia', 'Zona de jocs', 'Família informàtica', 'Estand informàtica', ''),
	(146, '20160416', 0, '', 'Tot el dia', 'Zona de jocs', 'Família informàtica', 'Estand informàtica', ''),
	(148, '20160414', 0, '', 'Tot el dia', 'Joc: Oh! Tenim una fuita, ajuda’ns', 'Família instal·lació i manteniment', 'Estand instal·lació i manteniment', ''),
	(149, '20160415', 0, '', 'Tot el dia', 'Joc: Oh! Tenim una fuita, ajuda’ns', 'Família instal·lació i manteniment', 'Estand instal·lació i manteniment', ''),
	(150, '20160416', 0, '', 'Tot el dia', 'Joc: Oh! Tenim una fuita, ajuda’ns', 'Família instal·lació i manteniment', 'Estand instal·lació i manteniment', ''),
	(151, '20160416', 0, '', 'De 11h a 13h', 'Servei ludoteca', 'Família serveis socioculturals i a la comunitat', 'Estand serveis socioculturals i a la comunitat', ''),
	(153, '20160415', 0, '', 'De 17h a 18h', 'Taller "Fem complements"', 'Família tèxtil, confecció i pell', 'Estand tèxtil, confecció i pell', ''),
	(154, '20160414', 0, '', 'Tot el dia', 'Sessió de fotos en estudi', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes de Grau Superior d’Il·luminació, Captació i Tractament d’Imatge.'),
	(155, '20160415', 0, '', 'Tot el dia', 'Sessió de fotos en estudi', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes de Grau Superior d’Il·luminació, Captació i Tractament d’Imatge.'),
	(156, '20160416', 0, '', 'Tot el dia', 'Sessió de fotos en estudi', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes de Grau Superior d’Il·luminació, Captació i Tractament d’Imatge.'),
	(157, '20160414', 0, '', 'Tot el dia', 'Música en directe', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Mig de Vídeo, Discjòquei i So.'),
	(158, '20160415', 0, '', 'Tot el dia', 'Música en directe', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Mig de Vídeo, Discjòquei i So.'),
	(159, '20160416', 0, '', 'Tot el dia', 'Música en directe', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Mig de Vídeo, Discjòquei i So.'),
	(160, '20160414', 0, '', 'Tot el dia', 'Modelatge i disseny en 3D', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Superior d’Animacions 3D, Jocs i entorns interactius.'),
	(161, '20160414', 0, '', 'Tot el dia', 'Exposició de GLOBALleida: Idea, Projecte, Realitat.', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Tot comença amb la teva idea.'),
	(162, '20160415', 0, '', 'Tot el dia', 'Exposició de GLOBALleida: Idea, Projecte, Realitat', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Tot comença amb la teva idea.'),
	(163, '20160416', 0, '', 'Tot el dia', 'Exposició de GLOBALleida: Idea, Projecte, Realitat', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Tot comença amb la teva idea.'),
	(164, '20160414', 0, '', 'Tot el dia', 'Concurs Instagram “La foto emprenedora”', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'A les persones visitants a l’estand se’ls proposa que es facin una fotografia amb un dels elements/imatges que els facilitem. La foto l’han de penjar a Instagram amb el hastag  #gllconcursFT i guanya un tablet aquella que té més likes.'),
	(165, '20160415', 0, '', 'Tot el dia', 'Modelatge i disseny en 3D', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Superior d’Animacions 3D, Jocs i entorns interactius.'),
	(166, '20160416', 0, '', 'Tot el dia', 'Modelatge i disseny en 3D', 'Família imatge i so', 'Estand imatge i so', 'A càrrec dels alumnes del Grau Superior d’Animacions 3D, Jocs i entorns interactius.'),
	(167, '20160415', 0, '', 'Tot el dia', 'Concurs Instagram “La foto emprenedora”', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'A les persones visitants a l’estand se’ls proposa que es facin una fotografia amb un dels elements/imatges que els facilitem. La foto l’han de penjar a Instagram amb el hastag #gllconcursFT i guanya un tablet aquella que té més likes.'),
	(168, '20160416', 0, '', 'Tot el dia', 'Concurs Instagram “La foto emprenedora”', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'A les persones visitants a l’estand se’ls proposa que es facin una fotografia amb un dels elements/imatges que els facilitem. La foto l’han de penjar a Instagram amb el hastag #gllconcursFT i guanya un tablet aquella que té més likes.'),
	(169, '20160414', 0, '', 'De 11h a 13h', 'Fes-te la teva imatge a les xarxes socials', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Per veure quina imatge personal és la més adequada per publicar des de Linkedin, Facebook i Twitter a nivell professional.'),
	(170, '20160415', 0, '', 'De 11h a 13h', 'Fes-te la teva imatge a les xarxes socials', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Per veure quina imatge personal és la més adequada per publicar des de Linkedin, Facebook i Twitter a nivell professional.'),
	(171, '20160416', 0, '', 'De 11h a 13h', 'Fes-te la teva imatge a les xarxes socials', 'GLOBALLEIDA', 'Estand GLOBALLEIDA', 'Per veure quina imatge personal és la més adequada per publicar des de Linkedin, Facebook i Twitter a nivell professional.'),
	(172, '20160415', 0, '', 'De 10h a 13h', 'Carnet de salut', 'Família sanitàries', 'Estand sanitàries', ''),
	(173, '20160414', 0, '', 'Tot el dia', 'Fira F&T xarxes socials', 'Xarxes socials', 'Estand xarxes socials', 'Dinamitzar la Fira F&T a través de les següents xarxes socials: facebook, twitter i instagram i assessorament als assistents de com funcionen i quines són les millors pràctiques.'),
	(174, '20160415', 0, '', 'Tot el dia', 'Fira F&T xarxes socials', 'Xarxes socials', 'Estand xarxes socials', 'Dinamitzar la Fira F&T a través de les següents xarxes socials: facebook, twitter i instagram i assessorament als assistents de com funcionen i quines són les millors pràctiques.'),
	(175, '20160416', 0, '', 'Tot el dia', 'Fira F&T xarxes socials', 'Xarxes socials', 'Estand xarxes socials', 'Dinamitzar la Fira F&T a través de les següents xarxes socials: facebook, twitter i instagram i assessorament als assistents de com funcionen i quines són les millors pràctiques.'),
	(176, '20160414', 13, '45min', '', 'Vine a la Palma que ho sabem tot', 'Ajuntament de Lleida', 'Jornades a la Sala de Presentacions del Pavelló 3', 'A càrrec de les tècniques del Departament de Joventut.'),
	(177, '20160414', 16, '1h', '', 'Fes de la interpretació la teva professió', 'Aula Municipal de Teatre', 'Sala de presentacions del pavelló 3', 'A càrrec de Jaume Belló. Secretariat acadèmic CFGS en Tècniques d’Actuació Teatral.'),
	(178, '20160415', 0, '', 'Tot el dia', 'Taller de tast de vins', 'Família industria alimentària', 'Estand industria alimentària', ''),
	(179, '20160414', 0, '', 'Tot el dia', 'Taller de tast de vins', 'Família industria alimentària', 'Estand industria alimentària', ''),
	(180, '20160416', 0, '', 'Tot el dia', 'Taller de tast de vins', 'Família industria alimentària', 'Estand industria alimentària', '');
/*!40000 ALTER TABLE `diary` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.families
CREATE TABLE IF NOT EXISTS `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0' COMMENT 'Nom',
  `logo` varchar(50) DEFAULT '0' COMMENT 'Logo',
  `code` varchar(50) DEFAULT '0' COMMENT 'Codi de familia',
  `map_sector` int(11) DEFAULT '0' COMMENT 'Sector del mapa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.families: ~23 rows (aproximadamente)
/*!40000 ALTER TABLE `families` DISABLE KEYS */;
INSERT INTO `families` (`id`, `name`, `logo`, `code`, `map_sector`) VALUES
	(5, 'Informàtica', 'informatica.jpg', 'inf', 3),
	(6, 'Administració i Gestió', 'admin-gestio.jpg', 'adm', 5),
	(7, 'Activitats físiques i esportives', 'activitats-esportives.jpg', 'fis', 4),
	(8, 'Agrària', 'agraria.jpg', 'agr', 3),
	(9, 'Arts gràfiques', 'arts-grafiques.jpg', 'arts', 2),
	(10, 'Comerç i màrqueting', 'comerc.jpg', 'comer', 3),
	(11, 'Edificació i obra civil', 'obra-civil.jpg', 'obra', 5),
	(12, 'Electricitat i electrònica', 'electricitat-electronica.jpg', 'elec', 4),
	(13, 'Energia i aigua', 'energia-aigua.jpg', 'ener', 1),
	(14, 'Fabricació mecànica', 'mecanitzacio.jpg', 'fabr', 1),
	(15, 'Indústries extractives', 'ind-extra.jpg', 'extr', 3),
	(16, 'Fusta, moble i suro', 'fusteria.jpg', 'fust', 1),
	(17, 'Hoteleria i turisme', 'host-tur.jpg', 'turis', 1),
	(18, 'Imatge i so', 'img-so.jpg', 'so', 2),
	(19, 'Imatge personal', 'img-pers.jpg', 'imat', 1),
	(20, 'Indústries alimentàries', 'ind-ali.jpg', 'ali', 1),
	(21, 'Instal·lació i manteniment', 'inst-mant.jpg', 'insta', 1),
	(22, 'Química', 'quim.jpg', 'qui', 3),
	(23, 'Sanitat', 'sanitat.jpg', 'san', 2),
	(24, 'Serveis socioculturals i a la comunitat', 'sociocultu.jpg', 'soci', 4),
	(25, 'Seguretat  i medi ambient', 'edu-medi.jpg', 'medi', 3),
	(26, 'Tèxtil, confecció i pell', 'text-confe.jpg', 'confec', 1),
	(27, 'Transport i manteniment de vehicles', 'mecanica.jpg', 'trans', 2);
/*!40000 ALTER TABLE `families` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.studies
CREATE TABLE IF NOT EXISTS `studies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT '0' COMMENT 'Nom',
  `type` varchar(50) DEFAULT '0' COMMENT 'Tipus d''estudi',
  `map` varchar(50) DEFAULT '0' COMMENT 'Mapa',
  `familia` varchar(50) DEFAULT NULL COMMENT 'Familia',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.studies: ~92 rows (aproximadamente)
/*!40000 ALTER TABLE `studies` DISABLE KEYS */;
INSERT INTO `studies` (`id`, `name`, `type`, `map`, `familia`) VALUES
	(9, 'Sistemes Microinformàtics i Xarxes', 'fpgm', 'map-gm-3-1-16.png', 'inf'),
	(10, 'Gestió administrativa', 'fpgm', 'map-gm-3-1-3.png', 'adm'),
	(11, 'Gestió administrativa àmbit jurídic', 'fpgm', 'map-gm-3-1-3-b.png', 'adm'),
	(12, 'Conducció d’activitats físicoesportives en el medi natural. LOGSE', 'fpgm', 'map-gm-3-1-1.png', 'fis'),
	(13, 'Conducció d’activitats físicoesportives en el medi natural explotació d’estacions d’esquí', 'fpgm', 'map-gm-3-1-1-b.png', 'fis'),
	(14, 'Producció Agropecuària', 'fpgm', 'map-gm-3-1-2.png', 'agr'),
	(15, 'Aprofitament i conservació del medi natural', 'fpgm', 'map-gm-3-1-2-b.png', 'agr'),
	(16, 'Producció Agroecològica', 'fpgm', 'map-gm-3-1-2-c.png', 'agr'),
	(17, 'Jardineria i Floristeria', 'fpgm', 'map-gm-3-1-2-d.png', 'agr'),
	(18, 'Preimpressió digital', 'fpgm', 'map-gm-3-1-4.png', 'arts'),
	(19, 'Activitats comercials', 'fpgm', 'map-gm-3-1-4.png', 'comer'),
	(20, 'Obres d’interior, decoració i rehabilitació', 'fpgm', 'map-gm-3-1-6.png', 'obra'),
	(21, 'Construcció', 'fpgm', 'map-gm-3-1-6-b.png', 'obra'),
	(22, 'Instal.lacions de telecomunicacions', 'fpgm', 'map-gm-3-1-5-c.png', 'elec'),
	(23, 'Equips electrònics de consum (LOGSE', 'fpgm', 'map-gm-3-1-7-b.png', 'elec'),
	(24, 'Instal.lacions elèctriques i automàtiques', 'fpgm', 'map-gm-3-1-7-j.png', 'elec'),
	(25, 'Mecanització', 'fpgm', 'map-gm-3-1-4.png', 'fabr'),
	(26, 'Excavacions i sondatges', 'fpgm', 'map-gm-3-1-2-d.png', 'extr'),
	(27, 'Fusteria i moble', 'fpgm', 'map-gm-3-1-4.png', 'fust'),
	(28, 'Cuina i gastronomia', 'fpgm', 'map-gm-3-1-11.png', 'turis'),
	(29, 'Serveis en restauració', 'fpgm', 'map-gm-3-1-4.png', 'turis'),
	(30, 'Vídeo discjòquei i so', 'fpgm', 'map-gm-3-1-5-c.png', 'so'),
	(31, 'Estètica i bellesa ', 'fpgm', 'map-gm-3-1-4.png', 'imat'),
	(32, 'Perruqueria i cosmètica capil·lar ', 'fpgm', 'map-gm-3-1-4.png', 'imat'),
	(33, 'Olis d’oliva i vins', 'fpgm', 'map-gm-3-1-14.png', 'ali'),
	(34, 'Forneria, pastisseria i confiteria ', 'fpgm', 'map-gm-3-1-1-c.png', 'ali'),
	(35, 'Elaboració de productes alimentaris', 'fpgm', 'map-gm-3-1-4.png', 'ali'),
	(36, 'Manteniment electromecànic ', 'fpgm', 'map-gm-3-1-17.png', 'insta'),
	(37, 'Instal.lacions frigorífiques i de climatització', 'fpgm', 'map-gm-3-1-4.png', 'insta'),
	(38, 'Instal.lacions de producció de calor', 'fpgm', 'map-gm-3-1-4.png', 'insta'),
	(39, 'Cures auxiliars d’infermeria  LOGSE', 'fpgm', 'map-gm-3-1-18.png', 'san'),
	(40, 'Farmàcia i parafarmàcia', 'fpgm', 'map-gm-3-1-4.png', 'san'),
	(41, 'Emergències Sanitàries ', 'fpgm', 'map-gm-3-1-5-c.png', 'san'),
	(42, 'Atenció a persones en situació de dependència', 'fpgm', 'map-gm-3-1-21.png', 'soci'),
	(43, 'Confecció i moda', 'fpgm', 'map-gm-3-1-4.png', 'confec'),
	(44, 'Electromecànica de vehicles automòbils (vehicles industrials)', 'fpgm', 'map-gm-3-1-4.png', 'trans'),
	(45, 'Electromecànica de vehicles automòbils', 'fpgm', 'map-gm-3-1-23-d.png', 'trans'),
	(46, 'Electromecànica de maquinària', 'fpgm', 'map-gm-3-1-2-d.png', 'trans'),
	(47, 'Carrosseria', 'fpgm', 'map-gm-3-1-4.png', 'trans'),
	(48, 'Desenvolupament Aplicacions Multiplataforma', 'fpgs', 'map-gs-3-1-16-a.png', 'inf'),
	(49, 'Administració de Sistemes Informàtics', 'fpgs', 'map-gs-3-1-16-b.png', 'inf'),
	(50, 'Desenvolupament d\'Aplicacions Web', 'fpgs', 'map-gs-3-1-16-c.png', 'inf'),
	(51, 'Administració i finances', 'fpgs', 'map-gm-3-1-3-c.png', 'adm'),
	(52, 'Administració i finances amb continguts de comerç internacional', 'fpgs', 'map-gm-3-1-3-d.png', 'adm'),
	(53, 'Assistència a la direcció', 'fpgs', 'map-gm-3-1-3-e.png', 'adm'),
	(54, 'Animació d’activitats físiques i esportives  LOGSE', 'fpgs', 'map-gm-3-1-1-c.png', 'fis'),
	(55, 'Ramaderia i assistència en sanitat animal', 'fpgs', 'map-gm-3-1-2-f.png', 'agr'),
	(56, 'Gestió forestal i del medi natural', 'fpgs', 'map-gm-3-1-2-g.png', 'agr'),
	(57, 'Paisatgisme i medi rural', 'fpgs', 'map-gm-3-1-2-e.png', 'agr'),
	(58, 'Disseny i edició de publicacions impreses i multimèdia', 'fpgs', 'map-gm-3-1-4.png', 'arts'),
	(59, 'Comerç internacional ', 'fpgs', 'map-gm-3-1-5.png', 'comer'),
	(60, 'Transport i logística', 'fpgs', 'map-gm-3-1-4.png', 'comer'),
	(61, 'Màrqueting i publicitat', 'fpgs', 'map-gm-3-1-5-c.png', 'comer'),
	(62, 'Màrqueting i publicitat (Enològic)', 'fpgs', 'map-gm-3-1-4.png', 'comer'),
	(63, 'Gestió de vendes i espais comercials', 'fpgs', 'map-gm-3-1-5-c.png', 'comer'),
	(64, 'Projectes d’edificació', 'fpgs', 'map-gm-3-1-6.png', 'obra'),
	(65, 'Projectes d’obra civil', 'fpgs', 'map-gm-3-1-6-b.png', 'obra'),
	(66, 'Realització i plans d’obres LOGSE', 'fpgs', 'map-gm-3-1-6-b.png', 'obra'),
	(67, 'Automatització i robòtica industrial', 'fpgs', 'map-gm-3-1-5-c.png', 'elec'),
	(68, 'Manteniment electrònic', 'fpgs', 'map-gm-3-1-4.png', 'elec'),
	(69, 'Sistemes electrotècnics i automatitzats', 'fpgs', 'map-gm-3-1-4.png', 'elec'),
	(70, 'Sistemes de telecomunicacions i informàtics', 'fpgs', 'map-gm-3-1-5-c.png', 'elec'),
	(71, 'Eficiència energètica i energia solar tèrmica', 'fpgs', 'map-gm-3-1-4.png', 'ener'),
	(72, 'Energies renovables', 'fpgs', 'map-gm-3-1-4.png', 'ener'),
	(73, 'Programació de la producció en fabricació mecànica', 'fpgs', 'map-gm-3-1-4.png', 'fabr'),
	(74, 'Instal.lació i moblament', 'fpgs', 'map-gm-3-1-4.png', 'fust'),
	(75, 'Gestió d’allotjaments turístics', 'fpgs', 'map-gm-3-1-11.png', 'turis'),
	(76, 'Direcció de cuina', 'fpgs', 'map-gm-3-1-4.png', 'turis'),
	(77, 'Direcció de serveis de restauració', 'fpgs', 'map-gm-3-1-4.png', 'turis'),
	(78, 'Il.luminació, captació i tractament d’imatge', 'fpgs', 'map-gm-3-1-4.png', 'so'),
	(79, 'Animacions en 3D, jocs i entorns interactius', 'fpgs', 'map-gm-3-1-4.png', 'so'),
	(80, 'Estètica integral i benestar ', 'fpgs', 'map-gm-3-1-4.png', 'imat'),
	(81, 'Processos i qualitat en la indústria alimentària', 'fpgs', 'map-gm-3-1-14-b.png', 'ali'),
	(82, 'Vitivinicultura', 'fpgs', 'map-gm-3-1-14.png', 'ali'),
	(83, 'Mecatrònica industrial ', 'fpgs', 'map-gm-3-1-17-b.png', 'insta'),
	(84, 'Manteniment d’instal.lacions tèrmiques i de fluids', 'fpgs', 'map-gm-3-1-4.png', 'insta'),
	(85, 'Laboratori d’anàlisi i control de qualitat', 'fpgs', 'map-gm-3-1-4.png', 'qui'),
	(86, 'Higiene bucodental', 'fpgs', 'map-gm-3-1-19.png', 'san'),
	(87, 'Dietètica', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(88, 'Salut ambiental LOGSE', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(89, 'Laboratori clínic i biomèdic', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(90, 'Imatge per al diagnòstic i medicina nuclear', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(91, 'Documentació i administració sanitàries', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(92, 'Radioteràpia i Dosimetria', 'fpgs', 'map-gm-3-1-4.png', 'san'),
	(93, 'Animació sociocultural i turística', 'fpgs', 'map-gm-3-1-21-b.png', 'soci'),
	(94, 'Educació infantil', 'fpgs', 'map-gm-3-1-23-d.png', 'soci'),
	(95, 'Mediació comunicativa', 'fpgs', 'map-gm-3-1-4.png', 'soci'),
	(96, 'Integració social', 'fpgs', 'map-gm-3-1-21-d.png', 'soci'),
	(97, 'Educació i control ambiental', 'fpgs', 'map-gm-3-1-20.png', 'medi'),
	(98, 'Vestuari a mida i per a espectacles', 'fpgs', 'map-gm-3-1-4.png', 'confec'),
	(99, 'Patronatge i moda', 'fpgs', 'map-gm-3-1-4.png', 'confec'),
	(100, 'Automoció', 'fpgs', 'map-gm-3-1-5.png', 'trans');
/*!40000 ALTER TABLE `studies` ENABLE KEYS */;

-- Volcando estructura para tabla firafp.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla firafp.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`username`, `pass`) VALUES
	('admin', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
