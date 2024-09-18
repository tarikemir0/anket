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
    <h3>HAKKIMIZDA</h3><br>
        <p>İşte arkadaşlar BoomBap Rap ve Ankara Ruhu toplulukları olarak karar verdik ki kendi seçtiğimiz kendi oyladığımız bağımsız bir listemiz olsun. Discord
            kanalımıza ve paydaş youtuberların kanallarına gelen en çok beğeni almış isimleri listeye ekliyoruz. SİZİN OYLARINIZLA. İlk liste bizim editörlüğümüzde oldu 
            ancak bundan sonraki haftaların listeleri buradaki oylama sonuçlarına göre şekillenecek ve tüm süreç katılımcı, demokratik ve şeffaf bir şekilde
            ilerleyecektir. Listelerde kendini duyurmak için yer almak isteyen tüm mc leri kollektif topluluğumuza eserlerini göndermeye ve kesinlikle
            ama kesinlikle listeyi kaydedip paylaşmaya davet ediyoruz. Bu bir bağımsız hip hop başkaldırısıdır. Herkesin elini taşın altına koymasını ve demokratik, 
            şeffaf süreçleri desteklemesini bekliyoruz. <br><br><br>

            Discord:link<br>
            Youtube:link
        </p>
    </div>
    <div class="anket">
        <h2>HAFTANIN ANKETİ</h2><br><br><br>
        <div class="anket-icerik">
            <div class="music">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/4d1h82c6Ha9sKIhDFkrd7g?utm_source=generator&theme=0" width="50%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <div class="music-anket">
            <h4>Listeye Eklenmeli mi?</h4>
        <form id="pollForm" style=" color: rgb(192, 192, 192);
    word-wrap: break-word;
    font-size: 20px;
    font-family: 'Hanken Grotesk', sans-serif;
    font-optical-sizing: auto;
    line-height: 30px;
    margin-top: 80px;">
            <label>
                <input type="radio" name="vote" value="blue"> Beğendim... Eklenmeli
            </label><br>
            <label>
                <input type="radio"  name="vote" value="red"> Daha Zamanı Var
            </label><br>
            <button type="submit" id="gizliButon" onClick="butonuGizle()">Oy Ver</button>
        </form>
        <br><br>
        <div id="results" class="hidden">
            <p>Beğendim... Eklenmeli: <span id="blueVotes">0</span> oy</p>
            <p> Daha Zamanı Var: <span id="redVotes">0</span> oy</p>
        </div>
            </div>
            </div>
        </div>
    </div>
   
</div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Kullanıcının daha önce oy verip vermediğini kontrol et
    const hasVoted = localStorage.getItem('hasVoted');
    if (hasVoted) {
        // Eğer kullanıcı oy verdiyse, formu gizle ve sonuçları göster
        let blueVotes = parseInt(localStorage.getItem('blueVotes')) || 0;
        let redVotes = parseInt(localStorage.getItem('redVotes')) || 0;

        document.getElementById('blueVotes').textContent = blueVotes;
        document.getElementById('redVotes').textContent = redVotes;
        document.getElementById('results').classList.remove('hidden');
        document.getElementById('pollForm').style.display = 'none';
    }
});

document.getElementById('pollForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const vote = document.querySelector('input[name="vote"]:checked');
    if (!vote) {
        alert('Lütfen bir seçim yapın.');
        return;
    }
    
    // Oyları saklamak için (gelişmiş bir uygulama için veritabanı kullanılabilir)
    let blueVotes = parseInt(localStorage.getItem('blueVotes')) || 0;
    let redVotes = parseInt(localStorage.getItem('redVotes')) || 0;
    
    if (vote.value === 'blue') {
        blueVotes++;
        localStorage.setItem('blueVotes', blueVotes);
    } else if (vote.value === 'red') {
        redVotes++;
        localStorage.setItem('redVotes', redVotes);
    }

    // Kullanıcının oy verdiğini kaydet
    localStorage.setItem('hasVoted', true);

    // Sonuçları göster
    document.getElementById('blueVotes').textContent = blueVotes;
    document.getElementById('redVotes').textContent = redVotes;
    document.getElementById('results').classList.remove('hidden');

    // Radyo butonlarını ve submit butonunu gizle
    document.getElementById('pollForm').style.display = 'none';
});

</script>


</body>
</html>
