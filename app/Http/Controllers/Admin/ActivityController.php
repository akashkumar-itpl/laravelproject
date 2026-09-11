<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Activity;
use App\Models\Admin\Media;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/Activity/list');
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

        // if($columnName == 'categoryName'){
        //     $columnName = "Gallery_categories.".$columnName;
        // }else{
        //     $columnName = "Gallery.".$columnName;
        // }

        // Total records
        $totalRecords           = Activity::select('count(*) as allcount')
            ->count();
        $totalRecordswithFilter = Activity::select('count(*) as allcount')
            ->where('title', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records = Activity::select('*')
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

            $action = '';
            $action .= '<a href="' . url('admin/edit-activity/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';


            if ($record->status == 1)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/activity-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('/admin/activity-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';



            $data_arr[] = array(
                "id" => $sno++,
                "title" => $title,
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
        $result['pageTitle'] = 'Add Gallery';
        $result['id']        = '';
        $result['title']     = '';
        $result['image']     = '';
        $result['vedio']     = '';
        $result['slug']     = '';
        $result['sortOrder'] = '';


        return view('/admin/Activity/form', $result);
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
        ]);

        if ($validator->passes()) {
            try {
                $model            = new Activity();

                if ($request->hasfile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move(public_path('/storage/media'), $image_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $image_name;
                        $modelMedia->save();
                        $model->image = $image_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('imageGallery') != '') {
                    $model->image = $request->post('imageGallery');
                }

                $model->title     = $request->post('title');
                $model->vedio     = $request->post('vedio');
                $model->slug      = $request->post('slug');
                $model->sortOrder = $request->post('sortOrder');
                $model->status    = 1;
                // prx($model);
                $model->save();
                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/activity']);
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
        $result['pageTitle']   = 'Update Service';
        $arr = Activity::where(['id' => $id])->first();

        $result['id']                   = $id;
        $result['title']                = $arr->title;
        $result['image']                = $arr->image;
        $result['vedio']                = $arr->vedio;
        $result['slug']                = $arr->slug;
        $result['sortOrder']            = $arr->sortOrder;
        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('/admin/Activity/form', $result);
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

                if ($request->hasfile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move(public_path('/storage/media'), $image_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $image_name;
                        $modelMedia->save();
                        $arr['image'] = $image_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('imageactivity') != '') {
                    $arr['image'] = $request->post('imageactivity');
                }

                $arr['title']                    = $request->post('title');
                $arr['vedio']                    = $request->post('vedio');
                $arr['slug']                    = $request->post('slug');
                $arr['sortOrder']                  = $request->post('sortOrder');

                Activity::where('id', $id)->update($arr);

                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/activity']);
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
                Activity::find($value)->delete();
            } else if ($task == 'Activate') {
                $arr['status'] = 1;
                Activity::where('id', $value)->update($arr);
            } else if ($task == 'Block') {
                $arr['status'] = 0;
                Activity::where('id', $value)->update($arr);
            }
        }

        if ($task == 'Delete') {
            return redirect('admin/activity')->with('success', 'Deleted Successfully');
        } else if ($task == 'Activate') {
            return redirect('admin/activity')->with('success', 'Activated Successfully');
        } else if ($task == 'Block') {
            return redirect('admin/activity')->with('success', 'Blocked Successfully');
        }
    }

    public function activity_status(Request $request, $status, $id)
    {
        $id     = Crypt::decrypt($id);
        $model  = Activity::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/activity']);
    }



    public function activityList(Request $request)
    {
        $homeItems     = $request->get("homeItems");

        if ($homeItems) {
            $selectedservicesHome = $homeItems;
        }


        $BusinessData =  Activity::where('status', '1')->orderBy('sortOrder', 'ASC')->get();
        $html = '';
        foreach ($BusinessData as $item) {

            $searchResult = (in_array($item->id, $selectedservicesHome)) ? 'selected' : '';
            // $html .= "<option $searchResult value = '$servicesValue->id'>$servicesValue->serviceName</option>";


            $html .= '<option ' . $searchResult . ' value="' . $item->id . '" >' . $item->title . '</option>';
        }
        return response()->json($html);
    }

    public function service_sort()
    {
        $result['service'] = Activity::where(['status' => 1])->orderBy('sortOrder', 'ASC')->get();
        return view('admin/Activity/sort', $result);
    }

    public function service_sort_store(Request $request)
    {
        foreach ($request->post('sortingDataid') as $keys => $sortingDataid) {
            $dataVal = array(
                'sortOrder' => $keys + 1,
            );
            // print_r($dataVal);
            Activity::where('id', $sortingDataid)->update($dataVal);
        }
        return redirect('admin/service-sort')->with('success', 'Updated Successfully');
    }
}
