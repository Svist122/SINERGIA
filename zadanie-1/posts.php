<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT posts.* 
    FROM posts 
    JOIN subscriptions ON posts.user_id = subscriptions.subscribed_to_id 
    WHERE subscriptions.user_id = ?
");
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll();
?>

<?php foreach ($posts as $post): ?>
    <div>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
    </div>
<?php endforeach; ?>