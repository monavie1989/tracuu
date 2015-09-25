<?php

/*
 * Process send mail to users in system
 */

class Common {

    public $Info;
	public static function get_root_parent_id( $page_id ) {
		if(!empty($page_id)){
			$pageInfo = Page::model()->findByPk($page_id);
			if($pageInfo){
				$parent = $pageInfo->parent_id;
				if( $parent == 0 ) return $page_id;
				else return self::get_root_parent_id( $parent );
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public static function get_all_child_page( $page_id ) {
		if(!empty($page_id)){
			foreach($page_id as $p){
				$pageInfo = Page::model()->findByPk($p);
			}
		}else{
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
		if($headers){
			if (isset($headers['Content-Length'])) return $headers['Content-Length'];
			if (isset($headers['Content-length'])) return $headers['Content-length'];

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
                if ($parent == $val->parent_id) {
                    $val->level = $level;
                    $this->Info[] = $val;
                    $_parent = $val->id;
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

}

