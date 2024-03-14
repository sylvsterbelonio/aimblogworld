<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Crypt {

 public function encrypt($string) 
        {
        $key = "MAL_979805"; //key to encrypt and decrypts.
        $result = '';
        $test = "";
         for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
      
           $test[$char]= ord($char)+ord($keychar);
           $result.=$char;
         }
      
         return urlencode(base64_encode($result));
        }

 public function decrypt($string) {
            $key = "MAL_979805"; //key to encrypt and decrypts.
            $result = '';
            $string = base64_decode(urldecode($string));
           for($i=0; $i<strlen($string); $i++) {
             $char = substr($string, $i, 1);
             $keychar = substr($key, ($i % strlen($key))-1, 1);
             $char = chr(ord($char)-ord($keychar));
             $result.=$char;
           }
           return $result;
       }

}
