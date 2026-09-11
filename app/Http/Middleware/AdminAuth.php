<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\AdminSubmenu;
use App\Models\Admin\LogActivity;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->user()) {

            $routename =   class_basename($request->route()->getActionname());

            // echo $routename;exit;

            $roleid = auth()->guard('admin')->user()->roleId;
            $LoginRoleData = AdminSubmenu::join("admin_menu_permissions", "admin_menu_permissions.sub_menu_id", "=", "admin_sub_menus.id")
                ->join('rolemaster', 'rolemaster.id', '=', 'admin_menu_permissions.role_id', 'left')
                ->where(['admin_sub_menus.sub_menus' => $routename])
                ->where(['admin_menu_permissions.role_id' => $roleid])
                ->where('rolemaster.status', '1')
                ->get();



            $action = explode('@', $routename);
            $method = $action[1];



            if ($request->ajax()) {
                return $next($request);
            }

            if ($LoginRoleData->isEmpty() && $routename != 'DashboardController@dashboard' && $routename != 'AdminController@changepassword' && $routename != 'AdminController@changepasswordupdate' && $routename != 'Closure') {
                return redirect('admin/access-denied');
            } else {

                // add LogActivity


                $log = [];
                $log['subject'] =    (!$LoginRoleData->isEmpty()) ? $LoginRoleData[0]->title : '';
                $log['url'] = $request->fullUrl();
                $log['method'] = $request->method();
                $log['ip'] = $request->ip();
                $log['agent'] = $request->header('user-agent');
                $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
                LogActivity::create($log);

                // end LogActivity
                return $next($request);
            }
        } else {
            Auth::logout();
            return redirect('admin')->with('error', 'Please Login To Continue');
        }
    }
}