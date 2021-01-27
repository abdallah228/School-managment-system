<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\http\requests\Dashboard\GradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grades = Grade::all();
        return view('dashboard.grades.index',compact('grades'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        //validation done
        
       // dd($request->all());
       try{
        $grade = new Grade();
        $grade->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $grade->notes = $request->notes;
        $grade->save();
        toastr()->success(__('dashboard/grade.grade_success'));
        return redirect()->route('grades.index');
       }
       catch(\Exception $e)
       {
           return redirect()->back()->with(['error'=>$e->getMessage()]);
       }
        
    

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
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GradeRequest $request, $id)
    {
        //
        try{
        $grade = Grade::findOrFail($id);
        $grade->update([
        'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
        'notes' => $request->notes,
    
        ]);
        toastr()->success(__('dashboard/grade.grade_success_update'));
        return redirect()->route('grades.index');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error'=>$e->getMessage()]);

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
        //
       // $ide = Request()->id;
       try{
        $grade = Grade::findOrFail($id);
        $grade->delete();
        toastr()->error(__('dashboard/grade.grade_success_delete'));
        return redirect()->route('grades.index');
       }
       catch(\Exception $e)
       {
           return redirect()->back()->with(['error'=>$e->getMessage()]);
       }
    }
}
