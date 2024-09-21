<?php
session_start();
include 'db.php'; // Veritabanı bağlantısı

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcıyı veritabanında kontrol et
    $stmt = $conn->prepare("SELECT user_id, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    // Kullanıcı bulundu mu?
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $is_admin);
        $stmt->fetch();

        // Şifre doğru mu?
        if (password_verify($password, $hashed_password)) {
            // Admin mi kontrol et
            if ($is_admin) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['admin'] = true; // Admin oturumu başlat
                header('Location: admin_panel.php');
                exit;
            } else {
                echo "Yönetici değilsiniz!";
            }
        } else {
            echo "Yanlış şifre!";
        }
    } else {
        echo "Kullanıcı bulunamadı!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Girişi</h1>
    <form action="admin_login.php" method="POST">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
