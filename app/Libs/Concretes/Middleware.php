<?php

namespace App\Libs\Concretes;

abstract class Middleware {
   
    private $next ;
    
    public function setNext($next) {
        $this->next = $next;
    }
    
    public function getNext() {
        return $this->next;
    }
}
