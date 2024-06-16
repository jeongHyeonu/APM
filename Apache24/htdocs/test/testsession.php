<!DOCTYPE html>
<?php
session_start();	// 세션 시작
$_SESSION["city"] = "부산"; // 세션 변수의 등록
$_SESSION["gu"] = "해운대구";
?>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<title>PHP Cookie And Session</title>
</head>

<body>

	<?php
	echo "제가 살고 있는 도시는 {$_SESSION['city']}입니다.<br>";
	echo "그 중에서도 {$_SESSION['gu']}에 살고 있습니다.<br>";
	print_r($_SESSION);		// 모든 세션 변수의 정보를 연관 배열 형태로 보여줌.
	
	echo "<br><br>";
	// 특정 세션 변수의 등록 해지
	// if (!isset($_SESSION["city"])) {
	// 	echo "{$_SESSION['city']} 세션 변수가 삭제되었습니다.";
	// 	unset($_SESSION["city"]);
	// } else {
	// 	echo "해당 세션 변수가 등록되어 있지 않습니다.";
	// }
	session_unset();		// 모든 세션 변수의 등록 해지
	session_destroy();		// 세션 아이디의 삭제
	echo "모든 세션 변수가 등록 해지되었으며, 세션 아이디도 삭제되었습니다.";

	?>

</body>

</html>