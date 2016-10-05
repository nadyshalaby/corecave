<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Core\Support\Info;

/**
 * Description of Contentable
 *
 * @author Taekunger
 */
class MimeType {

    /**
     * @var array
     */
    public static $mimeTypes = [
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',
        // Images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        // Archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
        // Audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
        // Adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
        // MS Office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        // Open Office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    ];

    const MIME_TYPE_IF_UNKNOWN = 'application/octet-stream';

    /**
     * @param string|\SplFileInfo|\SplFileObject $file
     * @return mixed|string
     * @throws MimeTypeException
     */
    public static function file($file) {
        if (is_string($file)) {
            $file = new \SplFileInfo($file);
        }
        $extension = strtolower($file->getExtension());
        if ($extension === '') {
            return static::MIME_TYPE_IF_UNKNOWN;
        }
        if (array_key_exists($extension, static::$mimeTypes)) {
            return static::$mimeTypes[$extension];
        }
        if (function_exists('finfo_open') && $file->isFile()) {
            $path = $file->getPath();
            $fileInfo = finfo_open(FILEINFO_MIME);
            $mimeType = finfo_file($fileInfo, $path);
            finfo_close($fileInfo);
            return $mimeType;
        }
        return static::MIME_TYPE_IF_UNKNOWN;
    }

    /**
     * @param string $ext
     * @return mixed|string
     * @throws MimeTypeException
     */
    public static function extension($ext) {

        $extension = strtolower($ext);
        if ($extension === '') {
            return static::MIME_TYPE_IF_UNKNOWN;
        }
        if (array_key_exists($extension, static::$mimeTypes)) {
            return static::$mimeTypes[$extension];
        }
        return static::MIME_TYPE_IF_UNKNOWN;
    }

    /**
     * @param array $files
     * @return array|MimeTypeInfo[]
     */
    public static function files(array $files) {
        $out = [];
        foreach ($files as $file) {
            $out[] = static::info($file);
        }
        return $out;
    }
    
    /**
     * @param array $exts
     * @return array|MimeTypeInfo[]
     */
    public static function extensions(array $exts) {
        $out = [];
        foreach ($exts as $ext) {
            $out[] = static::extension($ext);
        }
        return $out;
    }

    /**
     * @param $file
     * @return MimeTypeInfo
     */
    public static function info($file) {
        return new MimeTypeInfo($file, static::get($file));
    }

}
