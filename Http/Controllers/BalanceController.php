<?php

namespace App\Http\Controllers;

use App\Http\Requests\Balance\BalanceRequest;
use App\Http\Requests\Balance\PaymentCheckRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use Iyzipay\Options;

class BalanceController extends Controller
{

    protected $paymentController;

    public function __construct(PaymentController $paymentController)
    {
        $this->paymentController = $paymentController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BalanceRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $balance = Balance::create([
                'order_no' => generateOrderNumber(),
                'balance' => $request->balance,
                'result_type' => 0,
                'date' => now(),
                'customer_type' => auth()->user()->activeType,
                'customer_id' => auth()->user()->activeId,
                'card_id' => null,
            ]);
            $payment = $this->paymentController->payment($balance->balance, $request->url, $balance->order_no);
            return response()->success(0, null, $payment, 201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function check(PaymentCheckRequest $checkRequest)
    {
        $this->options = new Options();
        $this->options->setApiKey('sandbox-koSjID2wjUmVEsJxjXis1SqpIYn6iPLI');
        $this->options->setSecretKey('sandbox-l2TFzWg7Kv0GIxnDpGSRnSQCf0MqMXPQ');
        $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');

        $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setToken($checkRequest->token);

        $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $options);
        $balance = Balance::where('token', $_POST['token'])->first();
        if ($checkoutForm->getStatus() == 'success') {
            $balance->ypdate([
                'result_type' => 1
            ]);
            auth()->user()->wallet()->update([
                'balance' => auth()->user()->wallet->balance + $balance->balance
            ]);
            return response()->success(0, null, $checkoutForm->getStatus(), 201);
        } else {
            return response()->success(0, null, [$checkoutForm->getStatus(), $checkoutForm->getErrorMessage()], 201);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Balance $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
