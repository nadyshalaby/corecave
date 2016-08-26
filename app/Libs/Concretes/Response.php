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

use App\Libs\Statics\Config;
use App\Libs\Statics\Cookie;
use App\Libs\Statics\Session;
use App\Libs\Statics\Url;

class Response {

    const TYPE_php = 'text/plain';
    const TYPE_au = 'audio/basic';
    const TYPE_avi = 'video/msvideo, video/avi, video/x-msvideo';
    const TYPE_bmp = 'image/bmp';
    const TYPE_bz2 = 'application/x-bzip2';
    const TYPE_css = 'text/css';
    const TYPE_dtd = 'application/xml-dtd';
    const TYPE_doc = 'application/msword';
    const TYPE_docx = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    const TYPE_dotx = 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
    const TYPE_es = 'application/ecmascript';
    const TYPE_exe = 'application/octet-stream';
    const TYPE_gif = 'image/gif';
    const TYPE_gz = 'application/x-gzip';
    const TYPE_hqx = 'application/mac-binhex40';
    const TYPE_html = 'text/html';
    const TYPE_jar = 'application/java-archive';
    const TYPE_jpg = 'image/jpeg';
    const TYPE_js = 'application/x-javascript';
    const TYPE_midi = 'audio/x-midi';
    const TYPE_mp3 = 'audio/mpeg';
    const TYPE_mpeg = 'video/mpeg';
    const TYPE_ogg = 'audio/vorbis, application/ogg';
    const TYPE_pdf = 'application/pdf';
    const TYPE_pl = 'application/x-perl';
    const TYPE_png = 'image/png';
    const TYPE_potx = 'application/vnd.openxmlformats-officedocument.presentationml.template';
    const TYPE_ppsx = 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
    const TYPE_ppt = 'application/vnd.ms-powerpointtd>';
    const TYPE_pptx = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    const TYPE_ps = 'application/postscript';
    const TYPE_qt = 'video/quicktime';
    const TYPE_ra = 'audio/x-pn-realaudio, audio/vnd.rn-realaudio';
    const TYPE_ram = 'audio/x-pn-realaudio, audio/vnd.rn-realaudio';
    const TYPE_rdf = 'application/rdf, application/rdf+xml';
    const TYPE_rtf = 'application/rtf';
    const TYPE_sgml = 'text/sgml';
    const TYPE_json = 'application/json';
    const TYPE_sit = 'application/x-stuffit';
    const TYPE_sldx = 'application/vnd.openxmlformats-officedocument.presentationml.slide';
    const TYPE_svg = 'image/svg+xml';
    const TYPE_swf = 'application/x-shockwave-flash';
    const TYPE_tar_gz = 'application/x-tar';
    const TYPE_tgz = 'application/x-tar';
    const TYPE_tiff = 'image/tiff';
    const TYPE_tsv = 'text/tab-separated-values';
    const TYPE_txt = 'text/plain';
    const TYPE_wav = 'audio/wav, audio/x-wav';
    const TYPE_xlam = 'application/vnd.ms-excel.addin.macroEnabled.12';
    const TYPE_xls = 'application/vnd.ms-excel';
    const TYPE_xlsb = 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
    const TYPE_xlsx = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    const TYPE_xltx = 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
    const TYPE_xml = 'application/xml';
    const TYPE_zip = 'application/zip, application/x-compressed-zip';

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

    public function withJson($data) {
        $this->setContentType(self::TYPE_json);
        return json_encode($data);
    }

    public function withError($code, $default_message = '') {
        if (is_numeric($code)) {
            $txt = '';
            switch ($code) {
                case 404:
                    // Page was not found:
                    header('HTTP/1.1 404 Not Found');
                    break;
                case 403:
                    // Access forbidden:
                    header('HTTP/1.1 403 Forbidden');
                    break;
                case 410:
                    header('HTTP/1.1 403 Gone');
                    break;
                case 500:
                    header('HTTP/1.1 500 Internal Server Error');
                    break;
                case 503:
                    header('HTTP/1.1 503 Service Unavailable');
                    break;
                case 301:
                    header('HTTP/1.1 301 Page Moved Permanently');
                    break;
                case 304:
                    header('HTTP/1.1 304 Not modified');
                    break;
                case 307:
                    header('HTTP/1.1 304 Temporary redirect');
                    break;
                case 401:
                    header('HTTP/1.1 401 Unauthorized: Access is denied due to invalid credentials');
                    break;
                default:
                    header("HTTP/1.1 $code");
            }
            $error_page = Config::app("url.error.$code");
            die(empty($error_page) ? $default_message : twig($error_page));
        }
    }

    public function setContentLength($long) {
        header("Content-Length: $long");
        return $this;
    }

    public function withSession($name, $value = null) {
        if (is_array($name)) {
            foreach ($name as $key => $val) {
                Session::put($key, $val);
            }
        } else {
            Session::put($name, $value);
        }
        return $this;
    }

    public function forgetSession($name) {
        Session::delete($name);
        return $this;
    }

    public function withCookie($name, $value, $expiry, $path = '/', $domain = null) {
        Cookie::put($name, $value, $expiry, $path, $domain);
        return $this;
    }

    public function forgetCookie($name) {
        Cookie::delete($name);
        return $this;
    }

    public function flash($name, $content = null) {
        Session::flash($name, $content);
        return $this;
    }

    public function setContentType($type, $charset = 'utf-8') {
        header("Content-Type: $type; charset=$charset");
        return $this;
    }

    public function setContentTypeForFile($filename) {
        header("Content‐Type: " . mime_content_type($filename));
        return $this;
    }

    public function download($filepath, $filename = '', $open_in_browser = false) {
        $filename = (empty($filename)) ? basename($filepath) : $filename;
        $filetype = ($open_in_browser) ? mime_content_type($filepath) : self::TYPE_exe;
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
