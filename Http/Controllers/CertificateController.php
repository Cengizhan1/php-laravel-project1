<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supervisor\CertificateRequest;
use App\Http\Resources\Supervisor\CertificateResource;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function ()  {
            return CertificateResource::collection(
                Certificate::where('supervisor_id', auth()->user()->supervisor_id)->get());
        });
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificateRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $certificate = Certificate::create([
                'date'=>$request->date,
                'department'=>$request->department,
                'supervisor_id'=>auth()->user()->supervisor_id,

            ]);
            return response()->success(0, null, $certificate->id, 201);
        });
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        return $this->withErrorHandling(function () use ($certificate) {
            $certificate->delete();
            return response()->success(0, null, $certificate->id, 201);
        });
    }
}
