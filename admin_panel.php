<?php
session_start();
include 'db.php'; // Veritabanı bağlantısı

// Yönetici olup olmadığını kontrol et
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: giris.php');
    exit;
}

// Şarkı ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $track_url = $_POST['track_url'];
    $description = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO music_control (track_url, description) VALUES (?, ?)");
    $stmt->bind_param('ss', $track_url, $description);
    $stmt->execute();
}

// Şarkı kaldırma işlemi
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $music_id = $_POST['music_id'];
    $stmt = $conn->prepare("DELETE FROM music_control WHERE music_id = ?");
    $stmt->bind_param('i', $music_id);
    $stmt->execute();
}

// Şarkıları veritabanından çek
$result = $conn->query("SELECT music_id, track_url, description FROM music_control ORDER BY music_id DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Yönetim Paneli</h1>
    
    <form action="" method="POST">
        <input type="hidden" name="action" value="add">
        <label for="track_url">Spotify Parça URL'si:</label>
        <input type="text" id="track_url" name="track_url" required><br>

        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required></textarea><br>

        <button type="submit">Şarkı Ekle</button>
    </form>

    <h2>Eklenen Şarkılar</h2>
    <ul>
        <?php while ($music = $result->fetch_assoc()): ?>
            <li>
                <iframe style="border-radius:12px" src="<?php echo $music['track_url']; ?>" width="50%" height="352" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                <p><?php echo $music['description']; ?></p>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="music_id" value="<?php echo $music['music_id']; ?>">
                    <button type="submit" onclick="return confirm('Bu şarkıyı kaldırmak istediğinize emin misiniz?');">Kaldır</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
