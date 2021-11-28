<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    use HasFactory;

    public function Division(){
      return $this->belongsTo('App\Models\Division','DiviId','DiviId');
    }

    public function District(){
      return $this->belongsTo('App\Models\District','DistId','DistId');
    }

    public function Thana(){
      return $this->belongsTo('App\Models\Thana','ThanId','ThanId');
    }

    public function Union(){
      return $this->belongsTo('App\Models\Union','UnioId','UnioId');
    }



}
