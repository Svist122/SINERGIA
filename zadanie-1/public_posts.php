<?php
include 'config.php';

$stmt = $pdo->query("SELECT * FROM posts WHERE is_private = 0");
$posts = $stmt->fetchAll();
?>

<?php foreach ($posts as $post): ?>
    <div>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
    </div>
<?php endforeach; ?>

// hidden_post.php
<?php
include 'config.php';
$post_id = $_GET['post_id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND is_private = 1");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if ($post): ?>
    <div>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
    </div>
<?php else: ?>
    <p>Post not found or you don't have permission to view it.</p>
<?php endif; ?>