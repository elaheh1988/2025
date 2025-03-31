<?php
ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] . '/sessions');
session_start();

if (isset($_SESSION['user'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "لطفاً همه فیلدها را پر کنید.";
    } else {
        $conn = new mysqli("localhost", "hmtchir1_admin", "Amerfarihi67@", "hmtchir1_goods");
        $conn->set_charset("utf8");

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = $user;

                switch ($user['role']) {
                    case 'admin': header("Location: admin_dashboard.php"); exit;
                    case 'employee': header("Location: form_employee.php"); exit;
                    case 'evaluator': header("Location: evaluator.php"); exit;
                    case 'warehouse': header("Location: warehouse.php"); exit;
                    default: die("نقش تعریف نشده است.");
                }
            } else {
                $error = "نام کاربری یا رمز عبور اشتباه است.";
            }
        } else {
            $error = "نام کاربری یا رمز عبور اشتباه است.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ورود به سامانه</title>
</head>
<body>
  <form method="post">
    <h2>ورود به سامانه</h2>
    <?php if ($error): ?>
      <div style="color:red"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <input type="text" name="username" placeholder="نام کاربری" required><br>
    <input type="password" name="password" placeholder="رمز عبور" required><br>
    <button type="submit">ورود</button>
  </form>
</body>
</html>
