<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supervisor\WorkingPriceRequest;
use App\Http\Resources\Supervisor\WorkingPriceResource;
use App\Models\WorkingPrice;
use Illuminate\Http\Request;

class WorkingPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            return WorkingPriceResource::collection(WorkingPrice::where('supervisor_id', auth()->user()->supervisor_id)->get());
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkingPriceRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $workingPrice = WorkingPrice::create([
                'minute' => $request->minute,
                'supervisor_id' =>auth()->user()->id,
                'price' => $request->price,

            ]);
            return response()->success(0, null, $workingPrice->id, 201);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkingPrice  $workingPrice
     * @return \Illuminate\Http\Response
     */
    public function update(WorkingPriceRequest $request, WorkingPrice $workingPrice)
    {
        return $this->withErrorHandling(function () use ($request,$workingPrice) {
            $workingPrice->update([
                'minute' => $request->minute,
                'price' => $request->price,
            ]);
            return response()->success(0, null, $workingPrice->id, 201);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingPrice  $workingPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingPrice $workingPrice)
    {
        return $this->withErrorHandling(function () use ($workingPrice) {
            $workingPrice->delete();
            return response()->success(0, null, $workingPrice->id, 201);
        });
    }
}
