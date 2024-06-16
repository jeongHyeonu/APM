<?php
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, "asd" => 56);
function get_arguments($key, $value)
{
    echo " key : {$key}     value : {$value}<br/>";
}
foreach ($arr as $k => $v) {
    get_arguments($k, $v);
}
?>