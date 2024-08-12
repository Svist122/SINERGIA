<?php
include 'config.php';
$tag_name = $_GET['tag_name'];

$stmt = $pdo->prepare("
    SELECT posts.* FROM posts
    JOIN post_tags ON posts.id = post_tags.post_id
    JOIN tags ON post_tags.tag_id = tags.id
    WHERE tags.name = ?
");
$stmt->execute([$tag_name]);
$posts = $stmt->fetchAll();
?>

<h2>Posts tagged with "<?php echo htmlspecialchars($tag_name); ?>"</h2>
<?php foreach ($posts as $post): ?>
    <div>
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
    </div>
<?php endforeach; ?>