<?php  // server.php

// var_dump($_SERVER);

var_dump($_SERVER['HTTP_USER_AGENT']);

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
var_dump($ip);

