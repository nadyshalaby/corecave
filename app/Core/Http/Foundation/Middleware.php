<?php
/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Http\Foundation;

abstract class Middleware {
   
    private $next ;
    
    public function setNext($next) {
        $this->next = $next;
    }
    
    public function getNext() {
        return $this->next;
    }
}
