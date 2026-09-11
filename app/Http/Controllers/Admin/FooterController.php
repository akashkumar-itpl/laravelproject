<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use App\Models\Admin\Footer;

use App\Models\Admin\Fcol1;

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

        $data = Footer::all();

        $LeadersDetails = Fcol1::all();

        $result['pageTitle'] = 'Manage Footer';

        $frontData = array();

        foreach ($data as $key => $value) {

            $frontData[$value->field_name] = $value->field_value;

        }

        $result['allData']      = $frontData;

        $result['benchmark_details']      = $LeadersDetails;

        // $result['keyAchievements'] = $keyAchievements;

        $result['updated_at']   = date("F j, Y, h:i a", strtotime(Footer::max('updated_at')));

        return view('admin/footer/homepage', $result);

    }



    public function store(Request $request)

    {



        // prx($request->all());



        $request->validate([

            'footerlogo'  => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:1024',

        ]);



        if ($request->hasfile('footerlogo')) {

            $footerlogo = $request->file('footerlogo');

            $footerlogo_name = time() . rand(1, 100) . '.' . $footerlogo->extension();

            $footerlogo->move(public_path('/storage/media'), $footerlogo_name);



            $data = [

                'field_name' => 'footerlogo',

                'field_value' => $footerlogo_name,

                'displayOn' => 1,

            ];

            try {

                // insertMedia($footerlogo_name);



                $coloumnData = Footer::where('field_name', 'footerlogo')->get();

                if (!$coloumnData->isEmpty()) {

                    Footer::where('field_name', 'footerlogo')->update($data);

                } else {

                    Footer::insert($data);

                }

            } catch (Exception $e) {

                return redirect('admin/footer')->with('error', 'Something Went Wrong');

            }

        }



        foreach ($request->all() as $fieldName => $value) {

            $data = array();

            if ($value == '' || in_array($fieldName, array('footerlogo', 'approaches_heading', 'approaches_content', 'approaches_existing_content', 'approaches_existing_heading'))) continue;



            $data = [

                'field_name' => $fieldName,

                'field_value' => trim((is_array($value)) ? serialize($value) : $value),

            ];



            $coloumnData = Footer::where('field_name', $fieldName)->get();

            if (!$coloumnData->isEmpty()) {

                Footer::where('field_name', $fieldName)->update($data);

            } else {

                Footer::insert($data);

            }

        }



        Fcol1::truncate();



        if ($request->post('approaches_existing_heading')) {

            foreach ($request->post('approaches_existing_heading') as $key => $heading) {

                // Save to database

                $benchmark             = new Fcol1();

                $benchmark->heading    = $heading;

                $benchmark->content    = $request->post('approaches_existing_content')[$key];

                $benchmark->save();

            }

        }



        if ($request->post('approaches_heading')) {

            foreach ($request->post('approaches_heading') as $key => $heading) {

                // Save to database

                $benchmark             = new Fcol1();

                if (!empty($heading)) {

                    $benchmark->heading      = $heading;

                    $benchmark->content    = $request->post('approaches_content')[$key];

                    $benchmark->save();

                }

            }

        }



        return redirect('admin/footer')->with('success', 'Updated Successfully');

    }

}

