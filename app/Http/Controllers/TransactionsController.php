<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateTransaction();

        $desciption = $request->get('description');

        $chargeamount = (double)Str::substr($desciption, strrpos($desciption, 'C') + 1);

        $time = ((int)Str::substr($desciption, 0,strpos($desciption, ' '))) * 24 * 3600 ;

        $attributes = $attributes +
            ['paymentid' => $this->generatePaymentid()] +
            ['chargeamount' => $chargeamount] +
            ['time' => $time];

        Transaction::create($attributes);

        return $attributes;
//        return 'Application successfully submitted!';

//        return back();
//        return redirect()->back()->with('message', 'Application successfully submitted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->toArray());

        $transaction->user->update(
            ['timeremaining' => (int)$transaction->user->timeremaining + (int)$transaction->time]
        );

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function validateTransaction()
    {
        return request()->validate([
//            'profile_image' => ['required'],
            'user_id' => ['required'],
            'name' => ['required', 'min:3'],
            'description' => 'required|in:1 day @ GHC1.00,7 days @ GHC5.00,30 days @ GHC5.00',
            'mobileno' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    }

    public function validateTransactionUpdate()
    {
        return request()->validate([
            'transactionsuccessful' => ['required']
        ]);
    }

    public function paymentidExists($paymentid) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Transaction::wherepaymentid($paymentid)->exists();
    }

    public function generatePaymentid($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        if ($this->paymentidExists($string)) {
            return generatePaymentid();
        }

        return $string;
    }
}
