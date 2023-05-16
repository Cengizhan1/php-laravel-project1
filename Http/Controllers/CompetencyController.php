<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supervisor\CompetencyRequest;
use App\Http\Resources\Supervisor\CompetencyResource;
use App\Models\Competency;
use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            return CompetencyResource::collection(
                Competency::where('supervisor_id', auth()->user()->supervisor_id)->with('media')->get());
        });
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetencyRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $competency = Competency::create([
                'supervisor_id' => $request->supervisor_id,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'message' => $request->message,
            ]);
            $competency->addMedia($request->doc)->toMediaCollection('doc');
            return response()->success(0, null, $competency->id, 201);
        });
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Competency $competency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competency $competency)
    {
        return $this->withErrorHandling(function () use ($competency) {
            $competency->delete();
            return response()->success(0, null, $competency->id, 201);
        });
    }
}
