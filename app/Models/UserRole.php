<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model{
    use HasFactory;

    protected $fillable = [
       'role_name'
    ];

    public function roleInfo(){
        return $this->belongsTo(User::class, 'role_id', 'role');
    }
}
