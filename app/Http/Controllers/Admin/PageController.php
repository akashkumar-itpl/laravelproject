<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\Admin\Page;
use App\Models\Admin\Media;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;



use Validator;



class PageController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        return view('admin/page/list');

    }



    public function ajaxList(Request $request)
    {
        $draw          = $request->get('draw');
        $start         = $request->get("start");
        $rowperpage    = $request->get("length"); 
        $order_arr     = $request->get('order');
        $columnName_arr= $request->get('columns');
        $searchValue   = $request->get('search')['value'];
    
        $columnIndex     = $order_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
    
        // --------- FIXED ---------
    
        // Total records 
        $totalRecords = Page::count();
    
        // Search filter  
        $totalRecordswithFilter = Page::where('slug', 'like', "%$searchValue%")
            ->count();
    
        // Fetch records 
        $records = Page::where('slug', 'like', "%$searchValue%")
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowperpage)
            ->get();
    
        // ---------- Data Formatting ----------
    
        $data_arr = [];
        $sno = $start + 1;
    
        foreach ($records as $record) {
    
            $action  = '<a href="' . url('admin/edit-page/' . Crypt::encrypt($record->id)) . '">
                            <button type="button" class="btn badge btn-success">Edit</button>
                        </a>';
    
            if ($record->status == 1) {
                $action .= ' | <a href="javascript:void(0);" class="changeStatus" 
                        data-url="' . url('admin/page-status/0/' . Crypt::encrypt($record->id)) . '">
                        <button type="button" class="btn badge btn-info">Active</button></a>';
            } else {
                $action .= ' | <a href="javascript:void(0);" class="changeStatus" 
                        data-url="' . url('admin/page-status/1/' . Crypt::encrypt($record->id)) . '">
                        <button type="button" class="btn badge btn-warning">Blocked</button></a>';
            }
    
            $data_arr[] = [
                "id" => $sno++,
                "title" => $record->title,
                "slug" => $record->slug,
                "action" => $action,
                "check" => '<input type="checkbox" class="checkboxes recordcheckbox" value="' . $record->id . '"/>',
            ];
        }
    
        // Response
        return response()->json([
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ]);
    }
    


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $result['pageTitle']            = 'Add Page';

        $result['id']                   = '';

        $result['slug']              = '';

        $result['title']              = '';
        $result['banner']            = '';
        $result['content']              = '';
        $result['metaTitle']            = '';
      
        $result['metaKeywords']         = '';

        $result['metaDescription']      = '';

        $result['canonicalUrl']         = '';



        return view('admin/page/form', $result);

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
            'slug' => 'required|unique:pages,slug',
        ]);


        if ($validator->passes()) {

            try {


                $model = new Page();

                $model->title               = $request->post('title');
                //custom slug
                if(!empty($request->post('slug'))){
                $model->slug = $request->post('slug');
                }else{
                $model->slug = Str::slug($request->post('title'));
                }
                //close

                $model->content               = $request->post('content');

                if ($request->hasfile('banner')) {
                    $banner = $request->file('banner');
                    $bannerimage_name = time() . rand(1, 100) . '.' . $banner->extension();
                    $banner->move(public_path('/storage/media'), $bannerimage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $bannerimage_name;
                        $modelMedia->save();
                        $model->banner = $bannerimage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('oldbanner') != '') {
                    $model->banner = $request->post('oldbanner');
                }
    
                $model->metaTitle               = $request->post('metaTitle');

                $model->metaKeywords            = $request->post('metaKeywords');

                $model->metaDescription         = $request->post('metaDescription');

                $model->canonicalUrl            = $request->post('canonicalUrl');

                $model->status      = 1;

                $model->save();

                return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/page']);

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

        $result['pageTitle']   = 'Update Page';

        $arr = Page::where(['id' => $id])->first();

        $result['id']                   = $id;

        $result['slug']                = $arr->slug;

        $result['title']                = $arr->title;

        $result['banner']                = $arr->banner;

        $result['content']                = $arr->content;

        $result['metaTitle']            = $arr->metaTitle;

        $result['metaKeywords']         = $arr->metaKeywords;

        $result['metaDescription']      = $arr->metaDescription;

        $result['canonicalUrl']         = $arr->canonicalUrl;

        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('admin/page/form', $result);

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
            'slug' => 'required|unique:pages,slug,' . $id,
        ]);

        if ($validator->passes()) {

            try {

                $arr = array();
            
                $arr['title']                  = $request->post('title');
                //custom slug
                if(!empty($request->post('slug'))){
                $arr['slug'] = $request->post('slug');
                }else{
                $arr['slug'] = Str::slug($request->post('title'));
                }
                //close
                if ($request->hasfile('banner')) {
                    $banner = $request->file('banner');
                    $bannerimage_name = time() . rand(1, 100) . '.' . $banner->extension();
                    $banner->move(public_path('/storage/media'), $bannerimage_name);
                    try {
                        $modelMedia                  = new Media();
                        $modelMedia->media   = $bannerimage_name;
                        $modelMedia->save();
                        $arr['banner'] = $bannerimage_name;
                    } catch (Exception $e) {
                        return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                    }
                } else if ($request->post('oldbanner') != '') {
                    $arr['banner'] = $request->post('oldbanner');
                }

                $arr['content']                  = $request->post('content');

                $arr['metaTitle']                = $request->post('metaTitle');

                $arr['metaKeywords']             = $request->post('metaKeywords');

                $arr['metaDescription']          = $request->post('metaDescription');

                $arr['canonicalUrl']             = $request->post('canonicalUrl');

                Page::where('id', $id)->update($arr);

                return response()->json(['status' => 200, 'message' => 'Updated Successfully', 'redirect' => true, 'redirectUrl' => '/admin/page']);

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

                Page::find($value)->delete();

            } else if ($task == 'Activate') {

                $arr['status'] = 1;

                Page::where('id', $value)->update($arr);

            } else if ($task == 'Block') {

                $arr['status'] = 0;

                Page::where('id', $value)->update($arr);

            }

        }



        if ($task == 'Delete') {

            return redirect('admin/page')->with('success', 'Deleted Successfully');

        } else if ($task == 'Activate') {

            return redirect('admin/page')->with('success', 'Activated Successfully');

        } else if ($task == 'Block') {

            return redirect('admin/page')->with('success', 'Blocked Successfully');

        }

    }



    public function Page_status(Request $request, $status, $id)

    {

        $id     = Crypt::decrypt($id);

        $model  = Page::find($id);

        $model->status = $status;

        $model->save();

        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';

        return response()->json(['status' => 200, 'message' => $message, 'redirect' => true, 'redirectUrl' => '/admin/page']);

    }

}