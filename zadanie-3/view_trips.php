<?php
include 'config.php';

$stmt = $pdo->query("SELECT trips.*, users.username FROM trips JOIN users ON trips.user_id = users.id");
$trips = $stmt->fetchAll();
?>

<h2>All Trips</h2>
<?php foreach ($trips as $trip): ?>
    <div>
        <h3><?php echo htmlspecialchars($trip['title']); ?> by <?php echo htmlspecialchars($trip['username']); ?></h3>
        <p><?php echo htmlspecialchars($trip['description']); ?></p>
        <p>Location: <?php echo htmlspecialchars($trip['location']); ?></p>
        <?php if ($trip['image_url']): ?>
            <img src="<?php echo htmlspecialchars($trip['image_url']); ?>" alt="Trip Image">
        <?php endif; ?>
        <p>Cost: $<?php echo htmlspecialchars($trip['cost']); ?></p>
        <p>Cultural Heritage Sites: <?php echo htmlspecialchars($trip['heritage_sites']); ?></p>
        <p>Places to Visit: <?php echo htmlspecialchars($trip['places_to_visit']); ?></p>
        <p>Ratings:
            Comfort: <?php echo json_decode($trip['rating'])->comfort; ?>,
            Safety: <?php echo json_decode($trip['rating'])->safety; ?>,
            Crowd: <?php echo json_decode($trip['rating'])->crowd; ?>,
            Vegetation: <?php echo json_decode($trip['rating'])->vegetation; ?>
        </p>
    </div>
<?php endforeach; ?>