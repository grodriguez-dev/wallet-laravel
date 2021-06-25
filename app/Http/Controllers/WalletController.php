<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Requests\AmountRequest;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet = Wallet::first();


        return view('dashboard', compact('wallet'));
    }

    /**
     * Store/Update a Wallet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function operation(AmountRequest $request)
    {
        $wallet = Wallet::first();

        if (isset($wallet)) {

            if ($request->operation != 0) {

                $result = $wallet->amount + $request->amount;

                $message = 'Agregados';

            } else {

                $result = $wallet->amount - $request->amount;

                $message =  'Restados';
            }

            Wallet::where('id', $wallet->id)->update([
                'amount' => $result,
                'register' => $request->amount
            ]);
            return redirect()->route('dashboard')->with('message', $message);
        }
        
        Wallet::create([
            'amount' => $request->amount,
            'register' => $request->amount
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
