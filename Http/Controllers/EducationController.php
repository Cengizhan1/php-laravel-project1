<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supervisor\EducationRequest;
use App\Http\Resources\Supervisor\EducationResource;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function ()  {
            return EducationResource::collection(
                Education::where('supervisor_id', auth()->user()->supervisor_id)->orderBy('start_at','DESC')->get());
        });
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $education = Education::create([
                'supervisor_id'=>auth()->user()->supervisor_id,
                'start_at'=>$request->start_at,
                'end_at'=>$request->end_at,
                'school_name'=>$request->school_name,
                'department'=>$request->department,
            ]);
            return response()->success(0, null, $education->id, 201);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        return $this->withErrorHandling(function () use ($education) {
            $education->delete();
            return response()->success(0, null, $education->id, 201);
        });
    }
}
