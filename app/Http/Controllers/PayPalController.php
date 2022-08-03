<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Booking;

class PayPalController extends Controller
{
    protected $booking;
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    //  /**
    //  * create transaction.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function createTransaction()
    // {
    //     return view('transaction');
    // }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // total bookings
        $total = Currency::convert()
                ->from('VND')
                ->to('USD')
                ->amount((float) $request->totalPrice)
                ->get();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction', ['bookingID' => $request->bookingID]),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "" . round($total, 2)
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->back()
                ->with('error', 'Something went wrong.');
                
        } else {
            return redirect()
                ->back()
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $this->booking->changeStatusPayment(Booking::PAID, $request->bookingID);
            $this->booking->changeStatus(Booking::BOOKING_COMPLETED, $request->bookingID);
            return redirect()
                ->route('thanks')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->back()
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        // return redirect()
        //     ->back()
        //     ->with('error', $response['message'] ?? 'You have canceled the transaction.');
        return view('pages.fail');
    }
}
