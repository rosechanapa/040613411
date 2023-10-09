<?php
include "connect.php";
session_start();

// ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
if (empty($_SESSION["username"])) {
    header("location: login-form.php");
}

?>
<html>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>
<hr>

<?php
if (isset($_SESSION["rule"]) && $_SESSION["rule"] === "admin") {
    $stmt = $pdo->prepare("SELECT username, COUNT(*) as order_count FROM orders GROUP BY username");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<h3>จำนวน Order ทั้งหมด</h3>";
        echo "<table border='1'>";
        echo "<tr><th>username</th><th>จำนวน Order</th></tr>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td><a href='allorder.php?username=" . $row["username"] . "'>" . $row["order_count"] . "</a></td>";
            echo "</tr>";
        }

        echo "</table> <br>";
    } 
    else {
        echo "ไม่พบ Order ";
    }

    echo "<h3>หน้าคลังสินค้า</h3>";
    echo "<a href='product-list.php'> คลังสินค้า </a>";

    echo "<hr>";
} 
else { //user
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
    $stmt->bindParam(1, $_SESSION["username"]);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h2>รายการสั่งซื้อทั้งหมด</h2>";

        while ($row = $stmt->fetch()) {
            echo "<h3>รหัส Order: " . $row["ord_id"] . "</h3>";
            echo "<p>วันที่สั่ง: " . $row["ord_date"] . "</p>";
            echo "<p>สถานะ: " . $row["status"] . "</p>";

            $stmt2 = $pdo->prepare("SELECT i.pid, i.quantity, p.pname, p.price FROM item i JOIN product p ON i.pid = p.pid WHERE i.ord_id = ?");
            $stmt2->bindParam(1, $row["ord_id"]);
            $stmt2->execute();

            if ($stmt2->rowCount() > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ชื่อสินค้า</th><th>จำนวน</th><th>ราคา</th><th>ทั้งหมด</th></tr>";

                $total = 0;

                while ($row2 = $stmt2->fetch()) {
                    $subtotal = $row2["price"] * $row2["quantity"];
                    echo "<tr>";
                    echo "<td>" . $row2["pname"] . "</td>";
                    echo "<td>" . $row2["quantity"] . "</td>";
                    echo "<td>" . $row2["price"] . "</td>";
                    echo "<td>" . $subtotal . "</td>";
                    echo "</tr>";

                    $total += $subtotal;
                }

                echo "</table>";
                echo "<p>ราคารวม: " . $total . "</p><hr>";
            }

        }
    } 
    else {
        echo "ไม่พบ Order <br><br>";
    }
}

?>

<br>
หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
</body>
</html>
