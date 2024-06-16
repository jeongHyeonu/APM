<?php
include './LoginUser.php';

$host = 'localhost';
$dbname = 'testuser';
$username = 'root';
$password = 'Qq98933096@';

$loginUser = new LoginUser($host, $dbname, $username, $password);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $message = $loginUser->register($id, $password, $role);
    } elseif (isset($_POST['login'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $message = $loginUser->login($id, $password);
    } elseif (isset($_POST['logout'])) {
        $loginUser->logout();
        $message = "Logged out successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>회원가입 & 로그인</title>
</head>

<body>
    <h1>회원가입 & 로그인</h1>

    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['USER_ID'])): ?>
        <h2>회원가입</h2>
        <form method="post" action="">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <label for="role">Role:</label>
            <input type="text" name="role" id="role" required><br>
            <input type="submit" name="register" value="Register">
        </form>

        <h2>로그인</h2>
        <form method="post" action="">
            <label for="login_id">ID:</label>
            <input type="text" name="id" id="login_id" required><br>
            <label for="login_password">Password:</label>
            <input type="password" name="password" id="login_password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    <?php else: ?>
        <p>환영합니다, <?php echo $_SESSION['USER_ID']; ?>!</p>
        <p><?php echo "등급 : " . $loginUser->checkRole(); ?></p>
        <form method="post" action="">
            <input type="submit" name="logout" value="Logout">
        </form>
    <?php endif; ?>
</body>

</html>