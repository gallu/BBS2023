<?php  // singleton.php

class Hoge {
    private function __construct() {
    }

    //　XXXXXX
    private function __clone() {
    }
    public function __wakeup() {
        throw new \Exception('すんな');
    }

    public static function getInstance() {
        static $obj = null;
        if (null === $obj) {
            $obj = new static;
        }
        return $obj;
    }
}
//
$obj = Hoge::getInstance();
var_dump($obj);

// $obj2 = new Hoge();
// $obj2 = clone $obj;
$obj2 = unserialize(serialize($obj));
var_dump($obj2);

