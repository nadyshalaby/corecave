<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\DPL;

class View {

    

    public function show($path, $params = []) {
        foreach ($params as $key => $value) {
            if (is_numeric($key)) {
                continue;
            }
            ${$key} = $value;
        }
        $pagename = _multiexplode(['.', '/', '>', '|'], $path)[0];
        require_once _path('resources.views.' . $path . 'php');
    }

   
}
