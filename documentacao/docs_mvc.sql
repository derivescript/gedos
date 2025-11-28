-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: falconi
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_menus`
--

DROP TABLE IF EXISTS `admin_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_parent` int NOT NULL DEFAULT '0',
  `ordem` int DEFAULT NULL,
  `nivel_menu` int DEFAULT NULL,
  `class` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `icone` varchar(60) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `nome` varchar(60) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `href` varchar(30) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menus`
--

LOCK TABLES `admin_menus` WRITE;
/*!40000 ALTER TABLE `admin_menus` DISABLE KEYS */;
INSERT INTO `admin_menus` VALUES (1,0,1,1,'fa','home','In&iacute;cio','home/dashboard'),(2,0,2,1,'fa','user','Usu&aacute;rios','#'),(4,2,1,2,'fa','plus','Adicionar usu&aacute;rio','user/add'),(5,2,2,2,'fas','table','Listar','user/listar'),(7,0,2,1,'fas','file-alt','Documentos','#'),(8,0,4,1,'fas','city','Setores','#'),(9,7,2,2,'fas','plus','Adicionar documento','documentos/add'),(10,8,1,2,'fas','plus','Cadastrar setor','setores/add'),(11,8,2,2,'fas','list','Listar setores','setores/listar'),(12,7,1,2,'fas','th-list','Dashboard','documentos/index'),(13,7,3,2,'fas','file-contract','Criar novo modelo','docmodels/add'),(14,7,4,2,'fas','file-alt','Novo tipo de documento','tipodocumento/add'),(15,8,3,2,'fas','address-card','Lotar servidor','lotacao/add'),(16,8,4,2,'fas','glasses','Ver lota&ccedil;&otilde;es','lotacao/listar'),(17,7,5,2,'fas','table','Tipos de documentos','tipodocumento/listar'),(18,7,6,2,'fas','file','Nova classe de documento','classdoc/add'),(19,0,6,1,'fas','window-maximize','M&oacute;dulos','#'),(20,19,1,2,'fas','plus-square','Cadastrar m&oacute;dulo','modulo/add'),(21,19,2,2,'fas','table','Gerenciar m&oacute;dulos','modulo/listar'),(22,19,3,2,'fas','cog','Adicionar permiss&atilde;o','permissoes/add'),(23,19,4,2,'fas','cog','Gerenciar permiss&otilde;es','permissoes/gerenciar'),(24,0,6,1,'fas','ad','Cargos','#'),(25,24,1,2,'fas','plus-circle','Criar cargo','cargo/add'),(26,24,2,2,'fas','table','Ver rela&ccedil;&atilde;o de cargos','cargo/listar'),(27,7,7,2,'fas','table','Classes de documentos','classdoc/listar');
/*!40000 ALTER TABLE `admin_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao` date NOT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Assistente de Administracao','2015-06-11',1),(2,'ADM Master','2025-05-17',1);
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordenacao_setor`
--

DROP TABLE IF EXISTS `coordenacao_setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordenacao_setor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_setor` int NOT NULL,
  `id_coordenador` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordenacao_setor`
--

LOCK TABLES `coordenacao_setor` WRITE;
/*!40000 ALTER TABLE `coordenacao_setor` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordenacao_setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_classes`
--

DROP TABLE IF EXISTS `doc_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doc_classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `published` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_classes`
--

LOCK TABLES `doc_classes` WRITE;
/*!40000 ALTER TABLE `doc_classes` DISABLE KEYS */;
INSERT INTO `doc_classes` VALUES (1,'000','Administra&ccedil;&atilde;o Geral','2025-09-21',1),(2,'100','Carnval','2025-09-21',1);
/*!40000 ALTER TABLE `doc_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_models`
--

DROP TABLE IF EXISTS `doc_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doc_models` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL,
  `model` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `published` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `doctype_id` FOREIGN KEY (`type_id`) REFERENCES `doc_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_models`
--

LOCK TABLES `doc_models` WRITE;
/*!40000 ALTER TABLE `doc_models` DISABLE KEYS */;
INSERT INTO `doc_models` VALUES (1,1,'Relatório Técnico','<p style=\"text-align:center\"><span style=\"font-family:Calibri\"><strong>FISCALIZA&Ccedil;&Atilde;O T&Eacute;CNICA</strong></span><br />\r\n<span style=\"font-family:Calibri\"><strong>Relat&oacute;rio mensal</strong></span></p>\r\n\r\n<p style=\"text-align:center\">{{ documento_identificador }}</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 694px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"text-align: center; width: 684px;\"><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\">Informa&ccedil;&otilde;es do Contrato</span></strong></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 313px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">Tipo de servi&ccedil;o: </span></span></strong><span style=\"font-size:14px\"><span style=\"color:#000000\">F</span></span></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\"><span style=\"color:black\">ornecimento de acessos &agrave; internet</span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 368px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">Local de presta&ccedil;&atilde;o do servi&ccedil;o:</span></span></strong></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\"><span style=\"color:black\">&nbsp;</span></span></span><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,&quot;serif&quot;\">IFMT-Campus Avan&ccedil;ado Diamantino &ndash;&nbsp;</span></span><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size: 11.04pt;\">Rodovia Roberto Campos - Novo Diamantino, None - CEP:</span><span style=\"font-size:11.04pt\"><span style=\"color:#000000\">78400-000 Diamantino/MT </span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 313px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">Contrato n&ordm;:</span></span></strong><span style=\"font-size:14px\"><span style=\"color:#000000\">&nbsp;09/2022</span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 368px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">Vig&ecirc;ncia:&nbsp;</span></span></strong></span>12/02/2022 &agrave;&nbsp;12/08/2025</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 313px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">Contratada:&nbsp;</span></span></strong></span>VALE DO RIBEIRA INTERNET LTDA ME</p>\r\n			</td>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 368px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\"><span style=\"color:#000000\">CNPJ: </span></span></strong></span>07.017.934/0001-85</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 313px;\">\r\n			<p><strong style=\"\"><span style=\"font-size: 14px;\">Preposto:&nbsp;<font face=\"Times New Roman, serif\">&nbsp;</font></span></strong></p>\r\n			</td>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 368px;\">\r\n			<p><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\">Contato (e-mail e telefone):&nbsp;</span></strong></span>contato@valesat.com</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 313px;\"><span style=\"font-family:Calibri\"><strong><span style=\"font-size:14px\">M&ecirc;s presta&ccedil;&atilde;o do servi&ccedil;o: </span></strong><span style=\"font-size:14px\">Julho/2025</span></span></td>\r\n			<td style=\"background-color: rgb(255, 255, 255); width: 368px;\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:justify\"><br />\r\n<span style=\"font-family:Calibri\">De acordo com a Instru&ccedil;&atilde;o Normativa SEGES/MPDG n&ordm; 05/2017, a Fiscaliza&ccedil;&atilde;o T&eacute;cnica &eacute; o acompanhamento com objetivo de aferir se a quantidade, qualidade, tempo e modo da presta&ccedil;&atilde;o dos servi&ccedil;os est&atilde;o compat&iacute;veis com os indicadores de n&iacute;veis m&iacute;nimos de desempenho estipulados no ato convocat&oacute;rio, para efeito de pagamento conforme o resultado esperado, bem como quanto &agrave;s provid&ecirc;ncias tempestivas nos casos de inadimplemento.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Calibri\">A seguir ser&aacute; apresentado relat&oacute;rio mensal, feito antes do pagamento da Nota Fiscal/Fatura, de presta&ccedil;&atilde;o de servi&ccedil;o com regime de dedica&ccedil;&atilde;o exclusiva de m&atilde;o-de-obra, em conformidade com a Instru&ccedil;&atilde;o Normativa SEGES/MPDG n&ordm; 05, de 26/05/2017, Anexo VIII-A &ndash; Da Fiscaliza&ccedil;&atilde;o T&eacute;cnica, a fim de dar o recebimento provis&oacute;rio dos servi&ccedil;os.</span></p>\r\n\r\n<p style=\"text-align:justify\">A empresa vem prestando o servi&ccedil;o de forma adequada, atendendo os chamados abertos nos prazos estabelecidos.&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Calibri\">Em caso de irregularidades, relatar as ocorr&ecirc;ncias, provid&ecirc;ncias e notifica&ccedil;&otilde;es (anexar ao relat&oacute;rio) adotadas pela fiscaliza&ccedil;&atilde;o, bem como se os problemas foram sanados ou se ficaram pend&ecirc;ncias:&nbsp;</span></p>\r\n\r\n<p style=\"text-align:justify\">A empresa&nbsp;VALE DO RIBEIRA INTERNET LTDA ME&nbsp;n&atilde;o apresenta nenhuma pend&ecirc;ncia.<span style=\"font-family:Calibri\">&nbsp; </span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Calibri\">Ap&oacute;s as verifica&ccedil;&otilde;es quanto aos disp&ecirc;ndios concernentes a execu&ccedil;&atilde;o do servi&ccedil;o,&nbsp;esta fiscaliza&ccedil;&atilde;o t&eacute;cnica recebe provisoriamente a execu&ccedil;&atilde;o dos servi&ccedil;os, conforme lhe compete aos aspectos t&eacute;cnicos.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Calibri\">O presente Relat&oacute;rio da Fiscaliza&ccedil;&atilde;o T&eacute;cnica Mensal ser&aacute; encaminhado ao gestor de contrato&nbsp;para que este d&ecirc; ci&ecirc;ncia e realize as a&ccedil;&otilde;es que lhe competem e, posteriormente, junte este documento e seus anexos ao Processo de Contrata&ccedil;&atilde;o.</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>Diamantino, {{ documento_data_emissao_por_extenso }}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:null;\"><span style=\"font-family:Calibri\">Daniel da Costa e Faria</span><br />\r\n<span style=\"font-family:Calibri\">Fiscal T&eacute;cnico do Contrato n&ordm;&nbsp;</span></span>09/2022<br />\r\nPORTARIA 57/2025 - DMT-DG/CDMT/RTR/IFMT</p>\r\n\r\n<p>&nbsp;</p>\r\n','2025-09-05',1),(2,4,'Contrato de prestação de serviços','<p style=\"text-align:center\"><strong><span style=\"font-family:Carlito\"><span style=\"font-size:16px\">Contrato de Presta&ccedil;&atilde;o de Servi&ccedil;os de xxxxxxxxxxxxxxxxx<br />\r\n(Processo Administrativo n&deg; XXXXX.XXXXXX.xxxx-xx)</span></span></strong></p>\r\n\r\n<p><span style=\"font-family:Carlito\"><span style=\"font-size:16px\">Para elabora&ccedil;&atilde;o do Contrato consulte a minuta dispon&iacute;vel no processo de contrata&ccedil;&atilde;o.</span></span></p>\r\n','2025-09-06',NULL),(3,2,'Ata -Padrão','<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:700px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"width:200px\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Cidade</span></span></td>\r\n			<td style=\"width:500px\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Diamantino-MT</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Data</span></span></td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Convoca&ccedil;&atilde;o</span></span></td>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Email institucional</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Hor&aacute;rio</span></span></td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Local</span></span></td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:700px\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"text-align:center; width:400px\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>PRESEN&Ccedil;AS</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center; width:400px\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>Participantes</strong></span></span></td>\r\n			<td style=\"text-align:center; width:300px\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>Cargos/Fun&ccedil;&otilde;es</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center; width:400px\">&nbsp;</td>\r\n			<td style=\"text-align:center; width:300px\">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:700px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>ABERTURA</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align: justify;\">\r\n			<p><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\">Na data de</span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>PAUTA</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>1 - Informes Gerais</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:justify\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td><span style=\"font-family:Times New Roman,Times,serif;\"><span style=\"font-size:16px;\"><strong>2 - Ordem do Dia</strong></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:justify\">\r\n			<p>&nbsp;</p>\r\n\r\n			<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" dir=\"ltr\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n				<colgroup>\r\n					<col width=\"228\" />\r\n					<col width=\"61\" />\r\n					<col width=\"23\" />\r\n					<col width=\"163\" />\r\n					<col width=\"57\" />\r\n					<col width=\"23\" />\r\n					<col width=\"213\" />\r\n					<col width=\"61\" />\r\n					<col width=\"23\" />\r\n					<col width=\"171\" />\r\n					<col width=\"57\" />\r\n					<col width=\"23\" />\r\n					<col width=\"215\" />\r\n					<col width=\"57\" />\r\n				</colgroup>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:700px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>ENCERRAMENTO</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:justify\">A reuni&atilde;o foi encerrada com agradecimentos e proposta de manter o canal aberto para contribui&ccedil;&otilde;es.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','2025-09-06',NULL),(4,1,'RIT - Relatório Individual de Trabalho','<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><strong>RIT - Relat&oacute;rio Individual de Trabalho</strong></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">Semestre Letivo: <strong>2025/1</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Servidor: <strong>Daniel da Costa e Faria</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Campus: <strong>Diamantino</strong></td>\r\n			<td>Curso ou departamento: <strong>Departamento de Ensino</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Matr&iacute;cula SIAPE: <strong>2680702</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>E-mail: <strong>daniel.faria@ifmt.edu.br</strong></td>\r\n			<td>Telefone: <strong>(65) 992741809/(65) 984083679&nbsp;</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Regime de Trabalho: <strong>Dedica&ccedil;&atilde;o Exclusiva</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Tipo de v&iacute;nculo: <strong>Efetivo</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Grupo de Reg&ecirc;ncia: <strong>3</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">Total de horas semanais: <strong>40 horas</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong>1 &ndash; Atividades de Ensino</strong></span></span></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>Item</strong></td>\r\n			<td style=\"text-align:center\"><strong>Descri&ccedil;&atilde;o</strong></td>\r\n			<td style=\"text-align:center\"><strong>Max</strong></td>\r\n			<td style=\"text-align:center\"><strong>Unid.</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.1</td>\r\n			<td>Reg&ecirc;ncia de aulas</td>\r\n			<td>24</td>\r\n			<td>Aulas</td>\r\n			<td style=\"text-align: center;\">13</td>\r\n			<td style=\"text-align: center;\">10,83</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.1.1</td>\r\n			<td>Ensino M&eacute;dio Integrado e Subsequente</td>\r\n			<td>24</td>\r\n			<td>Aulas</td>\r\n			<td style=\"text-align: center;\">8</td>\r\n			<td style=\"text-align: center;\">6,67</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.1.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Ensino Superior Licenciatura, Bacharelado e Tecn&oacute;logo</span></span></td>\r\n			<td>24</td>\r\n			<td>Aulas</td>\r\n			<td style=\"text-align: center;\">5</td>\r\n			<td style=\"text-align: center;\">4,17</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.1.3</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Curso FIC</span></span></td>\r\n			<td>24</td>\r\n			<td>Aulas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.1.4</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">P&oacute;s Gradua&ccedil;&atilde;o (Lato Sensu e Stricto Sensu)</span></span></td>\r\n			<td>24</td>\r\n			<td>Aulas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Subtotal - Horas</span></span></strong></td>\r\n			<td colspan=\"4\" rowspan=\"1\" style=\"text-align: center;\"><strong>10,83</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>1.2</strong></td>\r\n			<td><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Atividades de Prepara&ccedil;&atilde;o e Manuten&ccedil;&atilde;o do Ensino</span></span></strong></td>\r\n			<td style=\"text-align:center\"><strong>Fator</strong></td>\r\n			<td style=\"text-align:center\"><strong>Unid.</strong></td>\r\n			<td style=\"text-align:center\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Qtdade</span></span></strong></td>\r\n			<td style=\"text-align:center\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">CH Obtidas</span></span></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.2.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Prepara&ccedil;&atilde;o + Planejamento</span></span></td>\r\n			<td>0,8</td>\r\n			<td>Horas</td>\r\n			<td style=\"text-align: center;\">10,83</td>\r\n			<td style=\"text-align: center;\">8,67</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\">Subtotal - horas</td>\r\n			<td colspan=\"4\" rowspan=\"1\" style=\"text-align: center;\">8,67</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>1.3</strong></td>\r\n			<td><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Atividades de Apoio ao Ensino</span></span></strong></td>\r\n			<td style=\"text-align:center\"><strong>Fator</strong></td>\r\n			<td style=\"text-align:center\"><strong>Unid.</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.3.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Atendimento a Estudantes</span></span></td>\r\n			<td>0,2</td>\r\n			<td>Horas</td>\r\n			<td style=\"text-align: center;\">10,83</td>\r\n			<td style=\"text-align: center;\">2,17</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\">Subtotal - horas</td>\r\n			<td colspan=\"4\" rowspan=\"1\" style=\"text-align: center;\">2,17</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>1.4</strong></td>\r\n			<td><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Atividades de Orienta&ccedil;&atilde;o (at&eacute; 10 horas)</span></span></strong></td>\r\n			<td style=\"text-align:center\"><strong>CH</strong></td>\r\n			<td style=\"text-align:center\"><strong>Unid</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.4.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Orienta&ccedil;&atilde;o de Est&aacute;gio e Monitoria, devidamente caracterizados nos projetos de cursos t&eacute;cnicos e de gradua&ccedil;&atilde;o (Limite de 5 horas)</span></span></td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">1h por estudante</span></span></td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.4.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Orienta&ccedil;&atilde;o de Trabalho de Conclus&atilde;o de Curso &ndash; TCC &ndash; de gradua&ccedil;&atilde;o e de cursos de p&oacute;s-gradua&ccedil;&atilde;o lato sensu (Limite de 6 horas)</span></span></td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">1h por estudante</span></span></td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.4.3</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Orienta&ccedil;&atilde;o de Disserta&ccedil;&otilde;es e Teses, nos cursos de p&oacute;s-gradua&ccedil;&atilde;o stricto sensu (Limite de 10 horas)</span></span></td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">2,5h por estudante</span></span></td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.4.4</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Orienta&ccedil;&atilde;o profissional nas depend&ecirc;ncias de empresas que promovam o regime dual em curso em parceria com o IFMT (Limite de 5 horas)</span></span></td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">1h por estudante</span></span></td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.4.5</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Para as atividades de co-orienta&ccedil;&atilde;o a estudantes de cursos de P&oacute;s Gradua&ccedil;&atilde;o Lato Sensu e Stricto Sensu do IFMT (Limite de 3 horas)</span></span></td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">1h por estudante</span></span></td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Subtotal - Horas</span></span></strong></td>\r\n			<td colspan=\"4\" rowspan=\"1\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>1.5</strong></td>\r\n			<td><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Atividades Administrativas</span></span></strong></td>\r\n			<td style=\"text-align:center\"><strong>CH</strong></td>\r\n			<td style=\"text-align:center\"><strong>Unid.</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.5.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Reuni&atilde;o Pedag&oacute;gica</span></span></td>\r\n			<td>&nbsp;</td>\r\n			<td>Horas</td>\r\n			<td style=\"text-align: center;\"><strong>1</strong></td>\r\n			<td style=\"text-align: center;\"><strong>1</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1.5.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Deslocamento &ndash; Aulas Ministradas fora da SEDE</span></span></td>\r\n			<td>&nbsp;</td>\r\n			<td>Horas</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Subtotal - Horas</span></span></strong></td>\r\n			<td colspan=\"4\" rowspan=\"1\" style=\"text-align: center;\"><strong>1</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Total de Horas em Atividades de Ensino</span></span></strong></td>\r\n			<td colspan=\"4\" rowspan=\"1\" style=\"text-align: center;\">23 horas</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Descri&ccedil;&atilde;o das atividades de ensino executadas:</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p data-end=\"282\" data-start=\"122\" style=\"text-align: justify;\"><strong data-end=\"282\" data-start=\"122\">Atividades de reg&ecirc;ncia de aula nas disciplinas de Marketing e Vendas e Gest&atilde;o de Pessoas, ambas ministradas para o 2&ordm; ano do Curso T&eacute;cnico em Administra&ccedil;&atilde;o.</strong></p>\r\n\r\n			<p data-end=\"324\" data-start=\"284\" style=\"text-align: justify;\">As principais a&ccedil;&otilde;es desenvolvidas foram:</p>\r\n\r\n			<ul data-end=\"1107\" data-start=\"326\">\r\n				<li data-end=\"464\" data-start=\"326\">\r\n				<p data-end=\"464\" data-start=\"328\" style=\"text-align: justify;\">Elabora&ccedil;&atilde;o dos planos de ensino das disciplinas, em conformidade com o Projeto Pedag&oacute;gico do Curso (PPC) e as diretrizes institucionais;</p>\r\n				</li>\r\n				<li data-end=\"657\" data-start=\"466\">\r\n				<p data-end=\"657\" data-start=\"468\" style=\"text-align: justify;\">Planejamento e prepara&ccedil;&atilde;o de aulas, com produ&ccedil;&atilde;o de conte&uacute;dos, atividades pedag&oacute;gicas e materiais did&aacute;ticos, seguindo os objetivos e metodologias definidos nos respectivos planos de ensino;</p>\r\n				</li>\r\n				<li data-end=\"805\" data-start=\"659\">\r\n				<p data-end=\"805\" data-start=\"661\" style=\"text-align: justify;\">Realiza&ccedil;&atilde;o de adapta&ccedil;&otilde;es pedag&oacute;gicas para atender estudantes com dificuldades de aprendizagem, garantindo a inclus&atilde;o e a recupera&ccedil;&atilde;o processual;</p>\r\n				</li>\r\n				<li data-end=\"970\" data-start=\"807\">\r\n				<p data-end=\"970\" data-start=\"809\" style=\"text-align: justify;\">Atendimento e orienta&ccedil;&atilde;o aos estudantes durante as atividades de apoio realizadas &agrave;s ter&ccedil;as-feiras, conforme cronograma estabelecido pelo Departamento de Ensino;</p>\r\n				</li>\r\n				<li data-end=\"1107\" data-start=\"972\">\r\n				<p data-end=\"1107\" data-start=\"974\" style=\"text-align: justify;\">Corre&ccedil;&atilde;o e devolutiva de atividades avaliativas e formativas, de acordo com os crit&eacute;rios e instrumentos previstos no plano de ensino.</p>\r\n				</li>\r\n			</ul>\r\n\r\n			<p data-end=\"1258\" data-start=\"1109\" style=\"text-align: justify;\">Todas as a&ccedil;&otilde;es foram executadas em conson&acirc;ncia com os planos de ensino aprovados para cada disciplina e com os princ&iacute;pios pedag&oacute;gicos institucionais.<br />\r\n			<br />\r\n			<strong data-end=\"282\" data-start=\"122\">Atividades de reuni&otilde;es pedag&oacute;gicas s&atilde;o organizadas de acordo com calend&aacute;rio acad&ecirc;mico e convoca&ccedil;&atilde;o da Chefia imediata.</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong>2 &ndash; Atividades de Pesquisa Preferencialmente Aplicada e Inova&ccedil;&atilde;o</strong></span></span></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>Item</strong></td>\r\n			<td style=\"text-align:center\"><strong>Atividades desenvolvidas</strong></td>\r\n			<td style=\"text-align:center\"><strong>Carga Horaria</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de Projeto de pesquisa com parceria externa oficialmente institucionalizada (Limite 8 horas)</span></span></td>\r\n			<td>8</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de Projeto de pesquisa aprovado em Edital interno ou autorizado pelo campus (Limite 8 horas)</span></span></td>\r\n			<td>8</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.3</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o/colabora&ccedil;&atilde;o em pesquisa com parceria externa oficialmente institucionalizada (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.4</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o/colabora&ccedil;&atilde;o em pesquisa aprovado em Edital interno ou autorizado pelo campus (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.5</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">L&iacute;der de Grupo de Pesquisa com status ativo no CNPq (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.6</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em Grupo de Pesquisa com status ativo no CNPq (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.7</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Editor de revista cient&iacute;fica/acad&ecirc;mica (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.8</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em banca de defesa de Trabalho de Conclus&atilde;o de Curso ou monografia (Limite 0,1 horas)</span></span></td>\r\n			<td>0,1</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.9</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em banca de qualifica&ccedil;&atilde;o/defesa de disserta&ccedil;&atilde;o ou tese do IFMT ou em outra institui&ccedil;&atilde;o de ensino (Limite 0,5 horas)</span></span></td>\r\n			<td>0,5</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.10</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Elabora&ccedil;&atilde;o de projetos para capta&ccedil;&atilde;o de recursos financeiros externos ao IFMT (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.11</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Elabora&ccedil;&atilde;o de projetos para capta&ccedil;&atilde;o de bolsa produtividade ou desenvolvimento tecnol&oacute;gico do CNPq (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.12</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Elabora&ccedil;&atilde;o de pedido de dep&oacute;sito de propriedade intelectual (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.13</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Reda&ccedil;&atilde;o de Patente de inova&ccedil;&atilde;o tecnol&oacute;gica (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.14</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Produ&ccedil;&atilde;o cient&iacute;fica (a convite ou a ser avaliada) designada a congressos, jornadas cient&iacute;ficas, workshops, simp&oacute;sios, semin&aacute;rios ou peri&oacute;dicos (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.15</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o como apresentador, moderador, debatedor, coordenador, secret&aacute;rio ou palestrante em congressos, jornadas cient&iacute;ficas, workshops, simp&oacute;sios, semin&aacute;rios e outros eventos t&eacute;cnicos cient&iacute;ficos (Limite 1 hora)</span></span></td>\r\n			<td>1</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.16</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Produ&ccedil;&atilde;o de livro t&eacute;cnico ou cient&iacute;fico, editora&ccedil;&atilde;o, organiza&ccedil;&atilde;o e/ou tradu&ccedil;&atilde;o de livros t&eacute;cnicos-cient&iacute;ficos (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.17</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Membro de conselho cient&iacute;fico, corpo editorial em revistas cient&iacute;ficas, consultor adhoc (Limite 1 hora)</span></span></td>\r\n			<td>1</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.18</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em comit&ecirc; ou comiss&atilde;o cient&iacute;fica, parecerista e/ou revisor de trabalhos cient&iacute;ficos e/ou Eventos (Limite 1 hora)</span></span></td>\r\n			<td>1</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2.19</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Organiza&ccedil;&atilde;o de eventos ligados &agrave; pesquisa, &agrave; inova&ccedil;&atilde;o ou &agrave; P&oacute;s Gradua&ccedil;&atilde;o (Limite 1 hora)</span></span></td>\r\n			<td>1</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Total de Horas em Atividades de Pesquisa Preferencialmente aplicada e inova&ccedil;&atilde;o</span></span></strong></td>\r\n			<td colspan=\"3\" rowspan=\"1\">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Descri&ccedil;&atilde;o das atividades de pesquisa executadas:</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p><strong data-end=\"282\" data-start=\"122\">Docente sem atividade de pesquisa no semestre.</strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong>3 &ndash; Atividades de Extens&atilde;o</strong></span></span></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>Item</strong></td>\r\n			<td style=\"text-align:center\"><strong>Atividades desenvolvidas</strong></td>\r\n			<td style=\"text-align:center\"><strong>Carga Horaria</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de Projeto de extens&atilde;o que esteja vinculado a um ou mais conv&ecirc;nios ou acordos de coopera&ccedil;&atilde;o interinstitucionais (Limite 8 horas)</span></span></td>\r\n			<td>8</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em projetos de extens&atilde;o que esteja vinculado a um ou mais conv&ecirc;nios ou acordos de coopera&ccedil;&atilde;o interinstitucionais (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.3</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de projeto de extens&atilde;o por edital de ampla concorr&ecirc;ncia no &acirc;mbito do IFMT (Limite 6 horas)</span></span></td>\r\n			<td>6</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.4</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de projeto de extens&atilde;o aprovado em Edital Interno ou autorizado pelo campus (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.5</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em projeto de extens&atilde;o aprovado em Edital Interno ou autorizado pelo campus (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td style=\"text-align: center;\">&nbsp;</td>\r\n			<td style=\"text-align: center;\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.6</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o e participa&ccedil;&atilde;o na organiza&ccedil;&atilde;o de eventos culturais, art&iacute;sticos, esportivos e comunit&aacute;rios (Limite 2 horas)</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.7</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o em treinamentos de equipes desportivas, em competi&ccedil;&otilde;es e em atividades art&iacute;sticas e culturais (Limite 3 horas)</span></span></td>\r\n			<td>3</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3.8</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o/acompanhamento Institucional a n&uacute;cleos empreendedores, programas, cooperativas, empresas juniores, incubadoras, coletivos, agremia&ccedil;&otilde;es e equipes de estudantes (Limite 4 horas)</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Total de Horas em Atividades de Extens&atilde;o</span></span></strong></td>\r\n			<td colspan=\"3\" rowspan=\"1\" style=\"text-align: center;\">&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Descri&ccedil;&atilde;o das atividades de extens&atilde;o executadas:</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p data-end=\"520\" data-start=\"263\" style=\"text-align: justify;\"><strong>Edital n&ordm; 135/2024 - Fomento para Coordenadores de N&uacute;cleos de Educa&ccedil;&atilde;o a Dist&acirc;ncia (NEaDs) do IFMT</strong></p>\r\n\r\n			<ul>\r\n				<li data-end=\"520\" data-start=\"261\">\r\n				<p data-end=\"520\" data-start=\"263\" style=\"text-align: justify;\">Planejamento e coordena&ccedil;&atilde;o de a&ccedil;&otilde;es de Ensino &agrave; Dist&acirc;ncia&nbsp;no &acirc;mbito do IFMT Campus Diamantino&nbsp;</p>\r\n				</li>\r\n				<li data-end=\"787\" data-start=\"522\">\r\n				<p data-end=\"787\" data-start=\"524\" style=\"text-align: justify;\">Acompanhamento e orienta&ccedil;&atilde;o de estudantes quanto &agrave; utiliza&ccedil;&atilde;o do Ambiente Virtual de Aprendizagem, atrav&eacute;s da plataforma Moodle, na realiza&ccedil;&atilde;o de atividades no curso de Tecn&oacute;logo em Geest&atilde;o do Agroneg&oacute;cio e suporte de conte&uacute;dos nos cursos integrados ao Ensino M&eacute;dio.</p>\r\n				</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong>4 &ndash; Gest&atilde;o e Representa&ccedil;&atilde;o Institucional</strong></span></span></p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><strong>Item</strong></td>\r\n			<td style=\"text-align:center\"><strong>Atividades desenvolvidas</strong></td>\r\n			<td style=\"text-align:center\"><strong>Carga Horaria</strong></td>\r\n			<td style=\"text-align:center\"><strong>Qtdade</strong></td>\r\n			<td style=\"text-align:center\"><strong>CH Obtidas</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.1</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Diretorias, chefias e coordena&ccedil;&otilde;es definidas no organograma da Reitoria ou dos campi do IFMT</span></span></td>\r\n			<td>30</td>\r\n			<td style=\"text-align: center;\"><strong>1</strong></td>\r\n			<td style=\"text-align: center;\"><strong>15</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.2</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&atilde;o de curso presencial</span></span></td>\r\n			<td>30</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.3</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">&Oacute;rg&atilde;os, N&uacute;cleos, Conselhos e colegiados definidos no organograma da Reitoria ou dos campi do IFMT</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.4</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Comiss&otilde;es e Comit&ecirc;s permanentes</span></span></td>\r\n			<td>6</td>\r\n			<td style=\"text-align: center;\"><strong>1</strong></td>\r\n			<td style=\"text-align: center;\"><strong>2</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.5</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Comiss&otilde;es e Comit&ecirc;s Eventuais</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.6</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Representa&ccedil;&atilde;o Institucional Externa</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.7</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o no N&uacute;cleo Permanente de Pessoal Docente &ndash; NPPD</span></span></td>\r\n			<td>2</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.8</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Participa&ccedil;&atilde;o na Comiss&atilde;o Permanente de Pessoal Docente &ndash; CPPD</span></span></td>\r\n			<td>3</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4.9</td>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Coordena&ccedil;&otilde;es ou tutoria (laborat&oacute;rios, setores, unidades de produ&ccedil;&atilde;o e afins) &ndash; fun&ccedil;&otilde;es n&atilde;o gratificadas</span></span></td>\r\n			<td>4</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" rowspan=\"1\"><strong><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Total de Horas em Gest&atilde;o e Representa&ccedil;&atilde;o Institucional</span></span></strong></td>\r\n			<td colspan=\"3\" rowspan=\"1\" style=\"text-align: center;\"><strong>17 horas</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:800px\">\r\n	<tbody>\r\n		<tr>\r\n			<td><span style=\"font-size:11.0pt\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;\">Descri&ccedil;&atilde;o das atividades de gest&atilde;o e representa&ccedil;&atilde;o institucional executadas</span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p data-end=\"282\" data-start=\"162\" style=\"text-align: justify;\"><strong data-end=\"226\" data-start=\"92\">Atividades desenvolvidas como membro do N&uacute;cleo de Ensino &agrave; Dist&acirc;ncia</strong></p>\r\n\r\n			<ul data-end=\"726\" data-start=\"228\">\r\n				<li data-end=\"726\" data-start=\"576\">\r\n				<p data-end=\"726\" data-start=\"578\" style=\"text-align: justify;\">Capacita&ccedil;&atilde;o de estudanes e professores quanto &agrave; utiliza&ccedil;&atilde;o do Ambiente Virtual de Aprendizagem e demais sistemas do IFMT e elabora&ccedil;&atilde;o de guias sobre o uso da plataforma Moodle.</p>\r\n				</li>\r\n			</ul>\r\n\r\n			<p data-end=\"840\" data-start=\"733\" style=\"text-align: justify;\">f<strong data-end=\"1592\" data-start=\"1492\">Atividades desenvolvidas na constru&ccedil;&atilde;o do Plano de Desenvolvimento Institucional (PDI) 2026-2030</strong></p>\r\n\r\n			<ul data-end=\"2082\" data-start=\"1594\">\r\n				<li data-end=\"1772\" data-start=\"1594\">\r\n				<p data-end=\"1772\" data-start=\"1596\" style=\"text-align: justify;\">Participa&ccedil;&atilde;o ativa na elabora&ccedil;&atilde;o dos&nbsp;Cap&iacute;tulos 4 e 13&nbsp;do PDI 2026&ndash;2030, colaborando com a organiza&ccedil;&atilde;o das diretrizes de ensino, pesquisa, extens&atilde;o, infraestrutura e gest&atilde;o de pessoas;</p>\r\n				</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Avalia&ccedil;&atilde;o do Relat&oacute;rio Individual de Trabalho se dar&aacute; mediante assinatura do Chefe de Departamento /Diretoria de Ensino</span></span></p>\r\n','2025-09-05',1);
/*!40000 ALTER TABLE `doc_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_types`
--

DROP TABLE IF EXISTS `doc_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doc_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `published` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_types`
--

LOCK TABLES `doc_types` WRITE;
/*!40000 ALTER TABLE `doc_types` DISABLE KEYS */;
INSERT INTO `doc_types` VALUES (1,'Relatório','','2025-09-05',1),(2,'Ata','','2025-09-06',1),(3,'Certidão','','2025-09-06',1),(4,'Contrato','','2025-09-06',1),(5,'Declaracao','','2025-09-06',1),(6,'Memorando','','2025-09-06',1),(7,'Ofício','','2025-09-06',1);
/*!40000 ALTER TABLE `doc_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_history`
--

DROP TABLE IF EXISTS `document_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `document_id` int NOT NULL,
  `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `document_id` (`document_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `document_history_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `document_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_history`
--

LOCK TABLES `document_history` WRITE;
/*!40000 ALTER TABLE `document_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_type` int NOT NULL,
  `class_id` int NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sector_id` int DEFAULT NULL,
  `process_id` int DEFAULT NULL,
  `status` enum('draft','in_review','approved','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `created_by` int DEFAULT NULL,
  `requested_review_by` int DEFAULT NULL,
  `requested_review_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sector_id` (`sector_id`),
  KEY `created_by` (`created_by`),
  KEY `requested_review_by` (`requested_review_by`),
  KEY `id_type` (`id_type`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `class_id` FOREIGN KEY (`class_id`) REFERENCES `doc_classes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `doctype` FOREIGN KEY (`id_type`) REFERENCES `doc_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE SET NULL,
  CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `documents_ibfk_4` FOREIGN KEY (`requested_review_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dummy`
--

DROP TABLE IF EXISTS `dummy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dummy` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dummy`
--

LOCK TABLES `dummy` WRITE;
/*!40000 ALTER TABLE `dummy` DISABLE KEYS */;
/*!40000 ALTER TABLE `dummy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_hipotesis`
--

DROP TABLE IF EXISTS `legal_hipotesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legal_hipotesis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hipotesis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `created_by` int NOT NULL,
  `published` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `id_author` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_hipotesis`
--

LOCK TABLES `legal_hipotesis` WRITE;
/*!40000 ALTER TABLE `legal_hipotesis` DISABLE KEYS */;
INSERT INTO `legal_hipotesis` VALUES (1,'Informação pessoal','2025-09-06',1,1);
/*!40000 ALTER TABLE `legal_hipotesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotacoes`
--

DROP TABLE IF EXISTS `lotacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lotacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_setor` int NOT NULL,
  `id_colaborador` int NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_setor` (`id_setor`,`id_colaborador`),
  KEY `id_colaborador` (`id_colaborador`),
  CONSTRAINT `fk_colaborador` FOREIGN KEY (`id_colaborador`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_setor` FOREIGN KEY (`id_setor`) REFERENCES `sectors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotacoes`
--

LOCK TABLES `lotacoes` WRITE;
/*!40000 ALTER TABLE `lotacoes` DISABLE KEYS */;
INSERT INTO `lotacoes` VALUES (1,1,1,'2016-07-27',NULL),(2,2,1,'2018-02-14',NULL),(3,17,26,'2025-09-01','2030-01-01');
/*!40000 ALTER TABLE `lotacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_areas`
--

DROP TABLE IF EXISTS `module_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module_areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_areas`
--

LOCK TABLES `module_areas` WRITE;
/*!40000 ALTER TABLE `module_areas` DISABLE KEYS */;
INSERT INTO `module_areas` VALUES (1,'Administra&ccedil;&atilde;o',NULL),(2,'Gest&atilde;o de Pessoas',NULL),(3,'Tecnologia da Informacao',NULL);
/*!40000 ALTER TABLE `module_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area` int NOT NULL DEFAULT '0',
  `nome` varchar(120) NOT NULL,
  `ativo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,1,'Contratos',1),(2,1,'Almoxarifado',1);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfis`
--

DROP TABLE IF EXISTS `perfis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfis`
--

LOCK TABLES `perfis` WRITE;
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;
INSERT INTO `perfis` VALUES (1,'Administrador'),(2,'Fiscal de contrato'),(3,'Operador de documentos'),(4,'Operador de processo eletrônico'),(5,'Tramitador de processo eletrônico'),(6,'Servidor'),(7,'Visualizador de processos');
/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  `id_modulo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `capa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processes`
--

LOCK TABLES `processes` WRITE;
/*!40000 ALTER TABLE `processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_permissions`
--

DROP TABLE IF EXISTS `profile_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int NOT NULL,
  `id_permissao` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_permissions`
--

LOCK TABLES `profile_permissions` WRITE;
/*!40000 ALTER TABLE `profile_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sectors`
--

DROP TABLE IF EXISTS `sectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sectors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sigla` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sectors`
--

LOCK TABLES `sectors` WRITE;
/*!40000 ALTER TABLE `sectors` DISABLE KEYS */;
INSERT INTO `sectors` VALUES (1,'HADES','DMT-ENS','Setor de Ensino','2015-12-12'),(2,'Coordenação de Tecnologia da Informação','DMT-CTI','Setor de tecnologia','2016-11-22'),(17,'Registro Escolar','DMT-REG','Descrição do setor','2015-12-12'),(18,'Direção','DMT-DG','Direção geral do campus','2015-12-12'),(19,'Biblioteca','DMT-BLB','Biblioteca do campus','2025-09-16');
/*!40000 ALTER TABLE `sectors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','manager','editor','viewer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'editor',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'daniel','$2y$10$TD5oeOWZjfrxNHri87J40eBPVhRAXWGVEPQYCpRxONKiHrRMH1k1q','Admin Demo','admin@empresa.com','admin','2025-09-04'),(8,'nemouser','$2y$10$NdrbClXVwXc0FtFT8Snk9uvIG9Uq5bq9Pnzh9YjZkwPmcIIilh6X2','Nemo','email@email.com','admin','2022-07-10'),(26,'tony','$2y$12$HGKIZLy/e.2lfAce6QJ5pulBhQBk1PMUtbYWBCi3kNTqDIuF6iMXi','Tony Stark','tony@starkindustries.com','admin','2025-09-16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-26  7:22:58
