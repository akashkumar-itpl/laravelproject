<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GeneralSettings;
use App\Models\Admin\Media;
use Illuminate\Http\Request;
use Validator;
use Exception;
use DateTimeZone;



class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GeneralSettings::all();



        $result['pageTitle'] = 'Admin Panel Setting';

        $frontData = array();
        foreach ($data as $key => $value) {
            $frontData[$value->field_name] = $value->field_value;
        }

        $result['timeZones'] = DateTimeZone::listIdentifiers();

        $result['allData']      = $frontData;
        $result['updated_at']   = date("F j, Y, h:i a", strtotime(GeneralSettings::max('updated_at')));

        return view('admin/generalSettings/view', $result);
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:1024',
            'favicon' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:512',
        ]);



        if ($request->hasfile('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . rand(1, 100) . '.' . $logo->extension();
            $logo->move(public_path('/storage/media/admin'), $logo_name);

            $data = [
                'field_name' => 'logo',
                'field_value' => $logo_name,
            ];
            try {


                $coloumnData = GeneralSettings::where('field_name', 'logo')->get();
                if (!$coloumnData->isEmpty()) {
                    GeneralSettings::where('field_name', 'logo')->update($data);
                } else {
                    GeneralSettings::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/generalsettings')->with('error', 'Something Went Wrong');
            }
        } else if ($request->post('logoGallery') != '') {
            $data = [
                'field_name' => 'logo',
                'field_value' => $request->post('logoGallery'),
            ];
            $coloumnData = GeneralSettings::where('field_name', 'logo')->get();
            if (!$coloumnData->isEmpty()) {
                GeneralSettings::where('field_name', 'logo')->update($data);
            } else {
                GeneralSettings::insert($data);
            }
        }

        if ($request->hasfile('favicon')) {
            $favicon = $request->file('favicon');
            $favicon_name = time() . rand(1, 100) . '.' . $favicon->extension();
            $favicon->move(public_path('/storage/media/admin'), $favicon_name);

            $data = [
                'field_name' => 'favicon',
                'field_value' => $favicon_name,

            ];
            try {
                $coloumnData = GeneralSettings::where('field_name', 'favicon')->get();
                if (!$coloumnData->isEmpty()) {
                    GeneralSettings::where('field_name', 'favicon')->update($data);
                } else {
                    GeneralSettings::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/generalsettings')->with('error', 'Something Went Wrong');
            }
        } else if ($request->post('faviconGallery') != '') {
            $data = [
                'field_name' => 'favicon',
                'field_value' => $request->post('faviconGallery'),

            ];
            $coloumnData = GeneralSettings::where('field_name', 'favicon')->get();
            if (!$coloumnData->isEmpty()) {
                GeneralSettings::where('field_name', 'favicon')->update($data);
            } else {
                GeneralSettings::insert($data);
            }
        }

        if ($request->hasfile('loader')) {
            $loader = $request->file('loader');
            $loader_name = time() . rand(1, 100) . '.' . $loader->extension();
            $loader->move(public_path('/storage/media/admin'), $loader_name);

            $data = [
                'field_name' => 'loader',
                'field_value' => $loader_name,

            ];
            try {
                $coloumnData = GeneralSettings::where('field_name', 'loader')->get();
                if (!$coloumnData->isEmpty()) {
                    GeneralSettings::where('field_name', 'loader')->update($data);
                } else {
                    GeneralSettings::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/generalsettings')->with('error', 'Something Went Wrong');
            }
        } else if ($request->post('loaderGallery') != '') {
            $data = [
                'field_name' => 'loader',
                'field_value' => $request->post('loaderGallery'),

            ];
            $coloumnData = GeneralSettings::where('field_name', 'loader')->get();
            if (!$coloumnData->isEmpty()) {
                GeneralSettings::where('field_name', 'loader')->update($data);
            } else {
                GeneralSettings::insert($data);
            }
        }

        if ($request->hasfile('placeholderImage')) {
            $placeholderImage = $request->file('placeholderImage');
            $placeholderImage_name = time() . rand(1, 100) . '.' . $placeholderImage->extension();
            $placeholderImage->move(public_path('/storage/media/admin'), $placeholderImage_name);

            $data = [
                'field_name' => 'placeholderImage',
                'field_value' => $placeholderImage_name,

            ];

            try {
                $coloumnData = GeneralSettings::where('field_name', 'placeholderImage')->get();
                if (!$coloumnData->isEmpty()) {

                    GeneralSettings::where('field_name', 'placeholderImage')->update($data);
                } else {
                    GeneralSettings::insert($data);
                }
            } catch (Exception $e) {
                return redirect('admin/generalsettings')->with('error', 'Something Went Wrong');
            }
        } else if ($request->post('placeholderImageGallery') != '') {
            $data = [
                'field_name' => 'placeholderImage',
                'field_value' => $request->post('placeholderImageGallery'),

            ];
            $coloumnData = GeneralSettings::where('field_name', 'placeholderImage')->get();
            if (!$coloumnData->isEmpty()) {
                GeneralSettings::where('field_name', 'placeholderImage')->update($data);
            } else {
                GeneralSettings::insert($data);
            }
        }

        foreach ($request->all() as $fieldName => $value) {
            $data = array();
            if ($value == '' || in_array($fieldName, array('logo', 'logoGallery', 'favicon', 'faviconGallery', 'loader', 'loaderGallery', 'placeholderImage', 'placeholderImageGallery'))) continue;

            $data = [
                'field_name' => $fieldName,
                'field_value' => trim($value),
            ];
            $coloumnData = GeneralSettings::where('field_name', $fieldName)->get();
            if (!$coloumnData->isEmpty()) {
                GeneralSettings::where('field_name', $fieldName)->update($data);
            } else {
                GeneralSettings::insert($data);
            }
        }

        return redirect('admin/generalsettings')->with('success', 'Updated Successfully');
    }
}