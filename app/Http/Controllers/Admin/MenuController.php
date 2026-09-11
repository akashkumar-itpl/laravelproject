<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomePage;
use App\Models\Admin\Menu;
use App\Models\Admin\Page;
use App\Models\Admin\Brands;
use App\Models\Admin\Tags;
use App\Models\Admin\Category;
use App\Models\Admin\Media;
use App\Models\Admin\OurBrands;
use App\Models\Admin\OurBusinesses;
use App\Models\Admin\OurServices;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = HomePage::all();

    $result['pageTitle']  = 'Menu';
    $result['MenuData']   = $this->menuTree();

    // prx($result['MenuData']);  

    return view('admin/home/menu', $result);
  }


  function menuTree($parent_id = 0)
  {
    $items = '';
    $query = Menu::where('parent_id', $parent_id)->get()->toArray();
    if (isset($query) && !empty($query)) {
      $items .= '<ol class="dd-list">';
      // $result = $query->fetchAll();
      foreach ($query as $row) {
        $items .= $this->renderMenuItem($row['id'], $row['menuName'], $row['menuslug']);
        $items .= $this->menuTree($row['id']);
        $items .= '</li>';
      }
      $items .= '</ol>';
    }
    return $items;
  }


  function renderMenuItem($id, $label, $url)
  {


    return '<li class="dd-item dd3-item"  data-id="' . $id . '" data-label="' . $label . '" data-url="' . $url . '">' .
      '<div class="dd-handle dd3-handle" > Drag</div>' .
      '<div class="dd3-content"><span>' . $label . '</span>' .
      '<div class="item-edit">Edit</div>' .
      '</div>' .
      '<div class="item-settings d-none">' .
      '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' . $label . '"></label></p>' .
      '<p><label for="">Navigation Url (Valid Slug (avoid 404))<br><input type="text" name="navigation_url" value="' . $url . '"></label></p>' .
      '<p><a class="item-delete" href="javascript:;">Remove</a> |' .
      '<a class="item-close" href="javascript:;">Close</a></p>' .
      '</div>';
  }


  public function store(Request $request)
  {

    $menu = $request->post('menu');
    $menu = json_decode($menu, true);
    $parent = 0;
    // prx($menu);          
    Menu::truncate();

    if (!empty($menu)) {


      foreach ($menu as $value) {

        $label = $value['label'];
        $url = (empty($value['url'])) ? '#' : $value['url'];


        $model = new Menu();
        $model->menuName = $label;
        $model->menuslug = $url;
        $model->parent_id = $parent;



        $model->save();

        $id = $model->id;

        if (array_key_exists('children', $value))
          $this->updateMenu($value['children'], $id);
      }
    }



    return response()->json(['status' => 200, 'message' => 'Added Successfully', 'redirect' => true, 'redirectUrl' => '/admin/menu']);
  }


  function updateMenu($menu, $parent = 0)
  {
    if (!empty($menu)) {


      foreach ($menu as $value) {

        $label = $value['label'];
        $url = (empty($value['url'])) ? '#' : $value['url'];

        $model = new Menu();
        $model->menuName = $label;
        $model->menuslug = $url;
        $model->parent_id = $parent;

        $model->save();
        $id = $model->id;
        if (array_key_exists('children', $value))
          $this->updateMenu($value['children'], $id);
      }
    }
  }


  public function deleteMenu(Request $request)
  {

    $resultData = Menu::where('sortorder', $request['removeId'])->orWhere('parent_id', $request['removeId'])->delete();


    $url = url('/admin/menu');
    return $url;
  }
}
