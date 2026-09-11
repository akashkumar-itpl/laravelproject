<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\Models\Admin\AboutUs;

class AboutusController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {



        $data         = AboutUs::all();

        $result    = array();

        $frontData = array();



        foreach ($data as $key => $value) {

            $frontData[$value->field_name] = $value->field_value;

        }



        $result['frontData']       = $frontData;

        $result['metaTitle']       = $frontData['metaTitle'];

        $result['metaKeywords']    = $frontData['metaKeywords'];

        $result['metaDescription'] = $frontData['metaDescription'];

        $result['canonicalUrl']    = $frontData['canonicalUrl'];

        return view('about-us', $result);

    }

}

