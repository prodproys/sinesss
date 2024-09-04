DROP TABLE IF EXISTS `feedback`;
#
#
CREATE TABLE `feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT '0000-00-00 00:00:00',
  `fecha_edicion` datetime DEFAULT '0000-00-00 00:00:00',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` char(1) DEFAULT NULL,
  `proyecto` varchar(80) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `motivo` varchar(80) DEFAULT NULL,
  `comentario` varchar(800) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
#
#
DROP TABLE IF EXISTS `paginas`;
#
#
CREATE TABLE `paginas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT '0000-00-00 00:00:00',
  `fecha_edicion` datetime DEFAULT '0000-00-00 00:00:00',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1',
  `pagina` varchar(80) DEFAULT NULL,
  `titulo` varchar(80) DEFAULT NULL,
  `texto` longtext,
  `foto` varchar(150) DEFAULT NULL,
  `foto_descripcion` varchar(80) DEFAULT NULL,
  `web` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagina` (`pagina`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
#
#
INSERT INTO `paginas` VALUES ("1", "2012-05-03 19:31:17", "2012-05-03 17:58:00", NULL, "1", "bienvenido", "Bienvenido", "<p>Nos es grato saludarlos y presentarnos a Ustedes como una Empresa con sólidos conocimientos en Ingeniería de Mantenimientos a Equipos Industriales.<br /><br />Ofrecemos Servicios Corporativos en diversas áreas del ramo, Gestión en Mantenimientos con manejo de Programas Preventivos, Correctivos, Historiales.<br />\nVentas de repuestos, electromecánicos, equipos electrónicos y sistemas de pesajes electrónicos contamos con personal altamente especializado.</p>", "pag_1336091477_474x248.jpg", NULL, "1");
#
#
INSERT INTO `paginas` VALUES ("2", "2012-04-29 13:01:17", "2013-02-02 20:04:29", NULL, "1", "empresa", "Empresa", "<p>En <strong>MECATRONIC SYSTEMS</strong>&nbsp;nos preocupamos por la mejora continua de su Organización, trabajando en equipo con Ustedes para lograr objetivos notables en su Empresa.<br /><br />\n \nEn la actualidad estamos trabajando con empresas de prestigio a nivel Nacional e Internacional (Latino América), estas nos presentan como una opción en el rubro por mantener un servicio de calidad y garantía a lo largo del tiempo.Y nos gustaría ser parte de su selecta lista de proveedores.<br /><br />Somos una empresa con personal especializado conformado por Ingenieros y Técnicos con más 18 años de experiencia en el rubro Industrial.<br /><br /><strong>Visión</strong><br />\n\"Ser líderes en el campo de la Tecnología Industrial en Venta de equipos y Servicios Especializados para ayudar al éxito de nuestros clientes , ofreciendo un buen soporte y garantía  en nuestro servicio de cada día que beneficiará notablemente a su organización\".<br /><br /><strong>Misión</strong><br />\n“Brindar soluciones en Tecnología, con conocimiento aplicado desarrollando alternativas de solución que se caractericen notablemente por ser confiables, con total garantía y con proyección a futuro cumpliendo siempre con los acuerdos iniciales pactados con nuestros clientes\".</p>", NULL, NULL, "1");
#
#
DROP TABLE IF EXISTS `proyectos`;
#
#
CREATE TABLE `proyectos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT '0000-00-00 00:00:00',
  `fecha_edicion` datetime DEFAULT '0000-00-00 00:00:00',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` char(1) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `carpeta` varchar(80) DEFAULT NULL,
  `url` varchar(80) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `descripcion` varchar(800) DEFAULT NULL,
  `dominio` varchar(80) DEFAULT NULL,
  `ftp_user` varchar(80) DEFAULT NULL,
  `ftp_pass` varchar(80) DEFAULT NULL,
  `ftp_root` varchar(80) DEFAULT NULL,
  `seguro` varchar(80) DEFAULT NULL,
  `para_subir` varchar(80) DEFAULT NULL,
  `fecha_acceso` datetime DEFAULT '0000-00-00 00:00:00',
  `calificacion` char(1) DEFAULT NULL,
  `tipo` varchar(80) DEFAULT NULL,
  `semilla` int(10) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `archivo` varchar(80) DEFAULT NULL,
  `firma` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;
#
#
INSERT INTO `proyectos` VALUES ("1", "2010-06-30 11:50:37", "2011-06-17 15:59:02", NULL, "1", "proy_1277913027_225x105.jpg", "cajamarcainfo", "cajamarcatravel.info", "Cajamarca Travel Marketing", "", "cajamarcatravel.info", "cjmarca", "travelinfo", "/www/", "0", "0", "2011-07-04 00:50:07", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("2", "2010-06-30 12:22:47", "2011-05-30 11:31:56", NULL, "1", NULL, "afarmach", NULL, "afarmach.com", NULL, "afarmach.com", "afarmach", "dr34chip", "/www/", NULL, NULL, "2011-05-30 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("3", "2010-06-30 12:22:47", "2010-06-30 12:22:47", NULL, "1", NULL, "agente", NULL, "www.agenteinmobiliarioperu.com", NULL, "www.agenteinmobiliarioperu.com", "agente", "prodiserv", "/www/", NULL, NULL, "2013-01-23 03:23:23", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("4", "2010-06-30 12:22:47", "2010-06-30 12:22:47", NULL, "1", NULL, "agentes", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:47", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("5", "2010-06-30 12:22:47", "2010-09-15 02:34:43", NULL, "1", NULL, "agentestop", NULL, "crazyosito", NULL, "crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-12-06 11:21:57", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("6", "2010-06-30 12:22:48", "2011-05-30 11:38:16", NULL, "1", NULL, "alopollo", NULL, "alopollo.com", NULL, "alopollo.com", "pollit", "Alo-pol1", "/", NULL, NULL, "2011-05-30 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("7", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "artemilenario", NULL, "artemilenario.com", NULL, "artemilenario.com", "artemili", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("8", "2010-06-30 12:22:48", "2010-07-27 17:35:07", NULL, "1", NULL, "boraedifica", NULL, "boraedifica", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("9", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "cafeexpress", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("10", "2010-07-03 12:26:33", "2011-05-30 11:37:00", NULL, "1", "proy_1278174385_135x120.jpg", "calandria", "calandriatravel.com", "Calandria Travel", "", "calandriatravel.com", "calan", "travel159357", "/www/", "0", "1", "2013-01-14 09:56:36", "0", NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("11", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "canon", NULL, "canondelapurimac.com", NULL, "canondelapurimac.com", "canondel", "salas", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("12", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "casalinda", NULL, "casalindaperu.com", NULL, "casalindaperu.com", "casalind", "fG6e1R89", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("13", "2010-06-30 12:22:48", "2010-07-27 17:34:57", NULL, "1", NULL, "ceperson", NULL, "ceperson", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("14", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "clubinvierta", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("15", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "coldserviceperu", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("16", "2010-06-30 12:22:48", "2010-07-27 17:34:49", NULL, "1", NULL, "colesiinmobiliaria", NULL, "colesiinmobiliaria", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("17", "2010-06-30 12:22:48", "2010-07-27 17:34:33", NULL, "1", NULL, "crazy", NULL, "crazy", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("18", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "dcmindustrias", NULL, "dcmindustrias.com", NULL, "dcmindustrias.com", "dcm", "industrias159357", "/www/", NULL, NULL, "2011-06-09 11:02:04", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("19", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "digitalico", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("20", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "dtask", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("21", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "edificiovancouver", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("22", "2010-06-30 13:54:22", "2011-06-17 16:01:24", NULL, "1", "proy_1277920453_75x75.jpg", "emailmarketing", "webtiendas.net", "email marketing", NULL, "webtiendas.net", "tiendas", "sentidos159357", "/www/emailmarketing/", "0", "0", "2010-07-01 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("23", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "enlaca2010", NULL, "lacasadelenvase.com", NULL, "lacasadelenvase.com", "casenv", "enlaca2010", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("24", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "entermedia", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("25", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "equiamerica", NULL, "equiamerica.com", NULL, "equiamerica.com", "equi", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("26", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "ethlodamusic", NULL, "ethlodamusic.com", NULL, "ethlodamusic.com", "ethloda", "music159357", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("27", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "eventostiens", NULL, "eventostiens.com", NULL, "eventostiens.com", "event", "tienspe2010", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("28", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "expoamericano", NULL, "www.expoamericano.com", NULL, "www.expoamericano.com", "expoamer", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("29", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "forteplast", NULL, "forteplast.com", NULL, "forteplast.com", "fortwa", "plastef2010", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("30", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "heteria", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("31", "2010-07-08 07:13:07", "2010-07-12 12:58:03", NULL, "1", "proy_1278587578_114x75.jpg", "iaac", "iaacuscolima.com", "iaacuscolima.com", "null", "iaacuscolima.com", "iaacusco", "iaa159357", "/www/", "null", "null", "2011-09-14 22:27:35", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("32", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "iaacusco", NULL, "webtiendas.net", NULL, "webtiendas.net", "tiendas", "tupac", "/www/iaacusco", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("34", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "istpoo", NULL, "istpoo.edu.pe", NULL, "istpoo.edu.pe", "apoo123", "106902", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("35", "2010-06-30 12:22:48", "2010-06-30 12:22:48", NULL, "1", NULL, "kankio", NULL, "kankio.com", NULL, "kankio.com", "kankio", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("36", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "kkiery", NULL, "www.kkieri.com", NULL, "www.kkieri.com", "kkieri", "159357", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("37", "2010-07-27 14:16:27", "2011-06-17 16:00:35", NULL, "1", "proy_1280254574_232x73.jpg", "kkiery2", NULL, "superplazavirtual.com", NULL, "superplazavirtual.com", "plaza", "virtual", "/www/", NULL, "0", "2010-11-22 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("38", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "kusina", NULL, "kusinapachacamac.com.pe", NULL, "kusinapachacamac.com.pe", "kusina", "abut761", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("39", "2010-07-27 14:09:39", "2010-07-27 14:09:29", NULL, "1", "proy_1280254171_210x104.jpg", "kusinapachacamac", NULL, "kusinapachacamac.com.pe", "null", "kusinapachacamac.com.pe", "kusina", "abut761", "/www/", "null", "null", "2011-05-24 14:06:07", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("40", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "limamarinaclub", NULL, "limamarinaclub.com", NULL, "limamarinaclub.com", "marina3d", "lmc159357", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("41", "2010-06-30 12:22:49", "2010-07-27 17:34:12", NULL, "1", NULL, "lupe", NULL, "lupe", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("42", "2010-06-30 12:22:49", "2010-07-27 17:34:04", NULL, "1", NULL, "luqma", NULL, "luqma", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("43", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "mainua", NULL, "mainuatours.com", NULL, "mainuatours.com", "mainua", "alpha", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("44", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "majocil", NULL, "majocil.com", NULL, "majocil.com", "majocil", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("45", "2010-08-03 11:09:42", "2011-05-30 11:32:37", NULL, "1", "proy_1280848171_294x69.jpg", "meijer", "meijereventos.com", "Meijer Eventos", NULL, "meijereventos.com", "meijer", "prodiserv", "/www/", "0", "1", "2011-07-04 03:25:44", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("46", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "mildelicias", NULL, "mildelicias.com", NULL, "mildelicias.com", "delicias", "md159357", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("47", "2011-04-28 14:47:10", "2011-04-28 14:46:41", NULL, "1", "proy_1304020007_298x100.jpg", "myhouse", "www.montes.pe", "MONTES.PE", "null", "www.montes.pe", "montespe", "napoleon", "/www/", "0", "0", "2011-11-16 14:23:26", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("48", "2010-06-30 12:22:49", "2011-04-06 20:55:11", NULL, "1", NULL, "myhousecompe", NULL, "montes.pe", "null", "montes.pe", "montespe", "napoleon", "/www/", "0", "0", "2011-04-06 20:52:55", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("49", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "nivueltaquedarle", NULL, "nivueltaquedarle.com", NULL, "nivueltaquedarle.com", "vuelta09", "quedarle", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("50", "2010-06-30 13:36:30", "2011-06-17 16:03:24", NULL, "1", "proy_1277919380_105x112.jpg", "nivueltaquedarlepe", "nivueltaquedarle.com.pe", "nivueltaquedarle.com.pe", NULL, "nivueltaquedarle.com.pe", "quedarle", "prodiserv", "/www/", "0", "0", "2010-08-09 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("53", "2011-06-07 15:14:27", "2011-06-16 23:35:14", NULL, "1", "proy_1307477657_54x64.jpg", "portafolioeconomico", "portafolioeconomico.com", "Perú Democrata", "", "perudemocrata.com", "ppkdemoc", "democracia2011", "/www/", "0", "1", "2013-08-07 07:50:44", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("54", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "preinca", NULL, "preinca.com", NULL, "preinca.com", "preinca", "losincas", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("55", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "socioesi", NULL, "consorcioesi.com", NULL, "consorcioesi.com", "consor", "socioesi", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("56", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "soedsac", NULL, "webtiendas.net", NULL, "webtiendas.net", "tiendas", "wt159357", "/www/soed/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("57", "2010-06-30 13:37:35", "2010-07-13 12:16:39", NULL, "1", "proy_1277919443_275x300.jpg", "starpartner", "", "starpartner.com.pe", "", "starpartner.com.pe", "star", "javana2010", "/www/", "null", "null", "2010-11-04 13:01:24", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("58", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "tavara", NULL, "waltertavara.com", NULL, "waltertavara.com", "walter", "tavara", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("59", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "unicornioazul", NULL, "unicornioazul.com.pe", NULL, "unicornioazul.com.pe", "unicor7", "unico2010", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("60", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "universmusic", NULL, "www.crazyosito.com", NULL, "www.crazyosito.com", "crazy", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("61", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "urbaniza", NULL, "urbaniza.com", NULL, "urbaniza.com", "urbaniza", "urbaniza", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("62", "2010-06-30 12:22:49", "2010-06-30 12:22:49", NULL, "1", NULL, "vipunder", NULL, "vip-underwear.net", NULL, "vip-underwear.net", "vipunder", "prodiserv", "/www/", NULL, NULL, "2010-06-30 12:22:49", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("63", "2010-06-30 12:22:50", "2010-07-27 17:33:32", NULL, "1", NULL, "zazzle", NULL, "zazzle", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "2010-06-30 12:22:50", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("68", "2010-07-13 13:35:13", "0000-00-00 00:00:00", NULL, "1", NULL, "mecatronicsystems", "mecatronicsystems.com", "mecatronicsystems.com", "", "mecatronicsystems.com", "mecatron", "prodiserv", "/www/", "", "", "2010-07-13 14:02:08", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("69", "2010-07-21 12:18:21", "2010-07-21 12:45:51", NULL, "1", NULL, "kankio2", "kankio.com", "kankio 2", "null", "kankio.com", "kankio", "kanarq2010", "/www/", "0", "0", "2010-07-21 12:17:01", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("70", "2011-05-27 09:09:05", "2011-06-16 23:33:41", NULL, "1", "proy_1306505335_305x100.jpg", "mitiendaderegalos", "globalvsc.com", "Ni Vuelta Que Darle", NULL, "nivueltaquedarle.com", "nicom1", "globalvscnvqd", "/www/", "0", "1", "2013-05-19 19:44:51", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("71", "2010-08-03 11:00:35", "2011-06-17 15:59:55", NULL, "1", "proy_1280847626_152x183.jpg", "conejitasperu", "conejitas-peru.com", "Conejitas Perú", "null", "conejitas-peru.com", "conejita", "aldomiraval2011", "/www/", "0", "0", "2011-05-30 00:00:00", "0", NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("72", "2010-08-06 22:50:30", "0000-00-00 00:00:00", NULL, "1", NULL, "bestpowerperu", "bestpowerperu.com", "bestpowerperu.com", NULL, "bestpowerperu.com", "bepoer", "perupower2010", "/www/", NULL, NULL, "2010-08-07 12:09:36", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("74", "2010-08-16 13:42:15", "0000-00-00 00:00:00", NULL, "1", NULL, "josecatano", "josecatano.com", "josecatano.com", NULL, "josecatano.com", "setano", "catano2010", "/www/", "0", "0", "2010-08-16 19:00:16", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("76", "2010-08-25 14:13:51", "0000-00-00 00:00:00", NULL, "1", NULL, "disegnaarq", "disegna-arq.com", "disegna-arq.com", NULL, "disegna-arq.com", "arquit", "disegna2010", "/www/", NULL, NULL, "2010-08-26 10:56:22", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("77", "2010-09-01 10:26:50", "0000-00-00 00:00:00", NULL, "1", NULL, "comercialelsiglo", "comercialelsiglo.pe", "comercialelsiglo", NULL, "comercialelsiglo.pe", "sigloc", "comercial2010", "/www/", NULL, NULL, "2010-09-01 19:06:01", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("78", "2010-09-01 10:49:06", "0000-00-00 00:00:00", NULL, "1", NULL, "albergueinkasisa", "albergueinkasisa.com", "albergueinkasisa", NULL, "albergueinkasisa.com", "kasisa", "albergue2010", "/www/", NULL, NULL, "2010-09-01 10:48:37", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("79", "2010-09-01 10:56:45", "0000-00-00 00:00:00", NULL, "1", NULL, "codisaelectronic", "codisaelectronic.pe", "codisaelectronic", NULL, "codisaelectronic.pe", "lectro", "codisa2010", "/www/", NULL, NULL, "2010-09-01 19:04:42", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("80", "2010-09-01 11:27:59", "0000-00-00 00:00:00", NULL, "1", NULL, "puericultoriojavadeayacucho", "puericultoriojavadeayacucho.com", "puericultoriojavadeayacucho", NULL, "puericultoriojavadeayacucho.com", "ayacho", "puericultorio2010", "/www/", NULL, NULL, "2010-09-01 12:31:25", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("81", "2010-09-09 15:39:44", "2011-04-28 09:18:24", NULL, "1", NULL, "perutradex", NULL, "perutradex", NULL, "perutradex.com", "tradex", "ingventas2010", "/www/", NULL, NULL, "2010-09-09 00:00:00", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("82", "2010-09-09 16:28:03", "2010-09-09 16:35:23", NULL, "1", NULL, "cienciaceleste", "cienciaceleste.org.pe/", "cienciaceleste", NULL, "cienciaceleste.org.pe", "cceleste", "c1enc1a", "/www/", NULL, NULL, "2010-10-04 18:07:10", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("83", "2010-09-16 14:01:24", "2010-09-16 14:02:43", NULL, "1", NULL, "kralovati", "kralovati.com", "kralovati.com", NULL, "kralovati.com", "kravot", "kralova2010", "/www/", NULL, NULL, "2010-09-16 14:11:06", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("94", "2010-10-05 21:44:03", "0000-00-00 00:00:00", NULL, "1", NULL, "todohoteles", "todohotelesperu.com", "todohotelesperu", NULL, "todohotelesperu.com", "hotelspe", "calandria", "/www/", NULL, NULL, "2010-10-05 21:43:07", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("95", "2010-10-11 09:02:15", "0000-00-00 00:00:00", NULL, "1", NULL, "inkasisahostel", "inkasisahostel.com", "inkasisahostel.com", NULL, "inkasisahostel.com", "hostka", "hotesisa2010", "/www/", NULL, NULL, "2010-10-11 09:04:03", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("96", "2010-10-12 20:18:08", "0000-00-00 00:00:00", NULL, "1", NULL, "postespasa", "postespasa.com", "postespasa.com", NULL, "postespasa.com", "postespa", "patespo2010", "/www/", NULL, NULL, "2010-10-12 22:32:48", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("97", "2010-10-26 17:04:53", "0000-00-00 00:00:00", NULL, "1", NULL, "omeghaconstructor", "omeghaconstructor.com", "omeghaconstructor", NULL, "omeghaconstructor.com", "omegha", "oc159357", "/www/", NULL, NULL, "2010-10-27 20:31:27", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("98", "2011-01-16 09:12:19", "2011-06-19 16:03:55", NULL, "1", "proy_1295187130_166x104.jpg", "mismotivos", "mismotivos.com", "Mis Motivos", NULL, "mismotivos.com", "homeromo", "romerotivos2010", "/www/", "0", "1", "2013-05-22 18:57:45", "2", NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("100", "2011-01-27 11:51:44", "2011-05-30 11:53:43", NULL, "0", "proy_1296147093_223x443.jpg", "kinetube", "kinetube.com", "Kinetube", "null", "kinetube.com", "kinejuan", "jkkine2010", "/www/", "0", "1", "2011-06-16 08:54:56", "0", NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("101", "2011-02-28 00:02:02", "2011-06-26 10:17:15", NULL, "1", "proy_1298869312_267x44.jpg", "olvacompras", "olvacompras.com", "Olva Compras", NULL, "olvacompras.com", "olvacomp", "compraonlineolva1202", "/www/", "0", "1", "2013-02-25 09:31:01", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("102", "2011-03-09 17:33:23", "0000-00-00 00:00:00", NULL, "1", NULL, "introducingperu", "introducingperu.com", "Introducing Peru", NULL, "introducingperu.com", "introdu", "cinperu", "/www/", NULL, NULL, "2011-03-09 17:32:30", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("103", "2011-11-10 20:35:40", "2011-11-10 20:36:36", NULL, "1", "proy_1320975331_293x76.jpg", "aquarelah", "dondeencontrar.com", "Aquarelah", NULL, "dondeencontrar.com", "dondeen", "platano", "/www/", "0", "1", "2011-12-09 16:04:19", NULL, "1", "145", NULL, NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("104", "2011-05-18 17:47:46", "2011-05-19 20:04:12", NULL, "1", "proy_1305758856_297x67.jpg", "qosmica", "dondeencontrar.com", "qosmica", NULL, "dondeencontrar.com", "dondeen", "platano", "/www/", NULL, NULL, "2011-05-24 13:44:18", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("110", "2011-06-15 16:08:56", "0000-00-00 00:00:00", NULL, "1", NULL, "MUNIPOMA", "MUNIPOMA.GOB.PE", "MUNIPOMA.GOB.PE", NULL, "MUNIPOMA.GOB.PE", "lospomabambinos", "loscedros150", "/www/", NULL, NULL, "2011-07-06 14:50:53", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("111", "2011-06-21 17:36:55", "0000-00-00 00:00:00", NULL, "1", NULL, "travelofertas", "travelofertas.info", "travelofertas", NULL, "travelofertas.info", "traofer", "ofertra", "/www/", NULL, NULL, "2011-06-21 17:57:01", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("112", "2011-06-21 17:57:46", "2011-06-21 17:58:52", NULL, "1", NULL, "ofertastravel", "ofertastravel.info", "ofertastravel", NULL, "ofertastravel.info", "ofertra", "traofer", "/www/", NULL, NULL, "2011-06-21 17:57:06", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("0", "2011-06-22 01:14:37", "2011-11-08 21:03:12", NULL, "1", NULL, "eshoradeviajar", "eshoradeviajar.com", "eshoradeviajar", NULL, "eshoradeviajar.com", "eshora", "deviajar", "/www/", NULL, NULL, "2011-07-04 00:49:57", NULL, NULL, NULL, NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("134", "2011-07-06 16:17:48", "2011-07-06 16:18:35", NULL, "1", NULL, "hitogroup", "hitogroup.com", "Hito Group", NULL, "hitogroup.com", "hitogr", "proyectohg", "/www/", "0", "0", "2011-07-08 09:42:54", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("135", "2011-11-06 20:03:55", "2011-11-07 20:25:29", NULL, "1", "proy_1320627827_377x91.jpg", "crmcallcenter", "vehiculos.com.pe", "CRM INCAPOWER", NULL, "vehiculos.com.pe", "circulan", "toyohatsutruck2011", "/www/", "0", "1", "2013-06-27 20:08:07", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("136", "2011-07-18 03:35:05", "2011-11-03 12:06:58", NULL, "1", "proy_1310978096_277x127.jpg", "olvacourier", "prodiserv.com/olvacourier", "Olvacourier", NULL, "prodiserv.com", "prodiser", "tavarasac", "/www/olvacourier/", "0", "1", "2014-08-04 13:56:32", "0", NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("137", "2011-08-02 13:36:11", "2011-08-02 13:36:01", NULL, "0", "proy_1312310163_172x39.jpg", "truckmax", "truckmax.com.pe", "Truck Max", NULL, "truckmax.com.pe", "truck", "r0manr0man", "/www/", "0", "1", "2011-10-25 15:09:24", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("138", "2011-08-29 11:23:03", "2011-08-31 05:44:04", NULL, "0", "proy_1314634974_244x109.jpg", "majocil", "majocil.com.pe", "Majocil", NULL, "majocil.com.pe", "majocil", "prodiserv", "/www/", "0", "1", "2011-09-02 14:28:52", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("139", "2011-09-27 20:55:05", "2011-11-23 15:31:49", NULL, "1", "proy_1317174893_243x104.jpg", "bukyncom", "bukyn.com", "BUKYN", NULL, "bukyn.com", "bukyn", "platano", "/www/", "0", "0", "2011-09-28 10:33:26", NULL, "1", "145", NULL, NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("140", "2011-10-19 18:37:40", "0000-00-00 00:00:00", NULL, "0", NULL, "majocilcasas", "casasmaderaprefabricadas.com", "majocil casas", NULL, "casasmaderaprefabricadas.com", "neocasas", "majocasas2011", "/www/", "0", "1", "2011-10-19 20:33:09", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("141", "2011-11-02 12:43:41", "2011-11-03 12:08:46", NULL, "1", NULL, "incapower", "incapower.vehiculos.com.pe", "incapower", NULL, "vehiculos.com.pe", "circulan", "toyohatsutruck2011", "/incapower/", "0", "1", "2011-11-12 10:14:32", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("142", "2011-11-03 12:10:26", "0000-00-00 00:00:00", NULL, "1", NULL, "daihatsu", "daihatsu.vehiculos.com.pe", "daihatsu", NULL, "vehiculos.com.pe", "circulan", "toyohatsutruck2011", "/www/daihatsu/", "0", "1", "2011-11-04 09:35:36", NULL, NULL, NULL, NULL, NULL, NULL);
#
#
INSERT INTO `proyectos` VALUES ("143", "2011-11-11 14:33:54", "2011-11-11 14:33:43", NULL, "1", "proy_1321040025_172x39.jpg", "crm", "crmcallcenter.info", "CRM TRUCKMAX", NULL, "crmcallcenter.info", "crmcallc", "chalujabuna2011", "/www/", "0", "1", "2012-11-08 21:54:02", NULL, "1", "137", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("144", "2011-11-09 12:53:25", "2011-11-09 12:53:13", NULL, "1", "proy_1320861195_192x70.jpg", "ceavirtual", "cea-virtual.com", "CEA-VIRTUAL", NULL, "cea-virtual.com", "ceavirtu", "ruceturvi2011", "/www/", "0", "1", "2011-11-23 02:32:54", NULL, "1", "136", "informes@cea-virtual.com", "http://cea-virtual.com/propuesta1.html", "1");
#
#
INSERT INTO `proyectos` VALUES ("145", "2011-11-09 12:51:06", "2011-11-09 12:50:55", NULL, "1", "proy_1320861057_267x49.jpg", "saludholisticaperu", "saludholisticaperu.com", "Salud Holística Perú", NULL, "saludholisticaperu.com", "saludhol", "pilar2011salud", "/www/", NULL, "1", "2012-12-03 08:26:02", NULL, "1", "143", "servicios@saludholisticaperu.com", "http://www.saludholisticaperu.com/propuesta1.html", "1");
#
#
INSERT INTO `proyectos` VALUES ("146", "2011-11-18 16:52:08", "2011-11-23 15:32:24", NULL, "1", NULL, "bursa", "bukyn.com", "Bursa", NULL, "bukyn.com", "bukyn", "platano", "/www/", "0", "0", "2011-11-23 15:33:04", NULL, "1", "145", "ventas@bursa.com", NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("147", "2011-12-04 21:21:57", "2011-12-04 21:21:48", NULL, "1", "proy_1323051710_91x93.jpg", "cgtp", "prodiserv.com/cgtp", "PROYECTO CGTP", NULL, "prodiserv.com", "prodiser", "tavarasac", "/www/cgtp", "0", "1", "2013-07-10 19:39:21", NULL, "1", "136", NULL, "http://prodiserv.com/cgtp/propuesta_home_2012.png", "1");
#
#
INSERT INTO `proyectos` VALUES ("148", "2012-09-02 17:02:30", "2013-03-24 08:55:12", NULL, "1", NULL, "crmdiamantes", "incapower.pe", "DIAMANTE DEL PACIFICO", NULL, "incapower.pe", "userinca", "inca2012", "/www/", "0", "1", "2014-10-28 17:08:35", "2", "1", "135", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("149", "2012-09-03 11:30:14", "0000-00-00 00:00:00", NULL, "1", NULL, "p1", NULL, "p1", NULL, NULL, NULL, NULL, "/www/", "0", "0", "2012-09-03 11:29:40", NULL, "1", "136", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("150", "2012-09-03 11:30:24", "0000-00-00 00:00:00", NULL, "1", NULL, "p2", NULL, "p2", NULL, NULL, NULL, NULL, "/www/", "0", "0", "2012-09-03 11:29:40", NULL, "1", "136", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("151", "2012-09-03 11:30:37", "2012-11-28 02:28:30", NULL, "1", NULL, "ejm", "ejm.com.pe", "ejm", NULL, "ejm.com.pe", "ejmcom", "exercises2012", "/www/", "0", "1", "2013-03-24 10:12:15", NULL, "1", "136", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("152", "2012-09-03 11:30:49", "2012-11-28 02:14:33", NULL, "1", NULL, "mecatronic", "mecatronicsystems.com", "mecatronic", NULL, "mecatronicsystems.com", "mecatron", "prodiserv", "/www/", "0", "1", "2013-03-24 10:56:07", NULL, "1", "136", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("153", "2012-09-05 10:48:44", "0000-00-00 00:00:00", NULL, "1", NULL, "portalcursos", "rincondemalena.com", "portalcursos", NULL, "rincondemalena.com", "rinconm", "rincon159357", "/www/", "0", "0", "2012-09-05 09:22:57", NULL, "1", "101", NULL, NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("154", "2012-10-11 09:35:44", "2012-10-24 10:47:00", NULL, "1", NULL, "truckmax3", "truckmax.com.pe", "CRM TRUCKMAX 3", NULL, "174.120.118.226", "truckmax", "i2%Jkhab7Jir", "/www/", "0", "1", "2013-06-20 19:50:55", NULL, "1", "135", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("155", "2012-11-28 02:09:20", "2012-11-28 02:10:14", NULL, "1", NULL, "ichibans", "ichibansystems.com", "Ichibans", NULL, "ichibansystems.com", "ichibans", "walichitems2011", "/www/", "0", "1", "2013-01-15 20:56:05", NULL, "1", "145", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("156", "2013-01-11 03:23:09", "2014-10-23 09:25:26", NULL, "1", "proy_1357892574_x.", "nerin", "nering.net", "nering", NULL, "nering.net", "nering", "puhna+lq", "/www/", "0", "1", "2014-10-29 11:29:23", "1", "1", "151", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("157", "2012-11-28 02:35:25", "0000-00-00 00:00:00", NULL, "1", NULL, "timbrame", "timbra.me", "timbrame", NULL, "timbra.me", "timbra", "mememe", "/www/", "0", "1", "2012-11-28 02:31:30", NULL, "1", "151", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("158", "2013-01-15 19:31:09", "0000-00-00 00:00:00", NULL, "1", NULL, "inmoobi", "inmoobi.com", "Inmoobi", NULL, "inmoobi.com", "inmoobi", "reneguillecaro", "/www/", "0", "0", "2013-01-19 17:47:18", NULL, "1", "101", "guillermolozan@gmail.com", NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("159", "2013-01-23 07:50:30", "2013-01-30 07:43:54", NULL, "1", NULL, "montescompe", "montes.com.pe", "Montes", NULL, "montes.com.pe", "montesco", "napoleon", "/www/", "0", "1", "2013-03-30 21:18:21", NULL, "1", "156", NULL, NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("160", "2013-01-30 07:44:49", "0000-00-00 00:00:00", NULL, "1", NULL, "covilla", "condominiocovilla.com", "Condominio Covilla", NULL, "condominiocovilla.com", "covilla", "napoleon", "/www/", "0", "1", "2013-01-30 07:45:48", NULL, "1", "159", NULL, NULL, "2");
#
#
INSERT INTO `proyectos` VALUES ("161", "2013-03-30 17:52:49", "0000-00-00 00:00:00", NULL, "1", NULL, "nvqdi", "nivueltaquedarle.info", "nvqdi", NULL, "nivueltaquedarle.info", "nivuelta", "abut761", "/www/", "0", "1", "2013-06-24 21:18:37", NULL, "1", "151", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("162", "2013-04-07 11:32:27", "2013-06-04 18:48:16", NULL, "1", NULL, "crminmobiliario", "crminmobiliario.info", "CRM INMOBILIARIO", NULL, "crminmobiliario.info", "crminmob", "inmue2013", "/www/", "0", "1", "2014-10-28 18:16:26", "2", "1", "148", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("163", "2013-06-24 21:23:28", "2013-07-01 01:08:54", NULL, "1", NULL, "munipomabamba", "munipomabamba.gob.pe", "munipomabamba", NULL, "munipomabamba.gob.pe", "pomabamb", "munipomuBA12", "/www/", "0", "1", "2013-07-30 18:22:38", NULL, "1", "147", NULL, NULL, "1");
#
#
INSERT INTO `proyectos` VALUES ("164", "2014-10-30 07:19:01", "0000-00-00 00:00:00", NULL, "1", NULL, "polar", "polarbear.com.pe", "polar", NULL, "polarbear.com.pe", "polarbea", "beapola200814", "/www/", "0", "1", "2014-10-30 07:27:37", NULL, "1", "156", "guillermolozan@gmail.com", NULL, "1");
#
#
DROP TABLE IF EXISTS `usuarios_acceso`;
#
#
CREATE TABLE `usuarios_acceso` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT '0000-00-00 00:00:00',
  `fecha_edicion` datetime DEFAULT '0000-00-00 00:00:00',
  `posicion` int(10) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL DEFAULT '1',
  `calificacion` tinyint(2) NOT NULL DEFAULT '0',
  `nombre` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `permisos` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
#
#
INSERT INTO `usuarios_acceso` VALUES ("1", "2012-05-02 12:46:20", "0000-00-00 00:00:00", NULL, "1", "0", "administrador", "prodiserv", NULL);
#
#
