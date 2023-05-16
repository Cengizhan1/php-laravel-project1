<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\MoneyDemandCreateRequest;
use App\Http\Resources\Wallet\MoneyDemandResource;
use App\Models\MoneyDemand;
use Illuminate\Http\Request;

class MoneyDemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            return MoneyDemandResource::collection(
                MoneyDemand::where('requester_type',auth()->user()->activeType)
            ->where('requester_id',auth()->user()->activeId)->get());
        });
    }


    public function store(MoneyDemandCreateRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            MoneyDemand::create([
                'demanded_price'=>$request->money,
                'demand_reason_id'=>0,
                'date'=>now(),
                'requester_id'=>auth()->user()->activeId,
                'requester_type'=>auth()->user()->activeType,
                'message'=>$request->message,
                'status'=>2
            ]);
            return response()->success(0, null, [], 201);
        });
    }

}
