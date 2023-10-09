<?php
include "connect.php";
session_start();

if ($_SESSION["rule"] !== "admin") {
    echo "ไม่มีสิทธ์เข้าถึงข้อมูล";

    exit(); 
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
    $stmt->bindParam(1, $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h2>รายการสั่งซื้อทั้งหมดของ $username</h2> <hr>";


        while ($row = $stmt->fetch()) {
            $orderId = $row["ord_id"];
            $orderDate = $row["ord_date"];
            $status = $row["status"];

            echo "<h3>รหัส Order: $orderId</h3>";
            echo "<p>วันที่สั่ง: $orderDate</p>";
            echo "<p>สถานะ: $status</p>";

            $itemStmt = $pdo->prepare("SELECT i.*, p.pname, p.price FROM item i JOIN product p ON i.pid = p.pid WHERE i.ord_id = ?");
            $itemStmt->bindParam(1, $orderId);
            $itemStmt->execute();

            if ($itemStmt->rowCount() > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ชื่อรายการ</th><th>จำนวน</th><th>ราคา</th><th>ทั้งหมด</th></tr>";

                $total = 0; 
                
                while ($row2 = $itemStmt->fetch()) {
                    $productname = $row2["pname"];
                    $quantity = $row2["quantity"];
                    $price = $row2["price"];
                    $subtotal = $price * $quantity;

                    echo "<tr>";
                    echo "<td>$productname</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>$price</td>";
                    echo "<td>$subtotal</td>";
                    echo "</tr>";

                    $total += $subtotal; 
                }

                echo "</table>";
                echo "<p>ราคารวม: $total</p><hr>";
            }
        }

        echo "<br> <a href='user-home.php'>กลับไปหน้าหลัก</a>";
    } 
    else {
        echo "ไม่พบ order ของ $username";
        echo "<br> <a href='user-home.php'>กลับไปหน้าหลัก</a>";
    }
} 
else {
    echo "ไม่พบผู้ใช้";
    echo "<br> <a href='user-home.php'>กลับไปหน้าหลัก</a>";
}
?>