/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : myapp

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-09-17 17:17:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `last_visited_date` datetime DEFAULT NULL,
  `activekey` varchar(32) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0' COMMENT '0: Inactive; 1:Active',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', '[\"superuser\"]', 'superuser', 'e10adc3949ba59abbe56e057f20f883e', 'binh.phamvan@gmail.com', '2015-09-17 14:59:29', '2015-09-17 14:59:34', '09123', '1', null);
INSERT INTO `tbl_user` VALUES ('2', '[\"administrator\"]', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', '2015-09-17 15:00:15', '2015-09-17 15:00:17', '12356', '1', null);

-- ----------------------------
-- Table structure for `tbl_user_auth`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_auth`;
CREATE TABLE `tbl_user_auth` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth
-- ----------------------------
INSERT INTO `tbl_user_auth` VALUES ('1', '0', 'superuser', 'Super User', 'Tài khoản quản trị cao nhất', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('2', '1', 'administrator', 'Administrator', 'Tài khoản Admin', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('3', '2', 'moderator', 'Moderator', 'Tài khoản quản trị viên', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('4', '3', 'publisher', 'Publisher', 'Chuyên viên cao cấp duyệt bài', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('5', '3', 'author', 'Author', 'Chuyên viên nhập liệu', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('6', '4', 'member', 'Member', 'Người dùng thông thường', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('7', '5', 'admin.*', 'admin.*', 'Quyền cho module admin', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('8', '5', 'moderator.*', 'moderator.*', 'Quyền cho module Moderator', null, null, null, null);
INSERT INTO `tbl_user_auth` VALUES ('9', '6', 'admin.user.*', 'admin.user.*', 'Quyền cho controller Admin.User', null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_user_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_auth_assignment`;
CREATE TABLE `tbl_user_auth_assignment` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth_assignment
-- ----------------------------
INSERT INTO `tbl_user_auth_assignment` VALUES ('1', 'superuser', '1', null, 'N;');

-- ----------------------------
-- Table structure for `tbl_user_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_auth_item_child`;
CREATE TABLE `tbl_user_auth_item_child` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth_item_child
-- ----------------------------
INSERT INTO `tbl_user_auth_item_child` VALUES ('1', 'superuser', 'admin.*');
INSERT INTO `tbl_user_auth_item_child` VALUES ('2', 'admin.*', 'admin.user.*');
INSERT INTO `tbl_user_auth_item_child` VALUES ('3', 'admin.user.*', 'admin.user.index');
