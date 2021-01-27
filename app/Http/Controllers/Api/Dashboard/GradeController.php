<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Http\Resources\Api\Dashboard\Grades\GradeResource;
use App\Http\Requests\Dashboard\GradeRequest;
use App\Http\Requests\Api\Dashboard\GradeRequest_api;

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
        $grades_api = Grade::paginate(2);
        return response()->json(['data'=>GradeResource::collection($grades_api),'status_code'=>200],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest_api $request)
    {
        //validation

        try{
            $grade = new Grade();
            $grade->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $grade->notes = $request->notes;
            $grade->save();
            return response()->json(['data'=>new GradeResource($grade),'message'=>'grade added succesfuly','status_code'=>201],201);
        }
        catch(\Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()]);
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
        $grade = Grade::findOrFail($id);
        return response()->json(['data'=>new GradeResource($grade)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GradeRequest_api $request, $id)
    {
        //
        $grade =Grade::find($id);
        $grade->update(

           [ 'name'=> ['ar' => $request->name_ar, 'en' => $request->name_en]]

        );
        return response()->json(['data'=>new GradeResource($grade),'msg'=>'grades updated succesfuly','status_code'=>200],200);
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
        $grade =Grade::find($id);
        $grade->delete();
        return response()->json(null,204);

    }
}
