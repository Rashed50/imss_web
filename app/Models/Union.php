<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $primaryKey = "UnioId";
    protected $guarded = [];
    public $timestamps = false;

    public function Division(){
      return $this->belongsTo(Division::class,'DiviId','DiviId');
    }

    public function District(){
      return $this->belongsTo(District::class,'DistId','DistId');
    }


    public function Thana(){
      return $this->belongsTo(Thana::class,'ThanId','ThanId');
    }
}
