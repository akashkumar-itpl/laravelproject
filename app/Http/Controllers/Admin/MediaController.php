<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result['mediaData']      = Media::orderBy('created_at', 'DESC')->paginate(24);
            if (!empty($result)) {
                $artilces = view('admin.media.mediaAjaxList', $result)->render();
                return $artilces;
            } else return FALSE;
        }
        return view('admin/media/list');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'media'      => 'required',
        ]);

        if ($request->hasfile('media')) {
            $images = $request->file('media');
            // prx($images);die;
            foreach ($images as $key => $image) {
                try {
                    $model            = new Media();
                    $image_name = $image->getClientOriginalName();
                    $image->move(public_path('/storage/media'), $image_name);
                    $model->media = $image_name;
                    $model->title = $request->post('title');
                    $model->save();
                } catch (Exception $e) {
                    return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
                }
            }
        }
        return redirect('admin/media')->with('success', 'Uploaded Successfully');
    }


    public function delete($id)
    {
        Media::find($id)->delete();
        return redirect('admin/media')->with('success', 'Deleted Successfully');
    }

    public function multitask(Request $request)
    {
        $id     = $request->post('ids');
        $task   = $request->post('task');
        foreach ($id as $value) {
                Media::find($value)->delete();
        }

        return response()->json(['status' => 200, 'message' => 'Deleted Successfully', 'redirect' => true, 'redirectUrl' => 'admin/media']);
    }
    public function multitask_del(Request $request)
    {

        $id     = $_GET['ids'];
        foreach ($id as $value) {
                Media::find($value)->delete();
        }
        return response()->json(['status' => 200, 'message' => 'Deleted Successfully', 'redirect' => true, 'redirectUrl' => 'admin/media']);
    }
}
