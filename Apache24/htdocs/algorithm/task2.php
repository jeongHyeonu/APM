<?php
$a;
$b;

function solve()
{
    global $a, $b;
    $filter_list = array_fill(0, $b + 1, true);
    $filter_list[0] = false;
    $filter_list[1] = false;

    for ($i = 2; $i * $i <= $b; $i++) {
        if ($filter_list[$i]) {
            for ($j = $i * $i; $j <= $b; $j += $i)
                $filter_list[$j] = false;
        }
    }

    for ($i = $a; $i <= $b; $i++) {
        if ($filter_list[$i]) {
            echo $i . "\n";
        }
    }
}

$input = fopen("input2.txt", 'r');
fscanf($input, '%d %d', $a, $b);
solve();
?>