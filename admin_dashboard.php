<?php
require 'auth.php';
require_role('admin');
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>داشبورد مدیریت</title>
</head>
<body>
  <h1>خوش آمدید ادمین عزیز 👋</h1>
  <p>شما با موفقیت وارد شده‌اید.</p>
  <p>نام کاربری: <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
  <p>نقش: <?= htmlspecialchars($_SESSION['user']['role']) ?></p>
</body>
</html>
