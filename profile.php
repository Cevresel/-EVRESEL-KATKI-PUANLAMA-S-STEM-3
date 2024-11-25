<?php
session_start();
include("includes/db_connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Kullanıcı bilgilerini alma
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil Sayfası</title>
</head>
<body>
    <h1>Profil Sayfası</h1>
    <p>Ad Soyad: <?php echo $user['name']; ?></p>
    <p>Okul: <?php echo $user['school']; ?></p>
    <p>İlçe: <?php echo $user['district']; ?></p>
    <p>İl: <?php echo $user['city']; ?></p>
    <p>Toplam Puan: <?php echo $user['total_points']; ?></p>

    <h2>Geri Dönüşüm Katkıları</h2>
    <form action="submit.php" method="POST">
        <label for="waste_type">Atık Türü:</label>
        <select name="waste_type">
            <option value="Kağıt">Kağıt</option>
            <option value="Plastik">Plastik</option>
            <option value="Cam">Cam</option>
            <option value="Metal">Metal</option>
            <option value="Pil">Pil</option>
        </select>

        <label for="waste_weight">Atık Miktarı (kg):</label>
        <input type="number" name="waste_weight" required>

        <button type="submit">Atık Gönder</button>
    </form>
</body>
</html>
