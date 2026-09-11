<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use App\Models\Admin\Media;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Exception;
use DB;
class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['id']                       = '';
        $result['title']                    = '';
        $result['content']                  = '';
        $result['bannerImage']              = '';
        $result['menu_id']                  = '';
        $result['mobImage']                 = '';
        $result['redirectUrl']              = '';
        $result['sortOrder']                = '';
        $result['status']                   = '';
        $bannerPageId                       = HomeBanner::select('menu_id')->where('menu_id', '!=', '40')->groupBy('menu_id')->get();
        $pageIds                            = array_column($bannerPageId->toArray(), 'menu_id');
        $result['menu']                     = Page::where('status', '1')->whereNotIn('id', $pageIds)->get();
        return view('admin/home/bannerList', $result);
    }

    public function ajaxBannerList(Request $request)
    {
        $draw           = $request->get('draw');
        $start          = $request->get("start");
        $rowperpage     = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $search_arr['value']; // Search value

        // Total records
        $totalRecords           = HomeBanner::select('count(*) as allcount')->with('getMenu')->count();
        $totalRecordswithFilter = HomeBanner::select('count(*) as allcount')
            ->with('getMenu')
            ->where('title', 'like', '%' . $searchValue . '%')
            ->count();

        // Fetch records
        $records = HomeBanner::orderBy($columnName, $columnSortOrder)
            ->where('title', 'like', '%' . $searchValue . '%')
            ->with('getPage')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id             = $record->id;
            $title          = $record->title;
            $menu           = !empty($record->getPage) ? $record->getPage->title : '';
            $sortOrder      = $record->sortOrder;
            $desktopBanner  = ($record->bannerImage !== '') ? '<img src="' . asset("storage/media/$record->bannerImage") . '" width="250px" />' : '<img src="' . asset("storage/media/admin/placeholder.png") . '" width="50px" />';
            $mobileBanner  = ($record->mobImage != '') ? '<img src="' . asset("storage/media/$record->mobImage") . '" width="250px" />' : '<img src="' . asset("storage/media/admin/placeholder.png") . '" width="50px" />';
            $action         = '';
            $action .= '<a href="' . url('admin/edit-homebanner/' .  Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            if ($record->status == 1)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/homebanner-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info" >Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="javascript:void(0);" class="changeStatus"  data-url="' . url('admin/homebanner-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning" >Blocked</button></a>';

            $data_arr[] = array(
                "id"                    => $sno++,
                "title"                 => $title,
                "page"                  => $menu,
                "desktopBanner"         => $desktopBanner,
                "mobileBanner"          => $mobileBanner,
                "sortOrder"             => $sortOrder,
                "action"                => $action,
                "check"                 => '<input type="checkbox" class="checkboxes recordcheckbox" value="' . $id . '"/>',
            );
        }

        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordswithFilter,
            "aaData"                => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

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
                'menu_id'                 => 'required',
                'title'                 => 'required',
                // 'bannerImage'           => 'required__without:bannerImageGallery|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048|dimensions:width=1280,height=500',
                'mobileImage'           => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048|dimensions:width=400,height=500',
                'sortOrder'             => 'nullable|numeric',
                'redirectUrl'           => 'nullable|url',

            ],
            // ['bannerImage.required' => 'Desktop banner image is required', 'dimensions' => 'Dimensions must be 1280 * 500 '],
            // ['mobileImage.required' => 'Desktop banner image is required', 'dimensions' => 'Dimensions must be 400 * 500 ']

        );

        if ($validator->passes()) {
            try {
                $model = new HomeBanner();

                $model->title            = $request->post('title');
                $model->menu_id            = $request->post('menu_id');
                $model->content          = $request->post('content');
                $model->redirectUrl      = $request->post('redirectUrl');
                $model->sortOrder        = $request->post('sortOrder');
                $model->status           = 1;

                if ($request->hasfile('bannerImage')) {
                    $bannerImage = $request->file('bannerImage');
                    $bannerImage_name = time() . rand(1, 100) . '.' . $bannerImage->extension();
                    $bannerImage->move(public_path('/storage/media'), $bannerImage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $bannerImage_name;
                        $modelMedia->save();
                        $model->bannerImage = $bannerImage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('bannerImageGallery') != '') {
                    $model->bannerImage = $request->post('bannerImageGallery');
                }

                if ($request->hasfile('mobImage')) {
                    $mobImage = $request->file('mobImage');
                    $mobImage_name = time() . rand(1, 100) . '.' . $mobImage->extension();
                    $mobImage->move(public_path('/storage/media'), $mobImage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $mobImage_name;
                        $modelMedia->save();
                        $model->mobImage = $mobImage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('mobImageGallery') != '') {
                    $model->mobImage = $request->post('mobImageGallery');
                }


                $model->save();
                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => false]);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        // return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);
        return response()->json(['status' => 401, 'message' => 'Please fill all required fields', 'redirect' => false]);

        // return redirect('admin/homebanner')->with('success', 'Added Successfully');
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
        $id =  Crypt::decrypt($id);
        $result['pageTitle']   = 'Update Banner';

        $arr = HomeBanner::where(['id' => $id])->first();
        $result['id']               = $id;
        $result['title']            = $arr->title;
        $result['menu_id']            = $arr->menu_id;
        $result['content']          = $arr->content;
        $result['bannerImage']      = $arr->bannerImage;
        $result['mobImage']         = $arr->mobImage;
        $result['redirectUrl']      = $arr->redirectUrl;
        $result['sortOrder']        = $arr->sortOrder;
        $result['status']           = $arr->status;
        $result['updated_at']       = date("F j, Y, h:i a", strtotime($arr->updated_at));
        $result['menu']             = Page::where('status', '1')->get();


        return view('admin/home/bannerFormEdit', $result);
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
            $request->all(),
            [
                // 'title'                 => 'required',
                'bannerImage'           => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'mobileImage'           => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'sortOrder'             => 'nullable|numeric',
                'redirectUrl'           => 'nullable|url',
            ],
            ['bannerImage.required' => 'Desktop banner image is required']
        ]);

        if ($validator->passes()) {

            try {
                $arr = array();
                $arr['title']            = $request->post('title');
                $arr['menu_id']            = $request->post('menu_id');
                $arr['content']          = $request->post('content');
                $arr['redirectUrl']      = $request->post('redirectUrl');
                $arr['sortOrder']        = $request->post('sortOrder');
                $arr['status']           = 1;

                if ($request->hasfile('bannerImage')) {
                    $bannerImage = $request->file('bannerImage');
                    $bannerImage_name = time() . rand(1, 100) . '.' . $bannerImage->extension();
                    $bannerImage->move(public_path('/storage/media'), $bannerImage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $bannerImage_name;
                        $modelMedia->save();
                        $arr['bannerImage'] = $bannerImage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('bannerImageGallery') != '') {
                    $arr['bannerImage'] = $request->post('bannerImageGallery');
                }

                if ($request->hasfile('mobImage')) {
                    $mobImage = $request->file('mobImage');
                    $mobImage_name = time() . rand(1, 100) . '.' . $mobImage->extension();
                    $mobImage->move(public_path('/storage/media'), $mobImage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $mobImage_name;
                        $modelMedia->save();
                        $arr['mobImage'] = $mobImage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('mobImageGallery') != '') {
                    $arr['mobImage'] = $request->post('mobImageGallery');
                }

                HomeBanner::where('id', $id)->update($arr);
                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/homebanner']);
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
                HomeBanner::find($value)->delete();
            } else if ($task == 'Activate') {
                $arr['status'] = '1';
                HomeBanner::where('id', $value)->update($arr);
            } else if ($task == 'Block') {
                $arr['status'] = '0';
                HomeBanner::where('id', $value)->update($arr);
            }
        }

        if ($task == 'Delete') {
            return redirect('admin/homebanner')->with('error', 'Deleted Successfully');
        } else if ($task == 'Activate') {
            return redirect('admin/homebanner')->with('info', 'Activated Successfully');
        } else if ($task == 'Block') {
            return redirect('admin/homebanner')->with('warning', 'Blocked Successfully');
        }
    }

    public function homebanner_status(Request $request, $status, $id)
    {
        $id     =  Crypt::decrypt($id);
        $model  = HomeBanner::find($id);
        $model->status = $status;
        $model->save();

        $arr['status'] = $status;

        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => 'homebanner']);
    }

    public function homebanner_sort()
    {
        $result['pageTitle']   = 'Sort Banner';
        $result['banners'] = HomeBanner::where(['status' => 1])->orderBy('sortOrder', 'ASC')->get();

        return view('admin/home/bannerSort', $result);
    }


    public function homebanner_sort_store(Request $request)
    {
        foreach ($request->post('sortingDataid') as $keys => $sortingDataid) {
            $dataVal = array(
                'sortOrder' => $keys + 1,
            );
            // print_r($dataVal);
            HomeBanner::where('id', $sortingDataid)->update($dataVal);
        }
        return response()->json(['status' => 200, 'message' => 'Sort Updated Successfully']);
    }

    public function News_banner_update(Request $request)
    {
    //$news = DB::table('news_banner')->findOrFail(1);
   
    if ($request->hasfile('news_banner')) {
        $mobImage = $request->file('news_banner');
        $mobImage_name = time() . rand(1, 100) . '.' . $mobImage->extension();
        $mobImage->move(public_path('/storage/media'), $mobImage_name);
        try {
            $modelMedia                  = new Media();
            $modelMedia->media   = $mobImage_name;
            $modelMedia->save();
    
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
        }
    } else if ($request->post('oldnews_banner') != '') {
        $mobImage_name = $request->post('oldnews_banner');
    }
    DB::table('news_banner')->where('id', 1)->update([
        'banner' => $mobImage_name
    ]);
   
    return back()->with('success', 'Banner updated successfully');
    }
    public function Blogs_banner_update(Request $request)
    {
    //$news = DB::table('news_banner')->findOrFail(1);
   
    if ($request->hasfile('blogs_banner')) {
        $mobImage = $request->file('blogs_banner');
        $mobImage_name = time() . rand(1, 100) . '.' . $mobImage->extension();
        $mobImage->move(public_path('/storage/media'), $mobImage_name);
        try {
            $modelMedia                  = new Media();
            $modelMedia->media   = $mobImage_name;
            $modelMedia->save();
    
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
        }
    } else if ($request->post('oldblogs_banner') != '') {
        $mobImage_name = $request->post('oldblogs_banner');
    }
    DB::table('blogs_banner')->where('id', 1)->update([
        'banner' => $mobImage_name
    ]);
   
    return back()->with('success', 'Banner updated successfully');
    }
}
