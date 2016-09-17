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

class Hash {

    /**
     * Hash the password according the password hashing API.
     * 
     * @param string $password
     * @param int $algo
     * @param array $options
     * @return string the hashed password
     */
    public function password($password, $algo = PASSWORD_BCRYPT, $options = null) {
        return password_hash($password, $algo, $options);
    }
    
   /**
    * one way hash for the text according the passed hashing algorithm.
    * 
    * @param string $text
    * @param int $algo
    * @param bool $raw
    * @return string
    */
    
    public function hash($text, $algo = 'sha256', $raw = false) {
        return hash($algo,$text, $raw);
        
    }
    
    /**
     * Checks if two hashes are equal or not.
     * 
     * @param string $known_string
     * @param string $user_string
     * @return type
     */
    public function matchHash($known_string, $user_string) {
        return hash_equals($known_string, $user_string);
        
    }

    /**
     * Generate unique random hash.
     * 
     * @param int $length
     * @return string random hash
     */
    public function random($length = 30) {
        $hash = '';
        while (strlen($hash) <= $length) {
            $hash .= rtrim(base64_encode(uniqid(rand(), true)), '=');
        }
        return substr($hash, 0, $length);
    }

    /**
     * rehash the password in case of it wasn't hashed.
     * 
     * @param string $password
     * @param int $algo
     * @param array $options
     * @return string
     */
    public function rehashPassword($password, $algo = PASSWORD_BCRYPT, $options = null) {
        if (password_needs_rehash($password, $algo, $options)) {
            return $this->password($password, $algo, $options);
        }
        return $password;
    }

    /**
     * Encrypt the passed string.
     * 
     * @param string $string text to be encrypted.
     * @param mixed $key identifier of 16,24 or 32 character.
     * @return string
     */
    public function encrypt($string, $key = '1234567891234567') {
        $string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
        return $string;
    }

    /**
     * Decrypt the passed string.
     * 
     * @param string $string text to be decrypted.
     * @param mixed $key identifier of 16,24 or 32 character.
     * @return string
     */
    public function decrypt($string, $key = '1234567891234567') {
        $string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_ECB));
        return $string;
    }

    /**
     * Checks if the two passwords matched or not.
     * 
     * @param string $password
     * @param string $hashed_password
     * @return bool
     */
    public function matchPassword($password, $hashed_password) {
        return password_verify($password, $hashed_password);
    }

}
