<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$subscribed_to_id = $_GET['user_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO subscriptions (user_id, subscribed_to_id) VALUES (?, ?)");
$stmt->execute([$user_id, $subscribed_to_id]);
header("Location: index.php");
?>