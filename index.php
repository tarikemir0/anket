<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="giris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Boom Bap Rap</title>
</head>
<body>
    <div class="wrapper">
        <form action="kayit_islem.php" method="POST">
            <h1>Kayıt Ol</h1>

            <div class="input-box">
                <input type="text" name="first_name" placeholder="İsim" required><i class='bx bxs-user-pin'></i>
            </div>

            <div class="input-box">
                <input type="text" name="last_name" placeholder="Soyisim" required><i class='bx bxs-user-pin'></i>
            </div>
            <div class="input-box">
                <input type="text" name="phone_number" placeholder="Telefon Numarası" maxlength="11" required><i class="fa-solid fa-phone"></i>
            </div>
            <div class="input-box">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Şifre" required><i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" class="btn">Kayıt Ol</button>

            <div class="register-link">
                <p>Zaten bir hesabın var mı?<a href="giris.html"> Giriş Yap</a></p>
            </div>
        </form>
    </div>
</body>
</html>
