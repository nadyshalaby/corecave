<?php

namespace App\Core\Support\Validation;

class ValidationErrors {

    protected $_errors = [];
    protected $_msgs = [];
    protected $_data = [];

    public function __construct(array $msgs, array $data) {
        $this->_msgs = $msgs;
        $this->_data = $data;
    }

    public function pullError($field, $rule = null) {
        if ($this->hasError($field, $rule)) {
            $error = $this->getError($field, $rule);
            $this->forgetError($field, $rule);
            return $error;
        }

        if ($this->hasError($field)) {
            $error = $this->getError($field);
            $this->forgetError($field);
            return $error;
        }

        return null;
    }

    public function clearErrors() {
        unset($this->_errors);
        unset($this->_data);
    }

    public function setError($field, $rule, $error) {
        $this->_errors[$field][$rule] = (isset($this->_msgs[$field][$rule])) ? $this->_msgs[$field][$rule] : $error;
        return $this;
    }

    public function hasError($field = null, $rule = null) {
        
        if (empty($field)) {
            return !empty($this->_errors);
        }
        if(!isset($this->_errors[$field])){
            return false;
        }
        
        if (!empty($rule)) {
            return isset($this->_errors[$field][$rule]);
        }
        
        return true;
    }

    public function forgetError($field, $rule = null) {
        if ($this->hasError($field, $rule)) {
            unset($this->_errors[$field][$rule]);
            return true;
        }
        if ($this->hasError($field)) {
            unset($this->_errors[$field]);
            return true;
        }
        return false;
    }

    public function getError($field, $rule = null) {
        if (!$this->hasError($field)) {
            return null;
        }
        if (!empty($rule)) {
            return $this->hasError($field, $rule) ? $this->_errors[$field][$rule] : null;
        }
        return $this->_errors[$field];
    }

    public function getData($field) {
        if (empty($this->_data)) {
            return null;
        }
        if (empty($this->_data[$field])) {
            return null;
        }

        return $this->_data[$field];
    }

    public function pullData($field) {
        if (empty($this->_data)) {
            return null;
        }
        if (empty($this->_data[$field])) {
            return null;
        }
        $res = $this->_data[$field];
        unset($this->_data[$field]);
        return $res;
    }

    public function allErrors() {
        $msgs = [];
        foreach ($this->_errors as $msg_arr) {
            foreach ($msg_arr as $msg) {
                $msgs [] = $msg;
            }
        }
        return $msgs;
    }

}
