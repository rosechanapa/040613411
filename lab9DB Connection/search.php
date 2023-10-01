<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
        if(!empty($_GET)){
            $value= '%' . $_GET["username"] . '%';
            $stmt->bindParam(1, $value);
            $stmt->execute();
        }

        while ($row = $stmt->fetch()) :
            echo "ชื่อสมาชิก: " . $row ["name"] . "<br>";
            echo "ที่อยู่: " . $row ["address"] . "<br>";
    
            echo "อีเมล์: " . $row ["email"] . "<br>";
        ?>
        
        <img src="member_photo/<?= $row["username"] ?>.jpg" width='200' height='200'> 

        <?php
        endwhile;
    ?>
</body>
</html>