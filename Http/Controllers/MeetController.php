<?php

namespace App\Http\Controllers;

use App\Http\Requests\Meet\MeetStoreRequest;
use App\Http\Requests\Meet\MeetUpdateRequest;
use App\Http\Resources\Meet\MeetIndexResource;
use App\Http\Resources\Meet\MeetShowResource;
use App\Models\Meet;
use App\Models\WalletTransaction;

class MeetController extends Controller
{

    protected $walletTransactionController;

    public function __construct(WalletTransactionController $walletTransactionController)
    {
        $this->walletTransactionController = $walletTransactionController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            $user = auth()->user();
            $meets = $user->supervisor_active ? Meet::where('supervisor_id', $user->activeId)->get()
                : Meet::where('user_id', $user->activeId)->get();
            return MeetIndexResource::collection($meets);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetStoreRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {

            $meet = Meet::create([
                'user_id' => auth()->user()->id,
                'supervisor_id' => $request->supervisor_id,
                'category_id' => $request->category_id,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'price' => $request->price,
                'message' => $request->message,
                'status' => 0,
                'supervisor_approval' => false,
                'user_approval' => true,
                'code' => 'TEST', // TODO generate unique code
            ]);
            $this->walletTransactionController->store($meet->id,$meet->price, $meet->supervisor_id);

            return response()->success(0, null, $meet->id, 201);
        });
    }

    public function getNextMeet(){
        return $this->withErrorHandling(function () {
            $user = auth()->user();
            $meet = $user->supervisor_active ? Meet::where('supervisor_id', $user->activeId)->get()
                : Meet::where('user_id', $user->activeId)->orderBy('start_at','DESC')->first();
            return MeetShowResource::make($meet);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        return $this->withErrorHandling(function () use ($meet) {
            return MeetShowResource::make($meet);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function update(MeetUpdateRequest $request, Meet $meet)
    {
        return $this->withErrorHandling(function () use ($request, $meet) {
            // TODO wallettransaction
            if ($request->result_type == 0) $this->approve($request, $meet);
            else if (!$request->result_type == 2) $this->reDate($request, $meet);
            else $this->notApprove($request, $meet);
            return response()->success(0, null, $meet->id, 201);
        });
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        return $this->withErrorHandling(function () use ($meet) {
            $meet->delete();
            return response()->success(0, null, [], 201);
        });
    }


    private function approve($request, $meet)
    {
        $meet->update([
            'supervisor_approval' => true,
            'user_approval' => true,
            'status' => $request->result_type,
        ]);
    }

    private function notApprove($request, $meet)
    {
        if (auth()->user()->supervisor_active){
            // TODO elo puanı düşürülecektir. (Elo kısmı daha yapılmadı)
        }else{
            // TODO iptal edilmesi durumundaki cezai işlem miktari supervisora aktarılacak.
            // TODO WalletTransaction done statusune gecırılecek
        }
        $canceled_count = $meet->canceled_count;
        $meet->update([
            'canceled_by_type' => auth()->user()->activeType,
            'canceled_by_id' => auth()->user()->activeId,
            'canceled_message' => $request->canceled_message,
            'canceled_count' => $canceled_count + 1,
            'status' => $request->result_type,
        ]);
    }

    private function reDate($request, $meet)
    {
        $supervisor_approval = $meet->supervisor_approval;
        $user_approval = $meet->user_approval;
        $canceled_count = $meet->canceled_count;

        $meet->update([
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'price' => $request->price,
            'status' => $request->result_type,
            'message' => $request->message,
            'supervisor_approval' => !$supervisor_approval,
            'user_approval' => !$user_approval,
            'canceled_by_type' => auth()->user()->activeType,
            'canceled_by_id' => auth()->user()->activeId,
            'canceled_message' => $request->canceled_message,
            'canceled_count' => $canceled_count,
        ]);
    }
}
