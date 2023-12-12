<?php
include 'db.php';
$db = new Database();
$pdo = $db->pdo;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db->insertUser($_POST['email'], $_POST['password']);
        echo "Successfully added";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="Wachtwoord">
        <input type="submit">
    </form>

    <table>
        <tr>
            <th>id</th>
            <th>email</th>
            <th>password</th>
        </tr>

        <tr> <?php
            $user = $db->selectOneUser(1);
            
            if ($user !== null) {
                echo "<td>{$user['id']}</td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['password']}</td>";
            } else {
                echo "<td colspan='3'>No user found</td>";
            }
            ?>
        </tr>
    </table>
</body>
</html>