-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 23 Mai 2017 à 21:59
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `spe_structure`
--

-- --------------------------------------------------------

--
-- Structure de la table `spe_account`
--

CREATE TABLE IF NOT EXISTS `spe_account` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `datec` datetime DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ref` varchar(20) NOT NULL,
  `label` varchar(30) NOT NULL,
  `fk_user_author` int(11) DEFAULT NULL,
  `fk_user_modif` int(11) DEFAULT NULL,
  `bank_name` varchar(60) DEFAULT NULL,
  `code_banque` varchar(8) DEFAULT NULL,
  `code_guichet` varchar(6) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `cle_rib` varchar(5) DEFAULT NULL,
  `bic` varchar(11) DEFAULT NULL,
  `iban_prefix` varchar(34) DEFAULT NULL,
  `country_iban` varchar(2) DEFAULT NULL,
  `cle_iban` varchar(2) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(128) DEFAULT NULL,
  `account_number` varchar(32) DEFAULT NULL,
  `min_allowed` int(11) DEFAULT '0',
  `min_desired` int(11) DEFAULT '0',
  `amount` double(24,2) DEFAULT '0.00',
  `comment` text,
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `uk_bank_label` (`label`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `spe_account`
--

INSERT INTO `spe_account` (`rowid`, `datec`, `tms`, `ref`, `label`, `fk_user_author`, `fk_user_modif`, `bank_name`, `code_banque`, `code_guichet`, `number`, `cle_rib`, `bic`, `iban_prefix`, `country_iban`, `cle_iban`, `status`, `url`, `account_number`, `min_allowed`, `min_desired`, `amount`, `comment`) VALUES
(1, NULL, '2017-05-23 19:58:55', 'Compte_courrant', 'Compte courrant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0.00, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `spe_comptacateg`
--

CREATE TABLE IF NOT EXISTS `spe_comptacateg` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `datec` datetime DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(15) NOT NULL,
  `label` varchar(150) NOT NULL,
  `ordre` int(11) NOT NULL DEFAULT '0',
  `plafond` float NOT NULL,
  `fk_parent` int(11) NOT NULL,
  `fk_user_author` int(11) DEFAULT NULL,
  `fk_user_modif` int(11) DEFAULT NULL,
  `min_allowed` int(11) DEFAULT '0',
  `min_desired` int(11) DEFAULT '0',
  PRIMARY KEY (`rowid`),
  KEY `fk_parent` (`fk_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `spe_payment`
--

CREATE TABLE IF NOT EXISTS `spe_payment` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(75) NOT NULL,
  `datec` time DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `datep` date DEFAULT NULL,
  `date_facture` date DEFAULT NULL,
  `amount` double(24,2) DEFAULT '0.00',
  `mode` int(11) DEFAULT '0',
  `note` text,
  `tva` int(11) NOT NULL DEFAULT '0',
  `provision` tinyint(4) NOT NULL DEFAULT '0',
  `fk_bank` int(11) NOT NULL DEFAULT '0',
  `fk_categcomptable` int(11) NOT NULL,
  `fk_user_creat` int(11) DEFAULT NULL,
  `fk_user_modif` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `exceptionnel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rowid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `spe_user`
--

CREATE TABLE IF NOT EXISTS `spe_user` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `datec` datetime DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_user_creat` int(11) DEFAULT NULL,
  `fk_user_modif` int(11) DEFAULT NULL,
  `login` varchar(24) NOT NULL,
  `pass_crypted` varchar(128) DEFAULT NULL,
  `pass_temp` varchar(32) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(25) DEFAULT NULL,
  `town` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `job` varchar(128) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `office_phone` varchar(20) DEFAULT NULL,
  `office_fax` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `admin` smallint(6) DEFAULT '0',
  `datelastlogin` datetime DEFAULT NULL,
  `datepreviouslogin` datetime DEFAULT NULL,
  `statut` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`rowid`),
  UNIQUE KEY `uk_user_login` (`login`),
  UNIQUE KEY `uk_user_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `spe_user`
--

INSERT INTO `spe_user` (`rowid`, `datec`, `tms`, `fk_user_creat`, `fk_user_modif`, `login`, `pass_crypted`, `pass_temp`, `lastname`, `firstname`, `address`, `zip`, `town`, `country`, `job`, `skype`, `office_phone`, `office_fax`, `email`, `admin`, `datelastlogin`, `datepreviouslogin`, `statut`) VALUES
(1, '2017-02-28 10:13:00', '2017-03-07 14:12:49', NULL, 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, 'ADMINISTRATEUR', 'A.', NULL, NULL, NULL, NULL, 'Développeur logiciel', NULL, NULL, NULL, 'admin@admin.com', 1, NULL, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
