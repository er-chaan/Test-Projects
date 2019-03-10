<?php
// author : er-Chaan +919004313006 er.chandreshbhai@gmail.com

// input test 1
// $customer_type = "regular"; 
// $start_date = "2009-03-16"; 
// $end_date = "2009-03-18"; 
// output LAKEWOOD

// input test 2
// $customer_type = "regular"; 
// $start_date = "2009-03-20"; 
// $end_date = "2009-03-22"; 
// output BRIDGEWOOD

// input test 3
$customer_type = "reward"; 
$start_date = "2009-03-26"; 
$end_date = "2009-03-28"; 
// output RINGEWOOD


$total_cost_lakewood = 0;
$total_cost_bridgewood = 0;
$total_cost_ringewood = 0;
$rating_lakewood = 3;
$rating_bridgewood = 4;
$rating_ringewood = 5;
$dates = new DatePeriod(
    new DateTime($start_date),
    new DateInterval('P1D'),
    new DateTime(date('Y-m-d', strtotime($end_date . ' +1 day')))
);
foreach ($dates as $key => $value) {
    $total_cost_lakewood = $total_cost_lakewood + hotelLakewood($customer_type,isWeekend($value->format('Y-m-d')));
    $total_cost_bridgewood = $total_cost_bridgewood + hotelBridgewood($customer_type,isWeekend($value->format('Y-m-d')));
    $total_cost_ringewood = $total_cost_ringewood + hotelRingewood($customer_type,isWeekend($value->format('Y-m-d')));
}
$output = "";
if($total_cost_lakewood < $total_cost_bridgewood && $total_cost_lakewood < $total_cost_ringewood){
    $output = "Lakewood";
}
if($total_cost_bridgewood < $total_cost_lakewood && $total_cost_bridgewood < $total_cost_ringewood){
    $output = "Bridgewood";
}
if($total_cost_ringewood < $total_cost_lakewood && $total_cost_ringewood < $total_cost_bridgewood){
    $output = "Ringewood";
}
if($total_cost_ringewood == $total_cost_lakewood || $total_cost_ringewood == $total_cost_bridgewood){
    $output = "Ringewood";
}
elseif($total_cost_bridgewood == $total_cost_lakewood){
    $output = "Bridgewood";
}
else{
    $output = "Lakewood"; 
}
echo $output; //output

function isWeekend($date_value) {
    $day = date("l",strtotime($date_value));
    if($day == "Sunday" || $day == "Saturday"){
        return "weekend";
    }else{
        return "weekday";
    }
}
function hotelLakewood($customer_type,$day){
    if($customer_type == "regular" && $day == "weekday"){
        return 110;
    }
    if($customer_type == "reward" && $day == "weekday"){
        return 80;
    }
    if($customer_type == "regular" && $day == "weekend"){
        return 90;
    }
    if($customer_type == "reward" && $day == "weekend"){
        return 80;
    }
}
function hotelBridgewood($customer_type,$day){
    if($customer_type == "regular" && $day == "weekday"){
        return 160;
    }
    if($customer_type == "reward" && $day == "weekday"){
        return 110;
    }
    if($customer_type == "regular" && $day == "weekend"){
        return 60;
    }
    if($customer_type == "reward" && $day == "weekend"){
        return 50;
    }
}
function hotelRingewood($customer_type,$day){
    if($customer_type == "regular" && $day == "weekday"){
        return 220;
    }
    if($customer_type == "reward" && $day == "weekday"){
        return 100;
    }
    if($customer_type == "regular" && $day == "weekend"){
        return 150;
    }
    if($customer_type == "reward" && $day == "weekend"){
        return 40;
    }
}

// NOTE : blackout dates vary from country to country so i need some more detailed requirement perhaps