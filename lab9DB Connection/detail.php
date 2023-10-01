<!DOCTYPE html>
<html lang="en">

<body>
    <?php
        $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
        $stmt->bindParam(1, $_GET["username"]); // 2. น าค่า pid ที่สงมากับ ่ URL ก าหนดเป็นเงื่อนไข
        $stmt->execute(); // 3. เริ่มค ้นหา
        $row = $stmt->fetch(); // 4. ดึงผลลัพธ์ (เนื่องจากมีข ้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
    ?>
    <div style="display:flex">
        <div>
            <img src='member_photo/<?=$row["username"]?>.jpg' width='200'>
        </div>
        <div style="padding: 15px">
            <h2><?=$row["name"]?></h2>
            <?php
            echo "ชื่อผู้ใช้: " . $row ["username"] . "<br>";
            echo "ที่อยู่: " . $row ["address"] . "<br>";
            echo "อีเมล์: " . $row ["email"] . "<br>";
            ?>
        </div>
    </div>
    
    
</body>
</html>