<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str; 
use Illuminate\Validation\Rule;

class Pagecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages= Page::all();
        return view('admin.pages.index')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::all();
        return view('admin/pages.create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'video' => 'mimetypes:video/mp4',
            'display_order' => 'required',
            'content_level' => 'required',
           ]);

           if ($request->hasFile('video')) 
           {
             $namevid = $request->file('video')->getClientOriginalName();
              $path = $request->file('video')->storeAs(
               'public/videos/',$namevid);
               $page->video= $namevid; 
            }

        if ($request->hasFile('image')) 
        {
          $name = $request->file('image')->getClientOriginalName();
           $path = $request->file('image')->storeAs(
            'public/images/',$name);
            $page->image= $name;
        }
       
      
       $page->title_en=$request->input('title_en');
       $page->title_ar=$request->input('title_ar');
       $page->url=$request->input('url');
       $page->btn_text_en=$request->input('btn_text_en');
       $page->btn_text_ar=$request->input('btn_text_ar');
       $page->slug=$request['slug'] = Str::slug($request->title_en);
       $page->parent_page=$request->input('parent_page');
       $page->parent_section=$request->input('parent_section');
       $page->display_order=$request->input('display_order');
       $page->content_level=$request->input('content_level');
       $page->description_en=$request->input('description_en');
       $page->description_ar=$request->input('description_ar');
       $page->additional_en=$request->input('additional_en');
       $page->additional_ar=$request->input('additional_ar');
       $page->save();
        return redirect()->back()->with('success', 'Page Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        $subpages = Page::where('parent_page', $id)->where('content_level', 1)->orderBy('display_order', 'ASC')->get();
        return view('/admin/pages.show',compact('page','subpages'));
    }
    public function pagesections($id)
    {
        $page = Page::find($id);
        $subpages = Page::where('parent_section', $id)->orderBy('display_order', 'ASC')->get();
        return view('/admin/pages.sections',compact('page','subpages'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allpages = Page::all();
        $page = Page::find($id);
        return view('/admin/pages.edit',compact('page', 'allpages'));
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
        $page = Page::find($id);
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'file' => 'mimetypes:video/mp4,application/pdf', // Accept video and PDF files
            'display_order' => 'required',
        ]);
        

           if ($request->hasFile('video')) 
           {
             $namevid = $request->file('video')->getClientOriginalName();
              $path = $request->file('video')->storeAs(
               'public/videos/',$namevid);
               $page->video= $namevid; 
            }

        if ($request->hasFile('image')) 
        {
          $name = $request->file('image')->getClientOriginalName();
           $path = $request->file('image')->storeAs(
            'public/images/',$name);
            $page->image= $name;
        }
           
       
        $page->title_en=$request->input('title_en');
        $page->title_ar=$request->input('title_ar');
        $page->url=$request->input('url');
        $page->slug=$request['slug'] = Str::slug($request->title_en);
        $page->parent_page=$request->input('parent_page');
        $page->parent_section=$request->input('parent_section');
        $page->display_order=$request->input('display_order');
        $page->content_level=$request->input('content_level');
        $page->description_en=$request->input('description_en');
        $page->description_ar=$request->input('description_ar');
        $page->additional_en=$request->input('additional_en');
        $page->additional_ar=$request->input('additional_ar');
        $page->btn_text_en=$request->input('btn_text_en');
        $page->btn_text_ar=$request->input('btn_text_ar');
       $page->save();
       

       if($request->parent_page && $request->parent_section )
       {
        return redirect('/admin/pages/sections/'.$request->parent_section)->with('success', 'Page Updated successfully');
      }

    else
    {
        return redirect()->back()->with('success', 'Page Updated successfully');
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect()->back()->with('success', 'Page Deleted successfully');

    }
}
