<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\LogActivity;
use App\Models\Admin\Admin;
use Carbon\Carbon;

use DB;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {


        return view('admin/logactivity/list');
    }

    public function ajaxList(Request $request)
    {
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        if($columnName == 'username'){
            $columnName = 'admins.firstName';
        }

        // Total records
        $totalRecords = LogActivity::select('count(log_activities.*) as allcount')->join('admins', 'admins.id', '=', 'log_activities.user_id')->count();
        $totalRecordswithFilter = LogActivity::select('count(log_activities.*) as allcount')
            ->join('admins', 'admins.id', '=', 'log_activities.user_id')
            ->where('subject', 'like', '%' . $searchValue . '%')
            ->orWhere('url', 'like', '%' . $searchValue . '%')
            ->orWhere('ip', 'like', '%' . $searchValue . '%')
            ->orWhere(DB::raw("CONCAT(`firstName`, ' ', `lastName`)"), 'LIKE', "%".$searchValue."%")
            ->count();

        // Fetch records
        $records = LogActivity::select('log_activities.*', DB::raw('CONCAT(firstName, " ", lastName) AS full_name'))
            ->orderBy($columnName, $columnSortOrder)
            ->join('admins', 'admins.id', '=', 'log_activities.user_id')
            ->where('subject', 'like', '%' . $searchValue . '%')
            ->orWhere('url', 'like', '%' . $searchValue . '%')
            ->orWhere('ip', 'like', '%' . $searchValue . '%')
            ->orWhere(DB::raw("CONCAT(`firstName`, ' ', `lastName`)"), 'LIKE', "%".$searchValue."%")
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {

            // prx($username);
            $id = $record->id;
            
            $usernameVal = $record->full_name;
            
            // $username = $username;
            $subject = $record->subject;
            $url = $record->url;
            $ip = $record->ip;
            $date =    Carbon::parse($record->created_at)->format('d-m-Y h:i:s a');;

            $data_arr[] = array(
                "id" => $sno++,
                "username" => $usernameVal,
                "subject" => $subject,
                "url" => $url,
                "ip" => $ip,
                "created_at" => $date,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
}