<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Certifications;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;



use Validator;



class CertificationsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        return view('/admin/certifications/list');

    }



    public function ajaxList(Request $request)

    {

        $draw               = $request->get('draw');

        $start              = $request->get("start");

        $rowperpage         = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');

        $columnName_arr     = $request->get('columns');

        $order_arr          = $request->get('order');

        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index

        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name

        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc

        $searchValue        = $search_arr['value']; // Search value

        // Total records

        $totalRecords           = Certifications::select('count(*) as allcount')

            ->count();

        $totalRecordswithFilter = Certifications::select('count(*) as allcount')

            ->where('title', 'like', '%' . $searchValue . '%')

            ->count();



        // Fetch records

        $records = Certifications::select('*')

            ->orderBy($columnName, $columnSortOrder)

            ->where('title', 'like', '%' . $searchValue . '%')

            ->skip($start)

            ->take($rowperpage)

            ->get();



        $data_arr   = array();

        $sno        = $start + 1;

        foreach ($records as $record) {

            $id         = $record->id;

            $title      = $record->title;
            $pdf      = $record->pdf;

            $pdf = ($record->pdf !== '')
            ? '<a href="' . asset('storage/media/certifications/' . $pdf) . '" target="_blank">
                  <img src="' . asset('storage/media/certifications/' . $record->image) . '" width="50px" />
               </a>'
            : '<img src="' . asset('storage/media/admin/placeholder.png') . '" width="50px" />';
            $action = '';

            $action .= '<a href="' . url('admin/edit-certifications/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            if ($record->status == 1)

                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/certifications-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';

            elseif ($record->status == 0)

                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/certifications-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';



            $data_arr[] = array(

                "id" => $sno++,

                "title" => $title,

                "pdf" => $pdf,

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

        $result['pageTitle']            = 'Add Certifications';

        $result['id']                   = '';

        $result['title']                = '';

        $result['sortOrder']             = '';

        $result['pdf']                  = '';
        $result['image']                  = '';

        return view('/admin/certifications/form', $result);

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        // prx($request->post('content'));



        $validator = Validator::make($request->all(), [

            'title'              => 'required',

            'pdf'          => 'required',
            'image'          => 'required',

        ]);



        if ($validator->passes()) { 

            try {

                $model = new Certifications();

                $model->title                   = $request->post('title');

                if ($request->hasfile('pdf')) {

                    $mainImage          = $request->file('pdf');

                    $mainImage_name     = time() . rand(1, 100) . '.' . $mainImage->extension();

                    $mainImage->move(public_path('/storage/media/certifications'), $mainImage_name);

                    $model->pdf   = $mainImage_name;

                }
                if ($request->hasfile('image')) {

                    $mainImage          = $request->file('image');

                    $mainImage_name     = time() . rand(1, 100) . '.' . $mainImage->extension();

                    $mainImage->move(public_path('/storage/media/certifications'), $mainImage_name);

                    $model->image   = $mainImage_name;

                }

                $model->sortOrder                 = $request->post('sortOrder');



                $model->status      = 1;

                // prx($model);

                $model->save();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/certifications']);

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

        $result['pageTitle']   = 'Update Certifications';

        $arr = Certifications::where(['id' => $id])->first();



        $result['id']                   = $id;

        $result['title']                = $arr->title;

        $result['pdf']                  = $arr->pdf;
        $result['image']                  = $arr->image;

        $result['sortOrder']            = $arr->sortOrder;



        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));



        return view('/admin/certifications/form', $result);

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

            'title'              => 'required',

            

        ]);



        if ($validator->passes()) {

            try {



                $arr = array();

                $arr['title']                    = $request->post('title');

                $arr['sortOrder']                = $request->post('sortOrder');



                if ($request->hasfile('pdf')) {

                    $mainImage          = $request->file('pdf');

                    $mainImage_name     = time() . rand(1, 100) . '.' . $mainImage->extension();

                    $mainImage->move(public_path('/storage/media/Images'), $mainImage_name);

                    $arr['pdf']   = $mainImage_name;

                }
                if ($request->hasfile('image')) {

                    $mainImage          = $request->file('image');

                    $mainImage_name     = time() . rand(1, 100) . '.' . $mainImage->extension();

                    $mainImage->move(public_path('/storage/media/Images'), $mainImage_name);

                    $arr['image']   = $mainImage_name;

                }



                Certifications::where('id', $id)->update($arr);



                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/certifications']);

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

                Certifications::find($value)->delete();

            } else if ($task == 'Activate') {

                $arr['status'] = 1;

                Certifications::where('id', $value)->update($arr);

            } else if ($task == 'Block') {

                $arr['status'] = 0;

                Certifications::where('id', $value)->update($arr);

            }

        }



        if ($task == 'Delete') {

            return redirect('admin/certifications')->with('success', 'Deleted Successfully');

        } else if ($task == 'Activate') {

            return redirect('admin/certifications')->with('success', 'Activated Successfully');

        } else if ($task == 'Block') {

            return redirect('admin/certifications')->with('success', 'Blocked Successfully');

        }

    }



    public function certifications_status(Request $request, $status, $id)

    {

        $id     = Crypt::decrypt($id);

        $model  = Certifications::find($id);

        $model->status = $status;

        $model->save();

        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';

        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/certifications']);

    }



}

