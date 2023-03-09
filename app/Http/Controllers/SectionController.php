<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=Section::all();
        return view('sections.index')->with('sections',$sections);
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
        //
            $data=$request->validate([
                'name'=>'required|unique:sections,name|max:255',
                'desc'=>'required',
            ]);
      
            Section::create([
                'name'=>$data['name'],
                'description'=>$data['desc'],
                'created_by'=>(Auth::user()->name),
            ]);
            return redirect()->back()->with('success','Section created successfully');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //check if the section name is unique
           
        $id=$request->id;
             $this -> validate($request,[
                'name'=>'required|unique:sections,name,'.$id,
                'desc'=>'required',
            ],
            [
                'name.required'=>'Section name is required',
                'name.unique'=>'Section name already exists',
                'desc.required'=>'Section description is required',
            ]
        );
            Section::where('id',$request->id)->update([
                'name'=>$request->name,
                'description'=>$request->desc,
            ]);
            
            return redirect()->back()->with('success','Section updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $section)
    {
        
        $find=Section::findOrFail($section->id);

        if($find) 
        {
            $find->delete();
            return redirect()->back()->with('success','Section deleted successfully');
        } 
        else 
            return redirect()->back()->with('error','Section not found');
      
        
    }
}
