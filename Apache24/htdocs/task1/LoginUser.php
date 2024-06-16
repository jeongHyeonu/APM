<?php
class LoginUser
{
    private $db;
    private $sessionTimeout = 300;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            session_start();
            $this->checkSessionTimeout();
        } catch (PDOException $e) {
            echo 'mysql 연결 실패, ' . $e->getMessage() . "<br>";
        }
    }

    public function checkSessionTimeout()
    {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $this->sessionTimeout)) {
            $this->logout();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    public function login($id, $password)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $userInfo = $query->fetch(PDO::FETCH_ASSOC);

        if ($userInfo && password_verify($password, $userInfo['password'])) {
            $currentIp = $_SERVER['REMOTE_ADDR'];

            if (isset($_SESSION['IP_ADDRESS']) && $_SESSION['IP_ADDRESS'] !== $currentIp) {
                $this->logout();
                return "다른 IP로 로그인하여 로그아웃합니다.";
            }

            $_SESSION['USER_ID'] = $userInfo['id'];
            $_SESSION['ROLE'] = $userInfo['role'];
            $_SESSION['IP_ADDRESS'] = $currentIp;
            $_SESSION['LAST_ACTIVITY'] = time();

            return "로그인 성공!";
        } else {
            return "ID 또는 비밀번호가 잘못되었습니다!";
        }
    }

    public function logout()
    {
        // 세션 모두 초기화
        //session_destroy();
        unset($_SESSION['USER_ID']);
        unset($_SESSION['ROLE']);
        unset($_SESSION['IP_ADDRESS']);
        unset($_SESSION['LAST_ACTIVITY']);
    }

    public function checkRole()
    {
        // 등급 체크
        if (isset($_SESSION['ROLE']))
            return $_SESSION['ROLE'];
    }

    public function register($id, $password, $role)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $userInfo = $query->fetch(PDO::FETCH_ASSOC);
        if ($userInfo) {
            return "이미 존재하는 ID 입니다!";
        }

        // 비밀번호 암호화
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // DB에 insert
        $query = $this->db->prepare("INSERT INTO users (id,password,role) VALUES (:id,:password,:role)");
        $query->bindParam(":id", $id);
        $query->bindParam(":password", $hashedPassword);
        $query->bindParam(":role", $role);
        $query->execute();
        return "회원가입 완료!";
    }
}
?>