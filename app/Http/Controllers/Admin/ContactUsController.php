<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactUs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('/admin/ContactUs/list');
    }

    public function ajaxList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        $totalRecords = ContactUs::count();
        $totalRecordswithFilter = ContactUs::where('title', 'like', '%' . $searchValue . '%')
            ->count();

        $records = ContactUs::where('title', 'like', '%' . $searchValue . '%')
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = [];
        $sno = $start + 1;

        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $address = $record->address;
            $email = $record->email;
            $mobile = $record->mobile;

            $banner = ($record->banner != '')
                ? '<img src="' . asset("storage/media/Images/$record->banner") . '" width="120px" />'
                : '<img src="' . asset("storage/media/admin/placeholder.png") . '" width="50px" />';

            $action = '<a href="' . url('admin/edit-contact-us/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-success">Edit</button></a>';

            if ($record->status == 1)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus" data-url="' . url('/admin/contact-us-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info">Active</button></a>';
            else
                $action .= ' | <a href="javascript:void(0);" class="changeStatus" data-url="' . url('/admin/contact-us-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning">Blocked</button></a>';

            $data_arr[] = [
                "id" => $sno++,
                "title" => $title,
                "banner" => $banner,
                "address" => $address,
                "email" => $email,
                "mobile" => $mobile,
                "action" => $action,
                "check" => '<input type="checkbox" class="checkboxes recordcheckbox" value="' . $id . '"/>',
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ];

        echo json_encode($response);
        exit;
    }

    public function create()
    {
        $result = [
            'pageTitle' => 'Add Contact Us',
            'id' => '',
            'banner' => '',
            'title' => '',
            'address' => '',
            'email' => '',
            'mobile' => '',
        ];

        return view('/admin/ContactUs/form', $result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner' => 'required',
            'title' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        if ($validator->passes()) {
            try {
                $model = new ContactUs();
                $model->title = $request->title;
                $model->address = $request->address;
                $model->email = $request->email;
                $model->mobile = $request->mobile;

                if ($request->hasfile('banner')) {
                    $banner = $request->file('banner');
                    $banner_name = time() . rand(1, 100) . '.' . $banner->extension();
                    $banner->move(public_path('/storage/media/Images'), $banner_name);
                    $model->banner = $banner_name;
                }

                $model->status = 1;
                $model->save();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/contact_us']);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors()]);
    }

    public function edit()
    {
        $id = 1;
        $arr = ContactUs::findOrFail($id);

        $result = [
            'pageTitle' => 'Edit Contact Us',
            'id' => $id,
            'banner' => $arr->banner,
            'title' => $arr->title,
            'address' => $arr->address,
            'email' => $arr->email,
            'mobile' => $arr->mobile,
            'mobile1' => $arr->mobile1,
            'mobile2' => $arr->mobile2,
            'image' => $arr->image,

            'updated_at' => date("F j, Y, h:i a", strtotime($arr->updated_at)),
        ];

        return view('/admin/ContactUs/form', $result);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
           

        ]);

        if ($validator->passes()) {
            try {
                $arr = [
                    'title' => $request->title,
                    'address' => $request->address,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'mobile1' => $request->mobile1,
                    'mobile2' => $request->mobile2,
                ];

                if ($request->hasfile('banner')) {
                    $banner = $request->file('banner');
                    $banner_name = time() . rand(1, 100) . '.' . $banner->extension();
                    $banner->move(public_path('/storage/media/Images'), $banner_name);
                    $arr['banner'] = $banner_name;
                }
                if ($request->hasfile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . rand(1, 100) . '.' . $image->extension();
                    $image->move(public_path('/storage/media/Images'), $image_name);
                    $arr['image'] = $image_name;
                }
                ContactUs::where('id', $id)->update($arr);
                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/contact_us']);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors()]);
    }

    public function multitask(Request $request)
    {
        $id = explode(',', $request->post('ids'));
        $task = $request->post('task');

        foreach ($id as $value) {
            if ($task == 'Delete') {
                ContactUs::find($value)->delete();
            } else if ($task == 'Activate') {
                ContactUs::where('id', $value)->update(['status' => 1]);
            } else if ($task == 'Block') {
                ContactUs::where('id', $value)->update(['status' => 0]);
            }
        }

        $message = ($task == 'Delete') ? 'Deleted Successfully' : (($task == 'Activate') ? 'Activated Successfully' : 'Blocked Successfully');
        return redirect('admin/contact_us')->with('success', $message);
    }

    public function contact_us_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = ContactUs::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/contact_us']);
    }
}
