/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : thuvien

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-10-07 23:30:43
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text,
  `category_slug` varchar(255) NOT NULL,
  `category_parent` int(11) DEFAULT '0',
  `category_order` int(11) DEFAULT '0',
  `category_count` int(11) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------
INSERT INTO tbl_category VALUES ('1', 'Thể thao', 'Thể thao', 'the-thao', '0', '0', '0');
INSERT INTO tbl_category VALUES ('2', 'Giải trí', 'Giải trí', 'giai-tri', '0', '0', '0');
INSERT INTO tbl_category VALUES ('3', 'Kinh tế', 'Kinh tế', 'kinh-te', '0', '0', '0');
INSERT INTO tbl_category VALUES ('4', 'Xã hội', 'Xã hội', 'xa-hoi', '0', '0', '0');
INSERT INTO tbl_category VALUES ('5', 'Chính trị', 'Chính trị', 'chinh-tri', '0', '0', '0');

-- ----------------------------
-- Table structure for `tbl_comments`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments` (
  `comment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author_name` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_subject` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_type` varchar(20) DEFAULT '',
  `comment_parent` bigint(20) unsigned DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `comment_post_ID` (`comment_post_id`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comments
-- ----------------------------
INSERT INTO tbl_comments VALUES ('12', '7', '2', 'moderator1', 'moderator1@thuvien.local', '2015-10-06 15:39:26', 'Nhận xét 1', 'Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\n\r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 ', '', '0');
INSERT INTO tbl_comments VALUES ('13', '11', '24', 'create_manager', 'create_manager@m.m', '2015-10-07 18:10:58', 'Nhận xét 1', 'Nội dung ko đầy đủ đề nghị bổ sung thêm', '', '0');

-- ----------------------------
-- Table structure for `tbl_post`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post`;
CREATE TABLE `tbl_post` (
  `post_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` int(11) NOT NULL DEFAULT '0',
  `post_date` datetime DEFAULT NULL,
  `post_content_head` longtext,
  `post_content_body` longtext,
  `post_content_foot` longtext,
  `post_title` varchar(255) NOT NULL,
  `post_category` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) DEFAULT 'Updating' COMMENT 'Updating, Pending, Publish, Private',
  `post_name` varchar(255) DEFAULT NULL,
  `post_guild` varchar(255) DEFAULT NULL,
  `post_approved_user` int(11) DEFAULT NULL,
  `post_approved` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  FULLTEXT KEY `post_title` (`post_title`),
  FULLTEXT KEY `post_content_head` (`post_content_head`),
  FULLTEXT KEY `post_content_body` (`post_content_body`),
  FULLTEXT KEY `post_content_foot` (`post_content_foot`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_post
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_post_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post_tag`;
CREATE TABLE `tbl_post_tag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_post_tag
-- ----------------------------
INSERT INTO tbl_post_tag VALUES ('8', '7', '3');
INSERT INTO tbl_post_tag VALUES ('9', '7', '4');
INSERT INTO tbl_post_tag VALUES ('15', '10', '4');
INSERT INTO tbl_post_tag VALUES ('16', '11', '4');

-- ----------------------------
-- Table structure for `tbl_profile`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0' COMMENT '0: male; 1: female',
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profile
-- ----------------------------
INSERT INTO tbl_profile VALUES ('1', 'Admin', '', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('2', 'Moderator', '1', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('3', 'Moderator', '2', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('4', 'Publisher', '1', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('5', 'Publisher', '2', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('6', 'Author', '1', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('7', 'Author', '2', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('8', 'Member', '1', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('9', 'Member', '2', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('10', 'Member', '3', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('11', 'Member', '4', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('12', 'Member', '5', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('16', 'Nguyễn', 'Quyết', '1', '2015-09-30');
INSERT INTO tbl_profile VALUES ('17', 'Mod', 'Kinh tế', '0', '1989-09-30');
INSERT INTO tbl_profile VALUES ('18', 'Mod', 'Thể thao', '0', '1981-06-25');
INSERT INTO tbl_profile VALUES ('19', 'Publisher', 'Kinh tế 1', '0', '1999-10-14');
INSERT INTO tbl_profile VALUES ('20', 'Publisher', 'Kinh tế 2', '1', '1994-10-18');
INSERT INTO tbl_profile VALUES ('21', 'Author', 'Kinh tế 1', '1', '1976-10-26');
INSERT INTO tbl_profile VALUES ('22', 'Author', 'Kinh tế 2', '1', '2015-10-13');
INSERT INTO tbl_profile VALUES ('23', 'Author', 'Thể thao 1', '0', '2015-10-17');
INSERT INTO tbl_profile VALUES ('24', 'DEMO', 'DEMO', '0', '2015-10-07');
INSERT INTO tbl_profile VALUES ('25', '', '', '1', '0000-00-00');

-- ----------------------------
-- Table structure for `tbl_tag`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tag`;
CREATE TABLE `tbl_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `tag_description` text,
  `tag_slug` varchar(255) NOT NULL,
  `tag_count` int(11) DEFAULT '0',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tag
-- ----------------------------
INSERT INTO tbl_tag VALUES ('1', 'Valentine', 'Ngày lễ tình nhân 14-2 hàng năm', 'valentine', '0');
INSERT INTO tbl_tag VALUES ('2', 'Family', 'Family', 'family', '0');
INSERT INTO tbl_tag VALUES ('3', 'Friend', 'Friend', 'friend', '0');
INSERT INTO tbl_tag VALUES ('4', 'WorldCup', 'WorldCup', 'worldcup', '0');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registered` date DEFAULT NULL,
  `lastvisited` datetime DEFAULT NULL,
  `activekey` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT '0',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` tinyint(1) DEFAULT '0' COMMENT '1:active, 0:not active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO tbl_user VALUES ('1', 'administrator', 'e10adc3949ba59abbe56e057f20f883e', '', 'administrator@thuvien.local', '2014-01-09', '2015-10-07 21:55:51', '', '0', 'administrator', '1');
INSERT INTO tbl_user VALUES ('8', 'member1', 'd41d8cd98f00b204e9800998ecf8427e', '123456789', 'member1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', '0', 'member', '0');
INSERT INTO tbl_user VALUES ('9', 'member2', 'd41d8cd98f00b204e9800998ecf8427e', '1234567891', 'member2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', '0', 'member', '0');
INSERT INTO tbl_user VALUES ('10', 'member3', 'e10adc3949ba59abbe56e057f20f883e', '', 'member3@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', '0', 'member', '1');
INSERT INTO tbl_user VALUES ('11', 'member4', 'e10adc3949ba59abbe56e057f20f883e', '', 'member4@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', '0', 'member', '1');
INSERT INTO tbl_user VALUES ('12', 'member5', 'e10adc3949ba59abbe56e057f20f883e', '', 'member5@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', '0', 'member', '1');
INSERT INTO tbl_user VALUES ('16', 'quyet', 'd41d8cd98f00b204e9800998ecf8427e', '', 'quyet@magingam.com', '2015-09-28', '2015-09-28 16:56:19', '', '0', 'member', '0');
INSERT INTO tbl_user VALUES ('17', 'mod_kinh_te', 'e10adc3949ba59abbe56e057f20f883e', '', 'mod_kinh_te@tracuu.com', '2015-10-06', '2015-10-07 20:27:28', '', '3', 'moderator', '1');
INSERT INTO tbl_user VALUES ('18', 'mod_the_thao', 'e10adc3949ba59abbe56e057f20f883e', '', 'mod_the_thao@tracuu.com', '2015-10-06', null, '', '1', 'moderator', '1');
INSERT INTO tbl_user VALUES ('19', 'publisher_kinhte1', 'e10adc3949ba59abbe56e057f20f883e', '', 'publisher_kinhte1@tracuu.com', '2015-10-06', null, null, '3', 'publisher', '1');
INSERT INTO tbl_user VALUES ('20', 'publisher_kinhte2', 'e10adc3949ba59abbe56e057f20f883e', '', 'publisher_kinhte2@tracuu.com', '2015-10-06', '2015-10-06 21:32:57', null, '3', 'publisher', '1');
INSERT INTO tbl_user VALUES ('21', 'author_kinhte1', 'e10adc3949ba59abbe56e057f20f883e', '', 'author_kinhte1@tracuu.com', '2015-10-06', '2015-10-07 22:07:48', null, '3', 'author', '1');
INSERT INTO tbl_user VALUES ('22', 'author_kinhte2', 'e10adc3949ba59abbe56e057f20f883e', '', 'author_kinhte2@tracuu.com', '2015-10-06', null, '', '3', 'author', '1');
INSERT INTO tbl_user VALUES ('23', 'author_thethao1', 'e10adc3949ba59abbe56e057f20f883e', '123125', 'author_thethao1@tracuu.com', '2015-10-06', '2015-10-07 23:07:47', '', '1', 'author', '1');
INSERT INTO tbl_user VALUES ('24', 'create_manager', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'create_manager@m.m', '2015-10-07', '2015-10-07 23:07:18', '', '1', 'moderator', '1');
INSERT INTO tbl_user VALUES ('25', 'adddddd', 'e10adc3949ba59abbe56e057f20f883e', '1231254', 'asdd@asda.m', '2015-10-07', '2015-10-07 22:08:44', '', '1', 'publisher', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth
-- ----------------------------
INSERT INTO tbl_user_auth VALUES ('1', '0', 'superuser', 'Super User', 'Tài khoản quản trị cao nhất', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('2', '1', 'administrator', 'Administrator', 'Tài khoản Admin', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('3', '2', 'moderator', 'Moderator', 'Tài khoản quản trị viên', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('4', '3', 'publisher', 'Publisher', 'Chuyên viên cao cấp duyệt bài', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('5', '3', 'author', 'Author', 'Chuyên viên nhập liệu', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('6', '4', 'member', 'Member', 'Người dùng thông thường', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('7', '5', 'admin.*', 'admin.*', 'Quyền cho module admin', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('8', '5', 'moderator.*', 'moderator.*', 'Quyền cho module Moderator', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('9', '6', 'admin.user.*', 'admin.user.*', 'Quyền cho controller Admin.User', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('10', '6', 'admin.userrole.*', 'admin.userrole.*', 'Quyền cho controller Admin.UserRole', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('11', '7', 'admin.userrole.index', 'admin.userrole.index', 'Quyền cho action Admin.UserRole.Index', null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('13', '7', 'admin.user.index', 'admin.user.index', null, null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('14', '7', 'admin.user.create', 'admin.user.create', null, null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('15', '7', 'admin.user.update', 'admin.user.update', null, null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('16', '7', 'admin.user.delete', 'admin.user.delete', null, null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('17', '7', 'admin.userrole.delete', 'admin.userrole.delete', null, null, null, null, null);
INSERT INTO tbl_user_auth VALUES ('18', '7', 'admin.userrole.create', 'admin.userrole.create', null, null, null, null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth_assignment
-- ----------------------------
INSERT INTO tbl_user_auth_assignment VALUES ('1', 'member', '16', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('2', 'administrator', '1', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('3', 'moderator', '2', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('4', 'moderator', '17', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('5', 'publisher', '20', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('6', 'author', '21', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('7', 'moderator', '24', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('8', 'publisher', '25', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('9', 'author', '23', null, 'N;');

-- ----------------------------
-- Table structure for `tbl_user_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_auth_item_child`;
CREATE TABLE `tbl_user_auth_item_child` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth_item_child
-- ----------------------------
INSERT INTO tbl_user_auth_item_child VALUES ('1', 'superuser', 'admin.*');
INSERT INTO tbl_user_auth_item_child VALUES ('2', 'admin.*', 'admin.user.*');
INSERT INTO tbl_user_auth_item_child VALUES ('3', 'admin.user.*', 'admin.user.index');
INSERT INTO tbl_user_auth_item_child VALUES ('4', 'admin.*', 'admin.userrole.*');
INSERT INTO tbl_user_auth_item_child VALUES ('5', 'admin.userrole.*', 'admin.userrole.index');
INSERT INTO tbl_user_auth_item_child VALUES ('6', 'admin.user.*', 'admin.user.delete');
INSERT INTO tbl_user_auth_item_child VALUES ('7', 'admin.userrole.*', 'admin.userrole.delete');
INSERT INTO tbl_user_auth_item_child VALUES ('8', 'admin.userrole.*', 'admin.userrole.create');
INSERT INTO tbl_user_auth_item_child VALUES ('9', 'admin.userrole.*', 'admin.userrole.update');
INSERT INTO tbl_user_auth_item_child VALUES ('10', 'administrator', 'admin.user.index');
INSERT INTO tbl_user_auth_item_child VALUES ('11', 'moderator', 'admin.user.index');
