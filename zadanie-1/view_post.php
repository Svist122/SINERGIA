<?php
include 'config.php';
$post_id = $_GET['post_id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

$stmt = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ?");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll();
?>

<h2><?php echo htmlspecialchars($post['title']); ?></h2>
<p><?php echo htmlspecialchars($post['content']); ?></p>

<h3>Comments</h3>
<?php foreach ($comments as $comment): ?>
    <div>
        <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
        <p><?php echo htmlspecialchars($comment['content']); ?></p>
    </div>
<?php endforeach; ?>

<a href="add_comment.php?post_id=<?php echo $post['id']; ?>">Add a comment</a>