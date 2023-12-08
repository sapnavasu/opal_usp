<?php

namespace app\commonfunction;

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
    
}