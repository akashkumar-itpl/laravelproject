<?php







namespace App\Http\Controllers\admin;







use App\Http\Controllers\Controller;



use App\Models\Admin\HomePage;



use Illuminate\Http\Request;

use App\Models\Admin\Achievements;

use Validator;



use Exception;















class HomePageController extends Controller



{



    /**



     * Display a listing of the resource.



     *



     * @return \Illuminate\Http\Response



     */



    public function index()



    {



        $data = HomePage::all();



        $popup = HomePage::where('field_name', 'home_popup')->first();





        // $keyAchievements = KeyAchievement::where('status' , '1')->get();



        $result['pageTitle'] = 'Home Page';



        $frontData = array();



        foreach ($data as $key => $value) {



            $frontData[$value->field_name] = $value->field_value;



        }



        // prx($frontData);

        $result['popup']      = $popup;



        $result['allData']      = $frontData;



        // $result['keyAchievements'] = $keyAchievements;
        $result['achievement_details'] = Achievements::all();
       

        $result['updated_at']   = date("F j, Y, h:i a", strtotime(HomePage::max('updated_at')));



        return view('admin/home/homepage', $result);



    }







    public function store(Request $request)



    {

       // echo "<pre>"; print_r($_FILES); die;

        $request->validate([

            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:6024',

            'favicon' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:6024',

        ]);



        if ($request->hasfile('sectionfourImage')) {



            $bannerMobile = $request->file('sectionfourImage');



            $bannerMobile_name = time() . rand(1, 100) . '.' . $bannerMobile->extension();



            $bannerMobile->move(public_path('/storage/media'), $bannerMobile_name);







            $data = [



                'field_name' => 'sectionfourImage',



                'field_value' => $bannerMobile_name,



                'displayOn' => 1,



            ];



            try {



                // insertMedia($bannerMobile_name);







                $coloumnData = HomePage::where('field_name', 'sectionfourImage')->get();



                if (!$coloumnData->isEmpty()) {



                    HomePage::where('field_name', 'sectionfourImage')->update($data);



                } else {



                    HomePage::insert($data);



                }



            } catch (Exception $e) {



                return redirect('admin/homepage')->with('error', 'Something Went Wrong');



            }



        }

        if ($request->hasfile('logo')) {



            $logo = $request->file('logo');



            $logo_name = time() . rand(1, 100) . '.' . $logo->extension();



            $logo->move(public_path('/storage/media'), $logo_name);







            $data = [



                'field_name' => 'logo',



                'field_value' => $logo_name,



                'displayOn' => 1,



            ];



            try {



                // insertMedia($logo_name);







                $coloumnData = HomePage::where('field_name', 'logo')->get();



                if (!$coloumnData->isEmpty()) {



                    HomePage::where('field_name', 'logo')->update($data);



                } else {



                    HomePage::insert($data);



                }



            } catch (Exception $e) {



                return redirect('admin/homepage')->with('error', 'Something Went Wrong');



            }



        }







        if ($request->hasfile('favicon')) {



            $favicon = $request->file('favicon');



            $favicon_name = time() . rand(1, 100) . '.' . $favicon->extension();



            $favicon->move(public_path('/storage/media'), $favicon_name);







            $data = [



                'field_name' => 'favicon',



                'field_value' => $favicon_name,



                'displayOn' => 1,



            ];



            try {



                // insertMedia($favicon_name);







                $coloumnData = HomePage::where('field_name', 'favicon')->get();



                if (!$coloumnData->isEmpty()) {



                    HomePage::where('field_name', 'favicon')->update($data);



                } else {



                    HomePage::insert($data);



                }



            } catch (Exception $e) {



                return redirect('admin/homepage')->with('error', 'Something Went Wrong');



            }



        }







        if ($request->hasfile('bannerFile')) {



            $bannerFile = $request->file('bannerFile');



            $bannerFile_name = time() . rand(1, 100) . '.' . $bannerFile->extension();



            $bannerFile->move(public_path('/storage/media'), $bannerFile_name);







            $data = [



                'field_name' => 'bannerFile',



                'field_value' => $bannerFile_name,



                'displayOn' => 1,



            ];



            try {



                // insertMedia($bannerFile_name);

                $coloumnData = HomePage::where('field_name', 'bannerFile')->get();



                if (!$coloumnData->isEmpty()) {



                    HomePage::where('field_name', 'bannerFile')->update($data);



                } else {



                    HomePage::insert($data);



                }



            } catch (Exception $e) {



                return redirect('admin/homepage')->with('error', 'Something Went Wrong');



            }



        }







        if ($request->hasfile('bannerMobile')) {



            $bannerMobile = $request->file('bannerMobile');



            $bannerMobile_name = time() . rand(1, 100) . '.' . $bannerMobile->extension();



            $bannerMobile->move(public_path('/storage/media'), $bannerMobile_name);







            $data = [



                'field_name' => 'bannerMobile',



                'field_value' => $bannerMobile_name,



                'displayOn' => 1,



            ];



            try {



                // insertMedia($bannerMobile_name);







                $coloumnData = HomePage::where('field_name', 'bannerMobile')->get();



                if (!$coloumnData->isEmpty()) {



                    HomePage::where('field_name', 'bannerMobile')->update($data);



                } else {



                    HomePage::insert($data);



                }



            } catch (Exception $e) {



                return redirect('admin/homepage')->with('error', 'Something Went Wrong');



            }



        }









        if ($request->has('popup_active_date')) {

              //echo "<pre>"; print_r($_POST); echo "<br>"; print_r($_FILES); die;

           

              $popup_name=$request->post('oldhome_popup');

            // Handle file upload only if a new file is uploaded

            if ($request->hasFile('home_popup')) {

                $popup = $request->file('home_popup');

                $popup_name = time() . rand(1, 100) . '.' . $popup->extension();

                $popup->move(public_path('storage/media'), $popup_name);

                //$data['field_value'] = $popup_name;

            }

            $data = [

               // 'home_popup'  => 'home_popup',

                'field_value' => $popup_name,

                'popup_link' => $request->post('popup_link'),

                'popup_active_date' => $request->post('popup_active_date'),

                'popup_displayOn'   => $request->post('popup_displayOn'),

                'home_popup'   => $popup_name,

            ];



          //  echo "<pre>"; print_r($data); die;

          HomePage::where('field_name', 'home_popup')->update($data);

          $data1 = [

             'field_value' => $request->post('popup_link'),

         ];

          HomePage::where('id', 41)->update($data1);



        }

         

        foreach ($request->all() as $fieldName => $value) {



            $data = array();



            if ($value == '' || in_array($fieldName, array('logo', 'favicon', 'bannerFile', 'bannerMobile','home_popup','popup_link','achievement_image','sectionfourImage'))) continue;







            $data = [



                'field_name' => $fieldName,



                'field_value' => trim((is_array($value)) ? serialize($value) : $value),



            ];







            $coloumnData = HomePage::where('field_name', $fieldName)->get();



            if (!$coloumnData->isEmpty()) {



                HomePage::where('field_name', $fieldName)->update($data);



            } else {



                HomePage::insert($data);



            }



        }

        Achievements::truncate();



        if ($request->post('existing_achievement_image')) {

            foreach ($request->post('existing_achievement_image') as $key => $image) {

                // Save to database

                $achievement             = new Achievements();

                $achievement->filename   = $image;

                $achievement->heading    = $request->post('achievement_existing_heading')[$key];

                $achievement->content    = $request->post('achievement_existing_content')[$key];

                $achievement->save();

            }

        }



        if ($request->hasFile('achievement_image')) {

            foreach ($request->file('achievement_image') as $key => $image) {

                $imageName = time() . rand(1, 100) . '.' . $image->getClientOriginalName();

                $image->move(public_path('/storage/media'), $imageName);



                // Save to database

                $achievement             = new Achievements();

                $achievement->filename   = $imageName;

                $achievement->heading    = $request->post('achievement_heading')[$key];

                $achievement->content    = $request->post('achievement_content')[$key];

                $achievement->save();

            }

        }


        return redirect('admin/homepage')->with('success', 'Updated Successfully');



    }



}



