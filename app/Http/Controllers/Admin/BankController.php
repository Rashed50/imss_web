<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
class BankController extends Controller{
    
    public function getAll(){
        return $allBank=Bank::orderBy('BankName', 'ASC')->get();
    }
}
