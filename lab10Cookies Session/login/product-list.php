<?php
	include "connect.php";
    session_start();
    // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if ($_SESSION["rule"] !== "admin") {
        echo "ไม่มีสิทธ์เข้าถึงข้อมูล";
    
        exit(); 
    }
?>

<html>
<head><meta charset="utf-8"></head>
<body>
<?php
   $stmt = $pdo->prepare("SELECT * FROM product");
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
    echo "<table border='1'>";
    echo "<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th>รายละเอียด</th><th>ราคา</th></tr>";

    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row["pid"] . "</td>";
        echo "<td>" . $row["pname"] . "</td>";
        echo "<td>" . $row["pdetail"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br> <a href='user-home.php'>กลับไปหน้าหลัก</a>";
} 
else {
    echo "ไม่พบสินค้าในคลัง";
    echo "<br> <a href='user-home.php'>กลับไปหน้าหลัก</a>";
}
?>

</body>
</html>
