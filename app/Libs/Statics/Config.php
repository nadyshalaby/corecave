<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Statics;

use App\Libs\Exceptions\FileNotFoundException;

abstract class Config {

    public static function __callStatic($name, $path) {
        $filename = __DIR__ . "/../../../config/$name.php";
        if (file_exists($filename)) {
            if ($path) {
                $config = include $filename;
                return array_fetch($config, $path[0]);
                
            } else {
                return $filename;
            }
        }
        throw new FileNotFoundException('File Not Found Exception');
    }

}
