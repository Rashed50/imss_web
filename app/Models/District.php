<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model{
    use HasFactory;
    protected $primaryKey = "DistId";
    protected $guarded = [];
    public $timestamps = false;

    public function Division(){
      return $this->belongsTo(Division::class,'DiviId','DiviId');
    }

}
