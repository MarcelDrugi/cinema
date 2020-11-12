<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Clients\PayPalClient;
use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\InputFields;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;

class PayPalService
{
    const CURRENCY = 'PLN';
    
    protected $payer;
    protected $itemList;
    protected $transaction;
    protected $paypalClient;
    protected $redirectUrls;
    protected $payment;
    protected $amount;
    protected $webProfile;
    protected $paymentExecution;
    protected $details;
    
    public function __construct(
        PayPalClient $payPalClient,
        Transaction $transaction,
        RedirectUrls $redirectUrls,
        ItemList $itemList,
        Payment $payment,
        Amount $amount,
        Payer $payer,
        Details $details,
        PaymentExecution $paymentExecution,
        WebProfile $webProfile
        )
    {
        $this->paypalClient     = $payPalClient;
        $this->payer            = $payer;
        $this->payment          = $payment;
        $this->itemList         = $itemList;
        $this->transaction      = $transaction;
        $this->redirectUrls     = $redirectUrls;
        $this->paymentExecution = $paymentExecution;
        $this->amount           = $amount;
        $this->webProfile       = $webProfile;
        $this->details          = $details;
    }
    
    public function createPayment($toPay)
    {
        $this->payer->setPaymentMethod('paypal');
        $this->itemList->setItems($this->getPayPalItems($toPay));
        $subTotalAmount = $this->getTotalAmount($toPay);
        $this->amount->setCurrency(self::CURRENCY)
        ->setTotal($subTotalAmount);
        $this->transaction->setAmount($this->amount)
        ->setItemList($this->itemList)
        ->setDescription('Purchase of tickets at the Klasyka Kina cinema')
        ->setInvoiceNumber(uniqid());
        $this->redirectUrls
        ->setReturnUrl(route('homepage.index', ['action' => 'paid']))
        ->setCancelUrl(route('homepage.index', ['action' => 'nonpaid']));
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
        $this->webProfile->setName('test' . uniqid())->setInputFields($inputFields);
        $webProfileId = $this->webProfile->create($this->paypalClient->context())->getId();
        $this->payment->setExperienceProfileId($webProfileId);
        $this->payment->setIntent("sale")
        ->setPayer($this->payer)
        ->setRedirectUrls($this->redirectUrls)
        ->setTransactions(array($this->transaction));
        
        try {
            $this->payment->create($this->paypalClient->context());
        }
        catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        
        foreach($this->payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        if(isset($redirect_url))
            return $redirect_url;
        else
            return null;
    }
    
    protected function getPayPalItems($toPay)
    {
        $items = $this->getItems($toPay);
        
        foreach ($items as $item) {
            $payPalItem = new Item();
            $payPalItem->setName($item['name'])
            ->setCurrency(self::CURRENCY)
            ->setQuantity($item['quantity'])
            ->setPrice($item['price']);
            $purchaseItems[] = $payPalItem;
        }
        
        return $purchaseItems;
    }
    
    protected function getTotalAmount($toPay)
    {
        $items = $this->getItems($toPay);
        $totalAmount = 0.00;
        
        foreach ($items as $item) {
            $amount = (float)$item['price'] * (int)$item['quantity'];
            $totalAmount += $amount;
        }
        
        return $totalAmount;
    }
    
    protected function getItems($toPay)
    {
        $request = request();
        
        if($toPay == $request->session()->get('toPay') || strpos($request->server('HTTP_REFERER'), '/profile'))
            return [
                ['name' => 'set of tickets', 'quantity' => 1, 'price' => $toPay],
            ];
            else
                abort(404,'Session not found.');
    }
    
    public function confirmPayment(Request $request)
    {
        $paymentId = $request->get('payment_id');
        $payerID   = $request->get('payer_id');
        $payment   = Payment::get($paymentId, $this->paypalClient->context());
        $this->paymentExecution->setPayerId($payerID);
        
        try {
            $result = $payment->execute($this->paymentExecution, $this->paypalClient->context());
        }
        catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        
        return $result;
    }
}