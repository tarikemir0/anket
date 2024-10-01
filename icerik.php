<?php
session_start();
include 'db.php'; // Veritabanı bağlantısı

// Kullanıcı giriş yapmış mı kontrol et
if (!isset($_SESSION['user_id'])) {
    header('Location: giris.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Eklenen şarkıları veritabanından çek
$musicResult = $conn->query("SELECT music_id, track_url, description FROM music_control ORDER BY music_id DESC");

// Oy sayma ve yüzdeleri hesaplama
$pollResults = [];
while ($music = $musicResult->fetch_assoc()) {
    $music_id = $music['music_id']; // Doğru değişken adı

    // Kullanıcının daha önce oy verip vermediğini kontrol et
    $stmt = $conn->prepare("SELECT vote_value FROM votes WHERE user_id = ? AND music_id = ?");
    $stmt->bind_param('ii', $user_id, $music_id);
    $stmt->execute();
    $stmt->store_result();

    $hasVoted = ($stmt->num_rows > 0);

    // Eğer kullanıcı daha önce oy vermişse oy değerini al
    if ($hasVoted) {
        $stmt->bind_result($vote_value);
        $stmt->fetch();
    }

    // Toplam oyları hesapla
    $voteCountStmt = $conn->prepare("SELECT vote_value, COUNT(*) as vote_count FROM votes WHERE music_id = ? GROUP BY vote_value");
    $voteCountStmt->bind_param('i', $music_id);
    $voteCountStmt->execute();
    $voteResults = $voteCountStmt->get_result();

    $votes = [];
    while ($row = $voteResults->fetch_assoc()) {
        $votes[$row['vote_value']] = $row['vote_count'];
    }

    // Yüzdeleri hesapla
    $totalVotes = array_sum($votes);
    $blueVotes = $votes['blue'] ?? 0;
    $redVotes = $votes['red'] ?? 0;

    $bluePercentage = $totalVotes > 0 ? ($blueVotes / $totalVotes) * 100 : 0;
    $redPercentage = $totalVotes > 0 ? ($redVotes / $totalVotes) * 100 : 0;

    $pollResults[] = [
        'music' => $music,
        'hasVoted' => $hasVoted,
        'vote_value' => $vote_value ?? null,
        'blueVotes' => $blueVotes,
        'redVotes' => $redVotes,
        'bluePercentage' => $bluePercentage,
        'redPercentage' => $redPercentage
    ];
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boom Bap Rap</title>
    <link rel="stylesheet" href="icerik.css">
</head>
<body>
    <header style="margin: auto;">
        <h1>BOOM BAP RAP</h1>
    </header>

    <div class="icerik">
        <div class="about"> 
            <h3>HAKKIMIZDA</h3>
            <p>İşte arkadaşlar BoomBap Rap ve Ankara Ruhu toplulukları olarak karar verdik ki kendi seçtiğimiz kendi oyladığımız bağımsız bir listemiz olsun. Discord kanalımıza ve paydaş youtuberların kanallarına gelen en çok beğeni almış isimleri listeye ekliyoruz. SİZİN OYLARINIZLA. İlk liste bizim editörlüğümüzde oldu ancak bundan sonraki haftaların listeleri buradaki oylama sonuçlarına göre şekillenecek ve tüm süreç katılımcı, demokratik ve şeffaf bir şekilde ilerleyecektir. Listelerde kendini duyurmak için yer almak isteyen tüm mc leri kollektif topluluğumuza eserlerini göndermeye ve kesinlikle ama kesinlikle listeyi kaydedip paylaşmaya davet ediyoruz. Bu bir bağımsız hip hop başkaldırısıdır. Herkesin elini taşın altına koymasını ve demokratik, şeffaf süreçleri desteklemesini bekliyoruz.</p>
        </div>

        <div class="anket">
            <h2>HAFTANIN ANKETİ</h2>
            <div class="anket-icerik">
                <div class="music">
                    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/4d1h82c6Ha9sKIhDFkrd7g?utm_source=generator&theme=0" width="50%" height="352" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                    <div class="music-anket">
                        <h4>Listeye Eklenmeli mi?</h4>
                        <?php if (!$hasVoted): ?>
                            <form id="pollForm" action="vote.php"  style=" color: rgb(192, 192, 192);
    word-wrap: break-word;
    font-size: 20px;
    font-family: 'Hanken Grotesk', sans-serif;
    font-optical-sizing: auto;
    line-height: 30px;
    margin-top: 80px;" method="POST">
                                <label>
                                    <input type="radio" name="vote" value="blue"> Beğendim... Eklenmeli
                                </label><br>
                                <label>
                                    <input type="radio" name="vote" value="red"> Daha Zamanı Var
                                </label><br>
                                <input type="hidden" name="poll_id" value="<?php echo $poll_id; ?>">
                                <button type="submit" id="gizliButon">Oy Ver</button>
                            </form>
                        <?php else: ?>
                            <div id="results">
                                <p>Beğendim... Eklenmeli: <?php echo $blueVotes; ?> oy</p>
                                <p>Daha Zamanı Var: <?php echo $redVotes; ?> oy</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
