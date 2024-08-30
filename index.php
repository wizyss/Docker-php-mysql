<?php
// Veritabanı bağlantı bilgileri
$servername = "database";
$username = "php_db_user";
$password = "super_strong_password";
$dbname = "php_db";

try {
    // Veritabanı bağlantısını oluştur
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // PDO hata modunu istisna olarak ayarla
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

// Tabloyu oluştur
// try {
//     $sql = "CREATE TABLE IF NOT EXISTS user_input (
//                 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//                 input_text VARCHAR(100) NOT NULL
//             )";
//     $conn->exec($sql);
// } catch(PDOException $e) {
//     die("Tablo oluşturma hatası: " . $e->getMessage());
// }

// Form gönderildiğinde çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST['inputText'];

    // SQL sorgusu hazırlanmış ifadelerle
    $sql = "INSERT INTO user_input (input_text) VALUES (:inputText)";
    $stmt = $conn->prepare($sql);
    
    // Parametreyi bağla
    $stmt->bindParam(':inputText', $inputText);
    
    if ($stmt->execute()) {
        echo "Kayıt başarılı!";
    } else {
        echo "Hata: " . $sql . "<br>" . $stmt->errorInfo();
    }
}

// Bağlantıyı kapat
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veri Girişi</title>
</head>
<body>

<h2>Veritabanına Veri Ekleme</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="inputText">Metin:</label><br>
  <input type="text" id="inputText" name="inputText"><br><br>
  <input type="submit" value="Gönder">
</form> 

</body>
</html>
