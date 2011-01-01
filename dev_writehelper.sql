-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2011 at 09:41 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

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

CREATE TABLE `AuthAssignment` (
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

CREATE TABLE `AuthItem` (
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

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `a_uname_idx` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `d_athr_idx` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `document_sections`
--

CREATE TABLE `document_sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `document` int(10) NOT NULL,
  `section` int(10) NOT NULL,
  `order` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doc_order_enforce` (`document`,`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `textid` int(10) NOT NULL,
  `contents` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `textid` (`textid`),
  KEY `modified` (`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_text`
--

CREATE TABLE `section_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `text` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `st_section_idx` (`section`),
  KEY `st_text_idx` (`text`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section_texts`
--

CREATE TABLE `section_texts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `section` int(10) NOT NULL,
  `text` int(10) NOT NULL,
  `order` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sec_order_enforcement` (`section`,`order`),
  UNIQUE KEY `sec_txt_unique` (`section`,`text`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Intersection to order texts within a section' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
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

CREATE TABLE `tag_instance` (
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

CREATE TABLE `tag_type` (
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

CREATE TABLE `text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `section` int(11) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `t_section_idx` (`section`),
  KEY `modified` (`modified`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `text_tags`
--

CREATE TABLE `text_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tt_text_idx` (`text`),
  KEY `tt_tag_idx` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='relation table to relate text elements to tags' AUTO_INCREMENT=1 ;
