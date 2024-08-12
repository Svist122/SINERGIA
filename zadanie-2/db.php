<?
require_once __DIR__.'/vendor/autoload.php';
class_alias('\RedBeanPHP\R', '\R');

const HOST = "localhost";
const LOGIN = "root";
const PASS = "";
const DB = "arendaTech";


R::setup('mysql:host='. HOST .'; dbname='.DB .'',LOGIN, PASS, false);

if(!R::testConnection()) die('No DB connection!');


