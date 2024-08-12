<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $image_url = $_POST['image_url'];
    $cost = $_POST['cost'];
    $heritage_sites = $_POST['heritage_sites'];
    $places_to_visit = $_POST['places_to_visit'];
    $rating = json_encode([
        'comfort' => $_POST['rating_comfort'],
        'safety' => $_POST['rating_safety'],
        'crowd' => $_POST['rating_crowd'],
        'vegetation' => $_POST['rating_vegetation'],
    ]);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO trips (user_id, title, description, location, image_url, cost, heritage_sites, places_to_visit, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $location, $image_url, $cost, $heritage_sites, $places_to_visit, $rating]);
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Trip Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="image_url" placeholder="Image URL">
    <input type="number" step="0.01" name="cost" placeholder="Cost">
    <textarea name="heritage_sites" placeholder="Cultural Heritage Sites"></textarea>
    <textarea name="places_to_visit" placeholder="Places to Visit"></textarea>
    <label>Comfort Rating: <input type="number" name="rating_comfort" min="1" max="5"></label>
    <label>Safety Rating: <input type="number" name="rating_safety" min="1" max="5"></label>
    <label>Crowd Rating: <input type="number" name="rating_crowd" min="1" max="5"></label>
    <label>Vegetation Rating: <input type="number" name="rating_vegetation" min="1" max="5"></label>
    <button type="submit">Create Trip</button>
</form>