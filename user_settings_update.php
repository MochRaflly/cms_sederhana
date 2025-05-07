<?php
session_start();
require_once 'config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '') {
    echo json_encode(['success' => false, 'message' => 'Nama dan email wajib diisi.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Format email tidak valid.']);
    exit;
}
if ($password && strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password minimal 6 karakter.']);
    exit;
}

try {
    // Cek email sudah dipakai user lain?
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $user_id]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email sudah digunakan user lain.']);
        exit;
    }
    // Update user
    if ($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$name, $email, $hash, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$name, $email, $user_id]);
    }
    // Update session
    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
    echo json_encode(['success' => true, 'message' => 'Pengaturan berhasil disimpan.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan: ' . $e->getMessage()]);
} 