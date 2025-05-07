<?php
require_once 'config/database.php';

try {
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        // Create users table
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "Users table created successfully<br>";
    }

    // Check if admin user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    if ($stmt->rowCount() == 0) {
        // Create admin user
        $password = 'admin123';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute(['admin', $hashed_password, 'admin@example.com']);
        echo "Admin user created successfully<br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
    } else {
        echo "Admin user already exists<br>";
    }

    echo "<br>Setup completed successfully!<br>";
    echo "<a href='login.php'>Go to Login Page</a>";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 