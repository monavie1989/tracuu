<?php

/*
 * Process send mail to users in system
 */

class Common {

    public $Info;

    public static function get_root_parent_id($page_id) {
        if (!empty($page_id)) {
            $pageInfo = Page::model()->findByPk($page_id);
            if ($pageInfo) {
                $parent = $pageInfo->category_parent;
                if ($parent == 0)
                    return $page_id;
                else
                    return self::get_root_parent_id($parent);
            }else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_all_child_page($page_id) {
        if (!empty($page_id)) {
            foreach ($page_id as $p) {
                $pageInfo = Page::model()->findByPk($p);
            }
        } else {
            return false;
        }
    }

    public static function getKeyNameOfTable($model) {
        $data = Yii::app()->db->createCommand('SHOW KEYS FROM `' . $model::model()->tableName() . '`')->queryRow();
        if (!empty($data)) {
            return $data['Column_name'];
        }
        return '';
    }

    public static function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 1) . ' gb';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 1) . ' mb';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 1) . ' kb';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function get_remote_size($url) {
        $headers = @get_headers($url, 1);
        if ($headers) {
            if (isset($headers['Content-Length']))
                return $headers['Content-Length'];
            if (isset($headers['Content-length']))
                return $headers['Content-length'];

            $c = curl_init();
            curl_setopt_array($c, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array('User-Agent: Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.1.3) Gecko/20090824 Firefox/3.5.3'),
            ));
            curl_exec($c);
            return curl_getinfo($c, CURLINFO_SIZE_DOWNLOAD);
        }
        return 0;
    }

    public static function genString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public static function genOrderNo($input, $length = 3, $pfx = 'DS') {
        if (strlen($input) > $length)
            $length = strlen($input);
        $string = str_pad($input, $length, "0", STR_PAD_LEFT);
        return $pfx . $string;
    }

    public static function getLastPk($tableName, $pkColumnName = 'id') {
        // Sql statement to get max id of a table x
        $model = $tableName::model();

        $data = Yii::app()->db->createCommand()
                ->select('MAX(' . $pkColumnName . ') as lastpk')
                ->from($model->getTableSchema()->name)
                ->queryRow();
        return !empty($data['lastpk']) ? $data['lastpk'] : 0;
    }

    public static function getNextPk($tableName, $pkColumnName = 'id') {
        // Sql statement to get max id of a table x
        $model = $tableName::model();

        $data = Yii::app()->db->createCommand()
                ->select('MAX(' . $pkColumnName . ') as lastpk')
                ->from($model->getTableSchema()->name)
                ->queryRow();
        return !empty($data['lastpk']) ? $data['lastpk'] + 1 : 1;
    }

    public static function genDate($date) {
        return date('Y', strtotime($date)) . ' / ' . date('m', strtotime($date)) . ' / ' . date('d', strtotime($date));
    }

    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function imgProcess($source, $destination, $size = 260) {
        asido::driver('gd');

        $data = getimagesize($source);
        $width = $data[0];
        $height = $data[1];
        $vheight = 0;
        if ($height > $width) {
            $vheight = $width;
        } else {
            $vheight = $height;
        }

        $i1 = Asido::image($source, $destination);
        Asido::Crop($i1, 0, 0, $width, $vheight);
        Asido::width($i1, $size);
        $i1->save(ASIDO_OVERWRITE_ENABLED);
    }

    public static function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function getCategories($data) {
        $this->Info = array();
        $this->recursive($data, 0, 1);
        return $this->Info;
    }

    public function getArrayCategories($data_input, $valueField, $textField) {
        $data = $this->getCategories($data_input);
        $tmp = array();
        foreach ($data as $it) {
            $tmp[$it->$valueField] = str_repeat('— ', $it->level - 1) . $it->$textField;
        }
        return $tmp;
    }

    public function recursive($CatArr, $parent, $level) {
        if (count($CatArr) > 0) {
            foreach ($CatArr as $key => $val) {
                if ($parent == $val->category_parent) {
                    $val->level = $level;
                    $this->Info[] = $val;
                    $_parent = $val->category_id;
                    unset($CatArr[$key]);
                    $this->recursive($CatArr, $_parent, $level + 1);
                }
            }
        }
    }

    public static function get_file_extension($filename) {
        /*
         * "." for extension should be available and not be the first character
         * so position should not be false or 0.
         */
        $lastDotPos = strrpos($filename, '.');
        if (!$lastDotPos)
            return '';
        return substr($filename, $lastDotPos);
    }

    public static function short_text($html, $numchars = 500) {
        // Remove the HTML tags
        $html = strip_tags($html);

        // Convert HTML entities to single characters
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');

        // Make the string the desired number of characters
        // Note that substr is not good as it counts by bytes and not characters
        $html = mb_substr($html, 0, $numchars, 'UTF-8');

        // Add an elipsis
        $html .= "… ";

        return $html;
    }

    // ----------------------------

    public static function sanitize_title_with_dashes($title, $raw_title = '', $context = 'display') {
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
        $title = self::remove_accents($title);
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }
//        $title = self::utf8_uri_encode($title, 255);

        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);

        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');

        return $title;
    }

    public static function seems_utf8($str) {
        $length = strlen($str);
        for ($i = 0; $i < $length; $i++) {
            $c = ord($str[$i]);
            if ($c < 0x80)
                $n = 0;# 0bbbbbbb
            elseif (($c & 0xE0) == 0xC0)
                $n = 1;# 110bbbbb
            elseif (($c & 0xF0) == 0xE0)
                $n = 2;# 1110bbbb
            elseif (($c & 0xF8) == 0xF0)
                $n = 3;# 11110bbb
            elseif (($c & 0xFC) == 0xF8)
                $n = 4;# 111110bb
            elseif (($c & 0xFE) == 0xFC)
                $n = 5;# 1111110b
            else
                return false;# Does not match any model
            for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
                if (( ++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                    return false;
            }
        }
        return true;
    }

    public static function utf8_uri_encode($utf8_string, $length = 0) {
        $unicode = '';
        $values = array();
        $num_octets = 1;
        $unicode_length = 0;

        $string_length = strlen($utf8_string);
        for ($i = 0; $i < $string_length; $i++) {

            $value = ord($utf8_string[$i]);

            if ($value < 128) {
                if ($length && ( $unicode_length >= $length ))
                    break;
                $unicode .= chr($value);
                $unicode_length++;
            } else {
                if (count($values) == 0)
                    $num_octets = ( $value < 224 ) ? 2 : 3;

                $values[] = $value;

                if ($length && ( $unicode_length + ($num_octets * 3) ) > $length)
                    break;
                if (count($values) == $num_octets) {
                    if ($num_octets == 3) {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                        $unicode_length += 9;
                    } else {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                        $unicode_length += 6;
                    }

                    $values = array();
                    $num_octets = 1;
                }
            }
        }

        return $unicode;
    }

    public static function remove_accents($string) {
        if (!preg_match('/[\x80-\xff]/', $string))
            return $string;

        if (self::seems_utf8($string)) {
            $chars = array(
                // Decompositions for Latin-1 Supplement
                chr(194) . chr(170) => 'a', chr(194) . chr(186) => 'o',
                chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
                chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
                chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
                chr(195) . chr(134) => 'AE', chr(195) . chr(135) => 'C',
                chr(195) . chr(136) => 'E', chr(195) . chr(137) => 'E',
                chr(195) . chr(138) => 'E', chr(195) . chr(139) => 'E',
                chr(195) . chr(140) => 'I', chr(195) . chr(141) => 'I',
                chr(195) . chr(142) => 'I', chr(195) . chr(143) => 'I',
                chr(195) . chr(144) => 'D', chr(195) . chr(145) => 'N',
                chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
                chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
                chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
                chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
                chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
                chr(195) . chr(158) => 'TH', chr(195) . chr(159) => 's',
                chr(195) . chr(160) => 'a', chr(195) . chr(161) => 'a',
                chr(195) . chr(162) => 'a', chr(195) . chr(163) => 'a',
                chr(195) . chr(164) => 'a', chr(195) . chr(165) => 'a',
                chr(195) . chr(166) => 'ae', chr(195) . chr(167) => 'c',
                chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
                chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
                chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
                chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
                chr(195) . chr(176) => 'd', chr(195) . chr(177) => 'n',
                chr(195) . chr(178) => 'o', chr(195) . chr(179) => 'o',
                chr(195) . chr(180) => 'o', chr(195) . chr(181) => 'o',
                chr(195) . chr(182) => 'o', chr(195) . chr(184) => 'o',
                chr(195) . chr(185) => 'u', chr(195) . chr(186) => 'u',
                chr(195) . chr(187) => 'u', chr(195) . chr(188) => 'u',
                chr(195) . chr(189) => 'y', chr(195) . chr(190) => 'th',
                chr(195) . chr(191) => 'y', chr(195) . chr(152) => 'O',
                // Decompositions for Latin Extended-A
                chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
                chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
                chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
                chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
                chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
                chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
                chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
                chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
                chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
                chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
                chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
                chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
                chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
                chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
                chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
                chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
                chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
                chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
                chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
                chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
                chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
                chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
                chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
                chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
                chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
                chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
                chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
                chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
                chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
                chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
                chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
                chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
                chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
                chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
                chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
                chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
                chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
                chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
                chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
                chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
                chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
                chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
                chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
                chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
                chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
                chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
                chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
                chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
                chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
                chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
                chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
                chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
                chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
                chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
                chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
                chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
                chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
                chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
                chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
                chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
                chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
                chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
                chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
                chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's',
                // Decompositions for Latin Extended-B
                chr(200) . chr(152) => 'S', chr(200) . chr(153) => 's',
                chr(200) . chr(154) => 'T', chr(200) . chr(155) => 't',
                // Euro Sign
                chr(226) . chr(130) . chr(172) => 'E',
                // GBP (Pound) Sign
                chr(194) . chr(163) => '',
                // Vowels with diacritic (Vietnamese)
                // unmarked
                chr(198) . chr(160) => 'O', chr(198) . chr(161) => 'o',
                chr(198) . chr(175) => 'U', chr(198) . chr(176) => 'u',
                // grave accent
                chr(225) . chr(186) . chr(166) => 'A', chr(225) . chr(186) . chr(167) => 'a',
                chr(225) . chr(186) . chr(176) => 'A', chr(225) . chr(186) . chr(177) => 'a',
                chr(225) . chr(187) . chr(128) => 'E', chr(225) . chr(187) . chr(129) => 'e',
                chr(225) . chr(187) . chr(146) => 'O', chr(225) . chr(187) . chr(147) => 'o',
                chr(225) . chr(187) . chr(156) => 'O', chr(225) . chr(187) . chr(157) => 'o',
                chr(225) . chr(187) . chr(170) => 'U', chr(225) . chr(187) . chr(171) => 'u',
                chr(225) . chr(187) . chr(178) => 'Y', chr(225) . chr(187) . chr(179) => 'y',
                // hook
                chr(225) . chr(186) . chr(162) => 'A', chr(225) . chr(186) . chr(163) => 'a',
                chr(225) . chr(186) . chr(168) => 'A', chr(225) . chr(186) . chr(169) => 'a',
                chr(225) . chr(186) . chr(178) => 'A', chr(225) . chr(186) . chr(179) => 'a',
                chr(225) . chr(186) . chr(186) => 'E', chr(225) . chr(186) . chr(187) => 'e',
                chr(225) . chr(187) . chr(130) => 'E', chr(225) . chr(187) . chr(131) => 'e',
                chr(225) . chr(187) . chr(136) => 'I', chr(225) . chr(187) . chr(137) => 'i',
                chr(225) . chr(187) . chr(142) => 'O', chr(225) . chr(187) . chr(143) => 'o',
                chr(225) . chr(187) . chr(148) => 'O', chr(225) . chr(187) . chr(149) => 'o',
                chr(225) . chr(187) . chr(158) => 'O', chr(225) . chr(187) . chr(159) => 'o',
                chr(225) . chr(187) . chr(166) => 'U', chr(225) . chr(187) . chr(167) => 'u',
                chr(225) . chr(187) . chr(172) => 'U', chr(225) . chr(187) . chr(173) => 'u',
                chr(225) . chr(187) . chr(182) => 'Y', chr(225) . chr(187) . chr(183) => 'y',
                // tilde
                chr(225) . chr(186) . chr(170) => 'A', chr(225) . chr(186) . chr(171) => 'a',
                chr(225) . chr(186) . chr(180) => 'A', chr(225) . chr(186) . chr(181) => 'a',
                chr(225) . chr(186) . chr(188) => 'E', chr(225) . chr(186) . chr(189) => 'e',
                chr(225) . chr(187) . chr(132) => 'E', chr(225) . chr(187) . chr(133) => 'e',
                chr(225) . chr(187) . chr(150) => 'O', chr(225) . chr(187) . chr(151) => 'o',
                chr(225) . chr(187) . chr(160) => 'O', chr(225) . chr(187) . chr(161) => 'o',
                chr(225) . chr(187) . chr(174) => 'U', chr(225) . chr(187) . chr(175) => 'u',
                chr(225) . chr(187) . chr(184) => 'Y', chr(225) . chr(187) . chr(185) => 'y',
                // acute accent
                chr(225) . chr(186) . chr(164) => 'A', chr(225) . chr(186) . chr(165) => 'a',
                chr(225) . chr(186) . chr(174) => 'A', chr(225) . chr(186) . chr(175) => 'a',
                chr(225) . chr(186) . chr(190) => 'E', chr(225) . chr(186) . chr(191) => 'e',
                chr(225) . chr(187) . chr(144) => 'O', chr(225) . chr(187) . chr(145) => 'o',
                chr(225) . chr(187) . chr(154) => 'O', chr(225) . chr(187) . chr(155) => 'o',
                chr(225) . chr(187) . chr(168) => 'U', chr(225) . chr(187) . chr(169) => 'u',
                // dot below
                chr(225) . chr(186) . chr(160) => 'A', chr(225) . chr(186) . chr(161) => 'a',
                chr(225) . chr(186) . chr(172) => 'A', chr(225) . chr(186) . chr(173) => 'a',
                chr(225) . chr(186) . chr(182) => 'A', chr(225) . chr(186) . chr(183) => 'a',
                chr(225) . chr(186) . chr(184) => 'E', chr(225) . chr(186) . chr(185) => 'e',
                chr(225) . chr(187) . chr(134) => 'E', chr(225) . chr(187) . chr(135) => 'e',
                chr(225) . chr(187) . chr(138) => 'I', chr(225) . chr(187) . chr(139) => 'i',
                chr(225) . chr(187) . chr(140) => 'O', chr(225) . chr(187) . chr(141) => 'o',
                chr(225) . chr(187) . chr(152) => 'O', chr(225) . chr(187) . chr(153) => 'o',
                chr(225) . chr(187) . chr(162) => 'O', chr(225) . chr(187) . chr(163) => 'o',
                chr(225) . chr(187) . chr(164) => 'U', chr(225) . chr(187) . chr(165) => 'u',
                chr(225) . chr(187) . chr(176) => 'U', chr(225) . chr(187) . chr(177) => 'u',
                chr(225) . chr(187) . chr(180) => 'Y', chr(225) . chr(187) . chr(181) => 'y',
                // Vowels with diacritic (Chinese, Hanyu Pinyin)
                chr(201) . chr(145) => 'a',
                // macron
                chr(199) . chr(149) => 'U', chr(199) . chr(150) => 'u',
                // acute accent
                chr(199) . chr(151) => 'U', chr(199) . chr(152) => 'u',
                // caron
                chr(199) . chr(141) => 'A', chr(199) . chr(142) => 'a',
                chr(199) . chr(143) => 'I', chr(199) . chr(144) => 'i',
                chr(199) . chr(145) => 'O', chr(199) . chr(146) => 'o',
                chr(199) . chr(147) => 'U', chr(199) . chr(148) => 'u',
                chr(199) . chr(153) => 'U', chr(199) . chr(154) => 'u',
                // grave accent
                chr(199) . chr(155) => 'U', chr(199) . chr(156) => 'u',
            );
            $string = strtr($string, $chars);
        } else {
            // Assume ISO-8859-1 if not UTF-8
            $chars['in'] = chr(128) . chr(131) . chr(138) . chr(142) . chr(154) . chr(158)
                    . chr(159) . chr(162) . chr(165) . chr(181) . chr(192) . chr(193) . chr(194)
                    . chr(195) . chr(196) . chr(197) . chr(199) . chr(200) . chr(201) . chr(202)
                    . chr(203) . chr(204) . chr(205) . chr(206) . chr(207) . chr(209) . chr(210)
                    . chr(211) . chr(212) . chr(213) . chr(214) . chr(216) . chr(217) . chr(218)
                    . chr(219) . chr(220) . chr(221) . chr(224) . chr(225) . chr(226) . chr(227)
                    . chr(228) . chr(229) . chr(231) . chr(232) . chr(233) . chr(234) . chr(235)
                    . chr(236) . chr(237) . chr(238) . chr(239) . chr(241) . chr(242) . chr(243)
                    . chr(244) . chr(245) . chr(246) . chr(248) . chr(249) . chr(250) . chr(251)
                    . chr(252) . chr(253) . chr(255);

            $chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

            $string = strtr($string, $chars['in'], $chars['out']);
            $double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
            $double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
            $string = str_replace($double_chars['in'], $double_chars['out'], $string);
        }

        return $string;
    }

}
