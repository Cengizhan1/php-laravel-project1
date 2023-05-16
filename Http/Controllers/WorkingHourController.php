<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supervisor\WorkingHourRequest;
use App\Http\Requests\Supervisor\WorkingHourUpdateRequest;
use App\Http\Resources\Supervisor\WorkingHourResource;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            return WorkingHourResource::collection(WorkingHour::where('supervisor_id', auth()->user()->supervisor_id)->get());
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkingHourRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $workingHour = WorkingHour::create([
                'supervisor_id'=>auth()->user()->id,
                'day' => $request->day,
                'start_at' =>$request->start_at,
                'end_at' => $request->end_at,
                'launch_hour_start_at' => $request->launch_hour_start_at,
                'launch_hour_end_at' => $request->launch_hour_end_at,

            ]);
            return response()->success(0, null, $workingHour->id, 201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHour $workingHour)
    {
        return $this->withErrorHandling(function () use($workingHour){
            return WorkingHourResource::make($workingHour);
        });
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(WorkingHourUpdateRequest $request, WorkingHour $workingHour)
    {
        return $this->withErrorHandling(function () use ($request,$workingHour) {
            $workingHour->update([
                'start_at' =>$request->start_at,
                'end_at' => $request->end_at,
                'launch_hour_start_at' => $request->launch_hour_start_at,
                'launch_hour_end_at' => $request->launch_hour_end_at,
            ]);
            return response()->success(0, null, $workingHour->id, 201);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingHour $workingHour)
    {
        return $this->withErrorHandling(function () use ($workingHour) {
            $workingHour->delete();
            return response()->success(0, null, $workingHour->id, 201);
        });
    }
}
