<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gateway;
use App\Models\Admin\EmailTemplate;
use App\Models\Admin\ShippingCharge;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use DB;
use Exception;
use Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['pageTitle']   = 'Settings';
        return view('admin/settings/list', $result);
    }

    // ---------------------------------------- Gateway Functions ------------------------------------------------

    public function settings_gateway()
    {
        $result['pageTitle']   = 'Gateway Settings';
        return view('admin/settings/gatewayList', $result);
    }

    public function ajaxGatewayList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords           = Gateway::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Gateway::select('count(*) as allcount')
            ->where('title', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records =  Gateway::orderBy($columnName, $columnSortOrder)
            ->where('title', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id             = $record->id;
            $title        = $record->title;
            $checked = "";
            if($record->status == '1'){
                $status        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/gateway-status/0/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch'.$sno.'" checked>
                        <label class="custom-control-label" for="customSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }else{
                $status        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/gateway-status/1/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch'.$sno.'">
                        <label class="custom-control-label" for="customSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }

            if($record->mode == '1'){
                $mode        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/gateway-mode/0/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="modeSwitch'.$sno.'" checked>
                        <label class="custom-control-label" for="modeSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }else{
                $mode        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/gateway-mode/1/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="modeSwitch'.$sno.'">
                        <label class="custom-control-label" for="modeSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }

            $action        = '<a href="' . url('admin/edit-gateway/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            $data_arr[] = array(
                "id"                => $sno++,
                "title"           => $title,
                "mode"              => $mode,
                "status"              => $status,
                "action"       => $action,
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result['pageTitle']        = 'Add Item order';
        $result['id']               = '';
        $result['orderName']     = '';
        $result['sortOrder']        = '';

        return view('admin/order/orderForm', $result);
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $result['pageTitle']   = 'Update Gateway';


        $arr = Gateway::select('*')
            ->where(['gateways.id' => $id])
            ->first();
        // prx($arr);

        $result['id']                       = $id;
        $result['title']                    = $arr->title;
        $result['description']          = $arr->description;
        $result['thankyouText']       = $arr->thankyouText;
        $result['payNowButtonText']              = $arr->payNowButtonText;
        $result['saltKey']              = $arr->saltKey;
        $result['testSaltKey']              = $arr->testSaltKey;
        $result['merchantKey']              = $arr->merchantKey;
        $result['testMerchantKey']              = $arr->testMerchantKey;
        $result['mode']              = $arr->mode;
        $result['status']              = $arr->status;

        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('admin/settings/gatewayForm', $result);
    }

    public function update(Request $request, $id){
        $rules = [
            'title'                     => 'required',
            'payNowButtonText'          => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $arr['title']                 = $request->post('title');
                $arr['description']             = $request->post('description');
                $arr['thankyouText']          = $request->post('thankyouText');
                $arr['payNowButtonText']          = $request->post('payNowButtonText');
                $arr['saltKey']          = $request->post('saltKey');
                $arr['testSaltKey']          = $request->post('testSaltKey');
                $arr['merchantKey']          = $request->post('merchantKey');
                $arr['testMerchantKey']          = $request->post('testMerchantKey');
                $arr['mode']          = $request->post('mode');
                $arr['status']          = $request->post('status');
                
                Gateway::where('id', $id)->update($arr);

                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/settings']);

            }catch(Exception $e) {
                DB::rollback();
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . __LINE__ . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all the required fields']);
    }

    public function gateway_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = Gateway::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        $class = ($status == 0) ? 'warning' : 'info';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'admin/settings']);
    }

    public function gateway_mode(Request $request, $mode, $id)
    {
        $id = Crypt::decrypt($id);
        $model = Gateway::find($id);
        $model->mode = $mode;
        $model->save();
        $message = ($mode == 0) ? 'Development Activated Successfully' : 'Production Activated Successfully';
        $class = ($mode == 0) ? 'warning' : 'info';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'admin/settings']);
    }

    // ---------------------------------------- Email Functions ------------------------------------------------

    public function settings_email()
    {
        $result['pageTitle']   = 'Email Settings';
        return view('admin/settings/emailList', $result);
    }

    public function ajaxEmailList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords           = EmailTemplate::select('count(*) as allcount')->count();
        $totalRecordswithFilter = EmailTemplate::select('count(*) as allcount')
            ->where('title', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records =  EmailTemplate::orderBy($columnName, $columnSortOrder)
            ->where('title', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id             = $record->id;
            $title        = $record->title;
            $recipients   = $record->recipient;
            $checked = "";
            if($record->status == '1'){
                $status        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/email-status/0/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch'.$sno.'" checked>
                        <label class="custom-control-label" for="customSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }else{
                $status        = '<a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/email-status/1/' . Crypt::encrypt($id)) . '">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch'.$sno.'">
                        <label class="custom-control-label" for="customSwitch'.$sno.'"></label>
                    </div>
                </a>';
            }

            $action        = '<a href="' . url('admin/edit-email/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            $data_arr[] = array(
                "id"                => $sno++,
                "title"           => $title,
                "recipients"              => $recipients,
                "status"              => $status,
                "action"       => $action,
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

    public function edit_email($id){
        $id = Crypt::decrypt($id);

        $arr = EmailTemplate::select('*')
            ->where(['email_templates.id' => $id])
            ->first();
        // prx($arr);
        $result['pageTitle']            = $arr->title;
        $result['id']                   = $id;
        $result['recipient']            = $arr->recipient;
        $result['subject']              = $arr->subject;
        $result['defaultTemplate']      = $arr->defaultTemplate;
        $result['bodyTemplate']         = $arr->bodyTemplate;
        $result['status']               = $arr->status;

        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('admin/settings/emailForm', $result);
    }

    public function update_email(Request $request, $id){
        $rules = [
            'subject'                     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $arr['recipient']             = $request->post('recipient');
                $arr['subject']          = $request->post('subject');
                $arr['bodyTemplate']          = $request->post('bodyTemplate');
                $arr['status']          = $request->post('status');
                
                EmailTemplate::where('id', $id)->update($arr);

                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/settings-email']);

            }catch(Exception $e) {
                DB::rollback();
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . __LINE__ . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all the required fields']);
    }

    public function email_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = EmailTemplate::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        $class = ($status == 0) ? 'warning' : 'info';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'admin/settings']);
    }

    // ---------------------------------------- Shipping Functions ------------------------------------------------

    public function settings_shipping(Request $request)
    {
        $result['pageTitle']   = 'Shipping Settings';

        $shippingCharges = ShippingCharge::all();

        $result['minCartValue']         = $shippingCharges[0]->minCartAmount;
        $result['ChargesApplicable']    = $shippingCharges[0]->charges;
        $result['status']               = $shippingCharges[0]->status;
        $result['id']                   = $shippingCharges[0]->id;

        return view('admin/settings/shippingList', $result);
    }

    public function update_shipping(Request $request, $id){
        $rules = [
            'id'                     => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            try {
                $id = $request->post('id');

                $arr['minCartAmount']           = $request->post('minCartValue');
                $arr['charges']                 = $request->post('ChargesApplicable');
                $arr['status']                  = $request->post('status');
                
                ShippingCharge::where('id', $id)->update($arr);

                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/settings-shipping']);
            
            }catch(Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . __LINE__ . $e->getMessage() . ')']);
            }
        }
        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all the required fields']);
    }
}