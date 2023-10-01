<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo "username : " . $row["username"] . "<br>";
        echo "รหัสผ่าน : " . $row["password"] . "<br>";
        echo "ชื่อจริง : " . $row["name"] . "<br>";
        echo "ที่อยู่: " . $row["address"] . "<br>";
        echo "เบอร์โทร : " . $row["mobile"] . "<br>";
        echo "อีเมล : " . $row["email"] . "<br>";
        echo "<a href='editmember.php?username=" . $row["username"] . "'>แก้ไข</a> ";
        // ส่งชื่อผู้ใช้ไปยังฟังก์ชัน JavaScript
        echo "<a href='remove.php?username=" . $row["username"] . "' onclick='confirmDelete(\"" . $row["username"] . "\")'>ลบ</a>";
        echo "<hr>\n";
    }
    ?>
    <script>
        function confirmDelete(username) {
            var ans = confirm("ต้องการลบผู้ใช้ " + username);
            if (ans == true) {
                // ให้เปลี่ยนเส้นทางไปยังหน้า remove.php พร้อมชื่อผู้ใช้
                document.location = "remove.php?username=" + username;
            }
        }
    </script>
</body>
</html>