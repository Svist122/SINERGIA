<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$post_id = $_GET['post_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $is_private = isset($_POST['is_private']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, is_private = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$title, $content, $is_private, $post_id, $_SESSION['user_id']]);
    header("Location: index.php");
} else {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $_SESSION['user_id']]);
    $post = $stmt->fetch();
}
?>

<form method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
    <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
    <label><input type="checkbox" name="is_private" <?php echo $post['is_private'] ? 'checked' : ''; ?>> Private</label>
    <button type="submit">Update Post</button>
</form>

// delete_post.php
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$post_id = $_GET['post_id'];

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$post_id, $_SESSION['user_id']]);
header("Location: index.php");
?>