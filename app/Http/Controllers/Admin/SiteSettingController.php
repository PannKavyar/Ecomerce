<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            //update data
            Setting::updated([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_decription,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2'  => $request->phone2,
                'email1'  => $request->email1,
                'email2'  => $request->email2,
                'facebook'  => $request->facebook,
                'twitter'  => $request->twitter,
                'instagram'  => $request->instagram,
                'youtube'  => $request->youtube
            ]);

            return redirect()->back()->with('message', 'Updated Setting Saved');
        } else {
            //create data
            // dd($request->all());
            Setting::create([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'page_title' => $request->page_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_decription,
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2'  => $request->phone2,
                'email1'  => $request->email1,
                'email2'  => $request->email2,
                'facebook'  => $request->facebook,
                'twitter'  => $request->twitter,
                'instagram'  => $request->instagram,
                'youtube'  => $request->youtube
            ]);
            // dd($website);
            return redirect()->back()->with('message', 'Setting Created');
        }
    }
}
