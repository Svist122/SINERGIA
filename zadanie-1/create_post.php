<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $is_private = isset($_POST['is_private']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content, is_private) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $content, $is_private]);
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <label><input type="checkbox" name="is_private"> Private</label>
    <button type="submit">Create Post</button>
</form>