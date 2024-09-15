<?php
session_start(); // Oturum başlat

// Veritabanı bağlantısı
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
    $sql = "SELECT * FROM kayıt WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu
        $user = $result->fetch_assoc();

        // Şifreyi kontrol et
        if (password_verify($password, $user['password'])) {
            // Şifre doğru, oturum başlat
            $_SESSION['username'] = $user['username']; // Oturuma kullanıcı adını kaydet
            header("Location: profil.php"); // Profil sayfasına yönlendir
            exit();
        } else {
            // Şifre yanlış
            echo "<script>alert('Hatalı şifre!');</script>";
        }
    } else {
        // Kullanıcı adı bulunamadı
        echo "<script>alert('Kullanıcı bulunamadı!');</script>";
    }
}

// Bağlantıyı kapat
$conn->close();
?>
