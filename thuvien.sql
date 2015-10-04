/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : thuvien

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2015-10-03 13:33:19
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
INSERT INTO tbl_category VALUES ('1', 'Mã Nhũng', 'Mã Nhúng', 'ma-nhung', '0', '0', '0');
INSERT INTO tbl_category VALUES ('2', 'Y khoa', 'Y Khoa', 'y-khoa', '0', '0', '0');
INSERT INTO tbl_category VALUES ('3', 'Đông Y', 'Đông Y', 'dong-y', '2', '0', '0');
INSERT INTO tbl_category VALUES ('4', 'Tây Y', 'Tây Y', 'tay-y', '2', '0', '0');
INSERT INTO tbl_category VALUES ('5', 'Thuốc Bắc', 'Thuốc bắc', 'thuoc-bac', '3', '0', '0');

-- ----------------------------
-- Table structure for `tbl_category_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_user`;
CREATE TABLE `tbl_category_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category_user
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_comments`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author_name` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comments
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_post`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post`;
CREATE TABLE `tbl_post` (
  `post_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_author` int(11) NOT NULL DEFAULT '0',
  `post_date` datetime DEFAULT NULL,
  `post_content_head` longtext,
  `post_content_body` longtext,
  `post_content_foot` longtext,
  `post_title` varchar(255) NOT NULL,
  `post_category` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'Updating' COMMENT 'Updating, Pending, Publish, Private',
  `post_name` varchar(255) NOT NULL,
  `post_guild` varchar(255) DEFAULT NULL,
  `post_approved_user` int(11) DEFAULT NULL,
  `post_approved` datetime DEFAULT NULL,
  PRIMARY KEY (`post_ID`),
  FULLTEXT KEY `post_title` (`post_title`),
  FULLTEXT KEY `post_content_head` (`post_content_head`),
  FULLTEXT KEY `post_content_body` (`post_content_body`),
  FULLTEXT KEY `post_content_foot` (`post_content_foot`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_post
-- ----------------------------
INSERT INTO tbl_post VALUES ('1', '6', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 1', '1', 'Updating', 'post_name', 'post_guild', '4', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('2', '6', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 2', '4', 'Updating', 'post_name', 'post_guild', '5', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('3', '7', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 3', '2', 'Pending', 'post_name', 'post_guild', '4', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('4', '6', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 4', '1', 'Publish', 'post_name', 'post_guild', '4', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('5', '6', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 5', '3', 'Private', 'post_name', 'post_guild', '5', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('6', '7', '2015-10-01 00:00:00', 'post_content_head', 'post_content_body', 'post_content_foot', 'post_title 6', '5', 'Updating', 'post_name', 'post_guild', '4', '2015-10-02 00:00:00');
INSERT INTO tbl_post VALUES ('7', '6', '2015-10-01 23:57:58', '<p>\r\n	Gi&aacute; nước tăng th&ecirc;m 19%, thế nhưng chất lượng dịch vụ đi xuống. Cũng v&igrave; vậy, nhiều người d&acirc;n Thủ đ&ocirc; sống trong cảnh &ldquo;kh&aacute;t&rdquo; nước sạch v&agrave; nỗi lo lại vỡ đường ống nước S&ocirc;ng Đ&agrave; lần thứ n&hellip;</p>\r\n', '<p>\r\n	<span align=\"center\" class=\"img-share\"><img alt=\"HN vỡ đường ống nước liên tiếp: “Chúng tôi đã làm tròn trách nhiệm” - 1\" class=\"news-image\" id=\"news-image-id-0\" src=\"http://24h-img.24hstatic.com/upload/4-2015/images/2015-10-01/1443709800-1443709430-vo-duong-ong-nuoc-song-da-hinh-anh-1.jpg\" /></span></p>\r\n<p style=\"color:#0000FF;font-style:italic;text-align:center;\">\r\n	9 th&aacute;ng đầu năm 2015, đường ống nước S&ocirc;ng Đ&agrave; đ&atilde; bị vỡ tới 5 lần. H&agrave;ng ng&agrave;n hộ d&acirc;n Thủ đ&ocirc; bị ảnh hưởng.</p>\r\n<p>\r\n	<strong>Gi&aacute; nước tăng 19%, d&acirc;n vẫn &ldquo;kh&aacute;t&rdquo; nước</strong></p>\r\n<p>\r\n	Từ 1.10, c&aacute;c đơn vị cung cấp nước sạch tr&ecirc;n địa b&agrave;n TP.H&agrave; Nội sẽ tăng gi&aacute; b&aacute;n nước sạch l&ecirc;n 19% so với gi&aacute; hiện đang &aacute;p dụng. Trong ng&agrave;y, người d&acirc;n ở khu vực phố Ho&agrave;ng Văn Th&aacute;i (quận Thanh Xu&acirc;n, H&agrave; Nội) b&agrave;n t&aacute;n r&ocirc;m rả về c&acirc;u chuyện &ldquo;kh&aacute;t&rdquo; nước sạch giữa Thủ đ&ocirc;. B&ecirc;n cạnh c&acirc;u chuyện &ldquo;dở kh&oacute;c, dở cười&rdquo; v&igrave; mất nước, nhiều người c&ograve;n nhăn nh&oacute; khi nhắc đến việc <u>H&agrave; Nội tăng gi&aacute; nước sạch</u>.</p>\r\n<p>\r\n	B&agrave; Nguyễn Diệu Th&uacute;y (50 tuổi, ở phố Ho&agrave;ng Văn Th&aacute;i) cho biết, đến chiều 30.9, khu vực nh&agrave; b&agrave; mới c&oacute; nước trở lại. B&agrave; Th&uacute;y chia sẻ, người d&acirc;n khu phố đều chấp nhận tăng gi&aacute; nước, nhưng c&ocirc;ng ty nước sạch phải cam kết đảm bảo đường ống dẫn nước kh&ocirc;ng bị vỡ.</p>\r\n<p>\r\n	&ldquo;Những ng&agrave;y mất nước v&igrave; <strong>vỡ đường ống nước S&ocirc;ng Đ&agrave;</strong>, mấy đứa con nh&agrave; t&ocirc;i s&aacute;ng th&igrave; dậy đi l&agrave;m thật sớm, chiều cố ở lại ở cơ quan để đi vệ sinh... Vợ chồng t&ocirc;i đang t&iacute;nh phải l&agrave;m c&aacute;i giếng khoan, chứ cứ v&agrave;i h&ocirc;m lại vỡ đường ống th&igrave; gia đ&igrave;nh lao đao. Gi&aacute; nước tăng m&agrave; chất lượng kh&ocirc;ng tăng th&igrave; kh&ocirc;ng thể chấp nhận được&rdquo;, b&agrave; Th&uacute;y n&oacute;i.</p>\r\n<p>\r\n	Trong khi đ&oacute;, &ocirc;ng Nguyễn Đức Viết (Ph&ugrave;ng Khoang, quận Nam Từ Li&ecirc;m, H&agrave; Nội) cho biết, gia đ&igrave;nh &ocirc;ng c&oacute; một m&aacute;y bơm giếng khoan, mấy h&ocirc;m nay mất nước sạch, &ocirc;ng Viết lại phải bơm nước giếng khoan l&ecirc;n sử dụng. Nhưng v&igrave; gia đ&igrave;nh &ocirc;ng ở gần khu vực nghĩa trang, d&ugrave; đ&atilde; qua lớp lọc c&aacute;t, nhưng nước giếng khoan bơm l&ecirc;n vẫn đục v&agrave; c&oacute; m&ugrave;i tanh, n&ecirc;n &ocirc;ng Viết chỉ d&ugrave;ng để giội nh&agrave; vệ sinh.</p>\r\n<p>\r\n	&ldquo;Do vậy, nh&agrave; t&ocirc;i đều phải đi mua nước về nấu cơm, tắm giặt. C&oacute; h&ocirc;m x&oacute;t tiền, t&ocirc;i lấy nước giếng khoan nấu nướng, nhưng nấu xong rồi lại kh&ocirc;ng d&aacute;m ăn. Tăng gi&aacute; nước m&agrave; cứ phải cắn răng d&ugrave;ng nước cạnh nghĩa trang th&igrave; t&ocirc;i kh&ocirc;ng đồng &yacute;&rdquo;, &ocirc;ng Viết n&oacute;i.</p>\r\n<p align=\"center\">\r\n	<span align=\"center\" class=\"img-share\"><span class=\"shareImage\" id=\"shareImage-1\" style=\"opacity: 0; left: 25px;\"><span><img alt=\"\" height=\"20\" src=\"http://24h-static.24hstatic.com/images/2014/share-fb.gif\" width=\"67\" /></span>&nbsp;<span title=\"\"><img alt=\"\" height=\"20\" src=\"http://24h-static.24hstatic.com/images/2014/share-gg.gif\" width=\"67\" /></span></span><img alt=\"HN vỡ đường ống nước liên tiếp: “Chúng tôi đã làm tròn trách nhiệm” - 2\" class=\"news-image\" id=\"news-image-id-1\" src=\"http://24h-img.24hstatic.com/upload/4-2015/images/2015-10-01/1443709800-1443709585-vo-duong-ong-nuoc-song-da-hinh-anh-2.jpg\" width=\"500\" /></span></p>\r\n<p style=\"color:#0000FF;font-style:italic;text-align:center;\">\r\n	Bệnh viện 198 - Bộ C&ocirc;ng an v&agrave; Bệnh viện Phụ sản H&agrave; Nội lao đao v&igrave; thiếu nước sạch.</p>\r\n<p>\r\n	<strong>Lưu lượng nước cung cấp cho H&agrave; Nội kh&ocirc;ng giảm</strong></p>\r\n<p>\r\n	&Ocirc;ng Trương Quốc Dương - Ph&oacute; Tổng gi&aacute;m đốc C&ocirc;ng ty cổ phần Nước sạch Vinaconex, đơn vị cung cấp nước v&agrave; quản l&yacute; vận h&agrave;nh <em>đường ống nước S&ocirc;ng Đ&agrave;</em> - cho hay, khi đường ống nước vỡ, đơn vị mất khoảng 10 tiếng để khắc phục v&agrave; cấp nước lại cho người d&acirc;n.</p>\r\n<p>\r\n	Trao đổi với ph&oacute;ng vi&ecirc;n, &ocirc;ng Dương cho biết: &ldquo;Trước khi đường ống nước s&ocirc;ng Đ&agrave; vỡ lần thứ 14, ch&uacute;ng t&ocirc;i cấp cho H&agrave; Nội với tổng lưu lượng khoảng 230.000m<sup>3</sup>/ng&agrave;y đ&ecirc;m. Sau khi khắc phục xong, ch&uacute;ng t&ocirc;i vẫn cấp đủ cho H&agrave; Nội, lưu lượng 240.000m<sup>3</sup>/ng&agrave;y đ&ecirc;m. C&ocirc;ng ty kh&ocirc;ng giảm &aacute;p trong ống hay lưu lượng nước&rdquo;.</p>\r\n<p>\r\n	Theo &ocirc;ng Dương, sau khi đường ống nước vỡ, c&aacute;c bể t&iacute;ch trữ, t&eacute;c nước của nh&agrave; d&acirc;n đều cạn. Do vậy, khi nguồn nước sạch S&ocirc;ng Đ&agrave; được cấp trở lại, nhiều hộ d&acirc;n đầu nguồn c&oacute; t&acirc;m l&yacute; muốn t&iacute;ch trữ đầy bể, n&ecirc;n nhiều người d&acirc;n ở cuối nguồn nước, khu vực cao th&igrave; chịu cảnh nước chảy chậm, thậm ch&iacute; mất nước.</p>\r\n<p>\r\n	&ldquo;Để khắc phục việc mất nước, c&aacute;c c&ocirc;ng ty ph&acirc;n phối, b&aacute;n lẻ nước phải linh hoạt trong việc điều tiết nước ở từng khu vực bằng c&aacute;ch cấp nước cho những hộ d&acirc;n ở đầu nguồn một v&agrave;i tiếng, sau đ&oacute; đ&oacute;ng van lại, dồn nước cho khu vực d&acirc;n cư ở xa nguồn, nơi cao. Cứ đảo như vậy, người d&acirc;n sẽ c&oacute; nước d&ugrave;ng, đỡ &ldquo;kh&aacute;t&rdquo; hơn&rdquo;, &ocirc;ng Dương n&ecirc;u giải ph&aacute;p.</p>\r\n<p>\r\n	Trả lời về việc nhiều &yacute; kiến cho rằng c&ocirc;ng ty nước sạch phải đền b&ugrave; thiệt hại cho c&aacute;c hộ d&acirc;n bị mất nước, phải mua nước gi&aacute; cao về d&ugrave;ng, &ocirc;ng Dương khẳng định: &ldquo;Khi vỡ đường ống, ch&uacute;ng t&ocirc;i c&oacute; tr&aacute;ch nhiệm khắc phục sự cố, cấp nước trở lại đầy đủ cho đơn vị b&aacute;n lẻ, kh&ocirc;ng giảm lưu lượng (230.000m<sup>3</sup>/ng&agrave;y đ&ecirc;m). Như vậy, ch&uacute;ng t&ocirc;i đ&atilde; l&agrave;m tr&ograve;n tr&aacute;ch nhiệm. Một số khu vực d&acirc;n cư thiếu nước l&agrave; do tr&aacute;ch nhiệm của c&aacute;c đơn vị b&aacute;n lẻ nước. Họ phải c&oacute; kế hoạch điều tiết l&agrave;m sao cấp đủ nước cho người d&acirc;n. Ch&uacute;ng t&ocirc;i kh&ocirc;ng k&yacute; hợp đồng với người d&acirc;n n&ecirc;n rất kh&oacute; xem x&eacute;t đến phương &aacute;n đền b&ugrave;&rdquo;.</p>\r\n<p>\r\n	&Ocirc;ng Dương cho biết, gi&aacute; nước tăng 19% kể từ ng&agrave;y 1.10, đ&acirc;y l&agrave; mức gi&aacute; đ&atilde; được Hội đồng nh&acirc;n d&acirc;n TP.H&agrave; Nội ph&ecirc; duyệt, quyết định c&aacute;ch đ&acirc;y hơn 1 năm. Mức gi&aacute; n&agrave;y tăng theo lộ tr&igrave;nh của UBND TP.H&agrave; Nội.</p>\r\n', '<p>\r\n	<em>Kể từ năm 2012 đến nay, đường ống dẫn nước từ s&ocirc;ng Đ&agrave; về H&agrave; Nội bị vỡ 14 lần. Ri&ecirc;ng 9 th&aacute;ng đầu năm 2015, đường ống bị vỡ 5 lần.</em></p>\r\n<p>\r\n	<em>Ng&agrave;y 26.9, đường ống nước từ s&ocirc;ng Đ&agrave; về H&agrave; Nội lại vỡ lần thứ 14, tại km26 + 350, huyện Thạch Thất (H&agrave; Nội). Khoảng 70.000 hộ d&acirc;n Thủ đ&ocirc; ở c&aacute;c quận: Thanh Xu&acirc;n, Ho&agrave;ng Mai, H&agrave; Đ&ocirc;ng&hellip; bị ảnh hưởng.</em></p>\r\n<p>\r\n	<em>Tại Bệnh viện (BV) 198 - Bộ C&ocirc;ng an (quận Cầu Giấy), b&aacute;c sĩ, người nh&agrave; bệnh nh&acirc;n phải đi x&aacute;ch từng can nước để sinh hoạt. Đặc biệt, tại BV Phụ sản H&agrave; Nội (quận Ba Đ&igrave;nh), nước dự trữ trong bể cũng hết, c&aacute;c b&aacute;c sĩ phải tạm dừng tất cả c&aacute;c ca mổ chủ động v&igrave; thiếu nước sạch. Đến ng&agrave;y 1.10, nước sạch cấp cho BV mới ổn định trở lại.</em></p>\r\n', 'HN vỡ đường ống nước liên tiếp: “Chúng tôi đã làm tròn trách nhiệm”', '1', 'Updating', 'HN vỡ đường ống nước liên tiếp: “Chúng tôi đã làm tròn trách nhiệm”', null, null, null);

-- ----------------------------
-- Table structure for `tbl_profile`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profile`;
CREATE TABLE `tbl_profile` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0' COMMENT '0: male; 1: female',
  `phone` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profile
-- ----------------------------
INSERT INTO tbl_profile VALUES ('1', 'Admin', '', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('2', 'Moderator', '1', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('3', 'Moderator', '2', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('4', 'Publisher', '1', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('5', 'Publisher', '2', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('6', 'Author', '1', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('7', 'Author', '2', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('8', 'Member', '1', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('9', 'Member', '2', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('10', 'Member', '3', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('11', 'Member', '4', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('12', 'Member', '5', '0', null, '1989-09-30');
INSERT INTO tbl_profile VALUES ('16', 'Nguyễn', 'Quyết', '1', null, '2015-09-30');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tag
-- ----------------------------
INSERT INTO tbl_tag VALUES ('1', 'Valentine', 'Ngày lễ tình nhân 14-2 hàng năm', 'valentine', '0');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO tbl_user VALUES ('1', 'administrator', 'e10adc3949ba59abbe56e057f20f883e', 'administrator@thuvien.local', '2014-01-09', '2015-10-01 20:08:31', '', 'administrator', '1');
INSERT INTO tbl_user VALUES ('2', 'moderator1', 'e10adc3949ba59abbe56e057f20f883e', 'moderator1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'moderator', '1');
INSERT INTO tbl_user VALUES ('3', 'moderator2', 'e10adc3949ba59abbe56e057f20f883e', 'moderator2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'moderator', '1');
INSERT INTO tbl_user VALUES ('4', 'publisher1', 'e10adc3949ba59abbe56e057f20f883e', 'publisher1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'publisher', '1');
INSERT INTO tbl_user VALUES ('5', 'publisher2', 'e10adc3949ba59abbe56e057f20f883e', 'publisher2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'publisher', '1');
INSERT INTO tbl_user VALUES ('6', 'author1', 'e10adc3949ba59abbe56e057f20f883e', 'author1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'author', '1');
INSERT INTO tbl_user VALUES ('7', 'author2', 'e10adc3949ba59abbe56e057f20f883e', 'author2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'author', '1');
INSERT INTO tbl_user VALUES ('8', 'member1', 'e10adc3949ba59abbe56e057f20f883e', 'member1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', '1');
INSERT INTO tbl_user VALUES ('9', 'member2', 'e10adc3949ba59abbe56e057f20f883e', 'member2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', '1');
INSERT INTO tbl_user VALUES ('10', 'member3', 'e10adc3949ba59abbe56e057f20f883e', 'member3@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', '1');
INSERT INTO tbl_user VALUES ('11', 'member4', 'e10adc3949ba59abbe56e057f20f883e', 'member4@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', '1');
INSERT INTO tbl_user VALUES ('12', 'member5', 'e10adc3949ba59abbe56e057f20f883e', 'member5@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 'member', '1');
INSERT INTO tbl_user VALUES ('16', 'quyet', 'd41d8cd98f00b204e9800998ecf8427e', 'quyet@magingam.com', '2015-09-28', '2015-09-28 16:56:19', '', 'member', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user_auth_assignment
-- ----------------------------
INSERT INTO tbl_user_auth_assignment VALUES ('1', 'member', '16', null, 'N;');
INSERT INTO tbl_user_auth_assignment VALUES ('2', 'administrator', '1', null, 'N;');

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
