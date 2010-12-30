-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2010 at 09:49 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dev_writehelper`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `a_uname_idx` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `d_athr_idx` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `document_sections`
--

CREATE TABLE IF NOT EXISTS `document_sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `document` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `order` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doc_order_enforce` (`document`,`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE IF NOT EXISTS `revisions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `textid` int(10) NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `textid` (`textid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_texts`
--

CREATE TABLE IF NOT EXISTS `section_texts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `section` int(10) NOT NULL,
  `text` int(10) NOT NULL,
  `order` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sec_order_enforcement` (`section`,`order`),
  UNIQUE KEY `sec_txt_unique` (`section`,`text`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Intersection to order texts within a section' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'foreign key for tag_type',
  PRIMARY KEY (`id`),
  KEY `t_prnt_idx` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag_instance`
--

CREATE TABLE IF NOT EXISTS `tag_instance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag` int(10) NOT NULL,
  `group` int(10) NOT NULL COMMENT 'no, non-lazy groups (i.e. this is the only representation of group)',
  `item` int(10) NOT NULL,
  `itemType` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'relates to the item type, either document, section or text',
  PRIMARY KEY (`id`),
  KEY `itemType` (`itemType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='contains instances of tags (e.g. that a given text is tagged' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag_type`
--

CREATE TABLE IF NOT EXISTS `tag_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `visible` int(1) NOT NULL,
  `callback` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tagtype_title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='tag type' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `section` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `t_section_idx` (`section`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
