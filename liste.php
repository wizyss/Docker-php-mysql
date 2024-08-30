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

// Veritabanındaki verileri çek
try {
    $sql = "SELECT id, input_text FROM user_input";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Sonuçları bir diziye al
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Veri çekme hatası: " . $e->getMessage());
}

// Bağlantıyı kapat
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veritabanı Verileri</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 50px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Veritabanına Kayıtlı Veriler</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Metin</th>
    </tr>
    <?php foreach ($results as $row): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['input_text']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
