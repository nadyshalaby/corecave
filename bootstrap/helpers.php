<?php

use App\Libs\Statics\Container;

function view($path, $args = []) {
    return View::show($path, $args);
}

function path($path) {
    return Url::path($path);
}

function twig($path = null, $args = []) {
    if ($path) {
        return View::twig($path, $args);
    }
    return View::getTwig();
}

function route($name, $args = []) {
    return Url::route($name, $args);
}

function flash($name, $content = null) {
    return Session::flash($name, $content);
}

function validate(array $data = null, array $param_rules = [], array $error_msgs = []) {
    if ($data) {
        return Validation::check($data, $param_rules, $error_msgs);
    }
    return Validation::getInstance();
}

function redirect($location, $with = [], $after = 0) {
    Response::redirectTo($location, $with, $after);
}

function goBack($with = [], $after = 0) {
    Response::redirectBack($with, $after);
}

function refresh($after = 0) {
    Response::refresh($after);
}

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function string_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

function array_fetch(array $array, $path_to_key, $default = null) {

    $path_to_key = multiexplode(['|', '/', '-', '>', ',', '.', ' '], $path_to_key);

    foreach ($path_to_key as $key) {
        $key = trim($key);
        if (isset($array[$key])) {
            $array = $array[$key];
        } else {
            $array = null;
            break;
        }
    }

    return $array ? $array : $default;
}

function array_merge_mixed() {
    $array = [];
    foreach (func_get_args() as $arg) {
        if (is_array($arg)) {
            $array = array_merge_recursive($array, $arg);
        } else if ($arg) {
            $array [] = $arg;
        }
    }
    return $array;
}

function uniqueFile($path, $filename) {
    $fileparts = explode('.', $filename);
    $fileext = end($fileparts);
    array_pop($fileparts);
    $fileorigin = implode('_', $fileparts);
    while (file_exists(path("$path/$filename"))) {
        $filename = "{$fileorigin}_" . rand(0, 99999) . ".$fileext";
    }
    return$filename;
}

/**
 * explode the the given string according to the specified array of delimiters
 * @param array $delimiters 
 * @param string $string 
 * @return array
 */
function multiexplode(array $delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return $launch;
}

/**
  Check whether the input is an array whose keys are all integers.
  @param[in] $InputArray          (array) Input array.
  @return                         (bool) \b true iff the input is an array whose keys are all integers.
 */
function isKeyIntArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_unique(array_map("is_int", array_keys($InputArray))) === array(true);
}

/**
  Check whether the input is an array whose keys are all strings.
  @param[in] $InputArray          (array) Input array.
  @return                         (bool) \b true iff the input is an array whose keys are all strings.
 */
function isKeyStringArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_unique(array_map("is_string", array_keys($InputArray))) === array(true);
}

/**
  Check whether the input is an array with at least one key being an integer and at least one key being a string.
  @param $InputArray          (array) Input array.
  @return                         (bool) \b true iff the input is an array with at least one key being an integer and at least one key being a string.
 */
function isKeyMixedArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return count(array_unique(array_map("is_string", array_keys($InputArray)))) >= 2;
}

/**
  Check whether the input is an array whose keys are numeric, sequential, and zero-based.
  @param[in] $InputArray          (array) Input array.
  @return                         (bool) \b true iff the input is an array whose keys are numeric, sequential, and zero-based.
 */
function isKeyNumZeroBasedArray($InputArray) {
    if (!is_array($InputArray)) {
        return false;
    }

    if (count($InputArray) <= 0) {
        return true;
    }

    return array_keys($InputArray) === range(0, count($InputArray) - 1);
}

function getClassBaseName($cls) {
    if (is_object($cls)) {
        $cls = get_class($cls);
    }
    $cls = explode('\\', $cls);
    return $cls[count($cls) - 1];
}

function loop(array $arr, Closure $callable) {
    foreach ($arr as $key => $value) {
        $arr[$key] = call_user_func_array($callable, [$key, $value]);
    }
    return $arr;
}

function arr2obg(array $arr) {
    return json_decode(json_encode($arr));
}

function obj2arr(object $obj) {
    return json_decode(json_encode($obj), true);
    ;
}

function scanImageToPng($source, $target = 'php://output') {
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

function slugify($text, $translate = false) {
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
        $text = ar2en($text);
    }

    $text = trim($text, ' -');

    $text = preg_replace_callback('/([A-Za-z0-9]+)/', function ($match) {
        return strtolower($match[0]);
    }, $text);

    return $text;
}

/**
 * @param array      $array
 * @param mixed      $position
 * @param mixed      $element
 */
function array_insert(&$array, $position, $element) {
    if (count($array) == 0) {
        $array[] = $element;
    } elseif (is_numeric($position) && $position < 0) {
        if ((count($array) + position) < 0) {
            $array = array_insert($array, $element, 0);
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

function insertBefore(&$input, $index, $element, $newKey = null) {
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

function insertAfter(&$input, $index, $element, $newKey = null) {
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

function en2ar($text) {
    $obj = new I18N_Arabic('Transliteration');
    return $obj->en2ar($text);
}

function ar2en($text) {
    $obj = new I18N_Arabic('Transliteration');
    return $obj->ar2en($text);
}

function arabic_date_format($timestamp) {
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
 * dump the variables and kill the rest of page
 * @param  mixed $args string to be displayed after killing the page
 */
if (!function_exists('dd')) {

    function dd() {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }

}


