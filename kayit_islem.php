<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "oylama";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Telefon numarasının veritabanında olup olmadığını kontrol et
    $sql_check_phone = "SELECT * FROM users WHERE number = '$phone_number'";
    $result_phone = $conn->query($sql_check_phone);

    // Kullanıcı adının veritabanında olup olmadığını kontrol et
    $sql_check_username = "SELECT * FROM users WHERE username = '$username'";
    $result_username = $conn->query($sql_check_username);

    if ($result_phone->num_rows > 0) {
        // Eğer telefon numarası varsa, kullanıcıya uyarı göster
        echo "<script>
                alert('Bu telefon numarası zaten kayıtlı. Lütfen giriş yapın.');
                window.location.href = 'giris.php';
              </script>";
        exit();
    } elseif ($result_username->num_rows > 0) {
        // Eğer kullanıcı adı varsa, kullanıcıya uyarı göster
        echo "<script>
                alert('Bu kullanıcı adı zaten kullanılıyor. Lütfen farklı bir kullanıcı adı seçin.');
                window.history.back();
              </script>";
        exit();
    } else {
        // Şifreyi hash'le
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Veritabanına kayıt ekle
        $sql = "INSERT INTO users (name, surname, number, username, password) 
                VALUES ('$first_name', '$last_name', '$phone_number', '$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Kayıt başarılı! Giriş sayfasına yönlendiriliyorsunuz.');
                    window.location.href = 'giris.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Hata: " . $conn->error . "');
                    window.history.back();
                  </script>";
        }
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
