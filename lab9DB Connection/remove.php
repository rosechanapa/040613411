<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php
    if (isset($_GET["username"])) {
        $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $pdo->prepare("DELETE FROM member WHERE username = ?");
        $stmt->bindParam(1, $_GET["username"]);
    
        if ($stmt->execute()) {
            header("Location: workshop6,9.php");
            exit();
        } else {
            echo "เกิดข้อผิดพลาดในการลบผู้ใช้";
        }
    } else {
        echo "ไม่ได้รับผู้ใช้ที่ต้องการลบ";
    }
    ?>

</body>
</html>