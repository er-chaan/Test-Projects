<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class TestController extends Controller
{
    function index(){
        // Query Parameters
        $site_id = NULL;
        $vendor_id = NULL; 
        $payment_mode = NULL; 
        $dateFrom = NULL; 
        $dateTo = NULL;
        // Query
        $query = "SELECT
            `sdh_transaction_type`.`transaction_type` AS `Type`,
            `sdh_site_transaction`.`date` AS `Date`,
            `sdh_site_transaction`.`debit` AS  `Debit`,
            `sdh_site_transaction`.`credit` AS `Credit`,
            `sdh_site_transaction`.`reference_no` AS `Reference`,
            `sdh_site_transaction`.`description` AS `Note`,
            `sdh_site_transaction`.`transaction_method` AS `Method`,
            `sdh_site_transaction`.`vendor_id` AS `v_id`,
            `sdh_site_transaction`.`vendor_name` AS `Vendor`,
            `sdh_site_transaction`.`transaction_id` AS `tran_id`,
            `sdh_site`.`site_name` AS `Site`
            FROM
                `sdh_site_transaction` INNER JOIN `sdh_transaction_type` ON `sdh_site_transaction`.`transaction_type_id` = `sdh_transaction_type`.`transaction_type_id`
                INNER JOIN `sdh_site` ON `sdh_site_transaction`.`site_id` = `sdh_site`.`site_id`
            WHERE 1 "
                . ($site_id != "" ? " AND `sdh_site_transaction`.`site_id`='$site_id' " : "")
                . ($vendor_id != "" ? " AND `vendor_id` = '$vendor_id' " : "")
                . ($payment_mode != "" ? " AND `transaction_method` = '$payment_mode' " : "")
                . ($dateFrom != "" && $dateTo != "" ? " AND `date` BETWEEN '$dateFrom' AND '$dateTo' " : "")
                . " ORDER BY `date`";                
        $results = DB::select($query);
        return view('welcome', ['results' => $results]);
    }
}
