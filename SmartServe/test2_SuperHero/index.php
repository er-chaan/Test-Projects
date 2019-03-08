<?php
// author : er-Chaan +919004313006 er.chandreshbhai@gmail.com

/* input = output 
228626 = BATMAN
4855 = HULK
78737626 = ???????? [test failed]
8467 = THOR
*/
$input = 8467; // change this values from [228626,4855,78737626,8467]

$input = str_split($input);
$super_heroes = array(
                    'SUPERMAN',
                    'THOR',
                    'ROBIN',
                    'IRONMAN',
                    'GHOSTRIDER',
                    'CAPTAINAMERICA',
                    'FLASH',
                    'WOLVERINE',
                    'BATMAN',
                    'HULK',
                    'BLADE',
                    'PHANTOM',
                    'SPIDERMAN',
                    'BLACKWIDOW',
                    'HELLBOY',
                    'PUNISHER');
$keypad = array(
    array('1'),
    array('A','B','C'),
    array('D','E','F'),
    array('G','H','I'),
    array('J','K','L'),
    array('M','N','O'),
    array('P','Q','R','S'),
    array('T','U','V'),
    array('W','X','Y','Z'),
    array('0')
);
$to_process = array();
foreach ($input as $key => $value) {
    foreach ($keypad[($value-1)] as $key1 => $value1) {
        array_push($to_process,$value1);
    }
}

function combination_number($k,$n){
    $n = intval($n);
    $k = intval($k);
    if ($k > $n){
        return 0;
    } elseif ($n == $k) {
        return 1;
    } else {
        if ($k >= $n - $k){
            $l = $k+1;
            for ($i = $l+1 ; $i <= $n ; $i++)
                $l *= $i;
            $m = 1;
            for ($i = 2 ; $i <= $n-$k ; $i++)
                $m *= $i;
        } else {
            $l = ($n-$k) + 1;
            for ($i = $l+1 ; $i <= $n ; $i++)
                $l *= $i;
            $m = 1;
            for ($i = 2 ; $i <= $k ; $i++)
                $m *= $i;            
        }
    }
    return $l/$m;
}

function array_combination($le, $set){
    $lk = combination_number($le, count($set));
    $ret = array_fill(0, $lk, array_fill(0, $le, '') );
    $temp = array();
    for ($i = 0 ; $i < $le ; $i++)
        $temp[$i] = $i;
    $ret[0] = $temp;
    for ($i = 1 ; $i < $lk ; $i++){
        if ($temp[$le-1] != count($set)-1){
            $temp[$le-1]++;
        } else {
            $od = -1;
            for ($j = $le-2 ; $j >= 0 ; $j--)
                if ($temp[$j]+1 != $temp[$j+1]){
                    $od = $j;
                    break;
                }
            if ($od == -1)
                break;
            $temp[$od]++;
            for ($j = $od+1 ; $j < $le ; $j++)    
                $temp[$j] = $temp[$od]+$j-$od;
        }
        $ret[$i] = $temp;
    }
    for ($i = 0 ; $i < $lk ; $i++)
        for ($j = 0 ; $j < $le ; $j++)
            $ret[$i][$j] = $set[$ret[$i][$j]];   
    return $ret;
}

$output = array_combination(count($input), $to_process);
foreach ($output as $key => $value) {
    $decoded_value = implode('',$value);
    if(in_array($decoded_value,$super_heroes)){
        echo $decoded_value; //output
        exit;
    }
}
