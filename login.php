<?php
session_start();
include("includes/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Veritabanında kullanıcıyı doğrulama
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: profile.php");
    } else {
        $error = "Geçersiz e-posta veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>
    <h1>Giriş Yap</h1>
    <form method="POST" action="">
        <label for="email">E-posta:</label>
        <input type="email" name="email" required>

        <label for="password">Şifre:</label>
        <input type="password" name="password" required>

        <button type="submit">Giriş Yap</button>
    </form>
    <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
