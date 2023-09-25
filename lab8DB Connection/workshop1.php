<html>
<body>
    <?php
        
        /*
        $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM product");

        $stmt->execute();

        while ($row = $stmt->fetch()) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
        }*/
        $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();

        echo "<table border='1'  >";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>รหัสสินค้า</th>";
                    echo "<th>ขื่อสินค้า</th>";
                    echo "<th>รายละเอียด</th>";
                    echo "<th>ราคา</th>";
                echo "</tr>";
            echo "</thead>";

            echo "<tbody>";
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                    echo "<td>" . $row["pid"] . "</td>";
                    echo "<td>" . $row["pname"] . "</td>";
                    echo "<td>" . $row["pdetail"] . "</td>";
                    echo "<td>" . $row["price"] . " บาท" . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
</body>
</html>