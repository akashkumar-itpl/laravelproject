<?php


//this is test
//return code
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Admin\HomePage;
use App\Models\Admin\AboutUs;
use App\Models\Admin\Researchdevelopments;
use App\Models\Admin\Certifications;
use App\Models\Admin\Sustainabilitys;
use App\Models\Admin\Footer;
use App\Models\Admin\Contacts;
use App\Models\Admin\Businessmodels;
use App\Models\Admin\Ourcorestrengths;
use App\Models\Admin\Achievements; 
use Validator; 
use App\Models\Admin\Keyfeatures;
use App\Models\Admin\Ourproducts;

use App\Models\Admin\Page;

use App\Models\Admin\Menu;

use Spatie\Searchable\Search;

use Spatie\Searchable\ModelSearchAspect;

use Mail;

use DB;





class HomeController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //echo "its m"; die;

        $homeData         = HomePage::all();
        $aboutdata = AboutUs::all();
        //$aboutdata = AboutUs::select('id', 'homesectionHeading', 'homesectionContent','homesectionImage','homesectionlink')->get();
        $keyfeature = Keyfeatures::where(['status'=>1, 'feature_status_home'=>1])->OrderBy('sortOrder')->get();
        $ourproducts = Ourproducts::where(['status'=>1])->OrderBy('sortOrder')->get();
        $frontData = array();

        foreach ($homeData as $key => $value) {

            $frontData[$value->field_name] = $value->field_value;

        }
        $aboutfrontData = array();
        foreach ($aboutdata as $key => $value) {
            $aboutfrontData[$value->field_name] = $value->field_value;
        }
       
        $result['aboutData']      = $aboutfrontData;
        $result['frontData']       = $frontData;
        $result['ourproducts']       = $ourproducts;
        $result['keyfeature']       = $keyfeature;
        $result['achievement'] = Achievements::all();

        // Fetch popup record

        $popup = HomePage::where('field_name', 'home_popup')->first();

        if ($popup) {

            // If expiry date is in the past, auto deactivate

            if (!empty($popup->popup_active_date) && $popup->popup_active_date < date('Y-m-d')) {

                $popup->popup_displayOn = 0;

                $popup->save(); // Auto update the DB

                $data = [

                    'field_value'   => '0',

                ];

                HomePage::where('id', 36)->update($data);

            }



            $frontData = [

                'home_popup'        => $popup->field_value,

                'popup_displayOn'   => $popup->popup_displayOn,

                'popup_active_date' => $popup->popup_active_date,

            ];

        } else {

            $frontData = [];

        }





        return view('home', $result);

    }





    public function page($menu, $slug = '')

    {

        $slug = !empty($slug) ? $slug : $menu;

        $pageData    = Page::where(['status' => '1', 'slug' => $slug])->with('getBanner')->first();

        $menuData    = Menu::where('menuslug', 'page/' . $slug)->first();

        $parentMenu  = Menu::where('id', !empty($menuData) ? $menuData->parent_id : '')->first();

        $bannerImage = !empty($pageData) ? (!empty($pageData->getBanner) ? $pageData->getBanner->bannerImage : '') : '';

        // prx($parentMenu);

        if (isset($pageData) && !empty($pageData)) {

            $result['data'] =  $pageData;

            $result['parentMenu'] =  !empty($parentMenu) ? $parentMenu->menuName : '';

            $result['bannerImage'] =  $bannerImage;

            

                return view('pagesCommon', $result);

        } else {

            return view('errors/404');

        }

    }



    public function our_products()

    {
        $menuData    = Menu::where('menuslug','our-products')->first();
        $parentMenu  = Menu::where('id', !empty($menuData) ? $menuData->parent_id : '')->first();
        $result['parentMenu'] =  !empty($parentMenu) ? $parentMenu->menuName : '';
        //echo "<pre>"; print_r($result['parentMenu']); die;
        $result['ourproducts'] = Ourproducts::where(['status'=>1])->OrderBy('sortOrder')->get();
        $result['keyfeature']  = Keyfeatures::where(['status'=>1, 'feature_status_product'=>1])->OrderBy('sortOrder')->get();
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'our-products'])->first();

        return view('our-products',$result);

    }

    public function research_development()

    {

        $result['development'] = Researchdevelopments::where(['status'=>1])->OrderBy('sortOrder')->get();
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'research-development'])->first();
        return view('research-development',$result);

    }

    public function contactUs()

    {

        return view('Contact-us');

    }

    public function contact()

    {

        $data = Footer::all();
        $frontData = array();
        foreach ($data as $key => $value) {
            $frontData[$value->field_name] = $value->field_value;
        }
        $result['frontData']    =$frontData;
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'contact'])->first();

        return view('contact',$result);

    }

    public function sustainability()

    {
        $result['sustainability'] = Sustainabilitys::where(['status'=>1])->OrderBy('sortOrder')->get();
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'sustainability'])->first();
        return view('sustainability',$result);

    }

    public function certifications()

    {
        $result['development'] = Certifications::where(['status'=>1])->OrderBy('sortOrder')->get();
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'certifications'])->first();
        return view('certifications',$result);

    }


    public function thankyou()
    {

        return view('thankyou');

    }
    public function about_us()
    {
        $data = AboutUs::all();
        $frontData = array();
        foreach ($data as $key => $value) {
            $frontData[$value->field_name] = $value->field_value;
        }
        $result['frontData']    =$frontData;
        $result['pageData']    = Page::where(['status' => '1', 'slug' => 'about-us'])->first();
        $result['businessmodels']    = Businessmodels::all();
        $result['ourcorestrengths']    = Ourcorestrengths::all();
        $result['keyfeature']  = Keyfeatures::where(['status'=>1, 'feature_status_product'=>1])->OrderBy('sortOrder')->get();

        return view('about-us',$result);

    }


    function contact_post_form(Request $request)
	{
        
        //echo "<pre>"; print_r($_POST); die;
        $validator = Validator::make($request->all(), [
            'name'                   => 'required',
            'email'                   => 'required|email',
            'phone'                   => 'required',
        ]);
 
        if ($validator->passes()) {

    //         $secretKey = "0x4AAAAAACf49hv1l7363iGLNvqzq5oyD7E";
    // $token = $_POST['cf-turnstile-response'];
    
    // $url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";

    // $data = [
    //     'secret' => $secretKey,
    //     'response' => $token,
    //     'remoteip' => $_SERVER['REMOTE_ADDR']
    // ];

    // $options = [
    //     'http' => [
    //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    //         'method'  => 'POST',
    //         'content' => http_build_query($data)
    //     ]
    // ];

    // $context  = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // $response = json_decode($result);
    // //echo "<pre>"; print_r($response); die;
    // if ($response->success) {

			$input = array();
			$input['name'] = $_POST['name'];
			$input['email'] 	 = $_POST['email'];
            $input['phone'] = $_POST['phone'];
			$input['subject'] 	 = $_POST['subject'];
			$input['msg'] 	 = $_POST['msg'];
            
            Contacts::insert($input);

                $toMail =$_POST['email'];

                $data['name']        = $_POST['name'];
                $data['email']        = $_POST['email'];
                $data['phone']        = $_POST['phone'];
                $data['subject']        = $_POST['subject'];
                $data['msg']        = $_POST['msg'];

               // echo "<pre>"; print_r($data); die;
                Mail::send(
                    'emails/contact',
                    $data,
                    function ($message) use ($toMail) {
                        $message->from(env('MAIL_FROM_ADDRESS'));
                        //$message->to($toMail)->subject('Contact form request..');
                        $message->to($toMail);
                        $message->cc(env('DEFAULT_EMAIL')); // CC email
                        $message->subject('Contact Form Request');
                    }
                );

                return response()->json(['success_resend' => 'Send Successfully']);
	// 		} else {

    //     echo "Turnstile verification failed. Try again.";
    // }

		} 
        return response()->json(['error' => $validator->errors()]);
		
	}


}

