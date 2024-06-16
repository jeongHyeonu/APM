<?php
// 수신자 목록 (예시)
$recipients = [
    ['name' => '홍길동', 'gender' => 'male', 'email' => 'abc1@ex.com'],
    ['name' => '김영희', 'gender' => 'female', 'email' => 'abc2@ex.com'],
    // 추가 수신자...
];

// 남성용 HTML 템플릿
$maleTemplate = '<html><body style="color:blue;">철수와 영이가 5월 4일 결혼합니다. OOO님 꼭 와주세요!</body></html>';

// 여성용 HTML 템플릿
$femaleTemplate = '<html><body style="color:pink;">철수와 영이가 5월 4일 결혼합니다. OOO님 꼭 와주세요!</body></html>';

foreach ($recipients as $recipient) {
    // 수신자 정보
    $name = $recipient['name'];
    $gender = $recipient['gender'];
    $email = $recipient['email'];

    // 성별에 따른 템플릿 선택
    if ($gender == 'male') {
        $message = str_replace('OOO', $name, $maleTemplate);
    } else {
        $message = str_replace('OOO', $name, $femaleTemplate);
    }

    // 메일 헤더 설정
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@example.com" . "\r\n";

    // 메일 보내기
    mail($email, "결혼식 초대장", $message, $headers);
}
?>