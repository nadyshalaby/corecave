<?php
/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Forgers;

use App\Core\Support\Forger;


class Twig extends Forger{
    
    public static function getForgedClass() {
        return 'App\Core\DPL\Twig';
    }
}
