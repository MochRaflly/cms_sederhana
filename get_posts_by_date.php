<?php
require_once 'config/database.php';
header('Content-Type: application/json');
$date = $_POST['date'] ?? '';
if (!$date) {
    echo json_encode(['success' => false, 'posts' => []]);
    exit;
}
try {
    $stmt = $pdo->prepare("SELECT posts.title, posts.status, categories.name as category FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE DATE(posts.created_at) = ? AND posts.status = 'published'");
    $stmt->execute([$date]);
    $posts = $stmt->fetchAll();
    echo json_encode(['success' => true, 'posts' => $posts]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'posts' => [], 'error' => $e->getMessage()]);
} 