<?php
session_start(); // Oturum başlat

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oylama";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen veriler
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Veritabanında kullanıcıyı bul
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $user = $result->fetch_assoc();

        // Şifreyi kontrol et
        if (password_verify($password, $user['password'])) {
            // Şifre doğruysa, oturum başlat ve kullanıcı ID'sini sakla
            $_SESSION['user_id'] = $user['user_id']; // 'id' yerine 'user_id' kullanıldı
            $_SESSION['username'] = $user['username'];

            // İçerik sayfasına yönlendir
            header("Location: icerik.php");
            exit();
        } else {
            // Şifre yanlış
            echo "<script>alert('Hatalı şifre!');</script>";
            header("Location: giris.php");
            exit();
        }
    } else {
        // Kullanıcı adı bulunamadı
        echo "<script>alert('Kullanıcı bulunamadı!');</script>";
        header("Location: giris.php");
        exit();
    }
}

// Bağlantıyı kapat
$conn->close();
?>
