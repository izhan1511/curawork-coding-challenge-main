<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_user_id',
        'sec_user_id',
        'status'
    ];

    //Sec User
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'sec_user_id');
    }

    //First User
    public function firstUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'first_user_id');
    }
}
