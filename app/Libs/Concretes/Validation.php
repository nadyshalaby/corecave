<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Concretes;

use function escape;

class Validation {

    private $_errors = [];
    private $_msgs = [];
    private $zip = [
        "GB" => "GIR[ ]?0AA|((AB|AL|B|BA|BB|BD|BH|BL|BN|BR|BS|BT|CA|CB|CF|CH|CM|CO|CR|CT|CV|CW|DA|DD|DE|DG|DH|DL|DN|DT|DY|E|EC|EH|EN|EX|FK|FY|G|GL|GY|GU|HA|HD|HG|HP|HR|HS|HU|HX|IG|IM|IP|IV|JE|KA|KT|KW|KY|L|LA|LD|LE|LL|LN|LS|LU|M|ME|MK|ML|N|NE|NG|NN|NP|NR|NW|OL|OX|PA|PE|PH|PL|PO|PR|RG|RH|RM|S|SA|SE|SG|SK|SL|SM|SN|SO|SP|SR|SS|ST|SW|SY|TA|TD|TF|TN|TQ|TR|TS|TW|UB|W|WA|WC|WD|WF|WN|WR|WS|WV|YO|ZE)(\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}))|BFPO[ ]?\d{1,4}",
        "JE" => "JE\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}",
        "GG" => "GY\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}",
        "IM" => "IM\d[\dA-Z]?[ ]?\d[ABD-HJLN-UW-Z]{2}",
        "US" => "\d{5}([ \-]\d{4})?",
        "CA" => "[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ ]?\d[ABCEGHJ-NPRSTV-Z]\d",
        "DE" => "\d{5}",
        "JP" => "\d{3}-\d{4}",
        "FR" => "\d{2}[ ]?\d{3}",
        "AU" => "\d{4}",
        "IT" => "\d{5}",
        "CH" => "\d{4}",
        "AT" => "\d{4}",
        "ES" => "\d{5}",
        "NL" => "\d{4}[ ]?[A-Z]{2}",
        "BE" => "\d{4}",
        "DK" => "\d{4}",
        "SE" => "\d{3}[ ]?\d{2}",
        "NO" => "\d{4}",
        "BR" => "\d{5}[\-]?\d{3}",
        "PT" => "\d{4}([\-]\d{3})?",
        "FI" => "\d{5}",
        "AX" => "22\d{3}",
        "KR" => "\d{3}[\-]\d{3}",
        "CN" => "\d{6}",
        "TW" => "\d{3}(\d{2})?",
        "SG" => "\d{6}",
        "DZ" => "\d{5}",
        "AD" => "AD\d{3}",
        "AR" => "([A-HJ-NP-Z])?\d{4}([A-Z]{3})?",
        "AM" => "(37)?\d{4}",
        "AZ" => "\d{4}",
        "BH" => "((1[0-2]|[2-9])\d{2})?",
        "BD" => "\d{4}",
        "BB" => "(BB\d{5})?",
        "BY" => "\d{6}",
        "BM" => "[A-Z]{2}[ ]?[A-Z0-9]{2}",
        "BA" => "\d{5}",
        "IO" => "BBND 1ZZ",
        "BN" => "[A-Z]{2}[ ]?\d{4}",
        "BG" => "\d{4}",
        "KH" => "\d{5}",
        "CV" => "\d{4}",
        "CL" => "\d{7}",
        "CR" => "\d{4,5}|\d{3}-\d{4}",
        "HR" => "\d{5}",
        "CY" => "\d{4}",
        "CZ" => "\d{3}[ ]?\d{2}",
        "DO" => "\d{5}",
        "EC" => "([A-Z]\d{4}[A-Z]|(?:[A-Z]{2})?\d{6})?",
        "EG" => "\d{5}",
        "EE" => "\d{5}",
        "FO" => "\d{3}",
        "GE" => "\d{4}",
        "GR" => "\d{3}[ ]?\d{2}",
        "GL" => "39\d{2}",
        "GT" => "\d{5}",
        "HT" => "\d{4}",
        "HN" => "(?:\d{5})?",
        "HU" => "\d{4}",
        "IS" => "\d{3}",
        "IN" => "\d{6}",
        "ID" => "\d{5}",
        "IL" => "\d{5}",
        "JO" => "\d{5}",
        "KZ" => "\d{6}",
        "KE" => "\d{5}",
        "KW" => "\d{5}",
        "LA" => "\d{5}",
        "LV" => "\d{4}",
        "LB" => "(\d{4}([ ]?\d{4})?)?",
        "LI" => "(948[5-9])|(949[0-7])",
        "LT" => "\d{5}",
        "LU" => "\d{4}",
        "MK" => "\d{4}",
        "MY" => "\d{5}",
        "MV" => "\d{5}",
        "MT" => "[A-Z]{3}[ ]?\d{2,4}",
        "MU" => "(\d{3}[A-Z]{2}\d{3})?",
        "MX" => "\d{5}",
        "MD" => "\d{4}",
        "MC" => "980\d{2}",
        "MA" => "\d{5}",
        "NP" => "\d{5}",
        "NZ" => "\d{4}",
        "NI" => "((\d{4}-)?\d{3}-\d{3}(-\d{1})?)?",
        "NG" => "(\d{6})?",
        "OM" => "(PC )?\d{3}",
        "PK" => "\d{5}",
        "PY" => "\d{4}",
        "PH" => "\d{4}",
        "PL" => "\d{2}-\d{3}",
        "PR" => "00[679]\d{2}([ \-]\d{4})?",
        "RO" => "\d{6}",
        "RU" => "\d{6}",
        "SM" => "4789\d",
        "SA" => "\d{5}",
        "SN" => "\d{5}",
        "SK" => "\d{3}[ ]?\d{2}",
        "SI" => "\d{4}",
        "ZA" => "\d{4}",
        "LK" => "\d{5}",
        "TJ" => "\d{6}",
        "TH" => "\d{5}",
        "TN" => "\d{4}",
        "TR" => "\d{5}",
        "TM" => "\d{6}",
        "UA" => "\d{5}",
        "UY" => "\d{5}",
        "UZ" => "\d{6}",
        "VA" => "00120",
        "VE" => "\d{4}",
        "ZM" => "\d{5}",
        "AS" => "96799",
        "CC" => "6799",
        "CK" => "\d{4}",
        "RS" => "\d{6}",
        "ME" => "8\d{4}",
        "CS" => "\d{5}",
        "YU" => "\d{5}",
        "CX" => "6798",
        "ET" => "\d{4}",
        "FK" => "FIQQ 1ZZ",
        "NF" => "2899",
        "FM" => "(9694[1-4])([ \-]\d{4})?",
        "GF" => "9[78]3\d{2}",
        "GN" => "\d{3}",
        "GP" => "9[78][01]\d{2}",
        "GS" => "SIQQ 1ZZ",
        "GU" => "969[123]\d([ \-]\d{4})?",
        "GW" => "\d{4}",
        "HM" => "\d{4}",
        "IQ" => "\d{5}",
        "KG" => "\d{6}",
        "LR" => "\d{4}",
        "LS" => "\d{3}",
        "MG" => "\d{3}",
        "MH" => "969[67]\d([ \-]\d{4})?",
        "MN" => "\d{6}",
        "MP" => "9695[012]([ \-]\d{4})?",
        "MQ" => "9[78]2\d{2}",
        "NC" => "988\d{2}",
        "NE" => "\d{4}",
        "VI" => "008(([0-4]\d)|(5[01]))([ \-]\d{4})?",
        "PF" => "987\d{2}",
        "PG" => "\d{3}",
        "PM" => "9[78]5\d{2}",
        "PN" => "PCRN 1ZZ",
        "PW" => "96940",
        "RE" => "9[78]4\d{2}",
        "SH" => "(ASCN|STHL) 1ZZ",
        "SJ" => "\d{4}",
        "SO" => "\d{5}",
        "SZ" => "[HLMS]\d{3}",
        "TC" => "TKCA 1ZZ",
        "WF" => "986\d{2}",
        "XK" => "\d{5}",
        "YT" => "976\d{2}",
    ];

    /**
     * Checks if the given array follows the specified rules on each field passed.eg
     * <b>Example:</b>
     * <pre>
     * 	Validation::check($array,[
     * 	                              		'password' => [
     *    	                               		'required' => true,
     *                                                  'field' => 'nr_password', // st_password,nr_password,username,url,color,ip,tag,email,phone;
     * 		                               		'min' => 2,
     * 		                               		'max' => 20,
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
     * 	if (Validation::passed()){
     * 		echo 'Ok';
     * 	}else{
     * 		echo '<pre>',print_r(Validation::getErrors()),'</pre>';
     * 	}
     * </pre>
     * @param array $data 
     * @param array $param_rules 
     * @return obj|boolean
     */
    public function check(array $data, array $param_rules = [], array $error_msgs = []) {
        $this->_msgs = $error_msgs;
        if (count($param_rules)) {
            $this->_errors = [];
            foreach ($param_rules as $param => $rules) {
                $param = escape(trim($param));
                $param_value = null;
                if (isset($data[$param])) {
                    $param_value = escape(trim($data[$param]));
                }
                $title = $param;
                if (isset($rules['title']) && !empty($rules['title'])) {
                    $title = $rules['title'];
                }
                foreach ($rules as $rule => $rule_value) {
                    switch ($rule) {
                        case 'required':
                            if ($rule_value === true && empty($param_value)) {
                                $this->addError($param, $rule, "{$title} is required!");
                            }
                            break;
                        case 'min':
                            if ($rule_value && !empty($param_value) && strlen($param_value) < $rule_value) {
                                $this->addError($param, $rule, "{$title} must be at least {$rule_value} chars!");
                            }
                            break;
                        case 'max':
                            if ($rule_value && !empty($param_value) && !empty($param_value) && strlen($param_value) > $rule_value) {
                                $this->addError($param, $rule, "{$title} must be maximum {$rule_value} chars!");
                            }
                            break;
                        case 'matches':
                            if ($rule_value && !empty($param_value) && strcmp($param_value, $data[$rule_value]) != 0) {
                                $sec_title = $rule_value;
                                if (isset($param_rules[$rule_value]['title']) && !empty($param_rules[$rule_value]['title'])) {
                                    $sec_title = $param_rules[$rule_value]['title'];
                                }
                                $this->addError($param, $rule, "{$title} & {$sec_title} don't match!");
                            }
                            break;
                        case 'equals':
                            if (count($rule_value) && !empty($param_value) && !in_array($param_value, $rule_value)) {
                                $this->addError($param, $rule, "{$title} must be one of  [ " . implode(', ', $rule_value) . " ]!");
                            }
                            break;
                        case 'range':
                            if (count($rule_value) && !empty($param_value)) {
                                $res = '';
                                if (!empty($rule_value['low'])) {
                                    if (!($param_value >= $rule_value['low'])) {
                                        $res .= "greater than or equal {$rule_value['low']} ";
                                    }
                                }
                                if (!empty($rule_value['high'])) {
                                    if (!($param_value <= $rule_value['high'])) {
                                        $res .= "lower than or equal {$rule_value['high']} ";
                                    }
                                }

                                if (!empty($res)) {
                                    $this->addError($param, $rule, "{$title} must be a value $res");
                                }
                            }
                            break;
                        case 'zip':
                            if (!empty($param_value)) {

                                if (is_array($rule_value) && count($rule_value)) {
                                    $check = false;
                                    foreach ($rule_value as $country) {
                                        if (array_key_exists($country, $this->zip)) {
                                            if (preg_match("/" . $this->zip[$country] . "/", $param_value)) {
                                                $check = true;
                                                break;
                                            }
                                        }
                                    }

                                    if (!$check) {
                                        $this->addError($param, $rule, "{$title} must match the rules of one of the following countries [ " . implode(', ', $rule_value) . " ]!");
                                    }
                                } else if (is_string($rule_value) && array_key_exists($rule_value, $this->zip)) {
                                    if (!preg_match("/" . $this->zip[$rule_value] . "/", $param_value)) {
                                        $this->addError($param, $rule, "{$title} must match the rules of the following country $rule_value");
                                    }
                                }
                            }
                            break;
                        case 'alpha':
                            if ($rule_value === true && !empty($param_value) && !empty($param_value) && !preg_match('/^[a-zA-Z]+$/', $param_value, $matches)) {
                                $this->addError($param, $rule, "{$title} must be alphabetic chars!");
                            }
                            break;
                        case 'alpha_space':
                            if ($rule_value === true && !empty($param_value) && !empty($param_value) && !preg_match('/^[ a-zA-Z]+$/', $param_value, $matches)) {
                                $this->addError($param, $rule, "{$title} must be alphabetic chars and spaces! ");
                            }
                            break;
                        case 'unicode':
                            if ($rule_value === true && !empty($param_value) && !empty($param_value) && !preg_match('/^[a-zA-Z\pL]+$/u', $param_value, $matches)) {
                                $this->addError($param, $rule, "{$title} must be alphabetic chars!");
                            }
                            break;
                        case 'unicode_space':
                            if ($rule_value === true && !empty($param_value) && !empty($param_value) && !preg_match('/^[ a-zA-Z\pL]+$/u', $param_value, $matches)) {
                                $this->addError($param, $rule, "{$title} must be alphabetic chars and spaces! ");
                            }
                            break;
                        case 'unicode_num':
                            if ($rule_value === true && !empty($param_value) && !empty($param_value) && !preg_match('/^[0-9a-zA-Z\pL]+$/u', $param_value, $matches)) {
                                $this->addError($param, $rule, "{$title} must be alphabetic chars and spaces! ");
                            }
                            break;
                        case 'num':
                            if (!empty($param_value)) {

                                if ($rule_value === true && !is_numeric($param_value)) {
                                    $this->addError($param, $rule, "{$title} must be numeric values!");
                                } else if ($rule_value === false && preg_match('/[0-9]/', $param_value)) {
                                    $this->addError($param, $rule, "{$title} mustn't contains numeric values!");
                                }
                            }
                            break;
                        case 'alpha_num':
                            if ($rule_value === true && !empty($param_value) && !preg_match('/(?:[a-zA-Z]+[0-9 ]+)|(?:[0-9 ]+[a-zA-Z]+)/', $param_value)) {
                                $this->addError($param, $rule, "{$title} must contain alphabetic and numeric chars!");
                            }
                            break;
                        case 'regexp':
                            if ($rule_value && !empty($param_value) && !preg_match($rule_value, $param_value)) {
                                $this->addError($param, $rule, "{$title} must be matches this pattern {$rule_value} !");
                            }
                            break;
                        case 'unique':
                            if ($rule_value && !empty($param_value)) {
                                if (!empty(DB::getInstance()->select(false, $rule_value, null, "$param = ?", [$param_value]))) {
                                    $this->addError($param, $rule, "{$title} already exists!");
                                }
                            }
                            break;
                        case 'field':
                            if (!empty($param_value)) {
                                switch ($rule_value) {
                                    case 'st_password':
                                        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', $param_value)) {
                                            $this->addError($param, $rule, "The password must contains at least one capital letter, one small letter, one digit, and one special character!");
                                        }
                                        break;
                                    case 'nr_password':
                                        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $param_value)) {
                                            $this->addError($param, $rule, "The password must contains at least one capital letter, one small letter, one digit!");
                                        }
                                        break;
                                    case 'username':
                                        if (!preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $param_value)) {
                                            $this->addError($param, $rule, "The username may contains alphanumeric, dashes and underscores only , min = 3 and max = 20!");
                                        }
                                        break;
                                    case 'url':
                                        if (!preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $param_value)) {
                                            $this->addError($param, $rule, "The url is invalid!");
                                        }
                                        break;
                                    case 'color':
                                        if (!preg_match('/^#?([a-f0-9]{6}|[a-f0-9]{3})$/', $param_value)) {
                                            $this->addError($param, $rule, "The color is invalid!");
                                        }
                                        break;
                                    case 'ip':
                                        if (!preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $param_value)) {
                                            $this->addError($param, $rule, "The ip is invalid!");
                                        }
                                        break;
                                    case 'tag':
                                        if (!preg_match('/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/', $param_value)) {
                                            $this->addError($param, $rule, "The tag is invalid!");
                                        }
                                        break;
                                    case 'email':
                                        if (!preg_match('/([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/', $param_value)) {
                                            $this->addError($param, $rule, "The {$title} must be a valid one!");
                                        }
                                        break;
                                    case 'phone':
                                        if (!preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $param_value) || strlen($param_value) < 10) {
                                            $this->addError($param, $rule, "The {$title} must be a valid one!");
                                        }
                                        break;
                                }
                            }
                            break;
                    }
                }
            }
        }

        return $this;
    }

    public function passed() {
        if (empty($this->_errors)) {
            return true;
        }
        return false;
    }

    private function addError($field, $rule, $error) {
        $this->_errors[$field][$rule] = (isset($this->_msgs[$field][$rule])) ? $this->_msgs[$field][$rule] : $error;
    }

    public function withMsgs(array $error_msgs = []) {
        foreach ($error_msgs as $field => $rules) {
            foreach ($rules as $rule => $msg) {
                if (isset($this->_errors[$field][$rule])) {
                    $this->_errors[$field][$rule] = $msg;
                }
            }
        }
        return $this;
    }

    public function getErrorsFor($param = '',$rule = '') {
        if (!empty($param) && key_exists($param, $this->_errors)) {
            if(isset($this->_errors[$param][$rule])){         
                 return $this->_errors[$param][$rule];
            }
            return $this->_errors[$param];
        }
        return array_values($this->_errors);
    }

    public function getAllErrorMsgs() {
        $msgs = [];
        foreach ($this->_errors as $param => $msg_arr) {
            foreach ($msg_arr as $msg) {
                $msgs [] = $msg;
            }
        }
        return $msgs;
    }

}
