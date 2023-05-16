<?php

namespace App\Http\Controllers;


use App\Http\Requests\Balance\RegisterCardRequest;
use App\Http\Resources\Wallet\MoneyDemandResource;
use App\Models\Card;
use App\Models\MoneyDemand;
use Iyzipay\Options;

class PaymentController extends Controller
{
    protected Options $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setApiKey('sandbox-koSjID2wjUmVEsJxjXis1SqpIYn6iPLI');
        $this->options->setSecretKey('sandbox-l2TFzWg7Kv0GIxnDpGSRnSQCf0MqMXPQ');
        $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');
    }
    public function payment($balance, $url,$orderNo)
    {
        $conversationId = rand(100000000, 999999999);
        # create request class
        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId($conversationId);
        $request->setPrice($balance);
        $request->setPaidPrice($balance);
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setCallbackUrl($url);
        $request->setEnabledInstallments(array(2, 3, 6, 9));
        $request->setBasketId($orderNo);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

        $user = auth()->user();
        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($user->id);
        $buyer->setName($user->first_name);
        $buyer->setSurname($user->last_name);
        $buyer->setGsmNumber($user->phone);
        $buyer->setEmail($user->email);
        $buyer->setIdentityNumber("74300864791");
        $buyer->setLastLoginDate("2015-10-05 12:43:35");
        $buyer->setRegistrationDate("2013-04-21 15:12:09");
        $buyer->setRegistrationAddress('test adresi');
        $buyer->setIp("85.34.78.112");
        $buyer->setCity('Yalova');
        $buyer->setCountry('Türkiye');
        $request->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName(auth()->user()->first_name);
        $shippingAddress->setCity('yalova');
        $shippingAddress->setCountry('Türkiye');
        $shippingAddress->setAddress('test adresi');
        $request->setShippingAddress($shippingAddress);
        // Billing address is used because there is no other address
        $request->setBillingAddress($shippingAddress);

        $basketItems = array();
        $basketItem = new \Iyzipay\Model\BasketItem();
        $basketItem->setId(0);
        $basketItem->setName('Bakiye yükleme');
        $basketItem->setCategory1('Bakiye');
        $basketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
        $basketItem->setPrice($balance);
        $basketItems[0] = $basketItem;

        $request->setBasketItems($basketItems);
        $payment = \Iyzipay\Model\CheckoutFormInitialize::create($request, $this->options);
        return $payment;
    }

    public function saveUserAndCard(RegisterCardRequest $cardRequest){
        return $this->withErrorHandling(function () use ($cardRequest) {
            $request = new \Iyzipay\Request\CreateCardRequest();
            if (auth()->user()->cardUserKey == null)
            {
                $request->setEmail(auth()->user()->email);
            }else{
                $request->setCardUserKey(auth()->user()->cardUserKey);
            }

            $cardInformation = new \Iyzipay\Model\CardInformation();
            $cardInformation->setCardAlias($cardRequest->alias);
            $cardInformation->setCardHolderName($cardRequest->cardName);
            $cardInformation->setCardNumber($cardRequest->cardNumber);
            $cardInformation->setExpireMonth($cardRequest->cardMonth);
            $cardInformation->setExpireYear($cardRequest->cardYear);
            $request->setCard($cardInformation);

            $card = \Iyzipay\Model\Card::create($request, $this->options);
            if (!$card->getCardToken())
            {
                return response()->error(0, null, $card->getErrorMessage(), 500);
            }
            if (auth()->user()->cardUserKey == null)
            {
                auth()->user()->update([
                    'cardUserKey'=>$card->getCardUserKey()
                ]);
            }
            Card::create([
                'cardName'=>$cardRequest->cardName,
                'cardToken'=>$card->getCardToken(),
            ]);
            return response()->success(0, null, $card->getCardToken(), 201);
        });
    }

    public function getCards() {
        return $this->withErrorHandling(function (){
            $request = new \Iyzipay\Request\RetrieveCardListRequest();
            $request->setLocale(\Iyzipay\Model\Locale::TR);
            $request->setCardUserKey(auth()->user()->cardUserKey);
            $cardList = \Iyzipay\Model\CardList::retrieve($request,  $this->options);
            return response()->success(0, null, $cardList->getCardDetails(), 201);
        });
    }

    // TODO payment with registered card


}
