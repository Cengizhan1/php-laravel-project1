<?php

namespace App\Http\Controllers;

use App\Http\Resources\Wallet\WalletTransactionResource;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->withErrorHandling(function () {
            if (auth()->user()->supervisor_active) {
                $wallets = WalletTransaction::where('recipientable_id', auth()->user()->supervisor_id)->get();
            } else {
                $wallets = WalletTransaction::where('senderable_id', auth()->user()->id)->get();
            }
            return WalletTransactionResource::collection($wallets);
        });
    }


    public function store($meet_id, $price, $supervisor_id)
    {
        WalletTransaction::create([
            'senderable_type' => 'App\Models\User',
            'senderable_id' => auth()->user()->id,
            'recipientable_type' => 'App\Models\Supervisor',
            'recipientable_id' => $supervisor_id,
            'meet_id' => $meet_id,
            'price' => $price,
            'transaction_result' => 0,
            'date' => now(),
        ]);
        auth()->user()->wallet()->update([
            'balance' => auth()->user()->wallet->balance - $price
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\WalletTransaction $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\WalletTransaction $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\WalletTransaction $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\WalletTransaction $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalletTransaction $walletTransaction)
    {
        //
    }
}
