<?php

/**
 * This file is part of kodekit framework
 * 
 * copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Concretes;

use App\Libs\Statics\Cookie;
use App\Libs\Statics\Session;
use Locale;

class Request {

    public function isPost() {
        return ($_POST && !$this->hasParam('_method')) ? true : false;
    }

    public function isGet() {
        return ($_GET && !$this->hasParam('_method')) ? true : false;
    }

    public function isPut() {
        return ($this->isPost() && $this->getParam('_method') === 'PUT') ? true : false;
    }

    public function isDelete() {
        return ($this->isPost() && $this->getParam('_method') === 'DELETE') ? true : false;
    }

    public function isForeign() {
        $myDomain = $this->getFullUrl();
        $requestsSource = $this->getPrevUrl();

        return parse_url($myDomain, PHP_URL_HOST) !== parse_url($requestsSource, PHP_URL_HOST);
    }

    public function getParam($name) {
        return ($this->hasParam($name)) ? ($_REQUEST[$name]) : null;
    }

    public function pullParam($name) {
        if ($this->hasParam($name)) {
            $param = $this->getParam($name);
            $this->forgetParam($name);
            return $param;
        }
        return null;
    }

    public function hasParam($name) {
        return (isset($_REQUEST[$name])) && !empty($_REQUEST[$name]);
    }

    public function getParamNames() {
        return array_keys($_REQUEST);
    }

    public function getParamValues() {
        return array_values($_REQUEST);
    }

    public function getAllParams($as_obj = false) {
        return ($as_obj) ? arr2obg($_REQUEST) : $_REQUEST;
    }

    public function forgetParam($name) {
        unset($_REQUEST[$name]);
        return $this;
    }

    public function appendParam($name, $value = null) {
        if (is_array($name)) {
            foreach ($name as $key => $val) {
                $_REQUEST[$key] = $val;
            }
        }
        $_REQUEST[$name] = $value;
        return $this;
    }

    public function getFile($name) {
        if ($this->hasFile($name)) {
            return new Upload($_FILES[$name]);
        }
        return null;
    }

    public function forgetFile($name) {
        unset($_FILES[$name]);
        return $this;
    }

    public function getFiles($name) {
        if(isset($_FILES[$name]) && is_array($_FILES[$name]['name'])) {
            $files = $this->reArrayFiles($_FILES[$name]);
            $objs = [];
            foreach ($files as $file) {
                if ($file['error'] === 0) {
                    $objs[] = new Upload($file);
                }
            }
            return $objs;
        }
        return null;
    }

    public function pullFile($name) {
        if ($this->hasFile($name)) {
            $File = $this->getFile($name);
            $this->forgetFile($name);
            return $File;
        }
        return null;
    }

    public function hasFile($name) {
        return isset($_FILES[$name]) && $_FILES[$name]['error'] === 0;
    }

    public function getPageUrl() {
        return $this->SERVER('REQUEST_URI');
    }

    public function __get($name) {
        if ($this->hasParam($name)) {
            return $this->getParam($name);
        }

        if ($this->hasFile($name)) {
            return $this->getFile($name);
        }

        return null;
    }

    public function __set($name, $value) {
        $this->appendParam($name, $value);
    }

    public function getFullUrl($use_forwarded_host = false) {
        return $this->getBaseUrl($use_forwarded_host) . $this->SERVER('REQUEST_URI');
    }

    public function getBaseUrl($use_forwarded_host = false) {
        $ssl = (!empty($this->SERVER('HTTPS')) && $this->SERVER('HTTPS') == 'on' );
        $sp = strtolower($this->SERVER('SERVER_PROTOCOL'));
        $protocol = substr($sp, 0, strpos($sp, '/')) . ( ( $ssl ) ? 's' : '' );
        $port = $this->SERVER('SERVER_PORT');
        $port = ( (!$ssl && $port == '80' ) || ( $ssl && $port == '443' ) ) ? '' : ':' . $port;
        $host = ( $use_forwarded_host && !empty($this->SERVER('HTTP_X_FORWARDED_HOST')) ) ? $this->SERVER('HTTP_X_FORWARDED_HOST') : (!empty($this->SERVER('HTTP_HOST')) ? $this->SERVER('HTTP_HOST') : null );
        $host = isset($host) ? $host : $this->SERVER('SERVER_NAME') . $port;
        return $protocol . '://' . $host;
    }

    /**
     * Returns the name of the host getServer (such as www.w3schools.com)
     * return (type) (description)
     */
    public function getServerName() {
        return $this->SERVER('SERVER_NAME');
    }

    /**
     * Returns the IP address of the host getServer
     * return (type) (description)
     */
    public function getServerIp() {
        return $this->SERVER('SERVER_ADDR');
    }

    public function getServerPort() {
        return $this->SERVER('SERVER_PORT');
    }

    /**
     * Returns the getServer identification string (such as Apache/2.2.24)
     * return (type) (description)
     */
    public function getServerSoftware() {
        return $this->SERVER('SERVER_SOFTWARE');
    }

    public function getServerAdmin() {
        return $this->SERVER('SERVER_ADMIN');
    }

    /**
     * Returns the name and revision of the information protocol (such as HTTP/1.1)
     * return (type) (description)
     */
    public function getServerProtocol() {
        return $this->SERVER('SERVER_PROTOCOL');
    }

    /**
     * Returns the filename of the currently executing script
     * return (type) (description)
     */
    public function fileName() {
        return $this->SERVER('PHP_SELF');
    }

    public function getMethod() {
        return $this->SERVER('REQUEST_METHOD');
    }

    /**
     * Returns the timestamp of the start of the getRequest (such as 1377687496)
     * return (type) (description)
     */
    public function getRequestTimestamp() {
        return $this->SERVER('REQUEST_TIME');
    }

    public function getRequestLocale() {
        return Locale::acceptFromHttp($this->SERVER('HTTP_ACCEPT_LANGUAGE'));
    }

    /**
     * Returns the query string if the page is accessed via a query string
     * return (type) (description)
     */
    public function getRequestQueryString() {
        return $this->SERVER('QUERY_STRING');
    }

    /**
     * Returns the Accept_Charset header from the current getRequest (such as utf-8,ISO-8859-1)
     * return (type) (description)
     */
    public function getRequestCharset() {
        return $this->SERVER('HTTP_ACCEPT_CHARSET');
    }

    /**
     * Returns the complete URL of the current page (not reliable because not all getClient-agents
     * return (type) (description)
     */
    public function getPrevUrl() {
        return ($this->SERVER('HTTP_REFERER')) ? $this->SERVER('HTTP_REFERER') : null;
    }

    public function hasCookie($name) {
        return Cookie::has($name);
    }

    public function getCookie($name) {
        return Cookie::get($name);
    }

    public function allCookies($as_arr = false) {
        return Cookie::all($as_arr);
    }

    public function hasSession($name) {
        return Session::has($name);
    }

    public function getSession($name) {
        return Session::get($name);
    }

    public function allSession($as_arr = false) {
        return Session::all($as_arr);
    }

    public function getClientIP() {
        return $this->SERVER('REMOTE_ADDR');
    }

    public function getClientInfo($ip = NULL, $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $this->SERVER("REMOTE_ADDR");
            if ($deep_detect) {
                if (filter_var($this->SERVER('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP))
                    $ip = $this->SERVER('HTTP_X_FORWARDED_FOR');
                if (filter_var($this->SERVER('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP))
                    $ip = $this->SERVER('HTTP_CLIENT_IP');
            }
        }
        return unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    }

    public function getClientHost() {
        return $this->SERVER('REMOTE_HOST');
    }

    public function getClientPort() {
        return $this->SERVER('REMOTE_PORT');
    }

    /**
     * eg. (Chrome, firefox)
     * return (type) (description)
     */
    public function getClientBrowser() {
        return $this->browser('browser');
    }

    /**
     * eg. (Mozilla Foundation . Google Inc)
     * return (type) (description)
     */
    public function getClientBrowserMaker() {
        return $this->browser('browser_maker');
    }

    /**
     * eg. (32)
     * return (type) (description)
     */
    public function getClientBrowserBits() {
        return $this->browser('browser_bits');
    }

    /**
     * eg. (48.0, 43.0)
     * return (type) (description)
     */
    public function getClientBrowserVersion() {
        return $this->browser('version');
    }

    /**
     * eg. (Win8.1)
     * return (type) (description)
     */
    public function getClientOS() {
        return $this->browser('platform');
    }

    /**
     * eg. (64, 32)
     * return (type) (description)
     */
    public function getClientOSBits() {
        return $this->browser('platform_bits');
    }

    /**
     * eg. (Microsoft Corporation)
     * return (type) (description)
     */
    public function getClientOSMaker() {
        return $this->browser('platform_maker');
    }

    /**
     * eg. (Windows 8.1)
     * return (type) (description)
     */
    public function getClientOSDesc() {
        return $this->browser('platform_description');
    }

    /**
     * eg. (Windows Desktop)
     * return (type) (description)
     */
    public function getClientDevice() {
        return $this->browser('device_name');
    }

    public function isSecure() {
        if (!empty($this->SERVER('HTTPS')) && $this->SERVER('HTTPS') == 'on') {
            return true;
        }
        if (!empty($this->SERVER('HTTP_X_FORWARDED_PROTO')) && $this->SERVER('HTTP_X_FORWARDED_PROTO') == 'https') {
            return true;
        }

        return false;
    }

    public function isAjax() {
        return (!empty($this->SERVER('HTTP_X_REQUESTED_WITH')) && strtolower($this->SERVER('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest' );
    }

    /**
     * Helper Method for retrieving browser info
     * param  (type) $key (description)
     * return (type)      (description)
     */
    private function browser($key) {
        return (get_browser(null, true)[$key]) ? : '';
    }

    /**
     * Helper Method for retrieving browser info
     * param  (type) $key (description)
     * return (type)      (description)
     */
    public function SERVER($key) {
        return (isset($_SERVER[$key])) ? $_SERVER[$key] : null;
    }

    private function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

}
