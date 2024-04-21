<?php

namespace App\Http\Controllers;

use App\DepositRecord;
use App\Jobs\SendGeneralEmail;
use App\Models\BkashPaymentRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Organization\Entities\OrganizationFinance;

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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request = BkashPaymentRequest::findOrFail($id);
            $request->status = 1;
            $request->save();

            $result = $this->depositWithGateWay($request->amount, $request->user_id);
            DB::commit();
            if ($result) {
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public static function depositWithGateWay($amount, $user_id)
    {
        try {
            if (Auth::check()) {
                DB::beginTransaction();
                $user = User::find($user_id);
                $user->balance += $amount;
                $user->save();
                $depositRecord = new DepositRecord();
                $depositRecord->user_id = $user->id;
                $depositRecord->method = "Bkash Payment";
                $depositRecord->amount = $amount;
                $depositRecord->save();

                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                DB::commit();
                return true;
            } else {
                DB::rollBack();
                Toastr::error('Something Went Wrong', 'Error');
                return false;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Toastr::error('Something Went Wrong', 'Error');
            return false;
        }
    }
}
