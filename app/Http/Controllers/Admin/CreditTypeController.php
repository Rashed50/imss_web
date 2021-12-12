<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrType;
use Illuminate\Support\Facades\Session;

class CreditTypeController extends Controller{

    public function store(Request $request){
        $insert=CrType::insertGetId([
         'CrTypeName'=>$request['CrTypeName'],
        ]);

        if($insert){
            Session::flash('success','new credit type name store Successfully.');
                return redirect()->route('CreitVoucher.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }
}
