<?php
require_once 'config/database.php';

try {
    // Delete existing admin user if exists
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    
    // Create new admin user with fresh password
    $username = 'admin';
    $password = 'admin123';
    $email = 'admin@example.com';
    
    // Generate new password hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new admin user
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hashed_password, $email]);
    
    echo "Admin password has been reset successfully!<br>";
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";
    echo "<br>Please try to login with these credentials.<br>";
    echo "<a href='login.php'>Go to Login Page</a>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 