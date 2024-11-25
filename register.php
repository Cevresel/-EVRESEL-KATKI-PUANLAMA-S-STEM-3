<?php
include("includes/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $school = $_POST['school'];
    $district = $_POST['district'];
    $city = $_POST['city'];

    // Şifreyi güvenli hale getirme
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Veritabanına yeni kullanıcı ekleme
    $query = "INSERT INTO users (email, password, name, school, district, city) VALUES ('$email', '$hashed_password', '$name', '$school', '$district', '$city')";
    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
    } else {
        $error = "Kayıt sırasında bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
</head>
<body>
    <h1>Kayıt Ol</h1>
    <form method="POST" action="">
        <label for="email">E-posta:</label>
        <input type="email" name="email" required>

        <label for="password">Şifre:</label>
        <input type="password" name="password" required>

        <label for="name">Ad Soyad:</label>
        <input type="text" name="name" required>

        <label for="school">Okul:</label>
        <input type="text" name="school" required>

        <label for="district">İlçe:</label>
        <input type="text" name="district" required>

        <label for="city">İl:</label>
        <input type="text" name="city" required>

        <button type="submit">Kayıt Ol</button>
    </form>
    <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
