<?php
require_once("db.php");

if (isset($_POST["val"]) and $_POST["val"] == 1){
	$books = R::getAll('SELECT * FROM `product` where  `category` = "'. $_POST["product"].'"');
} else if (isset($_POST["product"])){
	$books = R::getAll('SELECT * FROM `product` where  `category` = "'. $_POST["product"].'"');
} else if (isset($_POST["search"])){
	$books = R::getAll("SELECT * FROM `product` where `Name` LIKE  '%".$_POST["search"]."%' ");
} else if (isset($_POST["category"])){
	$books = R::getAll("SELECT `category` FROM `product` ");
}

print_r(json_encode($books));
