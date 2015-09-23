-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2015 at 07:02 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thuvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `last_visited_date` datetime DEFAULT NULL,
  `activekey` varchar(32) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0' COMMENT '0: Inactive; 1:Active',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role`, `username`, `password`, `fullname`, `phone`, `email`, `registered_date`, `last_visited_date`, `activekey`, `active`, `status`) VALUES
(1, 'superuser', 'superuser', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'binh.phamvan@gmail.com', '2015-09-17 14:59:29', '2015-09-23 21:36:42', '09123', 1, NULL),
(2, 'administrator', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'admin@gmail.com', '2015-09-17 15:00:15', '2015-09-23 21:22:09', '12356', 1, NULL),
(3, 'administrator', 'khongten', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'khongten@123.com', '2015-09-20 03:16:46', NULL, NULL, 1, 1),
(4, 'moderator', 'thunghiem', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thunghiem@123.com', '2015-09-20 03:25:21', '2015-09-23 21:24:06', 'rx3EhNAlsh', 1, NULL),
(5, 'member', 'hehe', 'e10adc3949ba59abbe56e057f20f883e', 'Bình Phạm', 2147483647, 'binhpv001@gmail.com', '2015-09-23 23:04:25', NULL, 'SZ3k0XFD2m', 0, NULL),
(6, 'member', 'tenten', '01cfcd4f6b8770febfb40cb906715822', 'Phạm Văn Bình', 989279795, 'binh.phamvan1@gmail.com', '2015-09-23 23:15:04', NULL, '235o1wJMYw', 0, NULL),
(7, 'member', 'tenten1', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bình', 2147483647, 'binh.phamvan11@gmail.com', '2015-09-23 23:15:48', '2015-09-23 23:43:31', '4LI0G1CtHN', 0, NULL),
(8, 'member', 'tenten11', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bình', 2147483647, 'binh.phamvan111@gmail.com', '2015-09-23 23:16:18', NULL, 'pmbVI0btT6', 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

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
(18, 7, 'admin.userrole.create', 'admin.userrole.create', NULL, NULL, NULL, NULL, NULL),
(27, 127, '324', '234', '', '', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_user_auth_assignment`
--

INSERT INTO `tbl_user_auth_assignment` (`id`, `itemname`, `userid`, `bizrule`, `data`) VALUES
(1, 'superuser', '1', NULL, 'N;'),
(3, 'administrator', '2', NULL, 'N;'),
(4, 'member', '7', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `tbl_user_auth_item_child` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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
(10, 'administrator', 'admin.user.index');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
