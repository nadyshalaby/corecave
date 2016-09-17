<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Support\Validation;

use App\Core\DAL\DB;
use App\Core\Exceptions\ValidationRuleNotFoundExecption;
use function _escape;

class Validator {

    protected $_errors;
    protected $_zip = [
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
     * 	if (Validation::passed()){
     * 		echo 'Ok';
     * 	}else{
     * 		echo '<pre>',print_r(Validation::getErrors()),'</pre>';
     * 	}
     * </pre>
     * @param array $data 
     * @param array $fields_rules 
     * @return obj|boolean
     */
    public function __construct() {
        $this->_errors = new ValidationErrors([], []);
    }
    public function validate(array $data, array $fields_rules = [], array $msgs = []) {
        if (count($fields_rules)) {
            $this->_errors = new ValidationErrors($msgs, $data);

            foreach ($fields_rules as $field => $rules) {
                $field_value = null;
                if (isset($data[$field]) && !empty(trim($data[$field]))) {
                    $field_value = _escape($data[$field]);
                }

                if (!isset($rules['title'])) {
                    $rules['title'] = $field;
                }

                foreach ($rules as $rule => $rule_value) {
                    if ($rule === 'title') {
                        continue;
                    }

                    if (!method_exists($this, $rule . 'Rule')) {
                        throw new ValidationRuleNotFoundExecption("The rule \"$rule\" couldn't be found.");
                    }

                    if (!call_user_func_array([$this, $rule . 'Rule'], [$field, $rule_value, $data])) {
                        $error = (method_exists($this, $rule . 'Msg')) ? call_user_func_array([$this, $rule . 'Msg'], [$rules['title'], $field, $rule_value, $data]) : "{$rules['title']} contains errors.";
                        $this->_errors->setError($field, $rule, $error);
                    }
                }
            }
        }
        return $this;
    }

    /*     * **************************************************************************************** */

    public function requiredRule($field, $rule_value, $data) {
        return $rule_value === !empty(trim($data[$field]));
    }

    public function requiredMsg($title, $field, $rule_value, $data) {
        return "{$title} is required.";
    }

    /*     * **************************************************************************************** */

    public function fieldRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        switch ($rule_value) {
            case 'st_password':
                return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', $data[$field]));
            case 'nr_password':
                return (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $data[$field]));
            case 'username':
                return (preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $data[$field]));
            case 'url':
                return (filter_var($data[$field], FILTER_VALIDATE_URL));
            case 'color':
                return (preg_match('/^#?([a-f0-9]{6}|[a-f0-9]{3})$/', $data[$field]));
            case 'ip':
                return (filter_var($data[$field], FILTER_VALIDATE_IP));
            case 'mac' :
                return (filter_var($data[$field], FILTER_VALIDATE_MAC));
            case 'tag':
                return (preg_match('/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/', $data[$field]));
            case 'email':
                return (filter_var($data[$field], FILTER_VALIDATE_EMAIL));
            case 'phone':
                return (preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $data[$field]));
        }
        return true;
    }

    public function fieldMsg($title, $field, $rule_value, $data) {
        switch ($rule_value) {
            case 'st_password':
                return "The {$title} must contains at least one capital letter, one small letter, one digit, and one special character.";
            case 'nr_password':
                return "The {$title} must contains at least one capital letter, one small letter, one digit.";
            case 'username':
                return "The {$title} may contains alphanumeric, dashes and underscores only , min = 3 and max = 20.";
            case 'url':
                return "The {$title} is invalid url.";
            case 'color':
                return "The {$title} is invalid color.";
            case 'ip':
                return "The {$title} is invalid ip.";
            case 'tag':
                return "The {$title} is invalid tag.";
            case 'email':
                return "The {$title} is invalid email.";
            case 'phone':
                return "The {$title} is invalid number.";
        }
    }

    /*     * **************************************************************************************** */

    public function minRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        if (is_numeric($rule_value)) {
            if (is_string($data[$field])) {
                return strlen($data[$field]) >= $rule_value;
            }
            return $data[$field] >= $rule_value;
        }
        return true;
    }

    public function minMsg($title, $field, $rule_value, $data) {
        if (is_string($data[$field])) {
            return "{$title} must be at least {$rule_value} characters.";
        }
        return "{$title} must be at less than or equal {$rule_value}.";
    }

    /*     * **************************************************************************************** */

    public function maxRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        if ($rule_value) {
            if (is_string($data[$field])) {
                return strlen($data[$field]) <= $rule_value;
            }
            return $data[$field] <= $rule_value;
        }

        return true;
    }

    public function maxMsg($title, $field, $rule_value, $data) {
        if (is_string($data[$field])) {
            return "{$title} must be at maximum {$rule_value} characters.";
        }
        return "{$title} must be at greater than or equal {$rule_value}.";
    }

    /*     * **************************************************************************************** */

    public function uniqueRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        if (!$rule_value) {
            return true;
        }

        if (is_string($rule_value)) {
            return empty(DB::getInstance()->select(false, $rule_value, null, "$field = ?", [$data[$field]]));
        } else if (is_array($rule_value) && isset($rule_value['table'])) {
            $col = isset($rule_value['col']) ? $rule_value['col'] : $field;
            $pk = isset($rule_value['pk']) ? $rule_value['pk'] : 'id';
            $pv = isset($rule_value['pv']) ? $rule_value['pv'] : null;

            $where = "$col = ?";
            $bindings = [$data[$field]];
            if ($pv) {
                $where .= " AND $pk <> ?";
                $bindings[] = $pv;
            }

            return empty(DB::getInstance()->select(false, $rule_value['table'], null, $where, $bindings));
        }
        return true;
    }

    public function uniqueMsg($title, $field, $rule_value, $data) {
        return "{$title} is already in use.";
    }

    /*     * **************************************************************************************** */

    public function alphaRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === preg_match('/^[a-zA-Z]+$/', $data[$field]));
    }

    public function alphaMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must be alphabetic characters.";
        } else {

            return "{$title} mustn't be alphabetic characters.";
        }
    }

    /*     * **************************************************************************************** */

    public function alpha_spaceRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
        return ($rule_value === preg_match('/^[ a-zA-Z]+$/', $data[$field]));
    }

    public function alpha_spaceMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must be alphabetic characters and spaces.";
        } else {

            return "{$title} mustn't be alphabetic characters and spaces.";
        }
    }

    /*     * **************************************************************************************** */

    public function unicodeRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === preg_match('/^[a-zA-Z\pL]+$/u', $data[$field]));
    }

    public function unicodeMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must be alphabetic characters.";
        } else {

            return "{$title} mustn't be alphabetic characters.";
        }
    }

    /*     * **************************************************************************************** */

    public function unicode_spaceRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === preg_match('/^[ a-zA-Z\pL]+$/u', $data[$field]));
    }

    public function unicode_spaceMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must be alphabetic characters and spaces.";
        } else {
            return "{$title} mustn't be alphabetic characters and spaces.";
        }
    }

    /*     * **************************************************************************************** */

    public function numRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === is_numeric($data[$field]));
    }

    public function numMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must be numeric values.";
        } else {
            return "{$title} mustn't contains numeric values.";
        }
    }

    /*     * **************************************************************************************** */

    public function alpha_numRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === preg_match('/(?:[a-zA-Z]+[0-9 ]+)|(?:[0-9 ]+[a-zA-Z]+)/', $data[$field]));
    }

    public function alpha_numMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {
            return "{$title} must contain alphabetic and numeric characters.";
        } else {

            return "{$title} mustn't contain alphabetic and numeric characters.";
        }
    }

    /*     * **************************************************************************************** */

    public function unicode_numRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        return ($rule_value === preg_match('/^[0-9a-zA-Z\pL]+$/u', $data[$field]));
    }

    public function unicode_numMsg($title, $field, $rule_value, $data) {
        if ($rule_value === true) {

            return "{$title} must be alphabetic characters and spaces.";
        } else {
            return "{$title} mustn't be alphabetic characters and spaces.";
        }
    }

    /*     * **************************************************************************************** */

    public function zipRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }

        if (is_array($rule_value) && count($rule_value)) {
            foreach ($rule_value as $country) {
                if (array_key_exists($country, $this->_zip)) {
                    if (preg_match("/" . $this->_zip[$country] . "/", $data[$field])) {
                        return true;
                    }
                }
            }
        } else if (is_string($rule_value) && array_key_exists($rule_value, $this->zip)) {
            if (preg_match("/" . $this->zip[$rule_value] . "/", $data[$field])) {
                return true;
            }
        }

        return false;
    }

    public function zipMsg($title, $field, $rule_value, $data) {
        if (is_array($rule_value)) {
            return "{$title} must match the rules of one of the following countries [ " . implode(', ', $rule_value) . " ].";
        } else if (is_string($rule_value)) {
            return "{$title} must match the rules of the following country $rule_value";
        }
    }

    /*     * **************************************************************************************** */

    public function regexpRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
        return ($rule_value && preg_match($rule_value, $data[$field]));
    }

    public function regexpMsg($title, $field, $rule_value, $data) {
        return "{$title} must be matches this pattern {$rule_value} .";
    }

    /*     * **************************************************************************************** */

    public function matchesRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
        return ($rule_value && strcmp($data[$field], $data[$rule_value]) != 0);
    }

    public function matchesMsg($title, $field, $rule_value, $data) {
        return "{$title} & {$data[$rule_value]['title']} don't match.";
    }

    /*     * **************************************************************************************** */

    public function equalsRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
        return (count($rule_value) && !in_array($data[$field], $rule_value));
    }

    public function equalsMsg($title, $field, $rule_value, $data) {
        return "{$title} must be one of  [ " . implode(', ', $rule_value) . " ].";
    }

    /*     * **************************************************************************************** */

    public function alpha_dashRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
    }

    public function alpha_dashMsg($title, $field, $rule_value, $data) {
        return "{$title} is required.";
    }

    /*     * **************************************************************************************** */

    public function unicode_dashRule($field, $rule_value, $data) {
        if (empty(trim($data[$field]))) {
            return true;
        }
    }

    public function unicode_dashMsg($title, $field, $rule_value, $data) {

        return "{$title} is required.";
    }

    /*     * **************************************************************************************** */

    public function failed() {
        return $this->_errors->hasError();
    }

    public function passed() {
        return !$this->failed();
    }

    public function errors() {
        return ($this->failed())? $this->_errors : null;
    }

    public function withMsgs(array $msgs = []) {
        foreach ($msgs as $field => $rules) {
            foreach ($rules as $rule => $msg) {
                if ($this->_errors->hasError($field, $rule)) {
                    $this->_errors->setError($field, $rule, $msg);
                }
            }
        }
        return $this;
    }

    public function getInstance() {
        return $this;
    }

}
