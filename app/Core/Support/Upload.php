<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Support;


/**
 * Description of Upload
 *
 * @author Taekunger
 */
class Upload {

    protected $displayName;
    protected $lastDisplayName;
    protected $fileName;
    protected $file;
    protected $tmpName;
    protected $size;
    protected $mime;
    protected $imageRealMime;
    protected $error;
    protected $extension;
    protected $nameLength;
    protected $lastModified;
    protected $permission;
    protected $lastAcessTime;
    protected $owner;
    protected $group;
    protected $isWritable;
    protected $isReadable;
    protected $isExecutable;
    protected $isImage;

    public function __construct(array $file) {

        $this->file = $file;
        $this->displayName = $file['name'];
        $this->lastDisplayName = $file['name'];
        $this->tmpName = $file['tmp_name'];
        $this->size = $file['size'];
        $this->error = $file['error'];
        $this->mime = $file['type'];
        $this->imageRealMime = $this->_getImageRealMime($file['tmp_name']);
        $path = pathinfo($file['name']);
        $this->extension = $path['extension'];
        $this->fileName = $path['filename'];
        $this->nameLength = strlen($path['basename']);
        $this->lastModified = filemtime($file['tmp_name']);
        $this->lastAcessTime = fileatime($file['tmp_name']);
        $this->owner = fileowner($file['tmp_name']);
        $this->group = filegroup($file['tmp_name']);
        $this->isWritable = is_writable($file['tmp_name']);
        $this->isReadable = is_readable($file['tmp_name']);
        $this->isExecutable = is_executable($file['tmp_name']);
        $this->isImage = (bool) getimagesize($file['tmp_name']);
        $this->permission = decoct(fileperms($this->tmpName) & 0777);
    }

    public function getPermission() {
        return $this->permission;
    }

        public function getImageRealMime() {
        return $this->imageRealMime;
    }

    public function getLastAcessTime() {
        return $this->lastAcessTime;
    }

    public function getLastDisplayName() {
        return $this->lastDisplayName;
    }

    public function getLastModified() {
        return $this->lastModified;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getTmpName() {
        return $this->tmpName;
    }

    public function getSize() {
        return $this->size;
    }

    public function getMime() {
        return $this->mime;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getNameLength() {
        return $this->nameLength;
    }

    public function getAuther() {
        return $this->auther;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getError() {
        return $this->error;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getFile() {
        return $this->file;
    }

    public function toArray() {
        return file($this->tmpName);
    }

    public function hasMime($mimeorMimes) {
        if (is_array($mimeorMimes) && in_array($this->mime, $mimeorMimes)) {
            return true;
        } else {
            return $this->mime === $mimeorMimes;
        }
    }

    public function hasExtension($extensionOrExtensions) {
        if (is_array($extensionOrExtensions) && in_array($this->extension, $extensionOrExtensions)) {
            return true;
        } else {
            return $this->extension === $extensionOrExtensions;
        }
    }

    public function isWritable() {
        return $this->isWritable;
    }

    public function isReadable() {
        return $this->isReadable;
    }

    public function isExecutable() {
        return $this->isExecutable;
    }

    public function isImage() {
        return $this->isImage;
    }
    
    public function isZip() {
        return $this->_isZip($this->tmpName);
    }
    
    public function isRar() {
        return $this->_isRar($this->tmpName);
    }

    public function isPermission($permission) {
        return $permission === $this->permission;
    }

    public function uploadAsPNG($target = 'php://output', $overwrite = true) {

        if (!$this->isImage) {
            return false;
        }

        if (file_exists($target) && $overwrite) {
            @unlink($target);
        }

        $sourceImg = @imagecreatefromstring(@file_get_contents($this->tmpName));

        if ($sourceImg === false) {
            return FALSE;
        }

        $width = imagesx($sourceImg);
        $height = imagesy($sourceImg);
        $targetImg = imagecreatetruecolor($width, $height);
        imagecopy($targetImg, $sourceImg, 0, 0, 0, 0, $width, $height);
        imagedestroy($sourceImg);
        imagepng($targetImg, $target);
        imagedestroy($targetImg);
        return TRUE;
    }

    public function uploadAsGIF($target = 'php://output', $overwrite = true) {

        if (!$this->isImage) {
            return false;
        }

        if (file_exists($target) && $overwrite) {
            @unlink($target);
        }

        $sourceImg = @imagecreatefromstring(@file_get_contents($this->tmpName));

        if ($sourceImg === false) {
            return FALSE;
        }

        $width = imagesx($sourceImg);
        $height = imagesy($sourceImg);
        $targetImg = imagecreatetruecolor($width, $height);
        imagecopy($targetImg, $sourceImg, 0, 0, 0, 0, $width, $height);
        imagedestroy($sourceImg);
        imagegif($targetImg, $target);
        imagedestroy($targetImg);
        return TRUE;
    }

    public function uploadAsJPEG($target = 'php://output', $overwrite = true) {

        if (!$this->isImage) {
            return false;
        }

        if (file_exists($target) && $overwrite) {
            @unlink($target);
        }

        $sourceImg = @imagecreatefromstring(@file_get_contents($this->tmpName));

        if ($sourceImg === false) {
            return FALSE;
        }

        $width = imagesx($sourceImg);
        $height = imagesy($sourceImg);
        $targetImg = imagecreatetruecolor($width, $height);
        imagecopy($targetImg, $sourceImg, 0, 0, 0, 0, $width, $height);
        imagedestroy($sourceImg);
        imagejpeg($targetImg, $target);
        imagedestroy($targetImg);
        return TRUE;
    }

    public function upload($destination, $new_name = '', $overwrite = true) {

        $name = $this->displayName;

        if (!empty($new_name)) {
            $name = $new_name;
        }

        if (file_exists("$destination/$name") && !$overwrite) {
            $name = _uniqueFile($destination, $name);
            $this->lastDisplayName = $name;
        }

        if (is_uploaded_file($this->tmpName)) {
            return move_uploaded_file($this->tmpName, "$destination/$name");
        }

        return false;
    }

    private function _getImageRealMime($filename) {
        if(empty($filename)){
            return null;
        }
        
        $img = getimagesize($filename);
        if (!empty($img[2]))
            return image_type_to_mime_type($img[2]);
        return false;
    }

    private function _isZip($filename) {
        if (is_resource($zip = zip_open($filename))) {
            zip_close($zip);
            return true;
        }
        return false;
    }
    private function _isRar($filename) {
        if (is_resource($rar = rar_open($filename))) {
            rar_close($rar);
            return true;
        }
        return false;
    }
}
