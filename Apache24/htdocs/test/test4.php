<?php
$subject = "PHP is cooooool!";

// 문자 'l' 바로 앞에 문자 'o'가 0 또는 1번 나타나는 경우를 검색함.
preg_match_all('/o?l/', $subject, $match_01);
var_dump($match_01);
echo "<br>" . $match_01[0][0] . "<br>";

// 문자 'l' 바로 앞에 문자 'o'가 0번 이상 나타나는 경우를 검색함.
preg_match_all('/o*l/', $subject, $match_02);
var_dump($match_02);
echo "<br>" . $match_02[0][0] . "<br>";

// 문자 'l' 바로 앞에 문자 'o'가 1번 이상 나타나는 경우를 검색함.
preg_match_all('/o+l/', $subject, $match_03);
var_dump($match_03);
echo "<br>" . $match_03[0][0] . "<br>";

// 영문 소문자가 1번 이상 나타나는 경우를 검색함.
// 즉, 영문 소문자만으로 이루어진 부분 문자열을 검색함.
preg_match_all('/[a-z]+/', $subject, $match_04);
var_dump($match_04);
echo "<br>" . $match_04[0][0] . "<br>";



$com = "help@abcd.com";
$co = "help@abcd.co.kr";

if (filter_var($com, FILTER_VALIDATE_EMAIL)) {
    echo $com;
} else {
    echo "{$com}은 유효한 형식의 이메일 주소가 아닙니다.<br>";
}
echo "<br><br>";

if (filter_var($co, FILTER_VALIDATE_EMAIL)) {
    echo $co;
} else {
    echo "{$co}은 유효한 형식의 이메일 주소가 아닙니다.<br>";
}

$regex = "/[가-힣]+/"; // 한글 소리 마디
$test = "aㅁ";
if (preg_match($regex, $test, $match_var)) {
    var_dump($match_var);
} else {
    echo "{$test}에는 한글이 포함되어 있지 않습니다.<br>";
}

class PropertyOverloading
{
    private $data = array();	// 오버로딩된 변수가 저장될 배열 생성
    public $declared = 10;		// public으로 선언된 프로퍼티
    private $hidden = 20;		// private로 선언된 프로퍼티

    public function __set($name, $value)
    {
        echo "$name 프로퍼티를 {$value}의 값으로 생성합니다!";
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        echo "$name 프로퍼티의 값을 읽습니다!<br>";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    public function __isset($name)
    {
        echo "$name 프로퍼티가 설정되어 있는지 확인합니다!<br>";
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        echo "$name 프로퍼티를 해지합니다!";
        unset($this->data[$name]);
    }
}

$obj = new PropertyOverloading();	// PropertyOverloading 객체 생성
echo "<br><br>";

$obj->a = 1;					// 동적 프로퍼티 생성
echo "<br><br>";
echo $obj->a;				// 동적 프로퍼티에 접근
echo "<br><br>";
var_dump(isset($obj->a));	// 동적 프로퍼티로 isset() 함수 호출
echo "<br><br>";
unset($obj->a);				// 동적 프로퍼티로 unset() 함수 호출
echo "<br><br>";
var_dump(isset($obj->a));	// 동적 프로퍼티로 isset() 함수 호출
echo "<br><br>";
echo $obj->declared;	// 선언된 프로퍼티는 오버로딩을 사용하지 않음.
echo "<br><br>";
echo $obj->hidden;		// private로 선언된 프로퍼티는 클래스 외부에서 접근할 수 없으므로, 오버로딩을 사용함.

?>