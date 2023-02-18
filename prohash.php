<?php
/*
===========================================
+--+  +--+  +--+     |  |  +--+  +---  |  |
|  |  |  |  |  |     |  |  |  |  |     |  |
+--+  +--+  |  |     +--+  +--+  +--+  +--+
|     |\    |  |     |  |  |  |     |  |  |
|     | \   +--+     |  |  |  |  ---+  |  |
===========================================
> ProHash v1.0
> Author: FoxWorn3365
> GitHub: https://github.com/FoxWorn3365/ProHash
> Version: 1.0
> PHP: => 7.4
> License: AGPL 3.0
===========================================
> Email: foxworn3365@gmail.com
> Discord: FoxWorn#0001
===========================================
*/

namespace Fox;

class Hash {
  protected string $val = " aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ<>!1234567890\"£$%&/;()=?^'|{}[]@#§";
  protected string $type;
  protected array $config = array(1 => '1500000', 2 => '150000000', 3 => '30000000', 4 => '75000000');

  function __construct($type = 1) {
    $this->type = $type;
  }

  protected function generateRandomString(int $length) : string {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function new(string $string) : array {
    // Lenght max = 7
    $ddc = str_split($string);
    $val = str_split($this->val);
    $arr = array();
    $decode = '';
    $res = '';
    foreach ($val as $l) {
      $arr[$l] = self::generateRandomString(7);
    }

    foreach ($arr as $vv) {
      $decode .= $vv . ':';
    }

    foreach ($ddc as $char) {
      $res .= $arr[$char];
    }
    return array('string' => $res, 'key' => $decode);
  }

  public function decode(string $string, string $key) : string {
    $str = str_split($string);
    if (stripos(strlen($string)/7, ".") !== false) {
      return false;
    }
    $val = str_split($this->val);

    $decodec = array();
    $count = 0;  
    $k = explode(':', $key);
    array_pop($k);
    $phrase = [];
    $count = 0;

    for ($a = 0; $a < count($str); $a) {
      $astr = '';
      for ($b = $a; $b < $a+7; $b++) {
        $astr .= $str[$b];
      }

      array_push($phrase, $astr);
      $a = $a+7;
    }

    for ($a = 0; $a < count($val)-1; $a++) {
      $decodec[$k[$a]] = $val[$a];
    }

    $string = '';
    foreach ($phrase as $el) {
      $string .= $decodec[$el];
    }

    return $string;
  }

  public function encode(string $string, string $key) : string {  
    $ddc = str_split($string);
    $val = str_split($this->val);
    $key = explode(':', $key);
    $arr = array();
    $decode = '';
    $res = '';
    $count = 0;
    foreach ($val as $l) {
      $arr[$l] = $key[$count];
      $count++;
    }

    foreach ($arr as $vv) {
      $decode .= $vv . ':';
    }

    foreach ($ddc as $char) {
      $res .= $arr[$char];
    }
    return $res;
  }

  public static function italianSanitize(string $string) : string {
    return str_replace('è', "&egrave;", str_replace('é', "&egrave;", str_replace('à', "&agrave;", str_replace('ì', "&igrave;", str_replace("ò", "&ograve;", str_replace("ù", "&ugrave;", $string))))));
  }
}
