<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Admin;

use App\Models\Admin\Role;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Validator;

use Exception;

use Mail;

class AdminController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function adminIndex(Request $request)

    {

        // prx(auth()->user());

        if (Auth::guard('admin')->check()) {

            return redirect(url('admin/dashboard'));

        } else {

            // return redirect(url('admin'));

            return view('admin.login');

        }

        return view('admin.login');

    }

         

    public function auth(Request $request)

    {

        //echo "Test Request"; die;

        $email = $request->post('email');

        $password = $request->post('password');

      

        $result = Admin::where(['email' => $email])->first();

        if (!empty($result)) {

            $userdata = array(

                'email'     => $email,

                'password'  => $password

            );

            if (Auth::guard('admin')->attempt($userdata)) {

                return redirect(url('admin/dashboard'))->with('success', 'Logged In Successfully');

            } else {

                return redirect(url('admin'))->with('error', 'Incorrect Password');

            }

        } else {

            return redirect(url('admin'))->with('error', 'Given Id is not registered with us');

        }

    }



    public function logout()

    {

        Auth::guard('admin')->logout();

        return redirect(url('admin'))->with('error', 'Logged Out Successfully');

    }



    public function index()

    {

        return view('admin/admin/list');

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

        $totalRecords = Admin::select('count(*) as allcount')->count();

        $totalRecordswithFilter = Admin::select('count(*) as allcount')

            ->where('firstName', 'like', '%' . $searchValue . '%')

            ->orWhere('lastName', 'like', '%' . $searchValue . '%')

            ->orWhere('email', 'like', '%' . $searchValue . '%')

            ->count();



        // Fetch records

        $records = Admin::orderBy($columnName, $columnSortOrder)

            ->where('firstName', 'like', '%' . $searchValue . '%')

            ->orWhere('lastName', 'like', '%' . $searchValue . '%')

            ->orWhere('email', 'like', '%' . $searchValue . '%')

            ->skip($start)

            ->take($rowperpage)

            ->get();



        $data_arr = array();

        $sno = $start + 1;

        foreach ($records as $record) {

            if ($record->roleId == 1) {

                continue;

            }

            $id = $record->id;

            $name = $record->firstName . ' ' . $record->lastName;

            $email = $record->email;



            $action = '';

            $action .= '<a href="' . url('admin/edit-admin/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';



            if ($record->status == 1)



                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/admin-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';



            elseif ($record->status == 0)

                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/admin-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';



            $data_arr[] = array(

                "id" => $sno++,

                "firstName" => $name,

                "email" => $email,

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

        $result['pageTitle']        = 'Add Admin';

        $result['id']               = '';

        $result['firstName']        = '';

        $result['lastName']         = '';

        $result['email']            = '';

        $result['phoneNumber']      = '';

        $result['password']         = '';

        $result['roleId']         = '';



        $result['roles'] = Role::where(['status' => '1'])->orderBy('id', 'desc')->pluck('role_name', 'id')->all();



        return view('admin/admin/form', $result);

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $validator = Validator::make(

            $request->all(),

            [

                'email'                 => 'required|email|unique:admins,email',

                'firstName'             => 'required',

                // 'lastName'              => 'required',

                'roleId'                => 'required',

                'phoneNumber'           => 'required|digits:10',

                'password'              => 'min:8|required_with:confirmPassword|same:confirmPassword',

                'confirmPassword'       => 'min:8',

            ],

            [

                'roleId.required' => 'Select a Role',

            ]

        );



        if ($validator->passes()) {

            try {



                $model = new Admin();

                $model->firstName           = $request->post('firstName');

                $model->lastName            = $request->post('lastName');

                $model->email               = $request->post('email');

                $model->phoneNumber         = $request->post('phoneNumber');

                $model->roleId              = $request->post('roleId');

                $model->password            = Hash::make($request->post('password'));

                $model->status              = '1';

                $model->save();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/admin']);

            } catch (Exception $e) {

                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);

            }

        }



        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);



        // return redirect('admin/Admin')->with('success', 'Added Successfully');

    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

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

        $result['pageTitle']   = 'Update Admin';

        $arr = Admin::where(['id' => $id])->first();



        $result['roles'] = Role::where(['status' => '1'])->orderBy('id', 'desc')->pluck('role_name', 'id')->all();

        $result['id']           = $id;

        $result['firstName']    = $arr->firstName;

        $result['lastName']     = $arr->lastName;

        $result['phoneNumber']  = $arr->phoneNumber;

        $result['email']        = $arr->email;

        $result['roleId']        = $arr->roleId;

        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));



        return view('admin/admin/form', $result);

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

        $validator = Validator::make(

            $request->all(),

            [

                'email'                 => 'required|email|unique:admins,email,' . $id,

                'firstName'             => 'required',

                // 'lastName'              => 'required',

                'roleId'                => 'required',

                'phoneNumber'           => 'required|digits:10',

                // 'password'              => 'sometimes|min:8|required_with:confirmPassword|same:confirmPassword',

                // 'confirmPassword'       => 'min:8',

            ],

            [

                'roleId.required' => 'Select a Role',

            ]

        );



        if ($validator->passes()) {

            try {



                $arr = array();

                $arr['firstName']       = $request->post('firstName');

                $arr['lastName']        = $request->post('lastName');

                $arr['email']           = $request->post('email');

                $arr['phoneNumber']     = $request->post('phoneNumber');

                $arr['roleId']          = $request->post('roleId');



                if ($request->post('password') != '') {

                    $arr['password']            = Hash::make($request->post('password'));

                }



                Admin::where('id', $id)->update($arr);

                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/admin']);

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

    public function multitask(Request $request)

    {

        $id     = explode(',', $request->post('ids'));

        $task   = $request->post('task');



        foreach ($id as $value) {

            if ($task == 'Delete') {

                Admin::find($value)->delete();

            } else if ($task == 'Activate') {

                $arr['status'] = '1';

                $response =   Admin::where('id', $value)->update($arr);

            } else if ($task == 'Block') {

                $arr['status'] = '0';

                Admin::where('id', $value)->update($arr);

            }

        }



        if ($task == 'Delete') {

            return redirect('admin/admin')->with('success', 'Deleted Successfully');

        } else if ($task == 'Activate') {

            return redirect('admin/admin')->with('success', 'Activated Successfully');

        } else if ($task == 'Block') {

            return redirect('admin/admin')->with('success', 'Blocked Successfully');

        }

    }



    public function admin_status(Request $request, $status, $id)

    {

        $id = Crypt::decrypt($id);

        $model = Admin::find($id);

        $model->status = $status;

        $model->save();

        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';

        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/admin']);

    }





    public function accessdenied()

    {

        return view('errors.access-denied');

    }



    public function forgetPassword()

    {

        return view('admin/forgetpassword',);

    }

}

