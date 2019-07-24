<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\system\DatabaseConnector;

$dotenv = new Dotenv(__DIR__);
//echo "OKTAAUDIENCE : " . getenv('OKTAAUDIENCE');
$dotenv->load();
$dbconnection = (new DatabaseConnector())->getConnetion(); 