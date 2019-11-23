<?php
namespace App\Helpers;
class Yajra_datatable{
    /**
    * Get row number Yajra Datatable
    * @author moko
    * @param $primary_key string
    * @param $request array
    * @return string sql
    */
    public static function get_no_urut($primary_key, $request){
        // get column index frontend
        $order_column = $request->get('order')[0]['column'];
        // nomor urut
        $sql_no_urut = "row_number() OVER (ORDER BY $primary_key DESC) AS rownum"; // row_number() = postgresql function
        if($order_column != 0){
            // ----------------------------
            // Yajra Datatable Index
            $field_name = $request->get('columns')[$order_column]['data']; // field_name
            if(isset($request->get('columns')[$order_column]['name'])){
                $field_name =  $request->get('columns')[$order_column]['name']; // table.field_name
            }
            $ordering   = $request->get('order')[0]['dir']; // asc|desc
            // ----------------------------
            
            $sql_no_urut= "row_number() OVER (ORDER BY $field_name $ordering) AS rownum";
        }
        return $sql_no_urut;
    }
}