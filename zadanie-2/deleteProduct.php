<?php
require_once("db.php");

if ($_POST["id"] != NULL) {
$book = R::load('product', $_POST["id"]);
R::trash($book);
$new_url = 'NewAdmin.php';
header('Location: '.$new_url);
}