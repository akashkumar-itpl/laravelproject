<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AboutUs;
use App\Models\Admin\Ourcorestrengths;
use App\Models\Admin\Businessmodels;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Illuminate\Support\Facades\DB;
class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // echo "Working.."; die;
        $data = AboutUs::all();
        $result['pageTitle'] = 'About-Us';
        $frontData = array();
        foreach ($data as $key => $value) {
            $frontData[$value->field_name] = $value->field_value;
        }
        // prx($frontData);
        $result['allData']      = $frontData;

        $result['our_core_strengths'] = Ourcorestrengths::all();
        $result['Business_Model'] = Businessmodels::all();
        // $result['keyAchievements'] = $keyAchievements;
        $result['updated_at']   = date("F j, Y, h:i a", strtotime(AboutUs::max('updated_at')));
        return view('admin/aboutus/homepage', $result);
    }
    public function store(Request $request)
    {
        // prx($request->all());
        $request->validate([
            'vissionImage'     => 'image|mimes:jpeg,png,jpg,webp|max:1024',
            'missionImage'     => 'image|mimes:jpeg,png,jpg,webp|max:1024',
           // 'sectionfourImage' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | Our Core Strengths
            |--------------------------------------------------------------------------
            */
        
            Ourcorestrengths::query()->delete();
        
            // Existing images
            $existingImages = $request->input('existing_achievement_image', []);
            $existingTitles = $request->input('achievement_existing_heading', []);
        
            foreach ($existingImages as $key => $image) {
        
                if (!empty($image)) {
                    $achievement = new Ourcorestrengths();
                    $achievement->image = $image;
                    $achievement->title = $existingTitles[$key] ?? '';
                    $achievement->save();
                }
            }
        
            // New images
            $achievementImages = $request->input('achievement_image', []);
            $achievementTitles = $request->input('achievement_heading', []);
        
            foreach ($achievementImages as $key => $image) {
        
                if (!empty($image)) {
                   $achievement = new Ourcorestrengths();
                   $achievement->image = $image;
                   $achievement->title = $achievementTitles[$key] ?? '';
                   $achievement->save();
                }
            }
        
        
            /*
            |--------------------------------------------------------------------------
            | Business Models
            |--------------------------------------------------------------------------
            */
        
            Businessmodels::query()->delete();
        
            // Existing business content
            $existingBusinessContent = $request->input(
                'existing_business_content',
                []
            );
        
            $existingBusinessHeading = $request->input(
                'existing_business_heading',
                []
            );
        
            foreach ($existingBusinessContent as $key => $content) {
        
                if (!empty($content)) {
                    $achievement = new Businessmodels();
                    $achievement->business_content = $content;
                    $achievement->business_heading = $existingBusinessHeading[$key] ?? '';
                    $achievement->save();
                }
            }
        
            // New business content
            $businessContent = $request->input('business_content', []);
            $businessHeading = $request->input('business_heading', []);
        
            foreach ($businessContent as $key => $content) {
        
                if (!empty($content)) {

                    if (!empty($content)) {
                        $achievement = new Businessmodels();
                        $achievement->business_content = $content;
                        $achievement->business_heading = $businessHeading[$key] ?? '';
                        $achievement->save();
                     }

                }
            }
        });



        if ($request->hasfile('homesectionImage')) {
            $bannerImage = $request->file('homesectionImage');
            $bannerImage_name = time() . rand(1, 100) . '.' . $bannerImage->extension();
            $bannerImage->move(public_path('/storage/media'), $bannerImage_name);
            $data = [
                'field_name' => 'homesectionImage',
                'field_value' => $bannerImage_name,
                'displayOn' => 1,
            ];
            try {
                insertMedia($bannerImage_name);
                $coloumnData = AboutUs::where('field_name', 'homesectionImage')->get();
                if (!$coloumnData->isEmpty()) {
                    AboutUs::where('field_name', 'homesectionImage')->update($data);
                } else {
                    AboutUs::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/aboutus')->with('error', 'Something Went Wrong');
            }
        }

        if ($request->hasfile('ourvaluesImage')) {
            $bannerImage = $request->file('ourvaluesImage');
            $bannerImage_name = time() . rand(1, 100) . '.' . $bannerImage->extension();
            $bannerImage->move(public_path('/storage/media'), $bannerImage_name);
            $data = [
                'field_name' => 'ourvaluesImage',
                'field_value' => $bannerImage_name,
                'displayOn' => 1,
            ];
            try {
                insertMedia($bannerImage_name);
                $coloumnData = AboutUs::where('field_name', 'ourvaluesImage')->get();
                if (!$coloumnData->isEmpty()) {
                    AboutUs::where('field_name', 'ourvaluesImage')->update($data);
                } else {
                    AboutUs::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/aboutus')->with('error', 'Something Went Wrong');
            }
        }
    


        
        if ($request->hasfile('vissionImage')) {
            $vissionImage = $request->file('vissionImage');
            $vissionImage_name = time() . rand(1, 100) . '.' . $vissionImage->extension();
            $vissionImage->move(public_path('/storage/media'), $vissionImage_name);
            $data = [
                'field_name' => 'vissionImage',
                'field_value' => $vissionImage_name,
                'displayOn' => 1,
            ];
            try {
                insertMedia($vissionImage_name);
                $coloumnData = AboutUs::where('field_name', 'vissionImage')->get();
                if (!$coloumnData->isEmpty()) {
                    AboutUs::where('field_name', 'vissionImage')->update($data);
                } else {
                    AboutUs::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/aboutus')->with('error', 'Something Went Wrong');
            }
        }
       
        if ($request->hasfile('missionImage')) {
            $missionImage = $request->file('missionImage');
            $missionImage_name = time() . rand(1, 100) . '.' . $missionImage->extension();
            $missionImage->move(public_path('/storage/media'), $missionImage_name);
            $data = [
                'field_name' => 'missionImage',
                'field_value' => $missionImage_name,
                'displayOn' => 1,
            ];
            try {
                insertMedia($missionImage_name);
                $coloumnData = AboutUs::where('field_name', 'missionImage')->get();
                if (!$coloumnData->isEmpty()) {
                    AboutUs::where('field_name', 'missionImage')->update($data);
                } else {
                    AboutUs::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/aboutus')->with('error', 'Something Went Wrong');
            }
        }
        if ($request->hasfile('sectionfourImage')) {
            $sectionfourImage = $request->file('sectionfourImage');
            $sectionfourImage_name = time() . rand(1, 100) . '.' . $sectionfourImage->extension();
            $sectionfourImage->move(public_path('/storage/media'), $sectionfourImage_name);
            $data = [
                'field_name' => 'sectionfourImage',
                'field_value' => $sectionfourImage_name,
                'displayOn' => 1,
            ];
            try {
                insertMedia($sectionfourImage_name);
                $coloumnData = AboutUs::where('field_name', 'sectionfourImage')->get();
                if (!$coloumnData->isEmpty()) {
                    AboutUs::where('field_name', 'sectionfourImage')->update($data);
                } else {
                    AboutUs::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/aboutus')->with('error', 'Something Went Wrong');
            }
        }
        foreach ($request->all() as $fieldName => $value) {
            $data = array();
            if ($value == '' || in_array($fieldName, array('bannerImage', 'vissionImage','company_overview_image', 'missionImage', 'sectionfourImage','ourvaluesImage', 'benchmark_image', 'achievement_image', 'existing_designation','homesectionImage'))) continue;
            $data = [
                'field_name' => $fieldName,
                'field_value' => trim((is_array($value)) ? serialize($value) : $value),
            ];
            $coloumnData = AboutUs::where('field_name', $fieldName)->get();
            if (!$coloumnData->isEmpty()) {
                AboutUs::where('field_name', $fieldName)->update($data);
            } else {
                AboutUs::insert($data);
            }
        }
 // echo "<pre>"; print_r($_POST); die;
 
      
        return redirect('admin/aboutus')->with('success', 'Updated Successfully');
    }
    public function country_contentdelete(Request $request)
    {
        $id = $request->id;
        // Example: delete from "member_banners" table
        $deleted = DB::table('about_country')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
