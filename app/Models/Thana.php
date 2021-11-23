<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;
    protected $primaryKey = "ThanId";
    protected $guarded = [];
    public $timestamps = false;

    public function Division(){
      return $this->belongsTo(Division::class,'DiviId','DiviId');
    }

    public function District(){
      return $this->belongsTo(District::class,'DistId','DistId');
    }
}
