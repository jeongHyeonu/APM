<?php
$n;

function solve()
{
    global $n;
    $arr = array();
    $arr[1] = 1;
    $arr[2] = 2;
    for ($i = 3; $i <= $n; $i++) {
        $arr[$i] = $arr[$i - 2] + $arr[$i - 1];
    }
    echo $arr[$n];
}

$input = fopen("input3.txt", 'r');
fscanf($input, '%d', $n);
solve();
?>