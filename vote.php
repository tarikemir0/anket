<?php
session_start();
include 'db.php'; // Veritabanı bağlantısı

// Kullanıcı giriş yapmamışsa geri gönder
if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$poll_id = $_POST['poll_id'];
$vote_value = $_POST['vote'];

// Kullanıcının daha önce oy verip vermediğini kontrol et
$stmt = $conn->prepare("SELECT vote_id FROM votes WHERE user_id = ? AND poll_id = ?");
$stmt->bind_param('ii', $user_id, $poll_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // Kullanıcı daha önce oy vermemişse, oyunu kaydet
    $insertStmt = $conn->prepare("INSERT INTO votes (user_id, poll_id, vote_value) VALUES (?, ?, ?)");
    $insertStmt->bind_param('iis', $user_id, $poll_id, $vote_value);
    $insertStmt->execute();
}

// İçerik sayfasına geri dön
header('Location: icerik.php');
exit;
?>
