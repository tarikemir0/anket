<?php
session_start();
include 'db.php'; // Veritabanı bağlantısı

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$music_id = $_POST['music_id'];
$new_vote = $_POST['vote'];

// music_id'nin varlığını kontrol et
$checkStmt = $conn->prepare("SELECT COUNT(*) FROM music_control WHERE music_id = ?");
$checkStmt->bind_param('i', $music_id);
$checkStmt->execute();
$checkStmt->bind_result($count);
$checkStmt->fetch();
$checkStmt->close(); // Kullanım tamamlandıktan sonra kapat

if ($count > 0) {
    // Kullanıcının mevcut oyunu güncelle veya yeni oyunu ekle
    $stmt = $conn->prepare("INSERT INTO votes (user_id, music_id, vote_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE vote_value = ?");
    $stmt->bind_param('iisi', $user_id, $music_id, $new_vote, $new_vote);
    $stmt->execute();
    $stmt->close(); // Kullanım tamamlandıktan sonra kapat
} else {
    // music_id bulunamazsa hata mesajı verebilirsiniz
    echo "Geçersiz müzik ID.";
}

// Başarılı güncelleme sonrası anket sayfasına yönlendir
header('Location: icerik.php');
exit;
?>
