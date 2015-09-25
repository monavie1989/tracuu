-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2015 at 08:14 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

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
  `post_status` varchar(20) DEFAULT 'Pendding' COMMENT 'Updating, Pedding, Publish, Private',
  `post_name` varchar(255) DEFAULT NULL,
  `post_guild` varchar(255) DEFAULT NULL,
  `post_approved_user` int(11) DEFAULT NULL,
  `post_approved` date DEFAULT NULL,
  PRIMARY KEY (`post_ID`),
  FULLTEXT KEY `post_title` (`post_title`),
  FULLTEXT KEY `post_content_head` (`post_content_head`),
  FULLTEXT KEY `post_content_body` (`post_content_body`),
  FULLTEXT KEY `post_content_foot` (`post_content_foot`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_ID`, `post_author`, `post_date`, `post_content_head`, `post_content_body`, `post_content_foot`, `post_title`, `post_status`, `post_name`, `post_guild`, `post_approved_user`, `post_approved`) VALUES
(1, 10, '2015-09-24 14:13:00', 'Một vấn đề mà chúng ta thường gặp phải khi dữ liệu website nhiều đó là vấn đề tìm kiếm với kiểu tìm kiếm thông thường “LIKE”. Khi sử dụng phương pháp này chắc chắn một điều rằng tốc độ xử lý sẽ chậm và sẽ nhận nhiều kết quả không chính xác(nhiễu). Do đó lúc này chúng ta cần sử dụng đến kỹ thuật full text search (tìm kiếm toàn văn). Vậy full text search là gì? Cách ứng dụng nó vào website như thế nào? Tất cả sẽ được làm rõ trong bài viết này.', '1. Full text search là gì?\r\n\r\n\r\nHiểu đơn giản nó là một kỹ thuật tìm kiếm giúp chúng ta có được thông tin nhanh chóng và chính xác hơn.\r\n\r\nKỹ thuật này đã được mysql hỗ trợ từ phiên bản 3.23.23 và cho đến những phiên sau này nó đã được hoàn thiện hơn với tìm kiếm boolean. Hầu hết nó chỉ có trên Storage Engine MyISAM nhưng gần đây, nó cũng được hỗ trợ trên InnoDB (>= 5.6) và nó chỉ được tạo trên các loại dữ liệu như: CHAR, VARCHAR và TEXT.\r\n\r\nVề cách sử dụng thì rất đơn giản. Chỉ với cú pháp:\r\n\r\n\r\nMATCH (col1,col2,...) AGAINST (expr [search_modifier])\r\n\r\n\r\nVới:\r\n\r\n- col1, col2, … là tên các cột sẽ được dò tìm.\r\n\r\n- expr: chuỗi tìm kiếm.\r\n\r\n- search_modifier: loại tìm kiếm. Nó nhận các giá trị sau:\r\n\r\n{ IN NATURAL LANGUAGE MODE | IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION | IN BOOLEAN MODE | WITH QUERY EXPANSION}\r\n\r\nLưu ý là trước khi sử dụng cú pháp trên các bạn cần định nghĩa một full text index trước nha. Các bạn có thể định nghĩa thông qua các cú pháp CREATE TABLE, ALTER TABLE hoặc CREATE INDEX.\r\n\r\nĐể có nhiều thông tin chi tiết hơn thì các bạn có thể lên hỏi bác google hoặc vào trang chủ của mysql để tìm hiểu nhé. Trong khuân khổ bài viết này thì mình không đi sâu vào nó mà đi vào vấn đề chính là sử dụng nó như thế nào trong wordpress.\r\n\r\n2. Ứng dụng\r\n\r\n\r\nĐể sử dụng full text search thì bắt buộc chúng ta phải custom 1 câu truy vấn tới CSDL. Vậy cách tốt nhất là sử dụng đối tượng global $wpdb. Nếu chưa rõ đối tượng này các bạn có thể xem lại bài viết về nó tại đây.\r\n\r\nTrước tiên cần định nghĩa 1 full text index với cú pháp sql như sau:\r\n\r\n\r\nALTER TABLE `wp_posts` ADD FULLTEXT `FullTextIndex` (`post_excerpt`)\r\n\r\n\r\nFullTextIndex ở đây là 1 key name, các bạn đặt với tên tùy ý, miễn không trùng là được. Còn post_excerpt là tên cột được đánh chỉ mục, các bạn có thể sử dụng cột khác hoặc nhiều cột, miễn tuân theo quy định về định dạng kiểu dữ liệu cho phép là được.\r\n\r\nTiếp mình sẽ sử dụng 1 template page để thực hiện từ việc hiển thị form đến xử lý, tất cả gói gọn trong 1 file duy nhất.\r\n\r\nCác bạn tạo 1 page và thêm template page này vào. Các bạn nhớ ID của page vừa tạo nhé, nó sẽ được sử dụng ở bên dưới đó.\r\n\r\n\r\n\r\n<?php\r\n\r\n/*\r\n\r\nTemplate Name: Full text search\r\n\r\n*/\r\n\r\n?>\r\n\r\n\r\n\r\nTiếp theo các bạn thêm các hàm sau vào template page vừa tạo (đây là các hàm hỗ trợ việc xử lý tìm kiếm):\r\n\r\n\r\n\r\n$stop_words = array(\r\n\r\n"a''s", "able", "about", "above", "according",\r\n\r\n"accordingly", "across", "actually", "after", "afterwards",\r\n\r\n"again", "against", "ain''t", "all", "allow",\r\n\r\n"allows", "almost", "alone", "along", "already",\r\n\r\n"also", "although", "always", "am", "among",\r\n\r\n"amongst", "an", "and", "another", "any",\r\n\r\n"anybody", "anyhow", "anyone", "anything", "anyway",\r\n\r\n"anyways", "anywhere", "apart", "appear", "appreciate",\r\n\r\n"appropriate", "are", "aren''t", "around", "as",\r\n\r\n"aside", "ask", "asking", "associated", "at",\r\n\r\n"available", "away", "awfully", "be", "became",\r\n\r\n"because", "become", "becomes", "becoming", "been",\r\n\r\n"before", "beforehand", "behind", "being", "believe",\r\n\r\n"below", "beside", "besides", "best", "better",\r\n\r\n"between", "beyond", "both", "brief", "but",\r\n\r\n"by", "c''mon", "c''s", "came", "can",\r\n\r\n"can''t", "cannot", "cant", "cause", "causes",\r\n\r\n"certain", "certainly", "changes", "clearly", "co",\r\n\r\n"com", "come", "comes", "concerning", "consequently",\r\n\r\n"consider", "considering", "contain", "containing", "contains",\r\n\r\n"corresponding", "could", "couldn''t", "course", "currently",\r\n\r\n"definitely", "described", "despite", "did", "didn''t",\r\n\r\n"different", "do", "does", "doesn''t", "doing",\r\n\r\n"don''t", "done", "down", "downwards", "during",\r\n\r\n"each", "edu", "eg", "eight", "either",\r\n\r\n"else", "elsewhere", "enough", "entirely", "especially",\r\n\r\n"et", "etc", "even", "ever", "every",\r\n\r\n"everybody", "everyone", "everything", "everywhere", "ex",\r\n\r\n"exactly", "example", "except", "far", "few",\r\n\r\n"fifth", "first", "five", "followed", "following",\r\n\r\n"follows", "for", "former", "formerly", "forth",\r\n\r\n"four", "from", "further", "furthermore", "get",\r\n\r\n"gets", "getting", "given", "gives", "go",\r\n\r\n"goes", "going", "gone", "got", "gotten",\r\n\r\n"greetings", "had", "hadn''t", "happens", "hardly",\r\n\r\n"has", "hasn''t", "have", "haven''t", "having",\r\n\r\n"he", "he''s", "hello", "help", "hence",\r\n\r\n"her", "here", "here''s", "hereafter", "hereby",\r\n\r\n"herein", "hereupon", "hers", "herself", "hi",\r\n\r\n"him", "himself", "his", "hither", "hopefully",\r\n\r\n"how", "howbeit", "however", "i''d", "i''ll",\r\n\r\n"i''m", "i''ve", "ie", "if", "ignored",\r\n\r\n"immediate", "in", "inasmuch", "inc", "indeed",\r\n\r\n"indicate", "indicated", "indicates", "inner", "insofar",\r\n\r\n"instead", "into", "inward", "is", "isn''t",\r\n\r\n"it", "it''d", "it''ll", "it''s", "its",\r\n\r\n"itself", "just", "keep", "keeps", "kept",\r\n\r\n"know", "known", "knows", "last", "lately",\r\n\r\n"later", "latter", "latterly", "least", "less",\r\n\r\n"lest", "let", "let''s", "like", "liked",\r\n\r\n"likely", "little", "look", "looking", "looks",\r\n\r\n"ltd", "mainly", "many", "may", "maybe",\r\n\r\n"me", "mean", "meanwhile", "merely", "might",\r\n\r\n"more", "moreover", "most", "mostly", "much",\r\n\r\n"must", "my", "myself", "name", "namely",\r\n\r\n"nd", "near", "nearly", "necessary", "need",\r\n\r\n"needs", "neither", "never", "nevertheless", "new",\r\n\r\n"next", "nine", "no", "nobody", "non",\r\n\r\n"none", "noone", "nor", "normally", "not",\r\n\r\n"nothing", "novel", "now", "nowhere", "obviously",\r\n\r\n"of", "off", "often", "oh", "ok",\r\n\r\n"okay", "old", "on", "once", "one",\r\n\r\n"ones", "only", "onto", "or", "other",\r\n\r\n"others", "otherwise", "ought", "our", "ours",\r\n\r\n"ourselves", "out", "outside", "over", "overall",\r\n\r\n"own", "particular", "particularly", "per", "perhaps",\r\n\r\n"placed", "please", "plus", "possible", "presumably",\r\n\r\n"probably", "provides", "que", "quite", "qv",\r\n\r\n"rather", "rd", "re", "really", "reasonably",\r\n\r\n"regarding", "regardless", "regards", "relatively", "respectively",\r\n\r\n"right", "said", "same", "saw", "say",\r\n\r\n"saying", "says", "second", "secondly", "see",\r\n\r\n"seeing", "seem", "seemed", "seeming", "seems",\r\n\r\n"seen", "self", "selves", "sensible", "sent",\r\n\r\n"serious", "seriously", "seven", "several", "shall",\r\n\r\n"she", "should", "shouldn''t", "since", "six",\r\n\r\n"so", "some", "somebody", "somehow", "someone",\r\n\r\n"something", "sometime", "sometimes", "somewhat", "somewhere",\r\n\r\n"soon", "sorry", "specified", "specify", "specifying",\r\n\r\n"still", "sub", "such", "sup", "sure",\r\n\r\n"t''s", "take", "taken", "tell", "tends",\r\n\r\n"th", "than", "thank", "thanks", "thanx",\r\n\r\n"that", "that''s", "thats", "the", "their",\r\n\r\n"theirs", "them", "themselves", "then", "thence",\r\n\r\n"there", "there''s", "thereafter", "thereby", "therefore",\r\n\r\n"therein", "theres", "thereupon", "these", "they",\r\n\r\n"they''d", "they''ll", "they''re", "they''ve", "think",\r\n\r\n"third", "this", "thorough", "thoroughly", "those",\r\n\r\n"though", "three", "through", "throughout", "thru",\r\n\r\n"thus", "to", "together", "too", "took",\r\n\r\n"toward", "towards", "tried", "tries", "truly",\r\n\r\n"try", "trying", "twice", "two", "un",\r\n\r\n"under", "unfortunately", "unless", "unlikely", "until",\r\n\r\n"unto", "up", "upon", "us", "use",\r\n\r\n"used", "useful", "uses", "using", "usually",\r\n\r\n"value", "various", "very", "via", "viz",\r\n\r\n"vs", "want", "wants", "was", "wasn''t",\r\n\r\n"way", "we", "we''d", "we''ll", "we''re",\r\n\r\n"we''ve", "welcome", "well", "went", "were",\r\n\r\n"weren''t", "what", "what''s", "whatever", "when",\r\n\r\n"whence", "whenever", "where", "where''s", "whereafter",\r\n\r\n"whereas", "whereby", "wherein", "whereupon", "wherever",\r\n\r\n"whether", "which", "while", "whither", "who",\r\n\r\n"who''s", "whoever", "whole", "whom", "whose",\r\n\r\n"why", "will", "willing", "wish", "with",\r\n\r\n"within", "without", "won''t", "wonder", "would",\r\n\r\n"wouldn''t", "yes", "yet", "you", "you''d",\r\n\r\n"you''ll", "you''re", "you''ve", "your", "yours",\r\n\r\n"yourself", "yourselves", "zero"\r\n\r\n); //mảng chứa các stop word\r\n\r\n\r\n\r\nfunction dvd_is_stop_query($q){ //hàm kiểm tra trong từ khóa tìm kiếm có stop word hay không?\r\n\r\nglobal $stop_words;\r\n\r\n$ar = explode('' '', strtolower($q)); //cắt chuỗi tìm kiếm thành các từ và kiểm tra\r\n\r\nforeach($ar as $w){\r\n\r\n$w = trim($w);\r\n\r\nif (empty($w))\r\n\r\ncontinue;\r\n\r\nif (!in_array($w, $stop_words))\r\n\r\nreturn false;\r\n\r\n}\r\n\r\nreturn true;\r\n\r\n}\r\n\r\n\r\n\r\nDo full text search không chập nhận các từ đặc biệt(stop words) nên chúng ta cần kiểm tra tính hợp lệ của từ khóa tìm kiếm thông qua hàm dvd_is_stop_query().\r\n\r\nTiếp đến là hàm phân trang và cắt chuỗi, các bạn tham khảo hàm ở bên dưới của mình hoặc có thể tự viết lại.\r\n\r\n\r\n\r\nfunction dvd_paging($pag, $total, $current_url) { //hàm phần trang\r\n\r\n$output = "";\r\n\r\nif ($total >= 2)\r\n\r\n$output .= "<li><a href=''" . $current_url . "'' >Đầu</a></li>";\r\n\r\nif ($pag >= 2)\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". ($pag - 1) . "'' ><<</a></li>";\r\n\r\n\r\n\r\nif ($pag - 4 >= 1) {\r\n\r\nfor ($i = $pag - 4; $i <= $pag; $i++) {\r\n\r\nif ($pag == $i)\r\n\r\n$output .= "<li class=''active''><a> $i </a></li>";\r\n\r\nelse\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". $i . "'' >$i </a></li>";\r\n\r\n}\r\n\r\n}\r\n\r\nelse {\r\n\r\nfor ($i = 1; $i <= $pag; $i++) {\r\n\r\nif ($pag == $i)\r\n\r\n$output .= "<li class=''active''><a> $i </a></li>";\r\n\r\nelse\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". $i . "'' >$i </a></li>";\r\n\r\n}\r\n\r\n}\r\n\r\nif ($pag + 4 <= $total) {\r\n\r\nfor ($i = $pag + 1; $i <= $pag + 4; $i++) {\r\n\r\nif ($pag == $i)\r\n\r\n$output .= "<li class=''active''><a> $i </a></li>";\r\n\r\nelse\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". $i . "'' >$i </a></li>";\r\n\r\n}\r\n\r\n}else {\r\n\r\nfor ($i = $pag + 1; $i <= $total; $i++) {\r\n\r\nif ($pag == $i)\r\n\r\n$output .= "<li class=''active''><a> $i </a></li>";\r\n\r\nelse\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". $i . "'' >$i </a></li>";\r\n\r\n}\r\n\r\n}\r\n\r\nif ($pag < $total)\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". ($pag + 1) . "''>>></a></li>";\r\n\r\nif ($total >= 2)\r\n\r\n$output .= "<li><a href=''" . $current_url. "&pag=". $total . "'' >Cuối</a></li>";\r\n\r\necho "<ul class=''pagination''>" . $output . ''</ul>'';\r\n\r\n}\r\n\r\nfunction dvd_substr( $str, $length, $minword = 3 ) { //hàm cắt chuỗi\r\n\r\n$sub = '''';\r\n\r\n$len = 0;\r\n\r\nforeach ( explode( '' '', $str ) as $word ) {\r\n\r\n$part = (($sub != '''') ? '' '' : '''') . $word;\r\n\r\n$sub .= $part;\r\n\r\n$len += strlen( $part );\r\n\r\nif ( strlen( $word ) > $minword && strlen( $sub ) >= $length ) {\r\n\r\nbreak;\r\n\r\n}\r\n\r\n}\r\n\r\nreturn $sub . (($len < strlen( $str )) ? ''...'' : '''');\r\n\r\n}\r\n\r\n\r\n\r\nThêm 1 hàm cuối cùng nữa đó là hàm dùng để hiển thị form tìm kiếm theo post_type và taxonomies. Hàm này giúp các bạn tùy biến dễ dàng và nhanh chóng hơn khi muốn thay đổi search form.\r\n\r\n\r\n\r\nfunction dvd_get_search_form_by($post_type, $taxonomies){ //hàm hiển thị form tìm kiếm theo post type và tax\r\n\r\n$terms = get_terms($taxonomies);// lấy term theo taxonomies\r\n\r\n?>\r\n\r\n<form class="navbar-form" role="search" action="<?php echo get_page_link(58); //thay 58 thành id page vừa tạo ở trên của các bạn ?>" method="get" style="margin-bottom:20px; padding:0;">\r\n\r\n<div class="input-group">\r\n\r\n<div class="input-group-btn">\r\n\r\n<select class="form-control" name="tid" style="border-right:none; background: #E3E3E3; ">\r\n\r\n<option value="0">Tất cả</option>\r\n\r\n<?php\r\n\r\nforeach($terms as $term){ //đổ term ra select box\r\n\r\n?>\r\n\r\n<option <?php if(isset($_GET[''tid'']) && $_GET[''tid''] == $term->term_id) echo "selected"; ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>\r\n\r\n<?php\r\n\r\n}\r\n\r\n?>\r\n\r\n</select>\r\n\r\n</div>\r\n\r\n<input autocomplete="off" type="text" class="form-control" placeholder="Nhập từ khóa cần tìm ..." name="q" id="q" value="<?php if(isset($_GET[''q''])) echo $_GET[''q'']; ?>" >\r\n\r\n<input type="hidden" name="pt" value="<?php echo $post_type; ?>">\r\n\r\n<div class="input-group-btn">\r\n\r\n<button style="background:#E3E3E3;" title="Tìm" class="btn btn-default" id="ftsbtn" type="submit"><i class="glyphicon glyphicon-search"></i></button>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n</form>\r\n\r\n<script type="text/javascript">\r\n\r\njQuery(document).ready(function($){\r\n\r\n$(''#ftsbtn'').click(function(){ //kiểm tra từ khóa trống\r\n\r\nif($(''#q'').val() == ""){\r\n\r\nalert(''Vui lòng nhập từ khóa cần tìm!'');\r\n\r\n$(''#q'').focus();\r\n\r\nreturn false;\r\n\r\n}\r\n\r\n});\r\n\r\n});\r\n\r\n</script>\r\n\r\n<?php\r\n\r\n}\r\n\r\n\r\n\r\nCác hàm hỗ trợ đã sẵn sàng. Tiếp theo các bạn gọi các header, footer, sidebar cho phù hợp với theme của mình. Template của mình có dạng sau:\r\n\r\n\r\n\r\n<?php get_header(); ?>\r\n\r\n<div class="content-wrap pull-left">\r\n\r\n//nội dung xử lý và hiển thị tại đây\r\n\r\n</div><!--end content-->\r\n\r\n<?php get_sidebar(); ?>\r\n\r\n<?php get_footer(); ?>\r\n\r\n\r\n\r\nPhần nội dung xử lý các bạn tiếp tục với các đoạn code sau:\r\n\r\n\r\n\r\ndvd_get_search_form_by(array(''post''), array(''category'')); //gọi search form\r\n\r\n\r\n\r\nỞ đây mình hiển thị form tìm kiếm cho post và hiển thị lọc theo các term của category. Các bạn có thể thay đổi lại theo ý của mình.\r\n\r\n\r\n\r\n$q = isset($_GET[''q'']) ? trim($_GET[''q'']) : '''';\r\n\r\n$tid = isset($_GET[''tid'']) ? $_GET[''tid''] : '''';\r\n\r\n$pt = isset($_GET[''pt'']) ? $_GET[''pt''] : '''';\r\n\r\n//lấy chuỗi tìm kiếm, term id và post type thông qua string query\r\n\r\n\r\n\r\nKiểm tra và lấy các string query cần thiết để xử lý tìm kiếm nếu có.\r\n\r\n\r\n\r\nif($q != '''' && $tid != '''' && $pt != ''''){\r\n\r\n//người dùng đã bấm search, xử lý và trả về kết quả tại đây\r\n\r\n} \r\n\r\n\r\n\r\nCác string query có tồn tại đồng nghĩa với việc người dùng đã bấm search. Bắt đầu xử lý. Các đoạn code bên dưới nằm trong if nhé.\r\n\r\n\r\n\r\nglobal $wpdb;\r\n\r\n&nbsp;\r\n\r\n$fts_flag = true; //cờ bặt tắt loại tìm kiếm. true: full text search, false: bình thường (like)\r\n\r\n&nbsp;\r\n\r\nif(strlen($q) < 4 || dvd_is_stop_query($q)){ //nếu chiều dài chuỗi tìm kiếm nhỏ hơn 4 hoặc nó nằm trong danh sách stop words thì sử dụng tìm kiếm bình thường\r\n\r\n$fts_flag = false;\r\n\r\n}\r\n\r\n\r\n\r\nNhư đã nói ở trên chúng ta sẽ làm việc trên đối tượng $wpdb để tạo truy vấn tới csdl vì thế phải khai báo trước khi sử dụng.\r\n\r\nDo full text search không chấp nhận trong nội dung tìm kiếm có chứa các stop words và chiều dài phải tối thiểu phải là 4 nên mình cần kiểm tra. Nếu thỏa thì sử dụng full text search ngược lại thì sử dụng như bình thường.\r\n\r\n\r\n\r\nif($fts_flag){ //query tìm kiếm full text search\r\n\r\n$sqlquery = "SELECT ".$wpdb->posts.".* " .\r\n\r\n"FROM ".$wpdb->posts." LEFT JOIN ".$wpdb->term_relationships." ON ".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id ".\r\n\r\n"WHERE ".\r\n\r\n"MATCH(post_excerpt) AGAINST(''".mysql_escape_string($q)."'') ";\r\n\r\n}else{ //query tìm kiếm bình thường\r\n\r\n$sqlquery = "SELECT ".$wpdb->posts.".* " .\r\n\r\n"FROM ".$wpdb->posts." LEFT JOIN ".$wpdb->term_relationships." ON ".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id ".\r\n\r\n"WHERE ".\r\n\r\n"post_excerpt LIKE ''%".mysql_escape_string($q)."%'' ";\r\n\r\n}\r\n\r\n$sqlquery .= " AND post_status = ''publish'' ";\r\n\r\n$tmp = "";\r\n\r\nforeach($pt as $t){\r\n\r\n$tmp .= "''$t'',";\r\n\r\n}\r\n\r\n$tmp = rtrim($tmp, '','');\r\n\r\n$sqlquery .= " AND post_type IN (".$tmp.") ";\r\n\r\n//thêm điều kiện cho where về status và post type\r\n\r\n&nbsp;\r\n\r\nif($tid != 0) //lọc theo term nếu có\r\n\r\n$sqlquery .= " AND ".$wpdb->term_relationships.".term_taxonomy_id = ''".(int)$tid."'' ";\r\n\r\nKiểm tra và tạo câu truy vấn cho phù hợp.\r\n\r\n$all_rows = count($wpdb->get_results($sqlquery)); //tổng số record\r\n\r\n$pag = isset($_GET[''pag'']) ? $_GET[''pag''] : 1; //lấy trang hiện tại\r\n\r\n$posts_per_page = 5; //số post hiển thị trên 1 trang\r\n\r\n$query_string = "?".preg_replace("/&pag=[0-9]/", "", $_SERVER[''QUERY_STRING'']); //lấy query string (loại bỏ pag)\r\n\r\n$sqlquery .= "LIMIT ".(($pag - 1) * $posts_per_page).", ".$posts_per_page; //giới hạn kết quả hiển thị theo số post quy định\r\n\r\n&nbsp;\r\n\r\n$results = $wpdb->get_results($sqlquery); //đổ kết quả vào $results\r\n\r\n&nbsp;\r\n\r\nif(count($results) > 0) : //có kết quả\r\n\r\nglobal $post;\r\n\r\necho "<p>Kết quả tìm kiếm với từ khóa <b>''$q''</b></p>";\r\n\r\n&nbsp;\r\n\r\nforeach($results as $post){ setup_postdata($post); //sử dụng template tag\r\n\r\n?>\r\n\r\n<div class="s_lst">\r\n\r\n<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a></h2>\r\n\r\n<a href="<?php the_permalink(); ?>"><img src="<?php if(has_post_thumbnail()) echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); else {\r\n\r\npreg_match_all(''/<\\s*img [^\\>]*src\\s*=\\s*[\\""\\'']?([^\\""\\''>]*)/i'', get_the_content(), $matches);\r\n\r\nif(isset($matches[1][0])) echo $matches[1][0];\r\n\r\nelse echo get_bloginfo(''template_url'')."/images/no_img.png"; ?>" alt="<?php the_title();\r\n\r\n}\r\n\r\n?>"></a>\r\n\r\n<div class="info_excerpt">\r\n\r\n<p class="post_time"><?php the_time(); echo '' - ''. get_the_date(); ?></p>\r\n\r\n<p><?php echo dvd_substr(get_the_excerpt(), 100); ?></p>\r\n\r\n</div>\r\n\r\n</div>\r\n\r\n<?php\r\n\r\n}\r\n\r\ndvd_paging($pag, ceil($all_rows/$posts_per_page), get_page_link(58).$query_string); //gọi hàm phân trang\r\n\r\nelse : //không có kết quả\r\n\r\necho "<p>Không có kết quả nào cho từ khóa <b>''$q''</b></p>";\r\n\r\nendif;\r\n\r\n\r\n\r\nTiếp tục với tính toán, hiển thị và phân trang kết quả tìm kiếm. Cụ thể mình đã giải thích trên từng dòng code rồi.\r\n\r\nVậy là xong rồi đấy. Kiểm tra kết quả thôi nào.', 'Vậy là mình đã hướng dẫn xong 1 bài nữa về tìm kiếm. Các bạn thấy thế nào về kỹ thuật tìm kiếm này? Website của các bạn đang dùng kỹ thuật tìm kiếm nào? Hãy chia sẻ ý kiến của các bạn tại đây để cùng nhau học hỏi và phát triển hơn.', 'Sử dụng full text search trong tìm kiếm, sử dụng như là', 'Pendding', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term`
--

CREATE TABLE IF NOT EXISTS `tbl_term` (
  `term_ID` int(11) NOT NULL AUTO_INCREMENT,
  `term_name` varchar(255) NOT NULL COMMENT 'Tên Team',
  `term_slug` varchar(255) DEFAULT NULL,
  `term_description` text,
  `term_status` bit(1) DEFAULT b'1',
  `term_parent` int(11) DEFAULT '0',
  `term_count` bigint(20) DEFAULT '0',
  `term_type` varchar(50) DEFAULT 'category' COMMENT 'category, tags',
  PRIMARY KEY (`term_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term_user`
--

CREATE TABLE IF NOT EXISTS `tbl_term_user` (
  `term_user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `term_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`term_user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role`, `username`, `password`, `fullname`, `phone`, `email`, `registered_date`, `last_visited_date`, `activekey`, `active`, `status`) VALUES
(1, 'superuser', 'superuser', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'binh.phamvan@gmail.com', '2015-09-17 14:59:29', '2015-09-27 20:04:49', '09123', 1, 1),
(2, 'administrator', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'admin@gmail.com', '2015-09-17 15:00:15', '2015-09-25 09:18:04', '12356', 1, 1),
(3, 'administrator', 'khongten', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'khongten@123.com', '2015-09-20 03:16:46', NULL, NULL, 1, 1),
(4, 'moderator', 'thunghiem', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 'thunghiem@123.com', '2015-09-20 03:25:21', '2015-09-25 10:39:42', 'rx3EhNAlsh', 1, 1),
(5, 'member', 'hehe', 'e10adc3949ba59abbe56e057f20f883e', 'Bình Phạm', 2147483647, 'binhpv001@gmail.com', '2015-09-23 23:04:25', NULL, 'SZ3k0XFD2m', 0, 1),
(6, 'member', 'tenten', '01cfcd4f6b8770febfb40cb906715822', 'Phạm Văn Bình', 989279795, 'binh.phamvan1@gmail.com', '2015-09-23 23:15:04', NULL, '235o1wJMYw', 0, 1),
(7, 'member', 'tenten1', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bình', 2147483647, 'binh.phamvan11@gmail.com', '2015-09-23 23:15:48', '2015-09-23 23:43:31', '4LI0G1CtHN', 0, 1),
(8, 'member', 'tenten11', 'e10adc3949ba59abbe56e057f20f883e', 'Phạm Văn Bình', 2147483647, 'binh.phamvan111@gmail.com', '2015-09-23 23:16:18', NULL, 'pmbVI0btT6', 0, 1),
(9, 'publisher', 'chuyenvien1', '14e1b600b1fd579f47433b88e8d85291', 'Chuyên viên 1', 989279795, 'chuyenvien1@gmail.com', '2015-09-25 10:36:48', NULL, 'T5oktZ94ju', 1, 1),
(10, '8', 'member8', '123456', 'Quyet', 1656223510, 'nguyennhuquyet@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_user_auth_assignment`
--

INSERT INTO `tbl_user_auth_assignment` (`id`, `itemname`, `userid`, `bizrule`, `data`) VALUES
(1, 'superuser', '1', NULL, 'N;'),
(3, 'administrator', '2', NULL, 'N;'),
(4, 'member', '7', NULL, 'N;'),
(5, 'moderator', '4', NULL, 'N;');

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
