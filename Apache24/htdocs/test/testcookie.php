<!DOCTYPE html>
<?php
$cookieName = "city";
$cookieValue = "서울";
setcookie($cookieName, $cookieValue, time() + 60, "/");	// 쿠키가 60초 간 지속됨.
// unset($_COOKIE["city"]); //쿠키삭제
?>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>PHP Cookie And Session</title>
</head>

<body>

    <p>다시 한 번 "결과보기" 버튼이나 "F5"버튼을 누르면 생성된 쿠키를 확인할 수 있습니다!</p>

    <?php
    if (!isset($_COOKIE[$cookieName])) {		// 해당 쿠키가 존재하지 않을 때
        echo "{$cookieName}라는 이름의 쿠키는 아직 생성되지 않았습니다.";
    } else {								// 해당 쿠키가 존재할 때
        echo "{$cookieName}라는 이름의 쿠키가 생성되었으며, 생성된 값은 '" . $_COOKIE[$cookieName] . "'입니다.";
    }
    ?>

</body>

</html>