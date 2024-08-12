<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$post_id = $_GET['post_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$post_id, $user_id, $content]);
    header("Location: view_post.php?post_id=" . $post_id);
}
?>

<form method="POST">
    <textarea name="content" placeholder="Write your comment..." required></textarea>
    <button type="submit">Add Comment</button>
</form>