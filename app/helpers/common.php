<?php



use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Crypt;

use App\Models\Admin\Page;
use App\Models\Admin\Ourproducts;
use App\Models\Admin\HomePage;





if (!function_exists('testHelper')) {

    function testHelper()

    {

        return 'Helper working successfully!';

    }

}



function prx($arr)

{

	echo "<pre>";

	print_r($arr);

	die();

}



function getSiteData()

{

	$result = DB::table('home_pages')

		->where('displayOn', 1)

		->get();



	$frontData = array();

	foreach ($result as $key => $value) {

		$frontData[$value->field_name] = $value->field_value;

	}

	return $frontData;

}



function getFrontMenu()

{

    $clsname = 'App\Models\Admin\Menu';

    $cls = new $clsname();

    $result = $cls::get();



    $processedArray = processMenuArray($result);



    $lastIndex = count($processedArray) - 1;



    foreach ($processedArray as $index => $menu) {

        $isLast = ($index === $lastIndex);

        printMenu($menu, $isLast);

    }

}



function printMenu($menu, $isLast = false)

{

    $menuClass = 'mainitemmenu' . ($isLast ? ' last' : '');



    if ($menu['haveChild'] && isset($menu['childMenu']) && is_array($menu['childMenu'])) {



        echo '<li>';

        echo '<a href="' . url($menu['menuslug']) . '" class="' . $menuClass . '">'

            . $menu['menuName'] . '</a>';



        echo '<ul class="dropdown ser-dr">';



        foreach ($menu['childMenu'] as $submenu) {

            printSubMenu($submenu);

        }



        echo '</ul>';

        echo '</li>';



    } else {



        echo '<li>';

        echo '<a href="' . url($menu['menuslug']) . '" class="' . $menuClass . '">'

            . $menu['menuName'] . '</a>';

        echo '</li>';

    }

}



function printSubMenu($submenu)

{

    if ($submenu['haveChild'] && isset($submenu['childMenu']) && is_array($submenu['childMenu'])) {



        echo '<li>';

        echo '<a href="' . url($submenu['menuslug']) . '">'

            . $submenu['menuName'] . '</a>';



        echo '<ul class="dropdown ser-dr">';



        foreach ($submenu['childMenu'] as $subsubmenu) {

            echo '<li>';

            echo '<a href="' . url($subsubmenu['menuslug']) . '">'

                . $subsubmenu['menuName'] . '</a>';

            echo '</li>';

        }



        echo '</ul>';

        echo '</li>';



    } else {



        echo '<li>';

        echo '<a href="' . url($submenu['menuslug']) . '">'

            . $submenu['menuName'] . '</a>';

        echo '</li>';

    }

}



// Function to process the array and add child data

function processMenuArray($menuArray, $parentId = 0)

{

	$result = [];



	foreach ($menuArray as $menuItem) {

		if ($menuItem['parent_id'] == $parentId) {

			$menuItem['haveChild'] = false;



			// Check if the current menu item has children

			$children = processMenuArray($menuArray, $menuItem['id']);

			if (!empty($children)) {

				$menuItem['haveChild'] = true;

				$menuItem['childMenu'] = $children;

			}



			$result[] = $menuItem;

		}

	}



	return $result;

}



function gettopbar()

{

	$result = DB::table('home_pages')

		->where('field_name', 'top_bar')

		->first();

	return $result;

}



function getsupport_box()

{

	$result = DB::table('home_pages')

		->where('field_name', 'support_box')

		->first();

	return $result;

}



function getAdminData()

{

	$result = DB::table('general_settings')

		->get();

	$frontData = array();

	foreach ($result as $key => $value) {

		$frontData[$value->field_name] = $value->field_value;

	}

	return $frontData;

}



function getFooterData()

{

	$result = DB::table('footers')

		->get();

	$frontData = array();

	foreach ($result as $key => $value) {

		$frontData[$value->field_name] = $value->field_value;

	}

	return $frontData;

}



function getQuickLinks()

{

	$result = DB::table('fcol1s')->get();

	return $result;

}





function ordinal($number)

{

	$ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');

	if ((($number % 100) >= 11) && (($number % 100) <= 13))

		return $number . 'th';

	else

		return $number . $ends[$number % 10];

}



function getPermissionData()

{

	$routename =   class_basename(Route::getCurrentRoute()->getActionname());

	$action = explode('@', $routename);

	$controller = $action[0];

	$roleid = auth()->guard('admin')->user()->roleId;



	$result =  DB::table('admin_sub_menus')

		->select('admin_sub_menus.sub_menus')

		->join('admin_menu_permissions', 'admin_menu_permissions.sub_menu_id', '=', 'admin_sub_menus.id')

		->where('admin_sub_menus.sub_menus', 'LIKE', $controller . '%')

		->where(['admin_menu_permissions.role_id' => $roleid])

		->get();



	$Permisionlistdata = array();



	for ($i = 0; $i < count($result); $i++) {

		$Permisionlistdata[] =  $result[$i]->sub_menus;

	}



	return $Permisionlistdata;

}



function getAdminMenu()

{

    $admin = auth()->guard('admin')->user();



    if (!$admin) {

        return '';

    }



    $roleid = $admin->roleId;



    $result = DB::table('admin_menus')

        ->select('admin_menus.*')

        ->where('admin_menus.permission_menu', 'Yes')

        ->whereExists(function ($query) use ($roleid) {

            $query->select(DB::raw(1))

                ->from('admin_sub_menus')

                ->join(

                    'admin_menu_permissions',

                    'admin_menu_permissions.sub_menu_id',

                    '=',

                    'admin_sub_menus.id'

                )

                ->join(

                    'rolemaster',

                    'rolemaster.id',

                    '=',

                    'admin_menu_permissions.role_id'

                )

                ->whereColumn(

                    'admin_sub_menus.menu_id',

                    'admin_menus.id'

                )

                ->where('admin_menu_permissions.role_id', $roleid)

                ->where('rolemaster.status', 1);

        })

        ->orderBy('admin_menus.order_by', 'ASC')

        ->get();



    $html = '';



    foreach ($result as $AdminMenuDataVal) {



        $html .= '<li class="nav-item">

            <a href="#" class="nav-link">

                <i class="nav-icon ' . $AdminMenuDataVal->icon . '"></i>

                <p>

                    ' . $AdminMenuDataVal->title . '

                    <i class="fas fa-angle-left right"></i>

                </p>

            </a>';



        $subMenuData = getAdminSubMenu($AdminMenuDataVal->id);



        if ($subMenuData != '') {

            $html .= $subMenuData;

        }



        $html .= '</li>';

    }



    return $html;

}



function getAdminSubMenu($id)

{

    $admin = auth()->guard('admin')->user();



    if (!$admin) {

        return '';

    }



    $roleid = $admin->roleId;



    $result = DB::table('admin_sub_menus')

        ->select('admin_sub_menus.*')

        ->where('admin_sub_menus.menu_id', $id)

        ->where('admin_sub_menus.show_left_menu', 'yes')

        ->whereExists(function ($query) use ($roleid) {

            $query->select(DB::raw(1))

                ->from('admin_menu_permissions')

                ->join(

                    'rolemaster',

                    'rolemaster.id',

                    '=',

                    'admin_menu_permissions.role_id'

                )

                ->whereColumn(

                    'admin_menu_permissions.sub_menu_id',

                    'admin_sub_menus.id'

                )

                ->where(

                    'admin_menu_permissions.role_id',

                    $roleid

                )

                ->where('rolemaster.status', 1);

        })

        ->whereExists(function ($query) {

            $query->select(DB::raw(1))

                ->from('admin_menus')

                ->whereColumn(

                    'admin_menus.id',

                    'admin_sub_menus.menu_id'

                )

                ->where('admin_menus.permission_menu', 'Yes');

        })

        ->orderBy('admin_sub_menus.display_order', 'ASC')

        ->get();



    $html = '';



    if ($result->isNotEmpty()) {



        $route = Route::currentRouteAction();



        $routename = class_basename($route);



        $routeParts = explode('@', $routename);



        $first = $routeParts[0] ?? '';



        $html .= '<ul class="nav nav-treeview">';



        foreach ($result as $AdminSubMenuDataVal) {



            $subMenuParts = explode(

                '@',

                $AdminSubMenuDataVal->sub_menus

            );



            $firstSubMenu = $subMenuParts[0] ?? '';



            $active = ($first == $firstSubMenu) ? 'active' : '';



            $html .= '<li class="nav-item">

                <a href="' . url('admin/' . $AdminSubMenuDataVal->url) . '"

                    class="nav-link subcat ' . $active . '">

                    <i class="far fa-circle nav-icon"></i>

                    <p>' . e($AdminSubMenuDataVal->title) . '</p>

                </a>

            </li>';

        }



        $html .= '</ul>';

    }



    return $html;

}



function getSubMenuPermission($id)

{

	$roleid = auth()->guard('admin')->user()->roleId;

	$result = DB::table('admin_sub_menus')

		->where('menu_id', $id)

		->orderBy('display_order', 'ASC')

		->get();



	//dd($result);

	return $result;

}



function insertMedia($image = NULL, $documentOriginalName = NULL)

{

	DB::table('media')->insert([

		'title' => $documentOriginalName,

		'created_at' => date('Y-m-d H:i:s'),

		'media' => $image,

	]);

	return TRUE;

}



function createUrlSlug($urlString)

{

	$slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString));

	return $slug;

}





function getSEOData($slug){

	$result = Page::where('slug', $slug)

	->first();

     return $result;

}

function GetSeo(){

	$result = Page::count();

     return $result;

}
function Getourproducts(){

	$result = Ourproducts::count();

     return $result;

}



function getnewsbannerData(){

	$result = DB::table('news_banner')

	->where('id', 1)

	->first();

     return $result;

}



function getCountry()

{

	$result = DB::table('countries')

		->where('status',1)

		->get();



	return $result;

}

function getState($countryId)

{

	$result = DB::table('states')

	    ->where('countryId',$countryId)

		->where('status',1)

		->get();

		

	return $result;

}

function getCity($stateId)

{

	$result = DB::table('cities')

	    ->where('stateId',$stateId)

		->where('status',1)

		->get();

		

	return $result;

}

function gethomedata(){
	$homeData         = HomePage::all();
	$frontData = array();

	foreach ($homeData as $key => $value) {
		$frontData[$value->field_name] = $value->field_value;
	}

	return $frontData;
}