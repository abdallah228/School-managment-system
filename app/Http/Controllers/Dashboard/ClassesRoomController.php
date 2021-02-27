<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassesRoom;
use App\Models\Grade;
use App\http\requests\Dashboard\ClassRoomRequest;

class ClassesRoomController extends Controller
{
    public function index()
    {
        //
        
        $classes_rooms = ClassesRoom::all();
        $grades = Grade::all();
        return view('dashboard.classesrooms.index',compact('classes_rooms','grades'));
    }

    public function create()
    {
        //
    }

   
    public function store(ClassRoomRequest $request)
    {
        //
      //  return $request;
       
        //return $request->List_Classes;        
    try{
            $validated = $request->validated();
            $list_class = $request->List_Classes;
            foreach($list_class as $list_class){
            $classrooms = new ClassesRoom;
            $classrooms->name = ['ar'=>$list_class['name_ar'],'en'=>$list_class['name_en']];
            $classrooms->grade_id = $list_class['grade_id'];
            $classrooms->save();
    }//end foreach
        toastr()->success(__('dashboard/classroom.class_room_success'));
        return redirect()->route('classes-rooms.index');
    }//end try
catch(\Exception $e)
    {
        return redirect()->back()->with(['error'=>$e->getMessage()]);
    }//end catch
    

    }

  
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    
    public function update(ClassRoomRequest $request,$id)
    {
        //
        //return $request->id;
        //return $id;
     
        try{
            $validated = $request->validated();
            $classes_rooms = ClassesRoom::findOrFail($request->id);
            $classes_rooms->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'grade_id' => $request->grade_id,
        
            ]);
            toastr()->success(__('dashboard/classroom.class_room_success_update'));
            return redirect()->route('classesrooms.index');
            }
            catch(\Exception $e)
            {
                return redirect()->back()->with(['error'=>$e->getMessage()]);
    
            }//end try and catch
    }

    
    public function destroy(Request $request)
    {
        //
        try{
            $classes_room = ClassesRoom::findOrFail($request->id);
            $classes_room->delete();
            toastr()->error(__('dashboard/classroom.class_room_success_delete'));
            return redirect()->route('classes-rooms.index');
           }
           catch(\Exception $e)
           {
               return redirect()->back()->with(['error'=>$e->getMessage()]);
           }
        }//end destroy function

        public function delete_all(Request $request)
        {
            // return $request->all();
            $myclsses = explode(",",$request->delete_all_id);
           // dd($myclsses);
            ClassesRoom::whereIn('id',$myclsses)->delete();
            toastr()->error(__('dashboard/classroom.class_room_success_delete'));
            return redirect()->route('classes-rooms.index');
            
        }//end delete all

        public function filter_classes(Request $request)
        {
            //return $request;
            $grades = Grade::all();
            $search = ClassesRoom::where('grade_id',$request->grade_id)->get();
            return view('dashboard.classesrooms.index',compact('grades','search'));

        }//end search by grades

    }

