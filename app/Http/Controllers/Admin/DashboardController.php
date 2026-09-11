<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Brands;
use App\Models\Admin\News;
use App\Models\Admin\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $result = array();
        // $result['orderCount']       = Order::count();
        // $result['productCount']     = Product::count();
        // $result['categoryCount']    = Category::count();
        // $result['brandCount']       = Brands::count();
        // $result['newsCount']        = News::count();
        return view('admin.dashboard', $result);
    }
}