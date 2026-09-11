<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
 

//ADMIN ROUTES
//Route::get('admin', [App\Http\Controllers\Admin\AdminController::class, 'adminIndex'])->middleware(['disable_back_btn']);
Route::get('admin', [App\Http\Controllers\Admin\AdminController::class, 'adminIndex']);
Route::post('admin/auth', [App\Http\Controllers\Admin\AdminController::class, 'auth'])->name('admin.auth');

Route::get('admin/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout']);
Route::get('admin/access-denied', [App\Http\Controllers\Admin\AdminController::class, 'accessdenied']);


Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return redirect()->back()->with('success', 'Configuration Cache Cleared Successfully');
});
Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return redirect()->back()->with('success', 'Routes Cache Cleared Successfully');
});
Route::get('/view-cache', function () {
    Artisan::call('view:cache');
    return redirect()->back()->with('success', 'View Cache Cleared Successfully');
});
Route::get('/event-cache', function () {
    Artisan::call('event:clear');
    return redirect()->back()->with('success', 'Events Cache Cleared Successfully');
});
Route::get('/application-cache', function () {
    Artisan::call('cache:clear');
    return redirect()->back()->with('success', 'Application Cache Cleared Successfully');
});
Route::get('/all-cache', function () {
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'All Cache Cleared Successfully');
});

Route::get('/admin/maintenance-down', function () {
    Artisan::call('down');
    return redirect()->back()->with('success', 'Website Is Under Maintenance Mode Now');
});

Route::get('/admin/maintenance-up', function () {
    Artisan::call('up');
    return redirect()->back()->with('success', 'Website Is Now Live');
});

//Route::group(['middleware' => 'disable_back_btn'], function () {
    Route::group(['middleware' => 'admin_auth'], function () {

        Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard']);
        Route::get('admin/logactivity', [App\Http\Controllers\Admin\LogActivityController::class, 'index']);
        Route::get('admin/ajaxLogActivityList', [App\Http\Controllers\Admin\LogActivityController::class, 'ajaxList'])->name('admin.ajaxLogActivityList');

        Route::get('admin/homepage', [App\Http\Controllers\Admin\HomePageController::class, 'index']);
        Route::post('admin/homepage-form', [App\Http\Controllers\Admin\HomePageController::class, 'store'])->name('admin.homepage-form');
        Route::get('admin/getDataSection', [App\Http\Controllers\Admin\HomePageController::class, 'getDataSection']);
        
        Route::get('admin/aboutus', [App\Http\Controllers\Admin\AboutUsController::class, 'index']);
        Route::post('admin/aboutus-form', [App\Http\Controllers\Admin\AboutUsController::class, 'store'])->name('admin.aboutus-form');
        Route::get('admin/getDataSection', [App\Http\Controllers\Admin\AboutUsController::class, 'getDataSection']);

        Route::post('country_content_delete', [App\Http\Controllers\Admin\AboutUsController::class, 'country_contentdelete'])->name('country_content_delete');

        Route::get('admin/whatmatters', [App\Http\Controllers\Admin\WhatmattersController::class, 'index']);
        Route::post('admin/whatmatters-form', [App\Http\Controllers\Admin\WhatmattersController::class, 'store'])->name('admin.whatmatters-form');
        Route::get('admin/getDataSection', [App\Http\Controllers\Admin\WhatmattersController::class, 'getDataSection']);

        Route::get('admin/footer', [App\Http\Controllers\Admin\FooterController::class, 'index']);
        Route::post('admin/footer-form', [App\Http\Controllers\Admin\FooterController::class, 'store'])->name('admin.footer-form');
        Route::get('admin/getDataSection', [App\Http\Controllers\Admin\FooterController::class, 'getDataSection']);

        Route::get('admin/generalsettings', [App\Http\Controllers\Admin\GeneralSettingsController::class, 'index']);
        Route::post('admin/generalsettings-form', [App\Http\Controllers\Admin\GeneralSettingsController::class, 'store'])->name('admin.generalsettings-form');

        Route::get('admin/homebanner', [App\Http\Controllers\Admin\HomeBannerController::class, 'index']);
        Route::get('admin/ajaxBannerList', [App\Http\Controllers\Admin\HomeBannerController::class, 'ajaxBannerList'])->name('admin.ajaxBannerList');
        Route::get('admin/add-homebanner', [App\Http\Controllers\Admin\HomeBannerController::class, 'create']);
        Route::post('admin/add-homebanner-form', [App\Http\Controllers\Admin\HomeBannerController::class, 'store'])->name('admin.add-homebanner-form');
        Route::post('admin/update-homebanner-form/{id}', [App\Http\Controllers\Admin\HomeBannerController::class, 'update'])->name('admin.update-homebanner-form');
        Route::get('admin/edit-homebanner/{id}', [App\Http\Controllers\Admin\HomeBannerController::class, 'edit']);
        Route::post('admin/homebanner-multitask', [App\Http\Controllers\Admin\HomeBannerController::class, 'multitask'])->name('admin.homebanner-multitask');
        Route::get('admin/homebanner-status/{status}/{id}', [App\Http\Controllers\Admin\HomeBannerController::class, 'homebanner_status']);
        Route::get('admin/homebanner-sort', [App\Http\Controllers\Admin\HomeBannerController::class, 'homebanner_sort'])->name('admin.homebannerSort');
        Route::post('admin/homebanner-sortUpdate', [App\Http\Controllers\Admin\HomeBannerController::class, 'homebanner_sort_store'])->name('admin.homebannersortUpdate');

        Route::get('admin/admin', [App\Http\Controllers\Admin\AdminController::class, 'index']);
        Route::get('admin/ajaxList', [App\Http\Controllers\Admin\AdminController::class, 'ajaxList'])->name('admin.ajaxList');
        Route::get('admin/add-admin', [App\Http\Controllers\Admin\AdminController::class, 'create']);
        Route::post('admin/add-admin-form', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.add-admin-form');
        Route::post('admin/update-admin-form/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.update-admin-form');
        Route::get('admin/edit-admin/{id}', [App\Http\Controllers\Admin\AdminController::class, 'edit']);
        Route::post('admin/admin-multitask', [App\Http\Controllers\Admin\AdminController::class, 'multitask'])->name('admin.admin-multitask');
        Route::get('admin/admin-status/{status}/{id}', [App\Http\Controllers\Admin\AdminController::class, 'admin_status']);


        Route::get('admin/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles');
        Route::get('admin/ajaxRoleList', [App\Http\Controllers\Admin\RoleController::class, 'ajaxList'])->name('admin.ajaxRoleList');
        Route::get('admin/add-roles', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('admin.add-roles');
        Route::post('admin/add-roles-form', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.add-roles-form');
        Route::post('admin/update-roles-form/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.update-roles-form');
        Route::get('admin/edit-roles/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.edit-roles');
        Route::post('admin/roles-multitask', [App\Http\Controllers\Admin\RoleController::class, 'multitask'])->name('admin.roles-multitask');
        Route::get('admin/roles-permision/{id}', [App\Http\Controllers\Admin\RoleController::class, 'role_permision'])->name('admin.roles_permision');
        Route::post('admin/roles-permision-form/{id}', [App\Http\Controllers\Admin\RoleController::class, 'role_permision_update'])->name('admin.roles-permision-form');
        Route::get('admin/roles-status/{status}/{id}', [App\Http\Controllers\Admin\RoleController::class, 'role_status']);


        Route::get('admin/page', [App\Http\Controllers\Admin\PageController::class, 'index']);
        Route::get('admin/ajaxpageList', [App\Http\Controllers\Admin\PageController::class, 'ajaxList'])->name('admin.ajaxpageList');
        Route::get('admin/add-page', [App\Http\Controllers\Admin\PageController::class, 'create']);
        Route::post('admin/add-page-form', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('admin.add-page-form');
        Route::post('admin/update-page-form/{id}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('admin.update-page-form');
        Route::get('admin/edit-page/{id}', [App\Http\Controllers\Admin\PageController::class, 'edit']);
        Route::post('admin/page-multitask', [App\Http\Controllers\Admin\PageController::class, 'multitask'])->name('admin.page-multitask');
        Route::get('admin/page-status/{status}/{id}', [App\Http\Controllers\Admin\PageController::class, 'page_status']);

        Route::get('admin/menu', [App\Http\Controllers\Admin\MenuController::class, 'index']);
        Route::get('admin/deleteMenu', [App\Http\Controllers\Admin\MenuController::class, 'deleteMenu']);
        Route::post('admin/menu-form', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('admin.menu-form');

        // Route::get('admin/footer', [App\Http\Controllers\Admin\FooterController::class, 'index']);
        // Route::get('admin/ajaxFooterList', [App\Http\Controllers\Admin\FooterController::class, 'ajaxList'])->name('admin.ajaxFooterList');
        // Route::get('admin/add-footer', [App\Http\Controllers\Admin\FooterController::class, 'create']);
        // Route::post('admin/add-footer-form', [App\Http\Controllers\Admin\FooterController::class, 'store'])->name('admin.add-footer-form');
        // Route::post('admin/update-footer-form/{id}', [App\Http\Controllers\Admin\FooterController::class, 'update'])->name('admin.update-footer-form');
        // Route::get('admin/edit-footer/{id}', [App\Http\Controllers\Admin\FooterController::class, 'edit']);
        // Route::post('admin/footer-multitask', [App\Http\Controllers\Admin\FooterController::class, 'multitask'])->name('admin.footer-multitask');
        // Route::get('admin/footer-status/{status}/{id}', [App\Http\Controllers\Admin\FooterController::class, 'footer_status']);
        // Route::get('admin/footer-showHome/{status}/{id}', [App\Http\Controllers\Admin\FooterController::class, 'footer_showHome']);

        Route::get('admin/media', [App\Http\Controllers\Admin\MediaController::class, 'index']);
        Route::post('admin/add-media-form', [App\Http\Controllers\Admin\MediaController::class, 'store'])->name('admin.add-media-form');
        Route::get('admin/deleteMedia/{id}', [App\Http\Controllers\Admin\MediaController::class, 'delete']);
        Route::post('admin/media-multitask', [App\Http\Controllers\Admin\MediaController::class, 'multitask'])->name('admin.media-multitask');
        Route::get('admin/media-multitask-del', [App\Http\Controllers\Admin\MediaController::class, 'multitask_del']);

        Route::get('admin/ourservices', [App\Http\Controllers\Admin\OurServicesController::class, 'index']);
        Route::get('admin/ajaxourservicesList', [App\Http\Controllers\Admin\OurServicesController::class, 'ajaxList'])->name('admin.ajaxourservicesList');
        Route::get('admin/add-ourservices', [App\Http\Controllers\Admin\OurServicesController::class, 'create']);
        Route::post('admin/add-ourservices-form', [App\Http\Controllers\Admin\OurServicesController::class, 'store'])->name('admin.add-ourservices-form');
        Route::post('admin/update-ourservices-form/{id}', [App\Http\Controllers\Admin\OurServicesController::class, 'update'])->name('admin.update-ourservices-form');
        Route::get('admin/edit-ourservices/{id}', [App\Http\Controllers\Admin\OurServicesController::class, 'edit']);
        Route::post('admin/ourservices-multitask', [App\Http\Controllers\Admin\OurServicesController::class, 'multitask'])->name('admin.ourservices-multitask');
        Route::get('admin/ourservices-status/{status}/{id}', [App\Http\Controllers\Admin\OurServicesController::class, 'ourservices_status']);
        Route::get('admin/OurServicesList', [App\Http\Controllers\Admin\OurServicesController::class, 'OurServicesList']);

        Route::get('admin/productshowcase', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'index']);
        Route::get('admin/ajaxproductshowcaseList', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'ajaxList'])->name('admin.ajaxproductshowcaseList');
        Route::get('admin/add-productshowcase', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'create']);
        Route::post('admin/add-productshowcase-form', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'store'])->name('admin.add-productshowcase-form');
        Route::post('admin/update-productshowcase-form/{id}', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'update'])->name('admin.update-productshowcase-form');
        Route::get('admin/edit-productshowcase/{id}', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'edit']);
        Route::post('admin/productshowcase-multitask', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'multitask'])->name('admin.productshowcase-multitask');
        Route::get('admin/productshowcase-status/{status}/{id}', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'productshowcase_status']);
        Route::get('admin/ProductShowcaseList', [App\Http\Controllers\Admin\ProductShowcaseController::class, 'ProductShowcaseList']);

        Route::get('admin/blogscategory', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'index']);
        Route::get('admin/ajaxblogscategoryList', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'ajaxList'])->name('admin.ajaxblogscategoryList');
        Route::get('admin/add-blogscategory', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'create']);
        Route::post('admin/add-blogscategory-form', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'store'])->name('admin.add-blogscategory-form');
        Route::post('admin/update-blogscategory-form/{id}', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'update'])->name('admin.update-blogscategory-form');
        Route::get('admin/edit-blogscategory/{id}', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'edit']);
        Route::post('admin/blogscategory-multitask', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'multitask'])->name('admin.blogscategory-multitask');
        Route::get('admin/blogscategory-status/{status}/{id}', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'blogscategory_status']);
        Route::get('admin/blogscategoryList', [App\Http\Controllers\Admin\BlogsCategoryController::class, 'blogscategoryList']);

        Route::get('admin/facultycategory', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'index']);
        Route::get('admin/ajaxfacultycategoryList', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'ajaxList'])->name('admin.ajaxfacultycategoryList');
        Route::get('admin/add-facultycategory', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'create']);
        Route::post('admin/add-facultycategory-form', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'store'])->name('admin.add-facultycategory-form');
        Route::post('admin/update-facultycategory-form/{id}', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'update'])->name('admin.update-facultycategory-form');
        Route::get('admin/edit-facultycategory/{id}', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'edit']);
        Route::post('admin/facultycategory-multitask', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'multitask'])->name('admin.facultycategory-multitask');
        Route::get('admin/facultycategory-status/{status}/{id}', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'facultycategory_status']);
        Route::get('admin/facultycategoryList', [App\Http\Controllers\Admin\FacultyCategoryController::class, 'facultycategoryList']);

        Route::get('admin/facultymember', [App\Http\Controllers\Admin\FacultyMemberController::class, 'index']);
        Route::get('admin/ajaxfacultymemberList', [App\Http\Controllers\Admin\FacultyMemberController::class, 'ajaxList'])->name('admin.ajaxfacultymemberList');
        Route::get('admin/add-facultymember', [App\Http\Controllers\Admin\FacultyMemberController::class, 'create']);
        Route::post('admin/add-facultymember-form', [App\Http\Controllers\Admin\FacultyMemberController::class, 'store'])->name('admin.add-facultymember-form');
        Route::post('admin/update-facultymember-form/{id}', [App\Http\Controllers\Admin\FacultyMemberController::class, 'update'])->name('admin.update-facultymember-form');
        Route::get('admin/edit-facultymember/{id}', [App\Http\Controllers\Admin\FacultyMemberController::class, 'edit']);
        Route::post('admin/facultymember-multitask', [App\Http\Controllers\Admin\FacultyMemberController::class, 'multitask'])->name('admin.facultymember-multitask');
        Route::get('admin/facultymember-status/{status}/{id}', [App\Http\Controllers\Admin\FacultyMemberController::class, 'facultymember_status']);
        Route::get('admin/facultymemberList', [App\Http\Controllers\Admin\FacultyMemberController::class, 'facultymemberList']);

        //Delete Banner Images
        Route::post('member_banner_delete', [App\Http\Controllers\Admin\FacultyMemberController::class, 'bannerdelete'])->name('member_banner_delete');
        Route::post('member_highlights_delete', [App\Http\Controllers\Admin\FacultyMemberController::class, 'highlightsdelete'])->name('member_highlights_delete');
        Route::post('member_joining_forces_delete', [App\Http\Controllers\Admin\FacultyMemberController::class, 'joining_forcesdelete'])->name('member_joining_forces_delete');
        Route::post('member_services_delete', [App\Http\Controllers\Admin\FacultyMemberController::class, 'member_services_delete'])->name('member_services_delete');


        Route::post('career_image_delete', [App\Http\Controllers\Admin\CareerController::class, 'career_image_delete'])->name('career_image_delete');
        Route::post('services_image_delete', [App\Http\Controllers\Admin\CareerController::class, 'services_image_delete'])->name('services_image_delete');
        Route::post('slider_image_delete', [App\Http\Controllers\Admin\CareerController::class, 'slider_image_delete'])->name('slider_image_delete');





        Route::get('admin/blogs', [App\Http\Controllers\Admin\BlogsController::class, 'index']);
        Route::get('admin/ajaxblogsList', [App\Http\Controllers\Admin\BlogsController::class, 'ajaxList'])->name('admin.ajaxblogsList');
        Route::get('admin/add-blogs', [App\Http\Controllers\Admin\BlogsController::class, 'create']);
        Route::post('admin/add-blogs-form', [App\Http\Controllers\Admin\BlogsController::class, 'store'])->name('admin.add-blogs-form');
        Route::post('admin/update-blogs-form/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'update'])->name('admin.update-blogs-form');
        Route::get('admin/edit-blogs/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'edit']);
        Route::post('admin/blogs-multitask', [App\Http\Controllers\Admin\BlogsController::class, 'multitask'])->name('admin.blogs-multitask');
        Route::get('admin/blogs-status/{status}/{id}', [App\Http\Controllers\Admin\BlogsController::class, 'blogs_status']);
        Route::get('admin/blogsList', [App\Http\Controllers\Admin\BlogsController::class, 'blogsList']);

        Route::get('admin/news', [App\Http\Controllers\Admin\NewsController::class, 'index']);
        Route::get('admin/ajaxnewsList', [App\Http\Controllers\Admin\NewsController::class, 'ajaxList'])->name('admin.ajaxnewsList');
        Route::get('admin/add-news', [App\Http\Controllers\Admin\NewsController::class, 'create']);
        Route::post('admin/add-news-form', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('admin.add-news-form');
        Route::post('admin/update-news-form/{id}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('admin.update-news-form');
        Route::get('admin/edit-news/{id}', [App\Http\Controllers\Admin\NewsController::class, 'edit']);
        Route::post('admin/news-multitask', [App\Http\Controllers\Admin\NewsController::class, 'multitask'])->name('admin.news-multitask');
        Route::get('admin/news-status/{status}/{id}', [App\Http\Controllers\Admin\NewsController::class, 'news_status']);
        Route::get('admin/newsList', [App\Http\Controllers\Admin\NewsController::class, 'newsList']);

        Route::get('admin/bsp', [App\Http\Controllers\Admin\BspController::class, 'index']);
        Route::get('admin/ajaxbspList', [App\Http\Controllers\Admin\BspController::class, 'ajaxList'])->name('admin.ajaxbspList');
        Route::get('admin/add-bsp', [App\Http\Controllers\Admin\BspController::class, 'create']);
        Route::post('admin/add-bsp-form', [App\Http\Controllers\Admin\BspController::class, 'store'])->name('admin.add-bsp-form');
        Route::post('admin/update-bsp-form/{id}', [App\Http\Controllers\Admin\BspController::class, 'update'])->name('admin.update-bsp-form');
        Route::get('admin/edit-bsp/{id}', [App\Http\Controllers\Admin\BspController::class, 'edit']);
        Route::post('admin/bsp-multitask', [App\Http\Controllers\Admin\BspController::class, 'multitask'])->name('admin.bsp-multitask');
        Route::get('admin/bsp-status/{status}/{id}', [App\Http\Controllers\Admin\BspController::class, 'bsp_status']);
        Route::get('admin/bspList', [App\Http\Controllers\Admin\BspController::class, 'bspList']);

        Route::get('admin/download', [App\Http\Controllers\Admin\DownloadController::class, 'index']);
        Route::get('admin/ajaxdownloadList', [App\Http\Controllers\Admin\DownloadController::class, 'ajaxList'])->name('admin.ajaxdownloadList');
        Route::get('admin/add-download', [App\Http\Controllers\Admin\DownloadController::class, 'create']);
        Route::post('admin/add-download-form', [App\Http\Controllers\Admin\DownloadController::class, 'store'])->name('admin.add-download-form');
        Route::post('admin/update-download-form/{id}', [App\Http\Controllers\Admin\DownloadController::class, 'update'])->name('admin.update-download-form');
        Route::get('admin/edit-download/{id}', [App\Http\Controllers\Admin\DownloadController::class, 'edit']);
        Route::post('admin/download-multitask', [App\Http\Controllers\Admin\DownloadController::class, 'multitask'])->name('admin.download-multitask');
        Route::get('admin/download-status/{status}/{id}', [App\Http\Controllers\Admin\DownloadController::class, 'download_status']);
        Route::get('admin/downloadList', [App\Http\Controllers\Admin\DownloadController::class, 'downloadList']);

        Route::get('admin/service-sort', [App\Http\Controllers\Admin\OurServicesController::class, 'service_sort'])->name('admin.serviceSort');
        Route::post('admin/service-sortUpdate', [App\Http\Controllers\Admin\OurServicesController::class, 'service_sort_store'])->name('admin.servicesortUpdate');

        Route::get('admin/gallery', [App\Http\Controllers\Admin\GalleryController::class, 'index']);
        Route::get('admin/ajaxgalleryList', [App\Http\Controllers\Admin\GalleryController::class, 'ajaxList'])->name('admin.ajaxgalleryList');
        Route::get('admin/add-gallery', [App\Http\Controllers\Admin\GalleryController::class, 'create']);
        Route::post('admin/add-gallery-form', [App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('admin.add-gallery-form');
        Route::post('admin/update-gallery-form/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('admin.update-gallery-form');
        Route::get('admin/edit-gallery/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'edit']);
        Route::post('admin/gallery-multitask', [App\Http\Controllers\Admin\GalleryController::class, 'multitask'])->name('admin.gallery-multitask');
        Route::get('admin/gallery-status/{status}/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'gallery_status']);
        Route::get('admin/galleryList', [App\Http\Controllers\Admin\GalleryController::class, 'galleryList']);

        Route::get('admin/gallery_detail', [App\Http\Controllers\Admin\GalleryDetailController::class, 'index']);
        Route::get('admin/ajaxGalleryDetailList', [App\Http\Controllers\Admin\GalleryDetailController::class, 'ajaxList'])->name('admin.ajaxGalleryDetailList');
        Route::get('admin/add-gallery-detail', [App\Http\Controllers\Admin\GalleryDetailController::class, 'create']);
        Route::post('admin/add-gallery-detail-form', [App\Http\Controllers\Admin\GalleryDetailController::class, 'store'])->name('admin.add-gallery-detail-form');
        Route::post('admin/update-gallery-detail-form/{id}', [App\Http\Controllers\Admin\GalleryDetailController::class, 'update'])->name('admin.update-gallery-detail-form');
        Route::get('admin/edit-gallery-detail/{id}', [App\Http\Controllers\Admin\GalleryDetailController::class, 'edit']);
        Route::post('admin/gallery-detail-multitask', [App\Http\Controllers\Admin\GalleryDetailController::class, 'multitask'])->name('admin.gallery-detail-multitask');
        Route::get('admin/gallery-detail-status/{status}/{id}', [App\Http\Controllers\Admin\GalleryDetailController::class, 'gallery_status']);
        Route::get('admin/delete_gallery_image/{id}', [App\Http\Controllers\Admin\GalleryDetailController::class, 'delete_gallery_image']);

        Route::get('admin/galleryitem', [App\Http\Controllers\Admin\GalleryitemController::class, 'index']);
        Route::get('admin/ajaxgalleryitemList', [App\Http\Controllers\Admin\GalleryitemController::class, 'ajaxList'])->name('admin.ajaxgalleryitemList');
        Route::get('admin/add-galleryitem', [App\Http\Controllers\Admin\GalleryitemController::class, 'create']);
        Route::post('admin/add-galleryitem-form', [App\Http\Controllers\Admin\GalleryitemController::class, 'store'])->name('admin.add-galleryitem-form');
        Route::post('admin/update-galleryitem-form/{id}', [App\Http\Controllers\Admin\GalleryitemController::class, 'update'])->name('admin.update-galleryitem-form');
        Route::get('admin/edit-galleryitem/{id}', [App\Http\Controllers\Admin\GalleryitemController::class, 'edit']);
        Route::post('admin/galleryitem-multitask', [App\Http\Controllers\Admin\GalleryitemController::class, 'multitask'])->name('admin.galleryitem-multitask');
        Route::get('admin/galleryitem-status/{status}/{id}', [App\Http\Controllers\Admin\GalleryitemController::class, 'galleryitem_status']);
        Route::get('admin/galleryitemList', [App\Http\Controllers\Admin\GalleryitemController::class, 'galleryitemList']);

        Route::get('admin/testimonial', [App\Http\Controllers\Admin\TestimonialController::class, 'index']);
        Route::get('admin/ajaxTestimonialList', [App\Http\Controllers\Admin\TestimonialController::class, 'ajaxList'])->name('admin.ajaxtestimonialList');
        Route::get('admin/add-testimonial', [App\Http\Controllers\Admin\TestimonialController::class, 'create']);
        Route::post('admin/add-testimonial-form', [App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('admin.add-testimonial-form');
        Route::post('admin/update-testimonial-form/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('admin.update-testimonial-form');
        Route::get('admin/edit-testimonial/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'edit']);
        Route::post('admin/testimonial-multitask', [App\Http\Controllers\Admin\TestimonialController::class, 'multitask'])->name('admin.testimonial-multitask');
        Route::get('admin/testimonial-status/{status}/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'testimonial_status']);
        Route::get('admin/testimonialList', [App\Http\Controllers\Admin\TestimonialController::class, 'testimonialList']);


        Route::get('admin/faq', [App\Http\Controllers\Admin\FaqController::class, 'index']);
        Route::get('admin/ajaxfaqList', [App\Http\Controllers\Admin\FaqController::class, 'ajaxList'])->name('admin.ajaxfaqList');
        Route::get('admin/add-faq', [App\Http\Controllers\Admin\FaqController::class, 'create']);
        Route::post('admin/add-faq-form', [App\Http\Controllers\Admin\FaqController::class, 'store'])->name('admin.add-faq-form');
        Route::post('admin/update-faq-form/{id}', [App\Http\Controllers\Admin\FaqController::class, 'update'])->name('admin.update-faq-form');
        Route::get('admin/edit-faq/{id}', [App\Http\Controllers\Admin\FaqController::class, 'edit']);
        Route::post('admin/faq-multitask', [App\Http\Controllers\Admin\FaqController::class, 'multitask'])->name('admin.faq-multitask');
        Route::get('admin/faq-status/{status}/{id}', [App\Http\Controllers\Admin\FaqController::class, 'faq_status']);
        Route::get('admin/faqList', [App\Http\Controllers\Admin\FaqController::class, 'faqList']);

        Route::get('admin/faq-sort', [App\Http\Controllers\Admin\FaqController::class, 'faq_sort'])->name('admin.faqSort');
        Route::post('admin/faq-sortUpdate', [App\Http\Controllers\Admin\FaqController::class, 'faq_sort_store'])->name('admin.faqsortUpdate');


        Route::get('admin/price-manage', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'index']);
        Route::get('admin/ajaxinvestmentlegendsList', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'ajaxList'])->name('admin.ajaxinvestmentlegendsList');
        Route::get('admin/add-price', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'create']);
        Route::post('admin/add-investmentlegends-form', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'store'])->name('admin.add-investmentlegends-form');
        Route::post('admin/update-investmentlegends-form/{id}', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'update'])->name('admin.update-investmentlegends-form');
        Route::get('admin/edit-price/{id}', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'edit']);
        Route::post('admin/investmentlegends-multitask', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'multitask'])->name('admin.investmentlegends-multitask');
        Route::get('admin/investmentlegends-status/{status}/{id}', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'investmentlegends_status']);
        Route::get('admin/InvestmentLegendsList', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'InvestmentLegendsList']);

        Route::get('admin/investmentlegends-sort', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'investmentlegends_sort'])->name('admin.investmentlegendsSort');
        Route::post('admin/investmentlegends-sortUpdate', [App\Http\Controllers\Admin\InvestmentLegendsController::class, 'investmentlegends_sort_store'])->name('admin.investmentlegendssortUpdate');
        // Gallary section start

        Route::get('admin/activity', [App\Http\Controllers\Admin\ActivityController::class, 'index']);
        Route::get('admin/ajaxactivityList', [App\Http\Controllers\Admin\ActivityController::class, 'ajaxList'])->name('admin.ajaxactivityList');
        Route::get('admin/add-activity', [App\Http\Controllers\Admin\ActivityController::class, 'create']);
        Route::post('admin/add-activity-form', [App\Http\Controllers\Admin\ActivityController::class, 'store'])->name('admin.add-activity-form');
        Route::post('admin/update-activity-form/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'update'])->name('admin.update-activity-form');
        Route::get('admin/edit-activity/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'edit']);
        Route::post('admin/activity-multitask', [App\Http\Controllers\Admin\ActivityController::class, 'multitask'])->name('admin.activity-multitask');
        Route::get('admin/activity-status/{status}/{id}', [App\Http\Controllers\Admin\ActivityController::class, 'activity_status']);
        Route::get('admin/activityList', [App\Http\Controllers\Admin\ActivityController::class, 'activityList']);

        Route::get('admin/activity_detail', [App\Http\Controllers\Admin\ActivityDetailController::class, 'index']);
        Route::get('admin/ajaxActivityDetailList', [App\Http\Controllers\Admin\ActivityDetailController::class, 'ajaxList'])->name('admin.ajaxActivityDetailList');
        Route::get('admin/add-activity-detail', [App\Http\Controllers\Admin\ActivityDetailController::class, 'create']);
        Route::post('admin/add-activity-detail-form', [App\Http\Controllers\Admin\ActivityDetailController::class, 'store'])->name('admin.add-activity-detail-form');
        Route::post('admin/update-activity-detail-form/{id}', [App\Http\Controllers\Admin\ActivityDetailController::class, 'update'])->name('admin.update-activity-detail-form');
        Route::get('admin/edit-activity-detail/{id}', [App\Http\Controllers\Admin\ActivityDetailController::class, 'edit']);
        Route::post('admin/activity-detail-multitask', [App\Http\Controllers\Admin\ActivityDetailController::class, 'multitask'])->name('admin.activity-detail-multitask');
        Route::get('admin/activity-detail-status/{status}/{id}', [App\Http\Controllers\Admin\ActivityDetailController::class, 'activity_status']);
        Route::get('admin/delete_activity_image/{id}', [App\Http\Controllers\Admin\ActivityDetailController::class, 'delete_activity_image']);

        Route::get('admin/activityitem', [App\Http\Controllers\Admin\ActivityitemController::class, 'index']);
        Route::get('admin/ajaxActivityitemList', [App\Http\Controllers\Admin\ActivityitemController::class, 'ajaxList'])->name('admin.ajaxActivityitemList');
        Route::get('admin/add-activityitem', [App\Http\Controllers\Admin\ActivityitemController::class, 'create']);
        Route::post('admin/add-activityitem-form', [App\Http\Controllers\Admin\ActivityitemController::class, 'store'])->name('admin.add-activityitem-form');
        Route::post('admin/update-activityitem-form/{id}', [App\Http\Controllers\Admin\ActivityitemController::class, 'update'])->name('admin.update-activityitem-form');
        Route::get('admin/edit-activityitem/{id}', [App\Http\Controllers\Admin\ActivityitemController::class, 'edit']);
        Route::post('admin/activityitem-multitask', [App\Http\Controllers\Admin\ActivityitemController::class, 'multitask'])->name('admin.activityitem-multitask');
        Route::get('admin/activityitem-status/{status}/{id}', [App\Http\Controllers\Admin\ActivityitemController::class, 'activityitem_status']);
        Route::get('admin/activityitemList', [App\Http\Controllers\Admin\ActivityitemController::class, 'activityitemList']);
        
        //Join Our Team
        Route::get('admin/join_our_team', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'edit']);
        Route::get('admin/ajaxJoinOurTeamList', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'ajaxList'])->name('admin.ajaxJoinOurTeamList');
        Route::get('admin/add-join-our-team', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'create']);
        Route::post('admin/add-join-our-team-form', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'store'])->name('admin.add-join-our-team-form');
        Route::post('admin/update-join-our-team-form/{id}', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'update'])->name('admin.update-join-our-team-form');
        Route::get('admin/edit-join-our-team/{id}', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'edit']);
        Route::post('admin/join-our-team-multitask', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'multitask'])->name('admin.join-our-team-multitask');
        Route::get('admin/join-our-team-status/{status}/{id}', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'join_our_team_status']);
        Route::get('admin/join_our_teamList', [App\Http\Controllers\Admin\JoinOurTeamController::class, 'join_our_teamList']);

        //Contact Us
        Route::get('admin/contact_us', [App\Http\Controllers\Admin\ContactUsController::class, 'edit']);
        Route::get('admin/ajaxcontact_usList', [App\Http\Controllers\Admin\ContactUsController::class, 'ajaxList'])->name('admin.ajaxcontact_usList');
        Route::get('admin/add-contact-us', [App\Http\Controllers\Admin\ContactUsController::class, 'create']);
        Route::post('admin/add-contact-us-form', [App\Http\Controllers\Admin\ContactUsController::class, 'store'])->name('admin.add-contact-us-form');
        Route::post('admin/update-contact-us-form/{id}', [App\Http\Controllers\Admin\ContactUsController::class, 'update'])->name('admin.update-contact-us-form');
        Route::get('admin/edit-contact-us/{id}', [App\Http\Controllers\Admin\ContactUsController::class, 'edit']);
        Route::post('admin/contact-us-multitask', [App\Http\Controllers\Admin\ContactUsController::class, 'multitask'])->name('admin.contact-us-multitask');
        Route::get('admin/contact-us-status/{status}/{id}', [App\Http\Controllers\Admin\ContactUsController::class, 'contact_us_status']);
        Route::get('admin/contact_usList', [App\Http\Controllers\Admin\ContactUsController::class, 'contact_usList']);

        // Partner With Us
        Route::get('admin/partner_with_us', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'edit']);
        Route::get('admin/ajaxPartnerWithUsList', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'ajaxList'])->name('admin.ajaxPartnerWithUsList');
        Route::get('admin/add-partner-with-us', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'create']);
        Route::post('admin/add-partner-with-us-form', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'store'])->name('admin.add-partner-with-us-form');
        Route::post('admin/update-partner-with-us-form/{id}', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'update'])->name('admin.update-partner-with-us-form');
        Route::get('admin/edit-partner-with-us/{id}', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'edit']);
        Route::post('admin/partner-with-us-multitask', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'multitask'])->name('admin.partner-with-us-multitask');
        Route::get('admin/partner-with-us-status/{status}/{id}', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'partner_with_us_status']);
        Route::get('admin/partner_with_usList', [App\Http\Controllers\Admin\PartnerWithUsController::class, 'partner_with_usList']);

        // Career
        Route::get('admin/career', [App\Http\Controllers\Admin\CareerController::class, 'edit']);
        Route::get('admin/ajaxCareerList', [App\Http\Controllers\Admin\CareerController::class, 'ajaxList'])->name('admin.ajaxCareerList');
        Route::get('admin/add-career', [App\Http\Controllers\Admin\CareerController::class, 'create']);
        Route::post('admin/add-career-form', [App\Http\Controllers\Admin\CareerController::class, 'store'])->name('admin.add-career-form');
        Route::post('admin/update-career-form/{id}', [App\Http\Controllers\Admin\CareerController::class, 'update'])->name('admin.update-career-form');
        Route::get('admin/edit-career/{id}', [App\Http\Controllers\Admin\CareerController::class, 'edit']);
        Route::post('admin/career-multitask', [App\Http\Controllers\Admin\CareerController::class, 'multitask'])->name('admin.career-multitask');
        Route::get('admin/career-status/{status}/{id}', [App\Http\Controllers\Admin\CareerController::class, 'career_status']);
        Route::get('admin/careerList', [App\Http\Controllers\Admin\CareerController::class, 'careerList']);

        //term and condition with privacy policy
        Route::post('admin/update-term-and-condition-form', [App\Http\Controllers\Admin\TermController::class, 'term_and_condition_update'])->name('admin.update-term-and-condition-form');
        Route::get('admin/edit-term-and-condition', [App\Http\Controllers\Admin\TermController::class, 'term_and_condition_edit']);
        Route::post('admin/update-privacy-policy-form', [App\Http\Controllers\Admin\PrivacyController::class, 'privacy_policy_update'])->name('admin.update-privacy-policy-form');
        Route::get('admin/edit-privacy-policy', [App\Http\Controllers\Admin\PrivacyController::class, 'privacy_policy_edit']);
        //Close

        Route::post('admin/update_news_banner', [App\Http\Controllers\Admin\HomeBannerController::class, 'News_banner_update']);
        Route::post('admin/update_blogs_banner', [App\Http\Controllers\Admin\HomeBannerController::class, 'Blogs_banner_update']);

        


        //New Master
        
        //Key Features
        Route::get('admin/keyfeatures', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'index']);
        Route::get('admin/ajaxkeyfeaturesList', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'ajaxList'])->name('admin.ajaxkeyfeaturesList');
        Route::get('admin/add-keyfeatures', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'create']);
        Route::post('admin/add-keyfeatures-form', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'store'])->name('admin.add-keyfeatures-form');
        Route::post('admin/update-keyfeatures-form/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'update'])->name('admin.update-keyfeatures-form');
        Route::get('admin/edit-keyfeatures/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'edit']);
        Route::post('admin/keyfeatures-multitask', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'multitask'])->name('admin.keyfeatures-multitask');
        Route::get('admin/keyfeatures-status/{status}/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'keyfeatures_status']);
        Route::get('admin/keyfeaturesList', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'keyfeaturesList']);

        Route::get('admin/keyfeatures-status-home/{status}/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'keyfeatures_status_home']);
        Route::get('admin/keyfeatures-status-about/{status}/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'keyfeatures_status_about']);
        Route::get('admin/keyfeatures-status-product/{status}/{id}', [App\Http\Controllers\Admin\KeyFeaturesController::class, 'keyfeatures_status_product']);

        //SustainaBilitys
        Route::get('admin/sustainabilitys', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'index']);
        Route::get('admin/ajaxsustainabilitysList', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'ajaxList'])->name('admin.ajaxsustainabilitysList');
        Route::get('admin/add-sustainabilitys', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'create']);
        Route::post('admin/add-sustainabilitys-form', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'store'])->name('admin.add-sustainabilitys-form');
        Route::post('admin/update-sustainabilitys-form/{id}', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'update'])->name('admin.update-sustainabilitys-form');
        Route::get('admin/edit-sustainabilitys/{id}', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'edit']);
        Route::post('admin/sustainabilitys-multitask', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'multitask'])->name('admin.sustainabilitys-multitask');
        Route::get('admin/sustainabilitys-status/{status}/{id}', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'sustainabilitys_status']);
        Route::get('admin/sustainabilitysList', [App\Http\Controllers\Admin\SustainaBilitysController::class, 'sustainabilitysList']);
        
        //ResearchDevelopments
        Route::get('admin/researchdevelopments', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'index']);
        Route::get('admin/ajaxresearchdevelopmentsList', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'ajaxList'])->name('admin.ajaxresearchdevelopmentsList');
        Route::get('admin/add-researchdevelopments', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'create']);
        Route::post('admin/add-researchdevelopments-form', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'store'])->name('admin.add-researchdevelopments-form');
        Route::post('admin/update-researchdevelopments-form/{id}', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'update'])->name('admin.update-researchdevelopments-form');
        Route::get('admin/edit-researchdevelopments/{id}', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'edit']);
        Route::post('admin/researchdevelopments-multitask', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'multitask'])->name('admin.researchdevelopments-multitask');
        Route::get('admin/researchdevelopments-status/{status}/{id}', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'researchdevelopments_status']);
        Route::get('admin/researchdevelopmentsList', [App\Http\Controllers\Admin\ResearchDevelopmentsController::class, 'researchdevelopmentsList']);
        
        //Certifications
        Route::get('admin/certifications', [App\Http\Controllers\Admin\CertificationsController::class, 'index']);
        Route::get('admin/ajaxcertificationsList', [App\Http\Controllers\Admin\CertificationsController::class, 'ajaxList'])->name('admin.ajaxcertificationsList');
        Route::get('admin/add-certifications', [App\Http\Controllers\Admin\CertificationsController::class, 'create']);
        Route::post('admin/add-certifications-form', [App\Http\Controllers\Admin\CertificationsController::class, 'store'])->name('admin.add-certifications-form');
        Route::post('admin/update-certifications-form/{id}', [App\Http\Controllers\Admin\CertificationsController::class, 'update'])->name('admin.update-certifications-form');
        Route::get('admin/edit-certifications/{id}', [App\Http\Controllers\Admin\CertificationsController::class, 'edit']);
        Route::post('admin/certifications-multitask', [App\Http\Controllers\Admin\CertificationsController::class, 'multitask'])->name('admin.certifications-multitask');
        Route::get('admin/certifications-status/{status}/{id}', [App\Http\Controllers\Admin\CertificationsController::class, 'certifications_status']);
        Route::get('admin/certificationsList', [App\Http\Controllers\Admin\CertificationsController::class, 'certificationsList']);
        
        //Our Products
        Route::get('admin/ourproducts', [App\Http\Controllers\Admin\OurproductsController::class, 'index']);
        Route::get('admin/ajaxourproductsList', [App\Http\Controllers\Admin\OurproductsController::class, 'ajaxList'])->name('admin.ajaxourproductsList');
        Route::get('admin/add-ourproducts', [App\Http\Controllers\Admin\OurproductsController::class, 'create']);
        Route::post('admin/add-ourproducts-form', [App\Http\Controllers\Admin\OurproductsController::class, 'store'])->name('admin.add-ourproducts-form');
        Route::post('admin/update-ourproducts-form/{id}', [App\Http\Controllers\Admin\OurproductsController::class, 'update'])->name('admin.update-ourproducts-form');
        Route::get('admin/edit-ourproducts/{id}', [App\Http\Controllers\Admin\OurproductsController::class, 'edit']);
        Route::post('admin/ourproducts-multitask', [App\Http\Controllers\Admin\OurproductsController::class, 'multitask'])->name('admin.ourproducts-multitask');
        Route::get('admin/ourproducts-status/{status}/{id}', [App\Http\Controllers\Admin\OurproductsController::class, 'ourproducts_status']);
        Route::get('admin/ourproductsList', [App\Http\Controllers\Admin\OurproductsController::class, 'ourproductsList']);
        
        //CLose


     

    });
//});
//check the post request executions
// Route::get('/php-info-check', function () {
//     return [
//         'post_max_size' => ini_get('post_max_size'),
//         'upload_max_filesize' => ini_get('upload_max_filesize'),
//         'memory_limit' => ini_get('memory_limit'),
//         'max_execution_time' => ini_get('max_execution_time'),
//         'max_input_time' => ini_get('max_input_time'),
//     ];
// });

Route::get('/admin-password', [App\Http\Controllers\Admin\AdminController::class, 'forgetPassword']);
Route::post('/admin-password-form', [App\Http\Controllers\Admin\AdminController::class, 'adminPasswordForm'])->name('admin.forgetPasswordForm');
//FRONT

//SiteMap Generate 13082026
Route::get('/sitemap-generate', [App\Http\Controllers\SitemapController::class, 'index']);
//Close

Route::post('/resume/submit', [App\Http\Controllers\HomeController::class, 'store_resume'])->name('resume.submit');
Route::post('/partner/submit', [App\Http\Controllers\HomeController::class, 'store_partner'])->name('partner.submit');
Route::post('/contact/submit', [App\Http\Controllers\HomeController::class, 'store_contact'])->name('contact.submit');


Route::get('/get-states/{country_id}', [App\Http\Controllers\HomeController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [App\Http\Controllers\HomeController::class, 'getCities']);

Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy']);
Route::get('/terms-condition', [App\Http\Controllers\HomeController::class, 'terms_condition']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/page/{any}', [App\Http\Controllers\HomeController::class, 'page']);
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact_us']);
Route::get('/career', [App\Http\Controllers\HomeController::class, 'why_gls']);
Route::get('/join-our-team', [App\Http\Controllers\HomeController::class, 'join_our_team']);
Route::get('/partner-with-us', [App\Http\Controllers\HomeController::class, 'partner_with_us']);
Route::get('/whatmatters', [App\Http\Controllers\WhatmattersController::class, 'index']);
Route::get('/solutions/{any}', [App\Http\Controllers\SolutionsController::class, 'index']);
Route::get('/solutions/{any1}/{any}', [App\Http\Controllers\SolutionsController::class, 'index']);
Route::get('/redressal_of_grievances', [App\Http\Controllers\HomeController::class, 'redressal_of_grievances']);
Route::get('/feedback', [App\Http\Controllers\HomeController::class, 'feedback']);
// Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);
Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');
Route::post('/contactsubmit', [App\Http\Controllers\HomeController::class, 'contactForm'])->name('contactsubmit');
Route::post('/feedbacksubmit', [App\Http\Controllers\HomeController::class, 'feedbackForm'])->name('feedbacksubmit');
Route::post('/redressal_of_grievancessubmit', [App\Http\Controllers\HomeController::class, 'redressal_of_grievancesForm'])->name('redressal_of_grievancessubmit');
Route::get('/search-result', [App\Http\Controllers\HomeController::class, 'search']);
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index']);
Route::get('/activity', [App\Http\Controllers\ActivityController::class, 'index']);
Route::get('/galleryvedio', [App\Http\Controllers\GalleryController::class, 'galleryvedio']);
Route::get('/galleryitems/{any}', [App\Http\Controllers\GalleryController::class, 'galleryitems']);
Route::get('/activityitems/{any}', [App\Http\Controllers\ActivityController::class, 'activityitems']);
Route::get('/get-in-touch', [App\Http\Controllers\HomeController::class, 'contactUs']);
Route::post('/contact-us', [App\Http\Controllers\HomeController::class, 'contactUsForm'])->name('contact-us');
Route::get('/staff', [App\Http\Controllers\TeachingFacultyController::class, 'index'])->name('teaching-faculty');
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/news/filterdata', [App\Http\Controllers\NewsController::class, 'filterdata'])->name('news.filterdata');

Route::get('/blogs', [App\Http\Controllers\BlogsController::class, 'index'])->name('blogs');
Route::get('/bsp', [App\Http\Controllers\BspController::class, 'index'])->name('bsp');
Route::get('/bsp/{any}', [App\Http\Controllers\BspController::class, 'bspDetail'])->name('bspDetail');
Route::get('/bsp_page/{any}', [App\Http\Controllers\BspController::class, 'bsp_page'])->name('bsp_page');
Route::get('/testimonial', [App\Http\Controllers\HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/news/{any}', [App\Http\Controllers\NewsController::class, 'newsDetail']);
Route::get('/blogs/{any}', [App\Http\Controllers\BlogsController::class, 'blogDetail']);
Route::get('/staff/{any}', [App\Http\Controllers\TeachingFacultyController::class, 'facultyMember']);

Route::post('/contact-post-form', [App\Http\Controllers\HomeController::class, 'contact_post_form']);

//new routes
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about_us']);
Route::get('/our-products', [App\Http\Controllers\HomeController::class, 'our_products']);
Route::get('/research-development', [App\Http\Controllers\HomeController::class, 'research_development']);
Route::get('/certifications', [App\Http\Controllers\HomeController::class, 'certifications']);
Route::get('/sustainability', [App\Http\Controllers\HomeController::class, 'sustainability']);
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);

//close
Route::get('/staff/{slug_cat}/{slug}', [App\Http\Controllers\TeachingFacultyController::class, 'facultyMemberDetail']);
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'page']);
Route::get('/{any1}/{any}', [App\Http\Controllers\HomeController::class, 'page']);

