<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountType;
class AccountTypeController extends Controller{
    
    public function getAll(){
        return $type= AccountType::orderBy('AcctTypeId','ASC')->get();
    }
}
