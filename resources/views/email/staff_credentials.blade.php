<!DOCTYPE html>
<html>

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>BangbaraPOS Staff Account Credentials</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #fff3e0; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ffcc80; border-radius: 10px;">
        <div style="text-align: center;">
            <img src="cid:logo_bangbara.png" alt="Logo BangbaraPOS" style="width: 80px; height: 80px;">
            <h2 style="color: #d32f2f;">Welcome to BangbaraPos</h2>
        </div>
        <p style="font-size: 16px;">Halo {{ $name }},

            Selamat datang di <span class="font-bold text-red-700">BangbaraPOS!</span> Kami sangat senang menyambut Anda
            sebagai bagian dari tim kami. Kami
            percaya bahwa kehadiran Anda akan membawa energi dan ide-ide segar yang akan semakin memperkuat kolaborasi
            dan inovasi di lingkungan kerja.</p>
        <p style="font-size: 16px;"><strong>Email:</strong> {{ $email }}</p>
        <p style="font-size: 16px;"><strong>Password:</strong> {{ $password }}</p>
        <p style="font-size: 16px;">Please login and change your password immediately.</p>
    </div>
</body>

</html>
