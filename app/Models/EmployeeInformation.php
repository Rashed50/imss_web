<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    use HasFactory;
    public function country(){
      return $this->belongsTo('App\Models\Country','country_id','id');
    }

    public function employeeType(){
      return $this->belongsTo('App\Models\EmployeeType','emp_type_id','id');
    }

    public function category(){
      return $this->belongsTo('App\Models\EmployeeCategory','designation_id','catg_id');
    }

    public function division(){
      return $this->belongsTo('App\Models\Division','division_id','division_id');
    }

    public function district(){
      return $this->belongsTo('App\Models\District','district_id','district_id');
    }

    public function department(){
      return $this->belongsTo('App\Models\Department','department_id','dep_id');
    }

    public function project(){
      return $this->belongsTo('App\Models\ProjectInfo','project_id','proj_id');
    }

    public function religion(){
      return $this->belongsTo('App\Models\Religion','religion','relig_id');
    }
}
