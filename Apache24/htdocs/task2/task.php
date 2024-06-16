<?php
$host = 'localhost';
$dbname = 'testuser';
$username = 'root';
$password = 'Qq98933096@';
$likeability = '';
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'mysql 연결 실패, ' . $e->getMessage() . "<br>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['target'])) {
        $query = $db->prepare("SELECT * FROM dooly WHERE target = :target");
        $query->bindParam(":target", $_POST['target']);
        $query->execute();
        $userInfo = $query->fetch(PDO::FETCH_ASSOC);
        if (!$userInfo)
            $likeability = "또치, 고길동 중 하나를 입력해 주세요!";
        else
            $likeability = $userInfo['likeability'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>둘리</title>
</head>

<body>
    <h2>둘리 호감도 체크</h2>
    <form method="post" action="">
        <label>대상:</label>
        <input type="text" name="target" id="login_id" required>
        <input type="submit" value="확인">
        <?php if ($likeability): ?>
            <p>둘리에 대한 호감도 : <?php echo $likeability; ?></p>
        <?php endif; ?>
    </form>
</body>

</html>