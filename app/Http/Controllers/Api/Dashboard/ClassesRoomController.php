<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\ClassesRoom;
use App\Http\Resources\Api\Dashboard\ClassRoom\ClassRoom;


class ClassesRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $class_room = ClassesRoom::paginate(3);
        return response()->json(['data'=>ClassRoom::collection($class_room),'status_code'=>200],200);
    }

   
     
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
