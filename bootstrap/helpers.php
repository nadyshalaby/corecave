<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
function _view($path, $args = []) {
    return View::show($path, $args);
}

/**
 * Translate the passed string into real path according to the application path.
 * 
 * <b>Note:</b>
 * <p>
 * if the path matches real directory it will be translated as directory path
 *  and if it's something else it will be translated as filename</p>
 * @param string $path
 * @return string the translated url
 */
function _path($path) {
    $chunks = _multiexplode(['.', '/', '>', '|','\\'], $path);
    $sperator = DIRECTORY_SEPARATOR;
    $path = implode($sperator, $chunks);
    $path = realpath(__DIR__ . "{$sperator}..{$sperator}{$path}");
    if (is_dir($path)) {
        return $path;
    } else {
        $file_name = implode('.', array_slice($chunks, -2, 2));
        $file_parent = implode($sperator, array_slice($chunks, 0, -2));
        $path = __DIR__ . "{$sperator}..{$sperator}{$file_parent}{$sperator}{$file_name}";
        if(file_exists($path)){
            return realpath($path);
        }
        
        return $path;
    }
}

/**
 * Fetch or bind something from or to the container, if no args provided a new instance of 
 * the DI container will be returned. 
 * 
 * @param mixed $name key name to be binded
 * @param mixed|callable $binding 
 * @return \Container
 */
function _container() {
    
    $args = func_get_args();
    $count = count($args);
    
    switch ($count){
        case 0:
            return new Container;
        case 1:
            return Container::fetch($args[0]);
        case 2:
            return Container::override($args[0],$args[1]);
    }  
}

/**
 * Render twig view.
 * 
 * @param string $path
 * @param array $args
 * @return object
 */
function _twig($path = null, $args = []) {
    if ($path) {
        return Twig::render($path, $args);
    }
    return Twig::getInstance();
}

/**
 * Construct the route url that have the passed name.
 * 
 * @param string $name name of route
 * @param mixed $args identifiers values
 * @return string
 */
function _route($name, $args = []) {
    return Url::route($name, $args);
}

/**
 * Construct the route url that have the passed action.
 * 
 * @param string $name action of route
 * @param mixed $args identifiers values
 * @return string the url
 */
function _action($name, $args = []) {
    return Url::action($name, $args);
}

/**
 * Flash the content to the session for only one use.
 * 
 * @param mixed $name 
 * @param mixed $content
 * @return object
 */
function _flash($name, $content = null) {
    return Response::flash($name, $content);
}

/**
 * Checks if the given array follows the specified rules on each field passed.eg
 * <b>Example:</b>
 * <pre>
 * 	_validate($array,[
 * 	                              		'password' => [
 *                                                      'required' => true,
 *                                                      'field' => 'nr_password', // st_password,nr_password,username,url,color,ip,tag,email,phone;
 * 		                               		'min' => 2,
 * 		                               		'max' => 20,
 * 		                               		'range' => ['min' => 20, 'max' => 100],
 * 		                               		'unique' => 'users',
 * 		                               		'alpha' =>true,
 * 		                               		'alpha_space' =>true,
 * 		                               		'unicode' =>true,
 * 		                               		'unicode_space' =>true,
 * 		                               		'unicode_num' =>true,
 * 		                               		'num' =>true,
 * 	 	                              		'alpha_num' => true,
 * 	 	                              		'zip' => ['CA','EG','US'],
 * 	 	                              		'zip' => 'CA',
 * 		                               		'regexp' =>'/[0-9]+/',
 * 	 	                              		'matches' => 'password_again',
 * 	 	                              		'equals' => ['password1','password2','password3'],
 * 		                               ],
 * 		                     ]);
 * 	if (_validate()->passed()){
 * 		echo 'Ok';
 * 	}else{
 * 		echo '<pre>',print_r(_validate()->getErrors()),'</pre>';
 * 	}
 * </pre>
 * @param array $data 
 * @param array $param_rules 
 * @return obj|boolean
 */
function _validate(array $data = null, array $field_rules = [], array $msgs = []) {
    if ($data) {
        return Validation::validate($data, $field_rules, $msgs);
    }
    return Validation::getInstance();
}

function _redirect($location, $with = [], $after = 0) {
    return Response::redirectTo($location, $with, $after);
}

function _goBack($with = [], $after = 0) {
    return Response::redirectBack($with, $after);
}

function _refresh($after = 0) {
    return Response::refresh($after);
}

function _escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function _strReplaceFirst($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

function _arrayFetch(array $array, $path_to_key, $default = null) {

    $path_to_key = _multiexplode(['|', '/', '-', '>', ',', '.', ' '], $path_to_key);

    foreach ($path_to_key as $key) {
        $key = trim($key);
        if (isset($array[$key])) {
            $array = $array[$key];
        } else {
            return $default;
        }
    }

    return $array;
}

/**
 * deeping merge between any type of arguments into one array.
 * 
 * @param $...args $mixed args to be merged
 * @return type
 */
function _arrayMergeMixed() {
    $array = [];
    foreach (func_get_args() as $arg) {
        if (is_array($arg)) {
            $array = _flattenArray($arg);
        } else if ($arg) {
            $array [] = $arg;
        }
    }
    return $array;
}

/**
 * Convert multi-dimension array into one-dimension array.
 * 
 * @param array $array array to convert
 * @return array
 */
function _flattenArray(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) {
        $return[] = $a;
    });
    return $return;
}

/**
 * Deeping merge between arrays or string-like-arrays.
 * 
 * @param type $array string-like-array or array contains string like array
 * @param type $return holds the expected result
 */
function _strArrayToArray($array, &$return) {
    if (is_array($array)) {
        array_walk_recursive($array, function($a) use (&$return) {
            _flattenArray($a, $return);
        });
    } else if (is_string($array) && stripos($array, '[') !== false) {
        $array = explode(',', trim($array, "[]"));
        _flattenArray($array, $return);
    } else {
        $return[] = $array;
    }
}

/**
 * Uniquifying the passed filename  against to the files located in the given path.
 *   
 * @param type $path directory path 
 * @param string $filename filename to uniquify 
 * @return string the old filename if its already unique or new name
 */
function _uniqueFile($path, $filename) {
    $fileparts = explode('.', $filename);
    $fileext = end($fileparts);
    array_pop($fileparts);
    $fileorigin = implode('_', $fileparts);
    while (file_exists("$path/$filename")) {
        $filename = "{$fileorigin}_" . rand(0, 99999) . ".$fileext";
    }
    return$filename;
}

/**
 * explode the the given string according to the specified array of delimiters.
 * 
 * @param array $delimiters 
 * @param string $string 
 * @return array
 */
function _multiexplode(array $delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}

/**
 * Check whether the input is an array whose keys are all integers.
 * 
 * @param[in] $InputArray          (array) Input array.
 * @return                         (bool) \b true iff the input is an array whose keys are all integers.
 */
function _isKeyIntArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_unique(array_map("is_int", array_keys($InputArray))) === array(true);
}

/**
 * Check whether the input is an array whose keys are all strings.
 * 
 * @param[in] $InputArray          (array) Input array.
 * @return                         (bool) \b true iff the input is an array whose keys are all strings.
 */
function _isKeyStringArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_unique(array_map("is_string", array_keys($InputArray))) === array(true);
}

/**
 * Check whether the input is an array with at least one key being an integer and at least one key being a string.
 * 
 * @param $InputArray          (array) Input array.
 * @return                         (bool) \b true iff the input is an array with at least one key being an integer and at least one key being a string.
 */
function _isKeyMixedArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return count(array_unique(array_map("is_string", array_keys($InputArray)))) >= 2;
}

/**
 * Check whether the input is an array whose keys are numeric, sequential, and zero-based.
 * 
 * @param[in] $InputArray          (array) Input array.
 * @return                         (bool) \b true iff the input is an array whose keys are numeric, sequential, and zero-based.
 */
function _isKeyNumZeroBasedArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_keys($InputArray) === range(0, count($InputArray) - 1);
}

/**
 * Check if the given file has mime matches one of the given mimes.
 * 
 * @param string $filename path to file
 * @param string|array $mimeorMimes string or array of mimes to check against
 * @return boolean
 */
function _fileHasMime($filename, $mimeorMimes) {
    $mime = mime_content_type($filename);
    if (is_array($mimeorMimes) && in_array($mime, $mimeorMimes)) {
        return true;
    } else {
        return $mime === $mimeorMimes;
    }
}

/**
 * Check if the given file has extension matches one of the given extensions.
 * 
 * @param string $filename path to file
 * @param string|array $extensionOrExtensions string or array of extensions to check against
 * @return boolean
 */
function _fileHasExtension($filename, $extensionOrExtensions, $case_in_sensitive = true) {
    $parts = explode('.', $filename);
    $extension = end($parts);
    if ($case_in_sensitive) {
        $extension = strtolower($extension);
    }
    if (is_array($extensionOrExtensions) && in_array($extension, $extensionOrExtensions)) {
        return true;
    } else {
        return $extension === $extensionOrExtensions;
    }
}

/**
 * Get the base class name from object of string class name.
 * 
 * @param string|object $cls
 * @return string
 */
function _getClassBaseName($cls) {
    if (is_object($cls)) {
        $cls = get_class($cls);
    }
    $arr = explode('\\', $cls);
    return end($arr);
}

/**
 * Apply the passed callable to eash element to the given array.
 * 
 * @param array $arr
 * @param Closure $callable
 * @return array 
 */
function _loop(array $arr, Closure $callable) {
    foreach ($arr as $key => $value) {
        $arr[$key] = call_user_func_array($callable, [$key, $value]);
    }
    return $arr;
}

/**
 * Convert the passed array to an object.
 * 
 * @param array $arr array to be converted
 * @return object
 */
function _arr2obg(array $arr) {
    return json_decode(json_encode($arr));
}

/**
 * Convert the passed object to an array.
 * 
 * @param object $obj object to be converted
 * @return array
 */
function _obj2arr(object $obj) {
    return json_decode(json_encode($obj), true);
}

/**
 * Scan the given image and convert it to a PNG image.
 * 
 * @param string $source the path to source image
 * @param string  [$target] the target output
 * @return boolean
 */
function _scanImageToPng($source, $target = 'php://output') {
    $sourceImg = @imagecreatefromstring(@file_get_contents($source));
    if ($sourceImg === false) {
        return FALSE;
    }
    $width = imagesx($sourceImg);
    $height = imagesy($sourceImg);
    $targetImg = imagecreatetruecolor($width, $height);
    imagecopy($targetImg, $sourceImg, 0, 0, 0, 0, $width, $height);
    imagedestroy($sourceImg);
    imagepng($targetImg, $target);
    imagedestroy($targetImg);
    return TRUE;
}

/**
 * Convert the given text to its slug representation.
 * 
 * @param string $text text to be converted
 * @param boolean $translate convert arabic into franco 
 * @return string
 */
function _slugify($text, $translate = false) {
    $replace = [
        '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
        '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
        '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
        'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
        'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
        'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
        'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
        'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
        'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
        'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
        'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
        'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
        'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
        'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
        'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
        '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
        'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
        'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
        'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
        'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
        'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
        'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
        'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
        'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
        'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
        'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
        'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
        'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
        '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
        'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
        'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
        'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
        'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
        'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
        'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
        'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
        'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
        'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
        'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
        'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
        'ю' => 'yu', 'я' => 'ya'
    ];
    // make a human readable string
    $text = strtr($text, $replace);

    $text = preg_replace('/[^A-Za-z0-9-\pL]+/u', '-', $text);

    if ($translate) {
        $text = _ar2en($text);
    }

    $text = trim($text, ' -');

    $text = preg_replace_callback('/([A-Za-z0-9]+)/', function ($match) {
        return strtolower($match[0]);
    }, $text);

    return $text;
}

/**
 * Insert the element into the given array at the passed position.
 * 
 * @param array      $array
 * @param mixed      $position
 * @param mixed      $element
 * @return array 
 */
function _arrayInsert(array &$array, $position, $element) {
    if (count($array) == 0) {
        $array[] = $element;
    } elseif (is_numeric($position) && $position < 0) {
        if ((count($array) + position) < 0) {
            $array = _arrayInsert($array, $element, 0);
        } else {
            $array[count($array) + $position] = $element;
        }
    } elseif (is_numeric($position) && isset($array[$position])) {
        $part1 = array_slice($array, 0, $position, true);
        $part2 = array_slice($array, $position, null, true);
        $array = array_merge($part1, array($position => $element), $part2);
        foreach ($array as $key => $item) {
            if (is_null($item)) {
                unset($array[$key]);
            }
        }
    } elseif (is_null($position)) {
        $array[] = $element;
    } elseif (!isset($array[$position])) {
        $array[$position] = $element;
    }
    $array = array_merge($array);
    return $array;
}

/**
 * Insert the element into the passed input before the given index. 
 * 
 * @param array $input
 * @param mixed $index
 * @param mixed $element
 * @param mixed $newKey
 * @return type
 * @throws Exception
 */
function _insertBefore(&$input, $index, $element, $newKey = null) {
    if (!array_key_exists($index, $input)) {
        throw new Exception("Index not found");
    }
    $tmpArray = array();
    foreach ($input as $key => $value) {
        if ($key === $index) {
            if (!empty($newKey)) {
                $tmpArray[$newKey] = $element;
            } else {
                $tmpArray[] = $element;
            }
        }

        if (is_numeric($key)) {
            $tmpArray[] = $value;
        } else {
            $tmpArray[$key] = $value;
        }
    }
    $input = $tmpArray;
    return $input;
}

/**
 * Insert the element into the passed input after the given index. 
 * 
 * @param array $input
 * @param mixed $index
 * @param mixed $element
 * @param mixed $newKey
 * @return type
 * @throws Exception
 */
function _insertAfter(&$input, $index, $element, $newKey = null) {
    if (!array_key_exists($index, $input)) {
        throw new Exception("Index not found");
    }
    $tmpArray = array();
    foreach ($input as $key => $value) {
        if (is_numeric($key)) {
            $tmpArray[] = $value;
        } else {
            $tmpArray[$key] = $value;
        }

        if ($key === $index) {
            if (!empty($newKey)) {
                $tmpArray[$newKey] = $element;
            } else {
                $tmpArray[] = $element;
            }
        }
    }
    $input = $tmpArray;
    return $input;
}

function _en2ar($text) {
    $obj = new I18N_Arabic('Transliteration');
    return $obj->en2ar($text);
}

function _ar2en($text) {
    $obj = new I18N_Arabic('Transliteration');
    return $obj->ar2en($text);
}

/**
 * Convert timestamp to arabic human readable format.
 * 
 * @param long $timestamp
 * @return string
 */
function _arabicDateFormat($timestamp) {
    $periods = array(
        "second" => "ثانية",
        "seconds" => "ثواني",
        "minute" => "دقيقة",
        "minutes" => "دقائق",
        "hour" => "ساعة",
        "hours" => "ساعات",
        "day" => "يوم",
        "days" => "أيام",
        "month" => "شهر",
        "months" => "شهور",
        "year" => "سنة",
        "years" => "سنوات",
    );

    $difference = (int) abs(time() - $timestamp);

    $plural = array(3, 4, 5, 6, 7, 8, 9, 10);

    $readable_date = "منذ ";

    if ($difference < 60) { // less than a minute
        $readable_date .= $difference . " ";
        if (in_array($difference, $plural)) {
            $readable_date .= $periods["seconds"];
        } else {
            $readable_date .= $periods["second"];
        }
    } elseif ($difference < (60 * 60)) { // less than an hour
        $diff = (int) ($difference / 60);
        $readable_date .= $diff . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["minutes"];
        } else {
            $readable_date .= $periods["minute"];
        }
    } elseif ($difference < (24 * 60 * 60)) { // less than a day
        $diff = (int) ($difference / (60 * 60));
        $readable_date .= $diff . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["hours"];
        } else {
            $readable_date .= $periods["hour"];
        }
    } elseif ($difference < (30 * 24 * 60 * 60)) { // less than a month
        $diff = (int) ($difference / (24 * 60 * 60));
        $readable_date .= $diff . " ";
        if (in_array($diff, $plural)) {
            $readable_date .= $periods["days"];
        } else {
            $readable_date .= $periods["day"];
        }
    } elseif ($difference < (365 * 24 * 60 * 60)) { // less than a year
        $diff = (int) ($difference / (30 * 24 * 60 * 60));
        $readable_date .= $diff . " ";

        if (in_array($diff, $plural)) {
            $readable_date .= $periods["months"];
        } else {
            $readable_date .= $periods["month"];
        }
    } elseif ($difference < (365 * 24 * 60 * 60 * 100)) { // less than a year
        $diff = (int) ($difference / (30 * 24 * 60 * 60 * 12));
        $readable_date .= $diff . " ";

        if (in_array($diff, $plural)) {
            $readable_date .= $periods["years"];
        } else {
            $readable_date .= $periods["year"];
        }
    } else {
        $readable_date = date("d-m-Y", $timestamp);
    }

    return $readable_date;
}

/**
 * Deep directory scan to list all files and directories located in the given path.
 *   
 * @param string $dir directory path 
 * @param bool [$include_dirs] include the sub directory pathes with the return result to not
 * @param array $results
 * @return array
 */
function _deepDirScan($dir, $include_dirs = false, array &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (in_array($value, [".", ".."])) {
            continue;
        }

        if (is_dir($path)) {
            _deepDirScan($path, $include_dirs, $results);
            if ($include_dirs) {
                $results[] = $path;
            }
        } else {
            $results[] = $path;
        }
    }

    return $results;
}

/**
 * dump the variables and kill the rest of page
 * @param  mixed $args string to be displayed after killing the page
 */
if (!function_exists('_dd')) {

    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function _dd() {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }

}


