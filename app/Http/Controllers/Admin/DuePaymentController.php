<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DuePaymentController extends Controller{
    
    public function add(){
        return view('admin.payment.due');
    }

    public function store(Request $request){
        dd($request->all());
    }
}
