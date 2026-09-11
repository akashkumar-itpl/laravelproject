<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Role;
use App\Models\Admin\AdminMenu;
use App\Models\Admin\RolePermission;
use Illuminate\Support\Facades\Crypt;

use Exception;
use Validator;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(Request $request)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        return view('admin/roles/list');
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

        // Total records
        $totalRecords = Role::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Role::select('count(*) as allcount')
            ->where('role_name', 'like', '%' . $searchValue . '%')
            ->where('id', '!=', 1)
            ->count();

        // Fetch records
        $records = Role::orderBy($columnName, $columnSortOrder)
            ->where('role_name', 'like', '%' . $searchValue . '%')
            ->where('id', '!=', 1)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $name = $record->role_name;
            $created_at = date("M jS, Y @ h:i a", strtotime($record->created_at));
            $updated_at = date("M jS, Y @ h:i a", strtotime($record->updated_at));
            $action = '';
            $action .= '<a href="' . url('admin/edit-roles/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';
            $action .= ' | <a href="' . url('admin/roles-permision/' . Crypt::encrypt($id)) . '" class="btn badge btn-secondary"><small><i class="right fas fa-lock"></i></a>';

            if ($record->status == 1)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/roles-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/roles-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';

            $data_arr[] = array(
                "id" => $sno++,
                "role_name" => $name,
                "created_at" => $created_at,
                "updated_at" => $updated_at,
                "action" => $action,
                "check" => '<input type="checkbox" class="checkboxes recordcheckbox" value="' . $id . '"/>',
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


        $result['pageTitle']        = 'Add Role';
        $result['id']               = '';
        $result['name']             = '';

        $result['rolePermissions']          = '';


        return view('admin/roles/form', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:rolemaster,role_name'
        ]);

        if ($validator->passes()) {
            try {

                $role = Role::create(['role_name' => $request->input('name'), 'status' => 1]);

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/roles']);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);


        $result['pageTitle']        = 'Add Role';
        $result['id']               = '';
        $result['name']             = '';

        return view('admin/roles/form', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);


        $result['pageTitle']        = 'Update Role';
        $result['id']               = $id;
        $result['name']             = $role->role_name;
        $result['updated_at']       = date("M jS, Y @ h:i a", strtotime($role->updated_at));

        return view('admin/roles/form', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:rolemaster,role_name,' . $id,
        ]);

        if ($validator->passes()) {
            try {

                $role = Role::find($id);
                $role->role_name = $request->input('name');
                $role->save();

                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/roles']);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multitask(Request $request)
    {
        $id     = explode(',', $request->post('ids'));
        $task   = $request->post('task');

        foreach ($id as $value) {
            if ($task == 'Delete') {
                Role::find($value)->delete();
            } else if ($task == 'Activate') {
                $arr['status'] = 1;
                Role::where('id', $value)->update($arr);
            } else if ($task == 'Block') {
                $arr['status'] = 0;
                Role::where('id', $value)->update($arr);
            }
        }

        if ($task == 'Delete') {
            return redirect('admin/roles')->with('success', 'Deleted Successfully');
        } else if ($task == 'Activate') {
            return redirect('admin/roles')->with('success', 'Activated Successfully');
        } else if ($task == 'Block') {
            return redirect('admin/roles')->with('success', 'Blocked Successfully');
        }
    }

    public function role_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = Role::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'roles']);
    }



    public function role_permision($id)
    {
        $id = Crypt::decrypt($id);

        $AdminMenulist = AdminMenu::orderBy('order_by', 'asc')->get();

        //prx($AdminMenulist);

        $Permisionlist = RolePermission::where(['role_id' => $id])->get()->pluck('sub_menu_id');
        $Permisionlistdata = array();

        for ($i = 0; $i < count($Permisionlist); $i++) {
            $Permisionlistdata[] =  $Permisionlist[$i];
        }

        $result['pageTitle']          = 'Set Role Permission';

        $result['id']                 = $id;
        $result['AdminMenulist']      = $AdminMenulist;
        $result['updated_at']         = '';
        $result['Permisionlist']  = $Permisionlistdata;

        return view('admin/roles/permission', $result);
    }

    public function role_permision_update(Request $request, $id)
    {
        // $request->validate(
        //     [
        //         'permissions' => 'required'
        //     ],
        //     [
        //         'permissions.required' => 'Set Role Pemission is required.'
        //     ]
        // );

        $validator = Validator::make(
            $request->all(),
            [
                'permissions' => 'required'
            ],
            [
                'permissions.required' => 'Set Role Pemission is required.'
            ]
        );

        if ($validator->passes()) {
            DB::beginTransaction();
            try {

                $permissions =  $request->post('permissions');
                $i                  = 0;
                $itemCount = count($permissions);

                //print_r($fileid );exit;
                RolePermission::where(['role_id' => $id])->delete();

                foreach ($permissions as $key => $value) {
                    $dataProduct = [
                        "role_id"  => $id,
                        "sub_menu_id" => $value
                    ];

                    if (RolePermission::create($dataProduct)) {
                        $i++;
                        //print_r($dataProduct);exit;
                    }
                }

                if ($i != $itemCount) {
                    DB::rollback();
                    return response()->json(['status' => 500, 'message' => 'Something Went Wrong']);
                } else {
                    DB::commit();
                    return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/roles']);
                    // return redirect('admin/roles')->with('success', 'Updated Successfully');
                }
            } catch (exception $e) {
                DB::rollback();
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }
    }
}