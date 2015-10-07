-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2015 at 08:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tracuuyte`
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
(1, 'Thể thao', 'Thể thao', 'the-thao', 0, 0, 0),
(2, 'Giải trí', 'Giải trí', 'giai-tri', 0, 0, 0),
(3, 'Kinh tế', 'Kinh tế', 'kinh-te', 0, 0, 0),
(4, 'Xã hội', 'Xã hội', 'xa-hoi', 0, 0, 0),
(5, 'Chính trị', 'Chính trị', 'chinh-tri', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_author_name`, `comment_author_email`, `comment_date`, `comment_subject`, `comment_content`, `comment_type`, `comment_parent`) VALUES
(12, 7, 2, 'moderator1', 'moderator1@thuvien.local', '2015-10-06 15:39:26', 'Nhận xét 1', 'Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 \r\n\r\nNội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 Nội dung nhận xét 1 ', '', 0),
(13, 11, 24, 'create_manager', 'create_manager@m.m', '2015-10-07 18:10:58', 'Nhận xét 1', 'Nội dung ko đầy đủ đề nghị bổ sung thêm', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
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
  FULLTEXT KEY `post_content_foot` (`post_content_foot`),
  FULLTEXT KEY `post_title_2` (`post_title`),
  FULLTEXT KEY `post_content_body_2` (`post_content_body`),
  FULLTEXT KEY `post_title_3` (`post_title`),
  FULLTEXT KEY `post_content_body_3` (`post_content_body`),
  FULLTEXT KEY `post_content_body_4` (`post_content_body`,`post_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_author`, `post_date`, `post_content_head`, `post_content_body`, `post_content_foot`, `post_title`, `post_category`, `post_status`, `post_name`, `post_guild`, `post_approved_user`, `post_approved`) VALUES
(12, 0, NULL, NULL, '<div class="fck_detail width_common">\r\n                        <table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12092315-1000965903259016-2131-9102-9211" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12092315-1000965903259016-2131-9102-9211-1444106053.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Một hộp sọ được xác định thuộc chi Australopithecus. Ảnh: <em>Pascal Goetgheluck/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Theo <em>BBC</em>, cách đây hàng triệu năm, một số loài thuộc tông Người (hominin) sống cùng nhau và chủ yếu ăn thực vật. Theo nhà nghiên cứu John Shea của Đại học Stony Brook, Mỹ, không có bằng chứng nào cho thấy họ săn bắt các loài động vật lớn.</p>\r\n<p class="Normal">\r\n	Khi điều kiện sống thay đổi, hominin bắt đầu di chuyển từ môi trường sống trong rừng cây đến các vùng thảo nguyên khô cằn và phát triển thói quen ăn thịt. Vấn đề là các loài động vật mà họ săn bắt cũng ngày càng khan hiếm cùng với cây cỏ, nên tình trạng thiếu lương thực thường xuyên xảy ra và cạnh tranh khốc liệt khiến một số loài tuyệt chủng.</p>\r\n<p class="Normal">\r\n	Cách đây 30.000 năm, người hiện đại từng sống cùng thời với ba loài hominin khác là người Neanderthal ở châu Âu và Tây Á, người Denisovan ở châu Á và "Hobbit" ở đảo Flores của Indonesia. Các dấu vết khảo cổ cho thấy người Hobbit có thể đã bị xóa sổ trong một vụ phun trào núi lửa lớn&nbsp;<span>cách đây khoảng 18.000 năm</span><span>. Trong khi đó, các dấu vết của người Denisovan rất khiêm tốn nên các nhà khoa học chưa thể kết luận được vì sao họ bị tuyệt chủng.</span></p>\r\n<p class="subtitle">\r\n	Lấn át</p>\r\n<p class="Normal">\r\n	Bằng chứng khảo cổ chỉ ra rằng người Neanderthal đã bị người hiện đại lấn át. Theo Jean-Jacques, chuyên gia Viện Tiến hóa Nhân chủng học Max Planck của Đức, người Neanderthal đã sớm bị "chiếm chỗ" khi người hiện đại từ châu Phi di cư tới châu Âu và điều này không thể là trùng hợp ngẫu nhiên.</p>\r\n<p class="Normal">\r\n	Người Neanderthal tiến hóa trước người hiện đại và đã sống ở châu Âu từ trước khi chúng ta đặt chân tới cách đây 40.000 năm. Khi con người có mặt tại châu Âu, người Neanderthal đã sống ở đây hơn 200.000 năm, đủ lâu để thích nghi với khí hậu lạnh. Họ mặc quần áo ấm, là những thợ săn cừ khôi và có nhiều công cụ bằng đá tinh xảo.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12081482-1000965896592350-1080-8404-7891" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12081482-1000965896592350-1080-8404-7891-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Hộp sọ của người Hobbit (trái) được phát hiện ở Indonesia. Ảnh: <em>Equinox Graphics/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Một số nhà khoa học cho rằng khi châu Âu bắt đầu trải qua giai đoạn biến đổi khí hậu nhanh chóng, người Neanderthal đã gặp nhiều khó khăn để sinh tồn. Chuyên gia John Stewart, Đại học Bournemouth, Anh, nhận định nhiệt độ không phải vẫn đề chính, mà khí hậu lạnh hơn đã thay đổi môi trường sinh sống, trong khi họ không thay đổi lối săn bắt truyền thống để&nbsp;<span>thích nghi&nbsp;</span><span>.</span></p>\r\n<p class="Normal">\r\n	So với người hiện đại, người Neanderthal thích nghi với phương thức săn bắn ở rừng núi hơn. Nhưng biến đổi khí hậu khiến các khu rừng ngày càng thưa hơn và càng trở nên giống các thảo nguyên châu Phi, nơi người hiện đại từng săn bắn. Những khu rừng vốn cung cấp thực phẩm chủ yếu cho người Neanderthal thu hẹp dần và không thể giúp họ duy trì sự sống.</p>\r\n<p class="Normal">\r\n	Người hiện đại săn bắn nhiều loài động vật hơn, bao gồm cả con vật nhỏ như thỏ. Ngược lại, theo phân tích tại các khu vực khảo cổ thuộc Iberia, nơi người Neanderthal sinh sống lâu nhất, rất ít bằng chứng cho thấy họ săn bắt động vật có vú nhỏ. Công cụ của người Neanderthal phù hợp để bắt động vật kích thước lớn, vì vậy ngay cả khi cố gắng, họ cũng khó có thể bắt được những con nhỏ.</p>\r\n<p class="Normal">\r\n	"Khi sống trong môi trường áp lực, người hiện đại dường như có thể làm được nhiều việc hơn. Sự đổi mới nhanh chóng giúp họ khai thác và đạt hiệu quả cao hơn trong môi trường sống, tỷ lệ sinh sản cũng cao hơn", Stewart nói, khẳng định khả năng đổi mới và thích nghi có thể lý giải vì sao họ có thể thế chỗ người Neanderthal&nbsp;<span>nhanh chóng đến vậy</span><span>.</span></p>\r\n<p class="subtitle">\r\n	Tiến hóa xã hội</p>\r\n<p class="Normal">\r\n	Công cụ của người Neanderthal có hiệu quả đáng kể trong một số nhiệm vụ, nhưng khi đến châu Âu, người hiện đại có&nbsp;<span>công cụ </span><span>tốt hơn, gây sát thương nhiều hơn. Ngoài công cụ săn bắn, người hiện đại còn sáng tạo nghệ thuật - đặc điểm vượt trội hơn hẳn bất kỳ loài nào trên Trái Đất. Các nhà khoa học đã tìm thấy nhiều bằng chứng chỉ ra rằng không lâu sau khi rời châu Phi, người hiện đại đã chế tác trang sức, đồ trang trí, hình vẽ tượng trưng các loài vật thần thoại và thậm chí cả nhạc cụ.</span></p>\r\n<p class="Normal">\r\n	"Khi người hiện đại đặt chân đến châu Âu, dân số của họ tăng lên nhanh chóng", Nicholas Conard, nhà nghiên cứu Đại học Tübingen tại Đức, nói. Khi dân số tăng, con người bắt đầu sống trong các đơn vị xã hội phức tạp hơn và có nhiều cách giao tiếp, liên lạc tinh vi hơn.</p>\r\n<p class="Normal">\r\n	Dấu vết về nghệ thuật của người hiện đại ở châu Âu có từ cách đây khoảng 40.000 năm. Một trong số đó là tượng nhân sư bằng gỗ có tên là Löwenmensch, được tìm thấy trong một hang động ở Đức. Các tác phẩm điêu khắc tương tự cùng thời từng được tìm thấy ở một số nơi khác tại châu Âu.</p>\r\n<p class="Normal">\r\n	Theo Conard, điều đó cho thấy chúng ta đã biết chia sẻ thông tin từ các nhóm văn hóa khu vực khác nhau thay vì giữ cho riêng mình và nghệ thuật dường như đóng vai trò quan trọng trong cuộc sống, đưa người đến gần người hơn. Ngược lại, người Neanderthal đi săn, nấu ăn, đi ngủ, duy trì nòi giống, nghỉ ngơi và không cần đến những đồ tạo tác mang tính biểu tượng.</p>\r\n<p class="Normal">\r\n	Quá trình tiến hóa thường được minh họa bằng hình ảnh từ các loài giống khỉ đến người hiện đại với não bộ lớn dần. Nhưng trên thực tế, câu chuyện tiến hóa phức tạp hơn nhiều.</p>\r\n<p class="Normal">\r\n	Người Homo erectus sống trong một thời gian dài và là loài hominin đầu tiên bước ra ngoài châu Phi, thậm chí trước cả người Neanderthal, nhưng lại có bộ não khá nhỏ. Bộ não lớn có thể đóng vai trò quan trọng trong sự thành công của con người, nhưng người Neanderthal cũng có bộ não tương đối lớn so với kích thước cơ thể họ.</p>\r\n<p class="Normal">\r\n	Trong một số trường hợp, hoàn cảnh sống và hành vi có thể tác động đến đặc điểm di truyền. Ví dụ, phần lớn người châu Âu chỉ hấp thu được lactose khi tổ tiên chúng ta bắt đầu ăn nhiều sản phẩm từ sữa. Thay đổi di truyền cũng có thể xảy ra khi nhiều người cùng phải đối mặt với dịch bệnh lớn như Cái chết đen ở thế kỷ 14.</p>\r\n<p class="Normal">\r\n	Tương tự, Hublin cho rằng người hiện đại đã thừa hưởng một số thay đổi di truyền quan trọng. Trong 100.000 tồn tại đầu tiên, người hiện đại có hành vi giống người Neanderthal. Tuy nhiên, bằng chứng di truyền cho thấy ADN của chúng ta có sự thay đổi và khác biệt sau khi tách ra từ tổ tiên chung với người Neanderthal.</p>\r\n<p class="Normal">\r\n	Các nhà di truyền học xác định nhiều điểm trong hệ gene chỉ có ở con người và một số liên quan đến sự phát triển của não bộ. Người Neanderthal có kích thước não lớn tương tự, nhưng sự phát triển của não bộ ở người hiện đại đã làm nên điểm khác biệt.</p>\r\n<p class="Normal">\r\n	Từ ngôn ngữ, văn hóa, đến chiến tranh và tình yêu, các hành vi con người đặc trưng nhất đều mang yếu tố xã hội. Hay nói cách khác, thiên hướng đời sống xã hội của con người đã kéo theo khả năng sử dụng các biểu tượng và sáng tạo nghệ thuật.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="ly-giai-kha-nang-sinh-ton-cua-loai-nguoi-tren-trai-dat-2" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/3-2899-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Tượng gỗ&nbsp;Löwenmensch có niên đại 30.000 năm tuổi. Ảnh: <em>Alamy</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal" style="text-align:right;">\r\n	<strong>Thùy Linh </strong></p>                                                </div>', NULL, 'Lý giải khả năng sinh tồn của loài người trên Trái Đất 1', 0, 'Updating', NULL, NULL, NULL, NULL),
(13, 0, NULL, NULL, '<div class="fck_detail width_common">\r\n                        <table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12092315-1000965903259016-2131-9102-9211" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12092315-1000965903259016-2131-9102-9211-1444106053.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Một hộp sọ được xác định thuộc chi Australopithecus. Ảnh: <em>Pascal Goetgheluck/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Theo <em>BBC</em>, cách đây hàng triệu năm, một số loài thuộc tông Người (hominin) sống cùng nhau và chủ yếu ăn thực vật. Theo nhà nghiên cứu John Shea của Đại học Stony Brook, Mỹ, không có bằng chứng nào cho thấy họ săn bắt các loài động vật lớn.</p>\r\n<p class="Normal">\r\n	Khi điều kiện sống thay đổi, hominin bắt đầu di chuyển từ môi trường sống trong rừng cây đến các vùng thảo nguyên khô cằn và phát triển thói quen ăn thịt. Vấn đề là các loài động vật mà họ săn bắt cũng ngày càng khan hiếm cùng với cây cỏ, nên tình trạng thiếu lương thực thường xuyên xảy ra và cạnh tranh khốc liệt khiến một số loài tuyệt chủng.</p>\r\n<p class="Normal">\r\n	Cách đây 30.000 năm, người hiện đại từng sống cùng thời với ba loài hominin khác là người Neanderthal ở châu Âu và Tây Á, người Denisovan ở châu Á và "Hobbit" ở đảo Flores của Indonesia. Các dấu vết khảo cổ cho thấy người Hobbit có thể đã bị xóa sổ trong một vụ phun trào núi lửa lớn&nbsp;<span>cách đây khoảng 18.000 năm</span><span>. Trong khi đó, các dấu vết của người Denisovan rất khiêm tốn nên các nhà khoa học chưa thể kết luận được vì sao họ bị tuyệt chủng.</span></p>\r\n<p class="subtitle">\r\n	Lấn át</p>\r\n<p class="Normal">\r\n	Bằng chứng khảo cổ chỉ ra rằng người Neanderthal đã bị người hiện đại lấn át. Theo Jean-Jacques, chuyên gia Viện Tiến hóa Nhân chủng học Max Planck của Đức, người Neanderthal đã sớm bị "chiếm chỗ" khi người hiện đại từ châu Phi di cư tới châu Âu và điều này không thể là trùng hợp ngẫu nhiên.</p>\r\n<p class="Normal">\r\n	Người Neanderthal tiến hóa trước người hiện đại và đã sống ở châu Âu từ trước khi chúng ta đặt chân tới cách đây 40.000 năm. Khi con người có mặt tại châu Âu, người Neanderthal đã sống ở đây hơn 200.000 năm, đủ lâu để thích nghi với khí hậu lạnh. Họ mặc quần áo ấm, là những thợ săn cừ khôi và có nhiều công cụ bằng đá tinh xảo.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12081482-1000965896592350-1080-8404-7891" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12081482-1000965896592350-1080-8404-7891-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Hộp sọ của người Hobbit (trái) được phát hiện ở Indonesia. Ảnh: <em>Equinox Graphics/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Một số nhà khoa học cho rằng khi châu Âu bắt đầu trải qua giai đoạn biến đổi khí hậu nhanh chóng, người Neanderthal đã gặp nhiều khó khăn để sinh tồn. Chuyên gia John Stewart, Đại học Bournemouth, Anh, nhận định nhiệt độ không phải vẫn đề chính, mà khí hậu lạnh hơn đã thay đổi môi trường sinh sống, trong khi họ không thay đổi lối săn bắt truyền thống để&nbsp;<span>thích nghi&nbsp;</span><span>.</span></p>\r\n<p class="Normal">\r\n	So với người hiện đại, người Neanderthal thích nghi với phương thức săn bắn ở rừng núi hơn. Nhưng biến đổi khí hậu khiến các khu rừng ngày càng thưa hơn và càng trở nên giống các thảo nguyên châu Phi, nơi người hiện đại từng săn bắn. Những khu rừng vốn cung cấp thực phẩm chủ yếu cho người Neanderthal thu hẹp dần và không thể giúp họ duy trì sự sống.</p>\r\n<p class="Normal">\r\n	Người hiện đại săn bắn nhiều loài động vật hơn, bao gồm cả con vật nhỏ như thỏ. Ngược lại, theo phân tích tại các khu vực khảo cổ thuộc Iberia, nơi người Neanderthal sinh sống lâu nhất, rất ít bằng chứng cho thấy họ săn bắt động vật có vú nhỏ. Công cụ của người Neanderthal phù hợp để bắt động vật kích thước lớn, vì vậy ngay cả khi cố gắng, họ cũng khó có thể bắt được những con nhỏ.</p>\r\n<p class="Normal">\r\n	"Khi sống trong môi trường áp lực, người hiện đại dường như có thể làm được nhiều việc hơn. Sự đổi mới nhanh chóng giúp họ khai thác và đạt hiệu quả cao hơn trong môi trường sống, tỷ lệ sinh sản cũng cao hơn", Stewart nói, khẳng định khả năng đổi mới và thích nghi có thể lý giải vì sao họ có thể thế chỗ người Neanderthal&nbsp;<span>nhanh chóng đến vậy</span><span>.</span></p>\r\n<p class="subtitle">\r\n	Tiến hóa xã hội</p>\r\n<p class="Normal">\r\n	Công cụ của người Neanderthal có hiệu quả đáng kể trong một số nhiệm vụ, nhưng khi đến châu Âu, người hiện đại có&nbsp;<span>công cụ </span><span>tốt hơn, gây sát thương nhiều hơn. Ngoài công cụ săn bắn, người hiện đại còn sáng tạo nghệ thuật - đặc điểm vượt trội hơn hẳn bất kỳ loài nào trên Trái Đất. Các nhà khoa học đã tìm thấy nhiều bằng chứng chỉ ra rằng không lâu sau khi rời châu Phi, người hiện đại đã chế tác trang sức, đồ trang trí, hình vẽ tượng trưng các loài vật thần thoại và thậm chí cả nhạc cụ.</span></p>\r\n<p class="Normal">\r\n	"Khi người hiện đại đặt chân đến châu Âu, dân số của họ tăng lên nhanh chóng", Nicholas Conard, nhà nghiên cứu Đại học Tübingen tại Đức, nói. Khi dân số tăng, con người bắt đầu sống trong các đơn vị xã hội phức tạp hơn và có nhiều cách giao tiếp, liên lạc tinh vi hơn.</p>\r\n<p class="Normal">\r\n	Dấu vết về nghệ thuật của người hiện đại ở châu Âu có từ cách đây khoảng 40.000 năm. Một trong số đó là tượng nhân sư bằng gỗ có tên là Löwenmensch, được tìm thấy trong một hang động ở Đức. Các tác phẩm điêu khắc tương tự cùng thời từng được tìm thấy ở một số nơi khác tại châu Âu.</p>\r\n<p class="Normal">\r\n	Theo Conard, điều đó cho thấy chúng ta đã biết chia sẻ thông tin từ các nhóm văn hóa khu vực khác nhau thay vì giữ cho riêng mình và nghệ thuật dường như đóng vai trò quan trọng trong cuộc sống, đưa người đến gần người hơn. Ngược lại, người Neanderthal đi săn, nấu ăn, đi ngủ, duy trì nòi giống, nghỉ ngơi và không cần đến những đồ tạo tác mang tính biểu tượng.</p>\r\n<p class="Normal">\r\n	Quá trình tiến hóa thường được minh họa bằng hình ảnh từ các loài giống khỉ đến người hiện đại với não bộ lớn dần. Nhưng trên thực tế, câu chuyện tiến hóa phức tạp hơn nhiều.</p>\r\n<p class="Normal">\r\n	Người Homo erectus sống trong một thời gian dài và là loài hominin đầu tiên bước ra ngoài châu Phi, thậm chí trước cả người Neanderthal, nhưng lại có bộ não khá nhỏ. Bộ não lớn có thể đóng vai trò quan trọng trong sự thành công của con người, nhưng người Neanderthal cũng có bộ não tương đối lớn so với kích thước cơ thể họ.</p>\r\n<p class="Normal">\r\n	Trong một số trường hợp, hoàn cảnh sống và hành vi có thể tác động đến đặc điểm di truyền. Ví dụ, phần lớn người châu Âu chỉ hấp thu được lactose khi tổ tiên chúng ta bắt đầu ăn nhiều sản phẩm từ sữa. Thay đổi di truyền cũng có thể xảy ra khi nhiều người cùng phải đối mặt với dịch bệnh lớn như Cái chết đen ở thế kỷ 14.</p>\r\n<p class="Normal">\r\n	Tương tự, Hublin cho rằng người hiện đại đã thừa hưởng một số thay đổi di truyền quan trọng. Trong 100.000 tồn tại đầu tiên, người hiện đại có hành vi giống người Neanderthal. Tuy nhiên, bằng chứng di truyền cho thấy ADN của chúng ta có sự thay đổi và khác biệt sau khi tách ra từ tổ tiên chung với người Neanderthal.</p>\r\n<p class="Normal">\r\n	Các nhà di truyền học xác định nhiều điểm trong hệ gene chỉ có ở con người và một số liên quan đến sự phát triển của não bộ. Người Neanderthal có kích thước não lớn tương tự, nhưng sự phát triển của não bộ ở người hiện đại đã làm nên điểm khác biệt.</p>\r\n<p class="Normal">\r\n	Từ ngôn ngữ, văn hóa, đến chiến tranh và tình yêu, các hành vi con người đặc trưng nhất đều mang yếu tố xã hội. Hay nói cách khác, thiên hướng đời sống xã hội của con người đã kéo theo khả năng sử dụng các biểu tượng và sáng tạo nghệ thuật.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="ly-giai-kha-nang-sinh-ton-cua-loai-nguoi-tren-trai-dat-2" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/3-2899-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Tượng gỗ&nbsp;Löwenmensch có niên đại 30.000 năm tuổi. Ảnh: <em>Alamy</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal" style="text-align:right;">\r\n	<strong>Thùy Linh </strong></p>                                                </div>', NULL, 'Lý giải khả năng sinh tồn của loài người trên Trái Đất 2', 0, 'Updating', NULL, NULL, NULL, NULL),
(14, 0, NULL, NULL, '<div class="fck_detail width_common">\r\n                        <table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12092315-1000965903259016-2131-9102-9211" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12092315-1000965903259016-2131-9102-9211-1444106053.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Một hộp sọ được xác định thuộc chi Australopithecus. Ảnh: <em>Pascal Goetgheluck/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Theo <em>BBC</em>, cách đây hàng triệu năm, một số loài thuộc tông Người (hominin) sống cùng nhau và chủ yếu ăn thực vật. Theo nhà nghiên cứu John Shea của Đại học Stony Brook, Mỹ, không có bằng chứng nào cho thấy họ săn bắt các loài động vật lớn.</p>\r\n<p class="Normal">\r\n	Khi điều kiện sống thay đổi, hominin bắt đầu di chuyển từ môi trường sống trong rừng cây đến các vùng thảo nguyên khô cằn và phát triển thói quen ăn thịt. Vấn đề là các loài động vật mà họ săn bắt cũng ngày càng khan hiếm cùng với cây cỏ, nên tình trạng thiếu lương thực thường xuyên xảy ra và cạnh tranh khốc liệt khiến một số loài tuyệt chủng.</p>\r\n<p class="Normal">\r\n	Cách đây 30.000 năm, người hiện đại từng sống cùng thời với ba loài hominin khác là người Neanderthal ở châu Âu và Tây Á, người Denisovan ở châu Á và "Hobbit" ở đảo Flores của Indonesia. Các dấu vết khảo cổ cho thấy người Hobbit có thể đã bị xóa sổ trong một vụ phun trào núi lửa lớn&nbsp;<span>cách đây khoảng 18.000 năm</span><span>. Trong khi đó, các dấu vết của người Denisovan rất khiêm tốn nên các nhà khoa học chưa thể kết luận được vì sao họ bị tuyệt chủng.</span></p>\r\n<p class="subtitle">\r\n	Lấn át</p>\r\n<p class="Normal">\r\n	Bằng chứng khảo cổ chỉ ra rằng người Neanderthal đã bị người hiện đại lấn át. Theo Jean-Jacques, chuyên gia Viện Tiến hóa Nhân chủng học Max Planck của Đức, người Neanderthal đã sớm bị "chiếm chỗ" khi người hiện đại từ châu Phi di cư tới châu Âu và điều này không thể là trùng hợp ngẫu nhiên.</p>\r\n<p class="Normal">\r\n	Người Neanderthal tiến hóa trước người hiện đại và đã sống ở châu Âu từ trước khi chúng ta đặt chân tới cách đây 40.000 năm. Khi con người có mặt tại châu Âu, người Neanderthal đã sống ở đây hơn 200.000 năm, đủ lâu để thích nghi với khí hậu lạnh. Họ mặc quần áo ấm, là những thợ săn cừ khôi và có nhiều công cụ bằng đá tinh xảo.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="12081482-1000965896592350-1080-8404-7891" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/12081482-1000965896592350-1080-8404-7891-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Hộp sọ của người Hobbit (trái) được phát hiện ở Indonesia. Ảnh: <em>Equinox Graphics/SPL</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal">\r\n	Một số nhà khoa học cho rằng khi châu Âu bắt đầu trải qua giai đoạn biến đổi khí hậu nhanh chóng, người Neanderthal đã gặp nhiều khó khăn để sinh tồn. Chuyên gia John Stewart, Đại học Bournemouth, Anh, nhận định nhiệt độ không phải vẫn đề chính, mà khí hậu lạnh hơn đã thay đổi môi trường sinh sống, trong khi họ không thay đổi lối săn bắt truyền thống để&nbsp;<span>thích nghi&nbsp;</span><span>.</span></p>\r\n<p class="Normal">\r\n	So với người hiện đại, người Neanderthal thích nghi với phương thức săn bắn ở rừng núi hơn. Nhưng biến đổi khí hậu khiến các khu rừng ngày càng thưa hơn và càng trở nên giống các thảo nguyên châu Phi, nơi người hiện đại từng săn bắn. Những khu rừng vốn cung cấp thực phẩm chủ yếu cho người Neanderthal thu hẹp dần và không thể giúp họ duy trì sự sống.</p>\r\n<p class="Normal">\r\n	Người hiện đại săn bắn nhiều loài động vật hơn, bao gồm cả con vật nhỏ như thỏ. Ngược lại, theo phân tích tại các khu vực khảo cổ thuộc Iberia, nơi người Neanderthal sinh sống lâu nhất, rất ít bằng chứng cho thấy họ săn bắt động vật có vú nhỏ. Công cụ của người Neanderthal phù hợp để bắt động vật kích thước lớn, vì vậy ngay cả khi cố gắng, họ cũng khó có thể bắt được những con nhỏ.</p>\r\n<p class="Normal">\r\n	"Khi sống trong môi trường áp lực, người hiện đại dường như có thể làm được nhiều việc hơn. Sự đổi mới nhanh chóng giúp họ khai thác và đạt hiệu quả cao hơn trong môi trường sống, tỷ lệ sinh sản cũng cao hơn", Stewart nói, khẳng định khả năng đổi mới và thích nghi có thể lý giải vì sao họ có thể thế chỗ người Neanderthal&nbsp;<span>nhanh chóng đến vậy</span><span>.</span></p>\r\n<p class="subtitle">\r\n	Tiến hóa xã hội</p>\r\n<p class="Normal">\r\n	Công cụ của người Neanderthal có hiệu quả đáng kể trong một số nhiệm vụ, nhưng khi đến châu Âu, người hiện đại có&nbsp;<span>công cụ </span><span>tốt hơn, gây sát thương nhiều hơn. Ngoài công cụ săn bắn, người hiện đại còn sáng tạo nghệ thuật - đặc điểm vượt trội hơn hẳn bất kỳ loài nào trên Trái Đất. Các nhà khoa học đã tìm thấy nhiều bằng chứng chỉ ra rằng không lâu sau khi rời châu Phi, người hiện đại đã chế tác trang sức, đồ trang trí, hình vẽ tượng trưng các loài vật thần thoại và thậm chí cả nhạc cụ.</span></p>\r\n<p class="Normal">\r\n	"Khi người hiện đại đặt chân đến châu Âu, dân số của họ tăng lên nhanh chóng", Nicholas Conard, nhà nghiên cứu Đại học Tübingen tại Đức, nói. Khi dân số tăng, con người bắt đầu sống trong các đơn vị xã hội phức tạp hơn và có nhiều cách giao tiếp, liên lạc tinh vi hơn.</p>\r\n<p class="Normal">\r\n	Dấu vết về nghệ thuật của người hiện đại ở châu Âu có từ cách đây khoảng 40.000 năm. Một trong số đó là tượng nhân sư bằng gỗ có tên là Löwenmensch, được tìm thấy trong một hang động ở Đức. Các tác phẩm điêu khắc tương tự cùng thời từng được tìm thấy ở một số nơi khác tại châu Âu.</p>\r\n<p class="Normal">\r\n	Theo Conard, điều đó cho thấy chúng ta đã biết chia sẻ thông tin từ các nhóm văn hóa khu vực khác nhau thay vì giữ cho riêng mình và nghệ thuật dường như đóng vai trò quan trọng trong cuộc sống, đưa người đến gần người hơn. Ngược lại, người Neanderthal đi săn, nấu ăn, đi ngủ, duy trì nòi giống, nghỉ ngơi và không cần đến những đồ tạo tác mang tính biểu tượng.</p>\r\n<p class="Normal">\r\n	Quá trình tiến hóa thường được minh họa bằng hình ảnh từ các loài giống khỉ đến người hiện đại với não bộ lớn dần. Nhưng trên thực tế, câu chuyện tiến hóa phức tạp hơn nhiều.</p>\r\n<p class="Normal">\r\n	Người Homo erectus sống trong một thời gian dài và là loài hominin đầu tiên bước ra ngoài châu Phi, thậm chí trước cả người Neanderthal, nhưng lại có bộ não khá nhỏ. Bộ não lớn có thể đóng vai trò quan trọng trong sự thành công của con người, nhưng người Neanderthal cũng có bộ não tương đối lớn so với kích thước cơ thể họ.</p>\r\n<p class="Normal">\r\n	Trong một số trường hợp, hoàn cảnh sống và hành vi có thể tác động đến đặc điểm di truyền. Ví dụ, phần lớn người châu Âu chỉ hấp thu được lactose khi tổ tiên chúng ta bắt đầu ăn nhiều sản phẩm từ sữa. Thay đổi di truyền cũng có thể xảy ra khi nhiều người cùng phải đối mặt với dịch bệnh lớn như Cái chết đen ở thế kỷ 14.</p>\r\n<p class="Normal">\r\n	Tương tự, Hublin cho rằng người hiện đại đã thừa hưởng một số thay đổi di truyền quan trọng. Trong 100.000 tồn tại đầu tiên, người hiện đại có hành vi giống người Neanderthal. Tuy nhiên, bằng chứng di truyền cho thấy ADN của chúng ta có sự thay đổi và khác biệt sau khi tách ra từ tổ tiên chung với người Neanderthal.</p>\r\n<p class="Normal">\r\n	Các nhà di truyền học xác định nhiều điểm trong hệ gene chỉ có ở con người và một số liên quan đến sự phát triển của não bộ. Người Neanderthal có kích thước não lớn tương tự, nhưng sự phát triển của não bộ ở người hiện đại đã làm nên điểm khác biệt.</p>\r\n<p class="Normal">\r\n	Từ ngôn ngữ, văn hóa, đến chiến tranh và tình yêu, các hành vi con người đặc trưng nhất đều mang yếu tố xã hội. Hay nói cách khác, thiên hướng đời sống xã hội của con người đã kéo theo khả năng sử dụng các biểu tượng và sáng tạo nghệ thuật.</p>\r\n<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>\r\n				<img alt="ly-giai-kha-nang-sinh-ton-cua-loai-nguoi-tren-trai-dat-2" data-natural-width="500" src="http://m.f29.img.vnecdn.net/2015/10/06/3-2899-1444106054.jpg" data-width="500" data-pwidth="470.40625" style="width: 100%;"></td>\r\n		</tr><tr><td>\r\n				<p class="Image">\r\n					Tượng gỗ&nbsp;Löwenmensch có niên đại 30.000 năm tuổi. Ảnh: <em>Alamy</em></p>\r\n			</td>\r\n		</tr></tbody></table><p class="Normal" style="text-align:right;">\r\n	<strong>Thùy Linh </strong></p>                                                </div>', NULL, 'Lý giải khả năng sinh tồn của loài người trên Trái Đất 3', 0, 'Updating', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_post_tag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_post_tag`
--

INSERT INTO `tbl_post_tag` (`ID`, `post_id`, `tag_id`) VALUES
(8, 7, 3),
(9, 7, 4),
(15, 10, 4),
(16, 11, 4);

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
(16, 'Nguyễn', 'Quyết', 1, '2015-09-30'),
(17, 'Mod', 'Kinh tế', 0, '1989-09-30'),
(18, 'Mod', 'Thể thao', 0, '1981-06-25'),
(19, 'Publisher', 'Kinh tế 1', 0, '1999-10-14'),
(20, 'Publisher', 'Kinh tế 2', 1, '1994-10-18'),
(21, 'Author', 'Kinh tế 1', 1, '1976-10-26'),
(22, 'Author', 'Kinh tế 2', 1, '2015-10-13'),
(23, 'Author', 'Thể thao 1', 0, '2015-10-17'),
(24, 'DEMO', 'DEMO', 0, '2015-10-07'),
(25, '', '', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  `tag_description` text,
  `tag_slug` varchar(255) NOT NULL,
  `tag_count` int(11) DEFAULT '0',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`tag_id`, `tag_name`, `tag_description`, `tag_slug`, `tag_count`) VALUES
(1, 'Valentine', 'Ngày lễ tình nhân 14-2 hàng năm', 'valentine', 0),
(2, 'Family', 'Family', 'family', 0),
(3, 'Friend', 'Friend', 'friend', 0),
(4, 'WorldCup', 'WorldCup', 'worldcup', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `phone`, `email`, `registered`, `lastvisited`, `activekey`, `category_id`, `role`, `status`) VALUES
(1, 'administrator', 'e10adc3949ba59abbe56e057f20f883e', '', 'administrator@thuvien.local', '2014-01-09', '2015-10-07 21:55:51', '', 0, 'administrator', 1),
(8, 'member1', 'd41d8cd98f00b204e9800998ecf8427e', '123456789', 'member1@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 0, 'member', 0),
(9, 'member2', 'd41d8cd98f00b204e9800998ecf8427e', '1234567891', 'member2@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 0, 'member', 0),
(10, 'member3', 'e10adc3949ba59abbe56e057f20f883e', '', 'member3@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 0, 'member', 1),
(11, 'member4', 'e10adc3949ba59abbe56e057f20f883e', '', 'member4@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 0, 'member', 1),
(12, 'member5', 'e10adc3949ba59abbe56e057f20f883e', '', 'member5@thuvien.local', '2014-01-09', '2015-09-27 22:30:48', '', 0, 'member', 1),
(16, 'quyet', 'd41d8cd98f00b204e9800998ecf8427e', '', 'quyet@magingam.com', '2015-09-28', '2015-09-28 16:56:19', '', 0, 'member', 0),
(17, 'mod_kinh_te', 'e10adc3949ba59abbe56e057f20f883e', '', 'mod_kinh_te@tracuu.com', '2015-10-06', '2015-10-07 20:27:28', '', 3, 'moderator', 1),
(18, 'mod_the_thao', 'e10adc3949ba59abbe56e057f20f883e', '', 'mod_the_thao@tracuu.com', '2015-10-06', NULL, '', 1, 'moderator', 1),
(19, 'publisher_kinhte1', 'e10adc3949ba59abbe56e057f20f883e', '', 'publisher_kinhte1@tracuu.com', '2015-10-06', NULL, NULL, 3, 'publisher', 1),
(20, 'publisher_kinhte2', 'e10adc3949ba59abbe56e057f20f883e', '', 'publisher_kinhte2@tracuu.com', '2015-10-06', '2015-10-06 21:32:57', NULL, 3, 'publisher', 1),
(21, 'author_kinhte1', 'e10adc3949ba59abbe56e057f20f883e', '', 'author_kinhte1@tracuu.com', '2015-10-06', '2015-10-07 22:07:48', NULL, 3, 'author', 1),
(22, 'author_kinhte2', 'e10adc3949ba59abbe56e057f20f883e', '', 'author_kinhte2@tracuu.com', '2015-10-06', NULL, '', 3, 'author', 1),
(23, 'author_thethao1', 'e10adc3949ba59abbe56e057f20f883e', '123125', 'author_thethao1@tracuu.com', '2015-10-06', '2015-10-07 23:07:47', '', 1, 'author', 1),
(24, 'create_manager', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'create_manager@m.m', '2015-10-07', '2015-10-07 23:07:18', '', 1, 'moderator', 1),
(25, 'adddddd', 'e10adc3949ba59abbe56e057f20f883e', '1231254', 'asdd@asda.m', '2015-10-07', '2015-10-07 22:08:44', '', 1, 'publisher', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user_auth_assignment`
--

INSERT INTO `tbl_user_auth_assignment` (`id`, `itemname`, `userid`, `bizrule`, `data`) VALUES
(1, 'member', '16', NULL, 'N;'),
(2, 'administrator', '1', NULL, 'N;'),
(3, 'moderator', '2', NULL, 'N;'),
(4, 'moderator', '17', NULL, 'N;'),
(5, 'publisher', '20', NULL, 'N;'),
(6, 'author', '21', NULL, 'N;'),
(7, 'moderator', '24', NULL, 'N;'),
(8, 'publisher', '25', NULL, 'N;'),
(9, 'author', '23', NULL, 'N;');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
