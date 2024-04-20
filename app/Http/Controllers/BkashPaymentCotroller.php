<?php

namespace App\Http\Controllers;

use App\Models\BkashPaymentRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BkashPaymentCotroller extends Controller
{

    public function index()
    {
        $payments = BkashPaymentRequest::latest()->paginate(10);
        return view('bkashPayment.index', compact('payments'));

    }

    public function store(Request $request)
    {
        try {
            $payment = new BkashPaymentRequest();
            $payment->user_id = Auth::user()->id ?? 0;
            $payment->bkash_trxid = $request->bkash_trxid;
            $payment->bkash_from_number = $request->bkash_from_number;
            $payment->amount = $request->deposit_amount;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = md5($request->bkash_trxid . rand(0, 10000)) . '.' . 'png';
                $upload_path = 'public/uploads/bkashpayment/';
                $image->move($upload_path, $name);
                $payment->image = 'public/uploads/bkashpayment/' . $name;
            }
            $payment->save();
            Toastr::success('Your request has pending. Please wait for approved', 'Success');

            return true;
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return false;
        }
    }
}
