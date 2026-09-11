<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\Admin\Ourproducts;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;



use Validator;



class OurproductsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        return view('/admin/ourproducts/list');

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

        $totalRecords           = Ourproducts::select('count(*) as allcount')

            ->count();

        $totalRecordswithFilter = Ourproducts::select('count(*) as allcount')

            ->where('title', 'like', '%' . $searchValue . '%')

            ->count();



        // Fetch records

        $records = Ourproducts::select('*')

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

            $sortOrder      = $record->sortOrder;



            $mainImage  = ($record->image !== '') ? '<img src="' . asset("storage/media/ourproducts/$record->image") . '" width="80px" />' : '<img src="' . asset("storage/media/admin/placeholder.png") . '" width="40px" />';

            // $mainImage = $record->mainImage;



            $action = '';

            $action .= '<a href="' . url('admin/edit-ourproducts/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';



            if ($record->status == 1)

                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/ourproducts-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';



            elseif ($record->status == 0)

                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/ourproducts-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';



            $data_arr[] = array(

                "id" => $sno++,

                "image" => $mainImage,

                "title" => $title,

                "sortOrder" => $sortOrder,

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

        $result['pageTitle']            = 'Add Our Products';

        $result['id']                   = '';

        $result['title']                = '';
        $result['htagtitle']                = '';

        $result['home_content']             = '';

        $result['home_image']            = '';

        $result['content']             = '';

        $result['sortOrder']             = '';

        $result['image']            = '';

        $result['icon']            = '';



        return view('/admin/ourproducts/form', $result);

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

            'title' => 'required|unique:ourproducts,title',

            'image'          => 'required',
            'home_image'          => 'required',

            'content'          => 'required',
            'home_content'          => 'required',

        ]);



        if ($validator->passes()) { 

            try {



                $model = new Ourproducts();

                $model->title                   = $request->post('title');
                $model->htagtitle                   = $request->post('htagtitle');

                $model->content                 = $request->post('content');
                $model->home_content                 = $request->post('home_content');

                $model->sortOrder                 = $request->post('sortOrder');

                $model->icon                   = $request->post('icon');



                if ($request->hasfile('home_image')) {

                    $image          = $request->file('home_image');

                    $image_name     = time() . rand(1, 100) . '.' . $image->extension();

                    $image->move(public_path('/storage/media/ourproducts'), $image_name);

                    $model->home_image   = $image_name;

                }

                if ($request->hasfile('image')) {

                    $image          = $request->file('image');

                    $image_name     = time() . rand(1, 100) . '.' . $image->extension();

                    $image->move(public_path('/storage/media/ourproducts'), $image_name);

                    $model->image   = $image_name;

                }



                $model->status      = 1;



                // prx($model);

                $model->save();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/ourproducts']);

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

        $result['pageTitle']   = 'Update Our Products';

        $arr = Ourproducts::where(['id' => $id])->first();



        $result['id']                   = $id;

        $result['title']                = $arr->title;
        $result['htagtitle']                = $arr->htagtitle;

        $result['home_content']              = $arr->home_content;

        $result['home_image']                = $arr->home_image;

        $result['content']              = $arr->content;

        $result['sortOrder']            = $arr->sortOrder;

        $result['image']                = $arr->image;

        $result['icon']                = $arr->icon;

        $result['updated_at']           = date("F j, Y, h:i a", strtotime($arr->updated_at));



        return view('/admin/ourproducts/form', $result);

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

            'title' => 'required|unique:ourproducts,title,' . $id,

        ]);



        if ($validator->passes()) {

            try {



                $arr = array();

                $arr['title']                    = $request->post('title');
                $arr['icon']                    = $request->post('icon');
                $arr['htagtitle']                    = $request->post('htagtitle');

                $arr['content']                  = $request->post('content');
                $arr['home_content']                  = $request->post('home_content');

                $arr['sortOrder']                = $request->post('sortOrder');



                if ($request->hasfile('image')) {

                    $image          = $request->file('image');

                    $image_name     = time() . rand(1, 100) . '.' . $image->extension();

                    $image->move(public_path('/storage/media/ourproducts'), $image_name);

                    $arr['image']   = $image_name;

                }

                if ($request->hasfile('home_image')) {

                    $image          = $request->file('home_image');

                    $image_name     = time() . rand(1, 100) . '.' . $image->extension();

                    $image->move(public_path('/storage/media/ourproducts'), $image_name);

                    $arr['home_image']   = $image_name;

                }

               



                Ourproducts::where('id', $id)->update($arr);



                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/ourproducts']);

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

                Ourproducts::find($value)->delete();

            } else if ($task == 'Activate') {

                $arr['status'] = 1;

                Ourproducts::where('id', $value)->update($arr);

            } else if ($task == 'Block') {

                $arr['status'] = 0;

                Ourproducts::where('id', $value)->update($arr);

            }

        }



        if ($task == 'Delete') {

            return redirect('admin/ourproducts')->with('success', 'Deleted Successfully');

        } else if ($task == 'Activate') {

            return redirect('admin/ourproducts')->with('success', 'Activated Successfully');

        } else if ($task == 'Block') {

            return redirect('admin/ourproducts')->with('success', 'Blocked Successfully');

        }

    }



    public function ourproducts_status(Request $request, $status, $id)

    {

        $id     = Crypt::decrypt($id);

        $model  = Ourproducts::find($id);

        $model->status = $status;

        $model->save();

        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';

        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/ourproducts']);

    }







    public function ourproductsList(Request $request)

    {

        $homeItems     = $request->get("homeItems");



        if ($homeItems) {

            $selectedservicesHome = $homeItems;

        }





        $BusinessData =  Ourproducts::where('status', '1')->orderBy('sortOrder', 'ASC')->get();

        $html = '';

        foreach ($BusinessData as $item) {



            $searchResult = (in_array($item->id, $selectedservicesHome)) ? 'selected' : '';

            $html .= '<option ' . $searchResult . ' value="' . $item->id . '" >' . $item->title . '</option>';

        }

        return response()->json($html);

    }



}

