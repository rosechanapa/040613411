<?php
$username = $_GET["username"];
echo $username . "<br>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM member WHERE username LIKE :username";
$usernameParam = '%' . $username . '%';  // Add '%' to the bound parameter
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $usernameParam, PDO::PARAM_STR);  // Use $usernameParam
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1">
    <th>username</th><th>name</th><th>address</th><th>profile</th>
    <?php foreach ($result as $row): ?>
        
        <tr>
            <td>
                <?php echo $row["username"] ?>
            </td>
            <td>
                <?php echo $row["name"] ?>
            </td>
            <td>
                <?php echo $row["address"] ?>
            </td>
            <td>
                <img src='member_photo/<?=$row["username"]?>.jpg' width='150' height='150'>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
