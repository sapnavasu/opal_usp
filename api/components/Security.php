<?php

namespace api\components;

class Security{

    public function base64_encrypt_str($str, $passw = null) {
        $r = '';
        $md = $passw ? substr(md5($passw), 0, 16) : '';
        $str = base64_encode($md . $str);
        $abc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $a = str_split('+/=' . $abc);
        $b = strrev('-_=' . $abc);
        if ($passw) {
            $b = self::_mixing_passw($b, $passw);
        } else {
            $r = rand(10, 65);
            $b = mb_substr($b, $r) . mb_substr($b, 0, $r);
        }
        $s = '';
        $b = str_split($b);
        $str = str_split($str);
        $lens = count($str);
        $lena = count($a);
        for ($i = 0; $i < $lens; $i++) {
            for ($j = 0; $j < $lena; $j++) {
                if ($str[$i] == $a[$j]) {
                    $s.=$b[$j];
                }
            }
        }
        return $s . $r;
    }

    public function base64_decrypt_str($str, $passw = null) {
        $abc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $a = str_split('+/=' . $abc);
        $b = strrev('-_=' . $abc);
        if ($passw) {
            $b = self::_mixing_passw($b, $passw);
        } else {
            $r = mb_substr($str, -2);
            $str = mb_substr($str, 0, -2);
            $b = mb_substr($b, $r) . mb_substr($b, 0, $r);
        }
        $s = '';
        $b = str_split($b);
        $str = str_split($str);
        $lens = count($str);
        $lenb = count($b);
        for ($i = 0; $i < $lens; $i++) {
            for ($j = 0; $j < $lenb; $j++) {
                if ($str[$i] == $b[$j]) {
                    $s.=$a[$j];
                }
            };
        };
        $s = base64_decode($s);
        if ($passw && substr($s, 0, 16) == substr(md5($passw), 0, 16)) {
            return substr($s, 16);
        } else {
            return $s;
        }
    }

    public function _mixing_passw($b, $passw) {
        $s = '';
        $c = $b;
        $b = str_split($b);
        $passw = str_split(sha1($passw));
        $lenp = count($passw);
        $lenb = count($b);
        for ($i = 0; $i < $lenp; $i++) {
            for ($j = 0; $j < $lenb; $j++) {
                if ($passw[$i] == $b[$j]) {
                    $c = str_replace($b[$j], '', $c);
                    if (!preg_match('/' . $b[$j] . '/', $s)) {
                        $s.=$b[$j];
                    }
                }
            };
        };
        return $c . '' . $s;
    }
    
    public static function aesencrypt($plain_text){
        $passphrase = "BGILyPIS";
        $salt = openssl_random_pseudo_bytes(256);
        $iv = openssl_random_pseudo_bytes(16);

        $iterations = 999;  
        $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

        $encrypted_data = openssl_encrypt($plain_text, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

        $data = array("ciphertext" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "salt" => bin2hex($salt));
        return base64_encode(json_encode($data));
    }

    
    public static function aesdecrypt($jsonString) {
        $passphrase = "BGILyPIS";
        $jsondata = json_decode(base64_decode($jsonString), true);

        try {
            $iv = hex2bin($jsondata['iv']);
            $salt = hex2bin($jsondata['salt']);
        } catch (Exception $e) {
            return null;
        }

        $ciphertext = base64_decode($jsondata['ciphertext']);
        $iterations = 999; //same as js encrypting 

        $key = hash_pbkdf2("sha512", $passphrase, $salt, $iterations, 64);

        $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', hex2bin($key), OPENSSL_RAW_DATA, $iv);

        return $decrypted;
    }
    
    public function decrypt($str){
        return base64_decode($str);
    }

    public function encrypt($str){
        return base64_encode($str);
    }

    // internal function for utf8 decoding
    // thanks to Hokkaido for noticing that PHP's utf8_decode function is a little
    // screwy, and to jamie for the code
    function my_utf8_decode($string)
    {
        return strtr($string,
            "???????¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ",
            "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
    }

    // paranoid sanitization -- only let the alphanumeric set through
    public static function sanitize_paranoid_string($string, $min='', $max='')
    {
        $string = trim(preg_replace("/[^a-zA-Z0-9 ]/", "", $string));
        $len = strlen($string);
        if((is_int($string)) || (is_float($string)) || (($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
            return "";
        return trim($string);
    }

    // sanitize a string in prep for passing a single argument to system() (or similar)
    function sanitize_system_string($string, $min='', $max='')
    {
        $pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // no piping, passing possible environment variables ($),
        // seperate commands, nested execution, file redirection,
        // background processing, special commands (backspace, etc.), quotes
        // newlines, or some other special characters
        $string = preg_replace($pattern, '', $string);
        $string = '"'.preg_replace('/\$/', '\\\$', $string).'"'; //make sure this is only interpretted as ONE argument
        $len = strlen($string);
        if ((($min != '') && ($len < $min)) || (($max != '') && ($len > $max))) {
            return "";
        }
        return $string;
    }

    // sanitize a string for SQL input (simple slash out quotes and slashes)
    function sanitize_sql_string($string, $min='', $max='')
    {
        $string = nice_addslashes($string); //gz
        $pattern = "/;/"; // jp
        $replacement = "";
        $len = strlen($string);
        if ((($min != '') && ($len < $min)) || (($max != '') && ($len > $max))) {
            return "";
        }
        return preg_replace($pattern, $replacement, $string);
    }

    // sanitize a string for SQL input (simple slash out quotes and slashes)
    function sanitize_ldap_string($string, $min='', $max='')
    {
        $pattern = '/(\)|\(|\||&)/';
        $len = strlen($string);
        if ((($min != '') && ($len < $min)) || (($max != '') && ($len > $max))) {
            return "";
        }
        return preg_replace($pattern, '', $string);
    }


    // sanitize a string for HTML (make sure nothing gets interpretted!)
    static function sanitize_html_string($string)
    {
        $pattern[0] = '/\&/';
        $pattern[1] = '/</';
        $pattern[2] = "/>/";
        $pattern[3] = '/\n/';
        $pattern[4] = '/"/';
        $pattern[5] = "/'/";
        $pattern[6] = "/%/";
        $pattern[7] = '/\(/';
        $pattern[8] = '/\)/';
        $pattern[9] = '/\+/';
        $pattern[10] = '/-/';
        $pattern[11] = '/script/';
        $pattern[12] = '/alert/';
        $pattern[13] = '/prompt/';
        $pattern[14] = '/onmouseover/';
        $pattern[15] = '/bad/';
        //$pattern[16] = '/;/';
        $replacement[0] = '&amp;';
        $replacement[1] = '&lt;';
        $replacement[2] = '&gt;';
        $replacement[3] = '<br>';
        $replacement[4] = '&quot;';
        $replacement[5] = '&#39;';
        $replacement[6] = '&#37;';
        $replacement[7] = '&#40;';
        $replacement[8] = '&#41;';
        $replacement[9] = '&#43;';
        $replacement[10] = '&#45;';
        $replacement[11] = '';
        $replacement[12] = '';
        $replacement[13] = '';
        $replacement[14] = '';
        $replacement[15] = '';
        //$replacement[16] = '';
        return preg_replace($pattern, $replacement, $string);
    }

    // make int int!
    static function sanitize_int($integer, $min='', $max='')
    {
        if ((!is_int($integer) && !is_numeric($integer)) || (($min != '') && ($int < $min)) || (($max != '') && ($int > $max))) {
            return 0;
        }
        return $integer;
    }

    // make float float!
    static function sanitize_float($float, $min='', $max='')
    {
        if ((!is_float($float) && !is_numeric($float)) || (($min != '') && ($float < $min)) || (($max != '') && ($float > $max))) {
            return 0;
        }
        return (float) $float;
    }

    // make double double!
    static function sanitize_double($double, $min='', $max='')
    {
        if ((!is_double($double) && !is_numeric($double)) || (($min != '') && ($double < $min)) || (($max != '') && ($double > $max))) {
            return 0;
        }
        return (double) $double;
    }



    /**
     * This function is used to sanitize and validate the input
     * @param string | int $userInput
     * @param string $type
     * @return string | int
     */
    public static function sanitizeInput($userInput, $type, $decryptUserInput = false){
        if($decryptUserInput){
            $userInput = self::decrypt($userInput);
        }
        switch ($type){
            case "number":
                return self::sanitize_int($userInput);
            case "float":
                return self::sanitize_float($userInput);
            case "string":
                return self::sanitize_paranoid_string($userInput);
            case "string_spl_char":
                return self::sanitize_string($userInput);
            case "html":
                return self::sanitize_html_string($userInput);
            default:
                return "";
        }
    }
    
    /**
     * This function is used to sanitize and validate the array
     * @param array $arr
     * @param string $type
     * @return string | int
     */
    public static function sanitizeArr($arr, $type){
        $returnArr = [];
        foreach($arr as $userInput){
            $sanitizedInput = self::sanitizeInput($userInput, $type);
            if($sanitizedInput){
                array_push($returnArr,$sanitizedInput);
            }
        }
        return $returnArr;
    }
    
    public function isDateValid($date, $format){
        $valid_date = date_format(date_create($date), $format);
        return ($valid_date) ? $valid_date : "";
    }
    
    public function sanitize_string($userInput){
        $string = filter_var($userInput, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return ($string) ? $string : "";
    }
    // public function decrypt_special_character($var) {
    //     $var = 'galfar&#39;&#39;&#39;&#39;&#39;&#39;&#34;&#34;&#34;&#34;&#34;&#34;213';
    //     $str = html_entity_decode($var, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    //     echo $str;
    // }
 
    public function decrypt_character($str){
        $var = '&#39;&#39;&#39;&#39;&#39;&#34;&#34;&#34;&#34;&#34;&#34;213';
        
       $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
       
        //return html_entity_decode( $var, ENT_QUOTES | ENT_COMPAT , 'UTF-8' );
        // print_r($str);
        // exit();
        return $str;
        //return html_entity_decode($str);
    }

    // public function encrypt_character($str){
    //     return html_entity_decode($str);
    // }
}