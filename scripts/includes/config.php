<?php

require_once("rb-mysql.php");
require_once("functions.php");

define("SITEURL",".");

R::setup('mysql:host=localhost;dbname=phptutor','root','');
if(!R::testConnection()) die("Нет соединения с базой данных");

session_start();