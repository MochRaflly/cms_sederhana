<?php
require_once 'config/database.php';
header('Content-Type: application/json');
$q = trim($_GET['q'] ?? '');
$results = [];
if ($q !== '') {
    // Cari post
    $stmt = $pdo->prepare("SELECT id, title FROM posts WHERE title LIKE ? LIMIT 5");
    $stmt->execute(['%' . $q . '%']);
    foreach ($stmt->fetchAll() as $row) {
        $results[] = [
            'label' => $row['title'],
            'type' => 'post',
            'url' => 'posts.php?edit=' . $row['id']
        ];
    }
    // Cari kategori
    $stmt = $pdo->prepare("SELECT id, name FROM categories WHERE name LIKE ? LIMIT 3");
    $stmt->execute(['%' . $q . '%']);
    foreach ($stmt->fetchAll() as $row) {
        $results[] = [
            'label' => $row['name'],
            'type' => 'category',
            'url' => 'categories.php?edit=' . $row['id']
        ];
    }
    // Cari user
    $stmt = $pdo->prepare("SELECT id, username FROM users WHERE username LIKE ? LIMIT 3");
    $stmt->execute(['%' . $q . '%']);
    foreach ($stmt->fetchAll() as $row) {
        $results[] = [
            'label' => $row['username'],
            'type' => 'user',
            'url' => 'users.php?edit=' . $row['id']
        ];
    }
}
echo json_encode(['success' => true, 'results' => $results]); 