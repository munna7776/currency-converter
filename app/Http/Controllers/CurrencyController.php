<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::rates()
                    ->latest()
                    ->get();
        return view('index',[
            'currencies'=>$currencies
        ]);
    }
    public function ConvertCurrency(Request $req)
    {
        $req->validate([
            'amount'=>'required|numeric|min:0',
            'from'=>'required',
            'to'=>'required'
        ]);
        $amount =  $req->amount;
        $from = $req->from;
        $to = $req->to;
        $converted =  Currency::convert()
                                    ->from($from)
                                    ->to($to)
                                    ->amount($amount)
                                    ->round(2)
                                    ->get();
        $show = $amount.' from '.$from.' to '.$to.' is '.$converted;
        return back()->with([
            'conversion'=>$show,
            'amount'=>$req->amount,
            'from'=>$req->from,
            'to'=>$req->to,
        ]);
    }
}
