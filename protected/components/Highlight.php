<?php

class Highlight {

    public $arr_search = array();
    private $str_search = array('Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Ế', 'Ề',
        'Ể', 'Ễ', 'Ệ', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ă', 'Â', 'Ả', 'Ã',
        'Ạ', 'Ỉ', 'Ĩ', 'Ị', 'Ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ỷ', 'Ỹ', 'Ỵ', 'Ẻ', 'Ẽ', 'Ẹ', 'Ó',
        'Ò', 'Ơ', 'Đ', 'Á', 'À', 'Í', 'Ì', 'Ý', 'Ỳ', 'Ê', 'É', 'È', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'ắ',
        'ằ', 'ẳ', 'ẵ', 'ặ', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ế', 'ề', 'ể',
        'ễ', 'ệ', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ă', 'â', 'ả', 'ã', 'ạ',
        'ỉ', 'ĩ', 'ị', 'ư', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ỷ', 'ỹ', 'ỵ', 'ẻ', 'ẽ', 'ẹ', 'ó', 'ò',
        'ơ', 'đ', 'á', 'à', 'í', 'ì', 'ý', 'ỳ', 'ê', 'é', 'è', 'ỏ', 'õ', 'ọ', 'ô');
    private $str_rep = array('A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'U', 'U', 'U', 'U', 'U', 'E', 'E',
        'E', 'E', 'E', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'A', 'A', 'A', 'A',
        'A', 'I', 'I', 'I', 'U', 'U', 'U', 'U', 'U', 'U', 'Y', 'Y', 'Y', 'E', 'E', 'E', 'O',
        'O', 'O', 'D', 'A', 'A', 'I', 'I', 'Y', 'Y', 'E', 'E', 'E', 'O', 'O', 'O', 'O', 'a',
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'u', 'u', 'u', 'u', 'u', 'e', 'e', 'e',
        'e', 'e', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'a', 'a', 'a', 'a', 'a',
        'i', 'i', 'i', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'e', 'e', 'e', 'o', 'o',
        'o', 'd', 'a', 'a', 'i', 'i', 'y', 'y', 'e', 'e', 'e', 'o', 'o', 'o', 'o');
    private $str_rep_uni = array('A81', 'A82', 'A83', 'A84', 'A85', 'A61', 'A61', 'A63', 'A64', 'A65', 'U71', 'U72', 'U73', 'U74', 'U75', 'E61', 'E62',
        'E63', 'E64', 'E65', 'O61', 'O62', 'O63', 'O64', 'O65', 'O71', 'O72', 'O73', 'O74', 'O75', 'A8', 'A6', 'A3', 'A4',
        'A5', 'I3', 'I4', 'I5', 'U7', 'U1', 'U2', 'U3', 'U4', 'U5', 'Y3', 'Y4', 'Y5', 'E3', 'E4', 'E5', 'O1',
        'O2', 'O7', 'D9', 'A1', 'A2', 'I1', 'I2', 'Y1', 'Y2', 'E6', 'E1', 'E2', 'O3', 'O4', 'O5', 'O6', 'a81',
        'a82', 'a83', 'a84', 'a85', 'a61', 'a62', 'a63', 'a64', 'a65', 'u71', 'u72', 'u73', 'u74', 'u75', 'e61', 'e62', 'e63',
        'e64', 'e65', 'o61', 'o62', 'o63', 'o64', 'o65', 'o71', 'o72', 'o73', 'o74', 'o75', 'a8', 'a6', 'a3', 'a4', 'a5',
        'i3', 'i4', 'i5', 'u7', 'u1', 'u2', 'u3', 'u4', 'u5', 'y3', 'y4', 'y5', 'e3', 'e4', 'e5', 'o1', 'o2',
        'o7', 'd9', 'a1', 'a2', 'i1', 'i2', 'y1', 'y2', 'e6', 'e1', 'e2', 'o3', 'o4', 'o5', 'o6');

    function __construct() {
        mb_internal_encoding("UTF-8");
        mb_regex_encoding("UTF-8");
    }

    private function toSimple($str) {
        return str_replace($this->str_search, $this->str_rep, $str);
    }

    private function toUnicodeSimple($str) {
        return str_replace($this->str_search, $this->str_rep_uni, $str);
    }

    public function toHighlight($source, $keywords, $tab_open = '<b>', $tab_close = '</b>', $length = 500, $more = '...') {
        $source = strip_tags($source);
        $keywords = explode(" ", $keywords);
        $arr_search = array();
        $st = 0;
        foreach ($keywords as $highlight) {
            if (!empty($highlight)) {
                $str_convert = strtolower($this->toSimple($source));
                $highlight_convert = strtolower($this->toSimple($highlight));
                $highlight_convert_unicode_simple = strtolower($this->toUnicodeSimple($highlight));
                $highlight_len = strlen($highlight_convert);
                $tab_len = strlen($tab_open . $tab_close);
                $i = 0;
                while (($start = strpos($str_convert, $highlight_convert, $i)) !== false) {
                    if (empty($st)) {
                        $st = $start;
                    }
                    $str = mb_substr($source, $start, $highlight_len);
                    //var_dump($str);
                    $str_convert_unicode_simple = strtolower($this->toUnicodeSimple($str));
                    if ($highlight == $highlight_convert) {
                        $arr_search[$str] = $str;
                    } else {
                        if (( $str_convert_unicode_simple == $highlight_convert_unicode_simple ) || ( $str_convert_unicode_simple == $highlight_convert )) {
                            $arr_search[$str] = $str;
                        }
                    }
                    $i = $start + 1;
                }
            }
        }

        $source = Common::short_text($source);
        foreach ($arr_search as $value) {
            $source = mb_ereg_replace($value, $tab_open . $value . $tab_close, $source);
        }
        return $source;
    }

}

?>