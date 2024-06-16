<?php
include 'test2.php';
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, "asd" => 56);
foreach ($arr as $k => $v) {
    get_arguments($k, $v);
    echo is_string($k);
}
?>