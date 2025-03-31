<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "hmtchir1_admin", "Amerfarihi67@", "hmtchir1_goods");
$conn->set_charset("utf8");

// تعریف کاربران و رمزهای عبور
$users = [
    ['username' => 'admin', 'password' => '1234', 'role' => 'admin'],
    ['username' => 'elaheh', 'password' => '852741', 'role' => 'admin'],
    ['username' => 'elaheh2', 'password' => '963852', 'role' => 'employee']
];

foreach ($users as $user) {
    // ایجاد هش جدید با PASSWORD_DEFAULT
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
    
    // بروزرسانی رمز عبور در دیتابیس
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashed_password, $user['username']);
    
    if ($stmt->execute()) {
        echo "رمز عبور برای کاربر {$user['username']} با موفقیت بروزرسانی شد<br>";
        echo "هش جدید: $hashed_password<br><hr>";
    } else {
        echo "خطا در بروزرسانی رمز عبور برای کاربر {$user['username']}<br>";
    }
    
    $stmt->close();
}

$conn->close();
?>