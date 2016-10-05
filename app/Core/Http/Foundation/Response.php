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

use App\Core\Http\Bags\Cookies\Cookie;
use App\Core\Http\Bags\Sessions\Session;
use App\Core\Support\Config;
use App\Core\Support\Info\MimeType;
use App\Core\Support\Url;

class Response {

    protected $session;
    protected $cookie;

    public function __construct() {
        $this->session = new Session;
        $this->cookie = new Cookie;
    }

    public function withHeader($name, $value) {
        header("$name: $value");
        return $this;
    }

    /**
     * redirect to <pre>$location</pre> or any Error page
     * @param  string|Code $location url to move to 
     * @param  array $with params sent with the url
     * @param  int $after num of second to wait before redirecting
     * @return void
     */
    public function redirectTo($location, $with = [], $after = 0) {

        if (!empty($with)) {
            foreach ($with as $k => $v) {
                Request::appendParam($k, $v);
            }
        }
        if (empty($location)) {
            $location = Url::app();
        } else if (!empty($location) && $after > 0) {
            // Redriect with a after:
            header("Refresh: $after; url=$location");
            return;
        }
        header("Location: $location");

        return $this;
    }

    /**
     * redirect back or to home page if the previous url not found
     * @param  array $with params sent with the url
     * @param  int $after num of second to wait before redirecting
     * @return void
     */
    public function redirectBack($with = [], $after = 0) {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->redirectTo($_SERVER['HTTP_REFERER'], $with, $after);
        } else {
            $this->redirectTo(Url::app(), $with, $after);
        }
        return $this;
    }

    /**
     * Refresh the current page after <code>$after</code> sec(s)
     * @param  integer $after num of second to wait before redirecting
     * @return void        
     */
    public function refresh($after = 0) {
        $this->after($after, $_SERVER['SCRIPT_URI']);
        return $this;
    }

    public function withJson(...$args) {
        $this->setContentType(MimeType::extension('json'));
        return json_encode(...$args);
    }

    public function withStatus($status, $default_message = '' ,$content_type = 'text/html') {
            $this->setStatusHeader($status,$content_type);

            $error_page = Config::app("url.error.$status");
            die(empty($error_page) ? $default_message : _twig($error_page));
    }
    
    public function withNotFound($default_message = '' ,$content_type = 'text/html') {
        $this->withStatus(404, $default_message, $content_type);
    }

    public function setContentLength($long) {
        header("Content-Length: $long");
        return $this;
    }

    public function withSession($name, $value = null) {
        if (is_array($name)) {
            foreach ($name as $key => $val) {
                $this->session->put($key, $val);
            }
        } else {
            $this->session->put($name, $value);
        }
        return $this;
    }

    public function forgetSession($name) {
        $this->session->delete($name);
        return $this;
    }

    public function flushSessions() {
        $this->session->flush();
        return $this;
    }

    public function withCookie($name, $value, $expiry, $path = '/', $domain = null, $http_only = true) {
        $this->cookie->put($name, $value, $expiry, $path, $domain, $http_only);
        return $this;
    }

    public function forgetCookie($name) {
        $this->cookie->delete($name);
        return $this;
    }

    public function flushCookies() {
        $this->cookie->flush();
        return $this;
    }

    public function flash($name, $content = null) {
        $this->session->flash($name, $content);
        return $this;
    }

    public function setContentType($type, $charset = 'utf-8') {
        header("Content-Type: $type; charset=$charset");
        return $this;
    }

    public function setContentTypeForFile($filename) {
        header("Content‐Type: " . MimeType::file($filename));
        return $this;
    }

    public function write($data, $status = 200, $content_type = 'text/html') {
        $this->setStatusHeader($status, $content_type);
        echo $data;
        exit;
    }

    public function setStatusHeader($status, $content_type = 'text/html') {
        header("HTTP/1.1 " . $status . " " . $this->getStatusMessage($status));
        header("Content-Type:" . $content_type);
    }

    public function getStatusMessage($code) {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }

    public function download($filepath, $filename = '', $open_in_browser = false) {
        $filename = (empty($filename)) ? basename($filepath) : $filename;
        $filetype = ($open_in_browser) ? mime_content_type($filepath) : MimeType::MIME_TYPE_IF_UNKNOWN;
        $dispostion = ($open_in_browser) ? "inline" : "attachment";
        $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        if (stristr($filename, $ext) == FALSE) {
            $filename .= ".$ext";
        }
        ob_clean(); // Clear any previously written headers in the output buffer

        if (ini_get('zlib.output_compression')) {
            ini_set('zlib.output_compression', 'Off');
        }

        $content = file_get_contents($filepath);
        header('Content-Type: ' . $filetype);
        header('Content-Length: ' . strlen($content));
        header('Content-disposition: ' . $dispostion . '; filename="' . $filename . '"');
        header('Cache-Control: private,false, must-revalidate,post-check=0, pre-check=0, max-age=0');
        header("Content-Transfer-Encoding: binary");
        header('Pragma: public');
        header('Expires: 0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        echo $content;
        return $this;
    }

}
