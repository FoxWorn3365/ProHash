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
  protected string $val = " aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ<>!1234567890\"£$%&/()=?^'|àèéìòù{}[]@#§";
  protected string $type;
  protected array $config = array(1 => '1500000', 2 => '150000000', 3 => '30000000', 4 => '75000000');

  function __construct($type = 1) {
    $this->type = $type;
  }

  public function new($string) {
    $ddc = str_split($string);
    $val = str_split($this->val);
    $arr = array();
    $decode = '';
    $res = '';
    foreach ($val as $l) {
      $arr[$l] = rand(10, $this->config[$this->type]);
    }

    foreach ($arr as $vv) {
      $decode .= $vv . ':';
    }

    foreach ($ddc as $char) {
      $res .= $arr[$char] . '^';
    }
    return array('string' => $res, 'key' => $decode);
  }

  public function decode($string, $key) {
    $str = explode('^', $string);
    array_pop($str);
    $val = str_split($this->val);
    $decodec = array();
    $count = 0;  
    $k = explode(':', $key);
    array_pop($k);
    foreach ($k as $value) {
      $decodec[$k[$count]] = $val[$count];
      $count++;
    }
    $string = '';
    foreach ($str as $el) {
      $string .= $decodec[$el];
    }
    return $string;
  }

  public function encode($string, $key) {  
    $val = str_split($this->val);
    $str = str_split($string);
    $key = explode(':', $key);
    $char = array();
    $res = '';
    array_pop($key);
    $count = 0;
    foreach ($key as $c) {
      $char[$val[$count]] = $c;
      $count++;
    }

    foreach ($str as $ch) {
      $res .= $char[$ch] . '^';
    }
    return $res;
  }
}
