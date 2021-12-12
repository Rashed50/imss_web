<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrType;
use Illuminate\Support\Facades\Session;

class DebitTypeController extends Controller{
    

    public function store(Request $request){
        $insert=DrType::insertGetId([
         'DrTypeName'=>$request['DrTypeName'],
        ]);

        if($insert){
            Session::flash('success','new debit type name store Successfully.');
                return redirect()->route('DebitVoucher.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }
}
