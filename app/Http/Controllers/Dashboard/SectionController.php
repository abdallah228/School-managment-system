<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Grade;
use App\Models\ClassesRoom;

class SectionController extends Controller
{
    //
    public function index()
    {
        
        $grades =  Grade::with('sections')->get();
        $list_grades = Grade::all();
        return view('dashboard.sections.index',compact('grades','list_grades'));

    }//end index

   
    public function store(Request $request)
    {   
        
        $request->validate([
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'grade_id' => 'required',
            'class_id'=>'required',
        ],[
            'name_ar.required'=>__('dashboard/sections.name_ar_required'),
            'name_en.required'=>__('dashboard/sections.name_en_required'),
            'grade_id.required'=>__('dashboard/sections.grade_id_required'),
            'class_id.required'=>__('dashboard/sections.classes_id_required'),
        ]);//end validation
       // return $request->all();
       try{
       $sections = Section::create([
        'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
        'grade_id'=>$request->grade_id,
        'classes_id'=>$request->class_id,
        'status'=>1,
       ]);
      // return $sections;
       toastr()->success(__('dashboard/sections.save'));
       return redirect()->back();
        }//end try
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }//end store
    public function update(Request $request ,$id)
    {
        try{
        if(!$request->has('status'))            
            $request->request->add(['status'=>false]);

            else
            $request->request->add(['status'=>true]);

        $sections = Section::findOrFail($id);
       // return $sections;
       $sections->update([
        'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
        'grade_id'=>$request->grade_id,
        'classes_id'=>$request->class_id,
        'status'=>$request->status,
       ]);
       toastr()->info(__('dashboard/sections.update_section'));
       return redirect()->back();
        }//end try
        catch(\Exception $e)
        {    
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }//end catch

    }//end function
    public function destroy($id)
    {
        try{
        $sections = Section::findOrFail($id);
        $sections->delete();
        toastr()->error(__('dashboard/sections.delete_section'));
        return redirect()->back();
        }//end try
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function get_classes($id)
    {
        $list_classes = ClassesRoom::where('grade_id',$id)->pluck('name','id');
        return $list_classes;
    }//end get classes

}
