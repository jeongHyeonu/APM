<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>PHP Form Validation</title>
    <style>
        .alert {
            color: red
        }
    </style>
</head>

<body>

    <?php
    $nameMsg = $emailMsg = $genderMsg = $websiteMsg = $favtopicMsg = $commentMsg = "";
    $name = $email = $gender = $website = $favtopic = $comment = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameMsg = "이름을 입력해 주세요!";
        } else {
            $name = $_POST["name"];
            // 이름의 입력 형식 검증
            if (!preg_match("/^[a-zA-Z가-힣 ]*$/", $name)) {
                $nameMsg = "영문자와 한글만 가능합니다!";
            }
        }

        if (empty($_POST["gender"])) {
            $genderMsg = "성별을 선택해 주세요!";
        } else {
            $gender = $_POST["gender"];
        }

        if (empty($_POST["email"])) {
            $emailMsg = "";
        } else {
            $email = $_POST["email"];
            // 이메일의 입력 형식 검증
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailMsg = "이메일을 정확히 입력해 주세요!";
            }
        }

        if (empty($_POST["website"])) {
            $websiteMsg = "";
        } else {
            $website = $_POST["website"];
            // 홈페이지 URL 주소의 입력 형식 검증
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                $websiteMsg = "홈페이지의 주소를 정확히 입력해 주세요!";
            }
        }

        if (empty($_POST["favtopic"])) {
            $favtopicMsg = "하나 이상 골라주세요!";
        } else {
            $favtopic = $_POST["favtopic"];
        }

        $comment = $_POST["comment"];
    }
    ?>

    <h2>회원 가입 양식</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p class="alert">* : 필수 입력 사항</p>
        이름 : <input type="text" name="name"><span class="alert"> * <?php echo $nameMsg ?></span>
        <br><br>
        성별 :
        <input type="radio" name="gender" value="female">여자
        <input type="radio" name="gender" value="male">남자
        <span class="alert"> * <?php echo $genderMsg ?></span>
        <br><br>
        이메일 : <input type="text" name="email"><span class="alert"><?php echo $emailMsg ?></span>
        <br><br>
        홈페이지 : <input type="text" name="website"><span class="alert"><?php echo $websiteMsg ?></span>
        <br><br>
        관심 있는 분야 :
        <input type="checkbox" name="favtopic[]" value="movie"> 영화
        <input type="checkbox" name="favtopic[]" value="music"> 음악
        <input type="checkbox" name="favtopic[]" value="game"> 게임
        <input type="checkbox" name="favtopic[]" value="coding"> 코딩
        <span class="alert"> * <?php echo $favtopicMsg ?></span>
        <br><br>
        기타 : <textarea name="comment"></textarea>
        <br><br>
        <input type="submit" value="전송">

        <?php
        echo "<h2>입력된 회원 정보</h2>";
        echo "이름 : " . $name . "<br>";
        echo "성별 : " . $gender . "<br>";
        echo "이메일 : " . $email . "<br>";
        echo "홈페이지 : " . $website . "<br>";
        echo "관심 있는 분야 : ";
        if (!empty($favtopic)) {
            foreach ($favtopic as $value) {
                echo $value . " ";
            }
        }
        echo "<br>기타 : " . $comment;
        ?>

    </form>

</body>

</html>