<?php
$conn = new mysqli("localhost", "hmtchir1_admin", "Amerfarihi67@", "hmtchir1_goods");
$conn->set_charset("utf8");

echo "<h2>بررسی کاربران موجود</h2>";

$result = $conn->query("SELECT * FROM users");
while ($row = $result->fetch_assoc()) {
    echo "<div style='margin: 10px; padding: 10px; border: 1px solid #ccc;'>";
    echo "نام کاربری: " . $row['username'] . "<br>";
    echo "نقش: " . $row['role'] . "<br>";
    echo "رمز عبور در دیتابیس: " . $row['password'] . "<br>";
    
    // تست رمزهای مختلف
    echo "<br>تست رمزها:<br>";
    echo "1234: " . (password_verify("1234", $row['password']) ? "صحیح" : "نادرست") . "<br>";
    echo "852741: " . (password_verify("852741", $row['password']) ? "صحیح" : "نادرست") . "<br>";
    echo "963852: " . (password_verify("963852", $row['password']) ? "صحیح" : "نادرست") . "<br>";
    echo "</div>";
}

$conn->close();
?>