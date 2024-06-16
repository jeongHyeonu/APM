<?php
define('_INF', 999999);
define('_MAX', 20002);

$V; // 정점 수
$k; // 시작 정점
$dist = array_fill(0, _MAX, INF); // dijkstra 알고리즘으로 유도된 거리
$vec = array_fill(0, _MAX, []); // 간선 저장 벡터

function dijkstra()
{
    global $V, $k, $dist, $vec; //전역변수로 선언
    $pq = new SplPriorityQueue();
    $pq->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
    $dist[$k] = 0;
    $pq->insert($k, 0);

    while (!$pq->isEmpty()) {
        $current = $pq->extract();
        $node = $current['data'];
        $cost = -$current['priority'];

        foreach ($vec[$node] as $it) {
            $next_node = $it[0];
            $next_cost = $cost + $it[1];

            if ($dist[$next_node] > $next_cost) {
                $dist[$next_node] = $next_cost;
                $pq->insert($next_node, -$next_cost);
            }
        }
    }

    for ($i = 1; $i <= $V; $i++) {
        if ($dist[$i] == _INF) {
            echo "INF\n";
        } else {
            echo $dist[$i] . "\n";
        }
    }
}

// 입력
$input = fopen('input1.txt', 'r');
fscanf($input, "%d %d", $V, $e);
fscanf($input, "%d", $k);
for ($i = 0; $i < $e; $i++) {
    fscanf($input, "%d %d %d", $u, $v, $w);
    $vec[$u][] = [$v, $w];
}

// dist 초기화
for ($i = 1; $i <= $V; $i++)
    $dist[$i] = _INF;

// 다익스트라 알고리즘 -> 최단거리 계산
dijkstra();

?>