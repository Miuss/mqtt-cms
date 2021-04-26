<?php

ob_start();
session_start();

define('ROOT', realpath(__DIR__ . '/..'));
ini_set('default_socket_timeout', 2);

include 'config.php';
include 'class/User.php';
include 'class/Mail.php';
include 'class/Template.php';
include 'class/Title.php';
include 'class/Device.php';
include 'class/Session.php';
include 'function/function.php';


$Session = new Session();
$Title = new Title();
$Template = new Template();
$User = new User();

?>
