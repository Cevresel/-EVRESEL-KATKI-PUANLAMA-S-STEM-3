<?php
session_start();
include("includes/db_connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$waste_type = $_POST['waste_type'];
$waste_weight = $_POST['waste_weight'];

// Atık türüne göre puan belirleme
switch ($waste_type) {
    case 'Kağıt':
        $points = 10 * $waste_weight;
        break;
    case 'Plastik':
        $points = 15 * $waste_weight;
        break;
    case 'Cam':
        $points = 20 * $waste_weight;
        break;
    case 'Metal':
        $points = 25 * $waste_weight;
        break;
    case 'Pil':
        $points = 50 * $waste_weight;
        break;
    default:
        $points = 0;
        break;
}

// Kullanıcının toplam puanını güncelleme
$query = "UPDATE users SET total_points = total_points + $points WHERE user_id = '$user_id'";
mysqli_query($conn, $query);

// Atık gönderisini veritabanına kaydetme
$query = "INSERT INTO waste_submission (user_id, waste_type, waste_weight, points_earned) VALUES ('$user_id', '$waste_type', '$waste_weight', '$points')";
mysqli_query($conn, $query);

// Kullanıcıyı profil sayfasına yönlendirme
header("Location: profile.php");
exit();
?>
