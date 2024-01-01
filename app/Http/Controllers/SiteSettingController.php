<?php

namespace App\Http\Controllers;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings= SiteSetting::first();
        return view('admin.site-setting.index', compact('settings'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'site_title' => 'required',
            'site_description' => 'required',
           ]);

           $name = $request->file('logo')->getClientOriginalName();
           $path = $request->file('logo')->storeAs(
            'public/images/',$name);

        $setting = new SiteSetting;
        $setting->logo= $name;
        $setting->site_title=$request->input('site_title');
        $setting->site_description=$request->input('site_description'); 
        $setting->save();
        return redirect('/admin/site-setting')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting= SiteSetting::find($id);
        return view('/admin/site-setting.edit')->with('setting',  $setting); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting= SiteSetting::find($id);
        $validatedData = $request->validate([
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',     
           ]);
           if ($request->hasFile('logo')) {
           $name = $request->file('logo')->getClientOriginalName();
           $path = $request->file('logo')->storeAs(
            'public/images/',$name);
            $setting->logo= $name;
           }
      
        $setting->site_title=$request->input('site_title');
        $setting->site_description=$request->input('site_description'); 
        $setting->save();
        return redirect('/admin/site-setting')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting= SiteSetting::find($id);
        $setting->delete();
        return redirect('/admin/site-setting')->with('success', 'Deleted successfully');
    }
}
