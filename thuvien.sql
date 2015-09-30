-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2015 at 06:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `thuvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text,
  `category_slug` varchar(255) NOT NULL,
  `category_parent` int(11) DEFAULT '0',
  `category_order` int(11) DEFAULT '0',
  `category_count` int(11) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_description`, `category_slug`, `category_parent`, `category_order`, `category_count`) VALUES
(1, 'Mã Nhũng', 'Mã Nhúng', 'ma-nhung', 0, 0, 0),
(2, 'Y khoa', 'Y Khoa', 'y-khoa', 0, 0, 0),
(3, 'Đông Y', 'Đông Y', 'dong-y', 2, 0, 0),
(4, 'Tây Y', 'Tây Y', 'tay-y', 2, 0, 0),
(5, 'Thuốc Bắc', 'Thuốc bắc', 'thuoc-bac', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_user`
--

CREATE TABLE IF NOT EXISTS `tbl_category_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `omment_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `post_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` int(11) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_content_head` longtext,
  `post_content_body` longtext,
  `post_content_foot` longtext,
  `post_title` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT 'Updating' COMMENT 'Updating, Pending, Publish, Private',
  `post_name` varchar(255) DEFAULT NULL,
  `post_guild` varchar(255) DEFAULT NULL,
  `post_approved_user` int(11) DEFAULT NULL,
  `post_approved` date DEFAULT NULL,
  PRIMARY KEY (`post_ID`),
  FULLTEXT KEY `post_title` (`post_title`),
  FULLTEXT KEY `post_content_head` (`post_content_head`),
  FULLTEXT KEY `post_content_body` (`post_content_body`),
  FULLTEXT KEY `post_content_foot` (`post_content_foot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0' COMMENT '0: male; 1: female',
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`user_id`, `fname`, `lname`, `gender`, `birthday`) VALUES
(1, 'Admin', '', 0, '1989-09-30'),
(2, 'Moderator', '1', 0, '1989-09-30'),
(3, 'Moderator', '2', 0, '1989-09-30'),
(4, 'Publisher', '1', 0, '1989-09-30'),
(5, 'Publisher', '2', 0, '1989-09-30'),
(6, 'Author', '1', 0, '1989-09-30'),
(7, 'Author', '2', 0, '1989-09-30'),
(8, 'Member', '1', 0, '1989-09-30'),
(9, 'Member', '2', 0, '1989-09-30'),
(10, 'Member', '3', 0, '1989-09-30'),
(11, 'Member', '4', 0, '1989-09-30'),
(12, 'Member', '5', 0, '1989-09-30'),
(16, 'Nguyễn', 'Quyết', 1, '2015-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) DEFAULT NULL,
  `tag_description` text,
  `tag_slug` varchar(255) DEFAULT NULL,
  `tag_parent` int(11) DEFAULT '0',
  `tag_order` int(11) DEFAULT NULL,
  `tag_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registered` date DEFAULT NULL,
  `lastvisited` datetime DEFAULT NULL,
  `activekey` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `status` tinyint(1) DEFAULT '0' COMMENT '1:active, 0:not active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `registered`, `lastvisited`, `activekey`, `role`, `status`) VALUES
(1, 'administrator', 'e10adc3949ba59abbe56e057f20f883e', 'administrator@thuvien.local', '2014-01-09', '2015-09-29 21:25:57', '', 'administrator', 1),
(2, 'moderator1', 'e10adc3949ba59abbe56e057f20f883e', 'moderator1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'moderator', 1),
(3, 'moderator2', 'e10adc3949ba59abbe56e057f20f883e', 'moderator2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'moderator', 1),
(4, 'publisher1', 'e10adc3949ba59abbe56e057f20f883e', 'publisher1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'publisher', 1),
(5, 'publisher2', 'e10adc3949ba59abbe56e057f20f883e', 'publisher2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'publisher', 1),
(6, 'author1', 'e10adc3949ba59abbe56e057f20f883e', 'author1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'author', 1),
(7, 'author2', 'e10adc3949ba59abbe56e057f20f883e', 'author2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'author', 1),
(8, 'member1', 'e10adc3949ba59abbe56e057f20f883e', 'member1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', 1),
(9, 'member2', 'e10adc3949ba59abbe56e057f20f883e', 'member2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', 1),
(10, 'member3', 'e10adc3949ba59abbe56e057f20f883e', 'member3@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', 1),
(11, 'member4', 'e10adc3949ba59abbe56e057f20f883e', 'member4@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', 1),
(12, 'member5', 'e10adc3949ba59abbe56e057f20f883e', 'member5@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', 1),
(16, 'quyet', 'd41d8cd98f00b204e9800998ecf8427e', 'quyet@magingam.com', '2015-09-28', '2015-09-28 16:56:19', '', 'member', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_auth`
--

CREATE TABLE IF NOT EXISTS `tbl_user_auth` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '0: Super User; 1: Admin; 2: Moderator; 3: Chuyên viên; 4: Member; 5: Quyền cho module; 6: Quyền cho controller; 7: Quyền cho action',
  `name` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  `ordering` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_user_auth`
--

INSERT INTO `tbl_user_auth` (`id`, `type`, `name`, `title`, `description`, `bizrule`, `data`, `ordering`, `status`) VALUES
(1, 0, 'superuser', 'Super User', 'Tài khoản quản trị cao nhất', NULL, NULL, NULL, NULL),
(2, 1, 'administrator', 'Administrator', 'Tài khoản Admin', NULL, NULL, NULL, NULL),
(3, 2, 'moderator', 'Moderator', 'Tài khoản quản trị viên', NULL, NULL, NULL, NULL),
(4, 3, 'publisher', 'Publisher', 'Chuyên viên cao cấp duyệt bài', NULL, NULL, NULL, NULL),
(5, 3, 'author', 'Author', 'Chuyên viên nhập liệu', NULL, NULL, NULL, NULL),
(6, 4, 'member', 'Member', 'Người dùng thông thường', NULL, NULL, NULL, NULL),
(7, 5, 'admin.*', 'admin.*', 'Quyền cho module admin', NULL, NULL, NULL, NULL),
(8, 5, 'moderator.*', 'moderator.*', 'Quyền cho module Moderator', NULL, NULL, NULL, NULL),
(9, 6, 'admin.user.*', 'admin.user.*', 'Quyền cho controller Admin.User', NULL, NULL, NULL, NULL),
(10, 6, 'admin.userrole.*', 'admin.userrole.*', 'Quyền cho controller Admin.UserRole', NULL, NULL, NULL, NULL),
(11, 7, 'admin.userrole.index', 'admin.userrole.index', 'Quyền cho action Admin.UserRole.Index', NULL, NULL, NULL, NULL),
(13, 7, 'admin.user.index', 'admin.user.index', NULL, NULL, NULL, NULL, NULL),
(14, 7, 'admin.user.create', 'admin.user.create', NULL, NULL, NULL, NULL, NULL),
(15, 7, 'admin.user.update', 'admin.user.update', NULL, NULL, NULL, NULL, NULL),
(16, 7, 'admin.user.delete', 'admin.user.delete', NULL, NULL, NULL, NULL, NULL),
(17, 7, 'admin.userrole.delete', 'admin.userrole.delete', NULL, NULL, NULL, NULL, NULL),
(18, 7, 'admin.userrole.create', 'admin.userrole.create', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_user_auth_assignment` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user_auth_assignment`
--

INSERT INTO `tbl_user_auth_assignment` (`id`, `itemname`, `userid`, `bizrule`, `data`) VALUES
(1, 'member', '16', NULL, 'N;'),
(2, 'administrator', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `tbl_user_auth_item_child` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_user_auth_item_child`
--

INSERT INTO `tbl_user_auth_item_child` (`id`, `parent`, `child`) VALUES
(1, 'superuser', 'admin.*'),
(2, 'admin.*', 'admin.user.*'),
(3, 'admin.user.*', 'admin.user.index'),
(4, 'admin.*', 'admin.userrole.*'),
(5, 'admin.userrole.*', 'admin.userrole.index'),
(6, 'admin.user.*', 'admin.user.delete'),
(7, 'admin.userrole.*', 'admin.userrole.delete'),
(8, 'admin.userrole.*', 'admin.userrole.create'),
(9, 'admin.userrole.*', 'admin.userrole.update'),
(10, 'administrator', 'admin.user.index'),
(11, 'moderator', 'admin.user.index');
