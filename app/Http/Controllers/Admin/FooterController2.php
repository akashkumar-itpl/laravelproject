<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Footer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Validator;
use Exception;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/footer/list');
    }

    public function ajaxList(Request $request)
    {
        $draw                   = $request->get('draw');
        $start                  = $request->get("start");
        $rowperpage             = $request->get("length"); // Rows display per page

        $columnIndex_arr        = $request->get('order');
        $columnName_arr         = $request->get('columns');
        $order_arr              = $request->get('order');
        $search_arr             = $request->get('search');

        $columnIndex            = $columnIndex_arr[0]['column']; // Column index
        $columnName             = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder        = $order_arr[0]['dir']; // asc or desc
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalRecords           = Footer::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Footer::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Footer::orderBy($columnName, $columnSortOrder)
            ->where('title', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id         = $record->id;
            $title      = $record->title;
            $sortOrder  = $record->sortOrder;

            $action = '';
            $action .= '<a href="' . url('admin/edit-footer/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';


            if ($record->status == 1)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/footer-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/footer-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';


            $data_arr[] = array(
                "id" => $sno++,
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
        $result['pageTitle']        = 'Add Footer';
        $result['id']               = '';
        $result['title']            = '';
        $result['content']          = '';
        $result['additionalClass']  = '';
        $result['sortOrder']        = '';

        return view('admin/footer/form', $result);
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
            'title'      => 'required',
            'content'     => 'required',
        ]);

        if ($validator->passes()) {
            try {
                $model                      = new Footer();
                $model->title               = $request->post('title');
                $model->content             = $request->post('content');
                $model->additionalClass     = $request->post('additionalClass');
                $model->sortOrder           = $request->post('sortOrder');
                $model->status              = '1';
                $model->save();
                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/footer']);
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
        $result['pageTitle']   = 'Update Footer';
        $arr = Footer::where(['id' => $id])->first();

        $result['id']               = $id;
        $result['title']            = $arr->title;
        $result['content']          = $arr->content;
        $result['additionalClass']  = $arr->additionalClass;
        $result['sortOrder']        = $arr->sortOrder;
        $result['updated_at']       = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('admin/footer/form', $result);
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
        $request->validate([
            'title'  => 'required',
        ]);

        $arr = array();
        $arr['title']               = $request->post('title');
        $arr['content']             = $request->post('content');
        $arr['additionalClass']     = $request->post('additionalClass');
        $arr['sortOrder']           = $request->post('sortOrder');

        Footer::where('id', $id)->update($arr);

        return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/footer']);
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
                Footer::find($value)->delete();
            } else if ($task == 'Activate') {
                $arr['status'] = '1';
                Footer::where('id', $value)->update($arr);
            } else if ($task == 'Block') {
                $arr['status'] = '0';
                Footer::where('id', $value)->update($arr);
            }
        }

        if ($task == 'Delete') {
            return redirect('admin/footer')->with('success', 'Deleted Successfully');
        } else if ($task == 'Activate') {
            return redirect('admin/footer')->with('success', 'Activated Successfully');
        } else if ($task == 'Block') {
            return redirect('admin/footer')->with('success', 'Blocked Successfully');
        }
    }

    public function Footer_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = Footer::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == '0') ? 'Blocked Successfully' : 'Activated Successfully';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'footer']);
    }
}