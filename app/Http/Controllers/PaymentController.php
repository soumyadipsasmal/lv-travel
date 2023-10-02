<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use App\Models\BookingDetails;
use App\Models\Booking;
use App\Models\PaymentModel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function paynow(Request $request)
    {
        $orders = Booking::where(['id' => $request->orderid])->first();
        $ip = $_SERVER['REMOTE_ADDR'];
        if (empty($orders)) {
            return redirect()->back()->with(['Error' => 'Plese Choose the Tour']);
        }
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                // Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        //check payment response
        if (isset($payment->status) && $payment->status == "authorized") {
            $payment = PaymentModel::create([
                'orderid' => $orders->bid,
                'payid' => $payment['id'],
                'entity' => $payment['entity'],
                'amount' => $payment['amount'] / 100,
                'currency' => $payment['currency'],
                'status' => $payment['status'],
                'created_by' => $orders->coustomerid,
                'created_by_ip' => $ip
            ]);

            //update bookibg status
            $order = Booking::where(['id' => $orders->id])->update([
                'status' => 1,
            ]);

            //send mail to users
            $info = User::where(['id' => $orders->coustomerid])->first();
            $user = [
                'to' => $info->email,
            ];

            $data = array(
                'orderid' => Crypt::encryptString($orders->bid),
                'clientname' => ucwords($info->name),
            );
            Mail::send('email.coustomerbilling', $data, function ($message) use ($user) {
                $message->from('sunnydeolyo@gmail.com');
                $message->to($user['to'], 'Tour and travel')->subject('Congratulation Your Booking is Confirmed!');
            });
            return redirect()->route('invoice', Crypt::encryptString($orders->bid))->with(['success' => 'Payment Successfully Recived,We will notify shortly']);
        } else {
            return redirect()->route('invoice', Crypt::encryptString($orders->bid))->with(['error' => 'Booking Failed, PLease Try Again!']);
        }
    }
}
