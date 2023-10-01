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
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $mobile = $_POST["mobile"];
        $email = $_POST["email"];

        // อัปโหลดรูปภาพ
        $profilePicture = $_FILES["profile"];

        $uploadDirectory = "member_photo/";
        $profilePictureName = $username . ".jpg";

        if (move_uploaded_file($profilePicture["tmp_name"], $uploadDirectory . $profilePictureName)) {
            // ได้ทำการอัปโหลดรูปภาพเรียบร้อยแล้ว
            // ตรวจสอบโค้ด SQL เพื่ออัปเดตข้อมูลสมาชิกในฐานข้อมูล
            $stmt = $pdo->prepare("UPDATE member SET password = ?, name = ?, address = ?, mobile = ?, email = ? WHERE username = ?");
            
            $stmt->bindParam(1, $password);
            $stmt->bindParam(2, $name);
            $stmt->bindParam(3, $address);
            $stmt->bindParam(4, $mobile);
            $stmt->bindParam(5, $email);
            $stmt->bindParam(6, $username);

            $stmt->execute();

            echo "อัปเดตข้อมูลสมาชิกและรูปภาพเรียบร้อยแล้ว";
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
        }
    ?>
</body>
</html>