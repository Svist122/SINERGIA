<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$post_id = $_GET['post_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tags = explode(',', $_POST['tags']);
    foreach ($tags as $tag) {
        $tag = trim($tag);
        if ($tag) {
            // Проверяем, существует ли уже тег
            $stmt = $pdo->prepare("SELECT id FROM tags WHERE name = ?");
            $stmt->execute([$tag]);
            $tag_id = $stmt->fetchColumn();

            // Если тега нет, создаем его
            if (!$tag_id) {
                $stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (?)");
                $stmt->execute([$tag]);
                $tag_id = $pdo->lastInsertId();
            }

            // Связываем тег с постом
            $stmt = $pdo->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$post_id, $tag_id]);
        }
    }
    header("Location: view_post.php?post_id=" . $post_id);
}
?>

<form method="POST">
    <input type="text" name="tags" placeholder="Enter tags, separated by commas">
    <button type="submit">Add Tags</button>
</form>