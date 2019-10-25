<?php
namespace App\Helpers;
class Encryption_decryp_soal
{
    public static function encrypt_soal($str)
    {
        $cipher = "rijndael-128";
                $mode = "cbc";
                $secret_key = "D4:6E:AC:3F:F0:BE";
                //iv length should be 16 bytes
                $iv = "fedcba9876543210";
                // Make sure the key length should be 16 bytes
                $key_len = strlen($secret_key);
        if ($key_len < 16) {
            $addS = 16 - $key_len;
            for ($i =0; $i < $addS; $i++) {
                $secret_key.=" ";
            }
        } else {
            $secret_key = substr($secret_key, 0, 16);
        }
                $td = mcrypt_module_open($cipher, "", $mode, $iv);
                mcrypt_generic_init($td, $secret_key, $iv);
                $cyper_text = mcrypt_generic($td, $str);
                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);
                return bin2hex($cyper_text);
    }
    public static function decrypt_soal($str)
    {
        $str = str_replace("<html>", "", str_replace("</html>", "", $str));
        
        $cipher = "rijndael-128";
        $mode = "cbc";
        $secret_key = "D4:6E:AC:3F:F0:BE";
        //iv length should be 16 bytes
        $iv = "fedcba9876543210";
        $_this = new self;
        // Make sure the key length should be 16 bytes
        $key_len = strlen($secret_key);
        if ($key_len < 16) {
            $addS = 16 - $key_len;
            for ($i =0; $i < $addS; $i++) {
                $secret_key.=" ";
            }
        } else {
            $secret_key = substr($secret_key, 0, 16);
        }
        $td = mcrypt_module_open($cipher, "", $mode, $iv);
        mcrypt_generic_init($td, $secret_key, $iv);
        $decrypted_text = mdecrypt_generic($td, self::hex2bin($str)); //kayanya disini yang salah nih
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $decrypted_text = str_replace("file:images", "/images", trim($decrypted_text));
        return $decrypted_text;
    }
    public static function hex2bin($hexdata)
    {
        $bindata = "";
        for ($i = 0; $i < strlen($hexdata); $i += 2) {
                $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }
}