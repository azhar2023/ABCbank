<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;
    public $table = 'useraccounts';

    public function userbalance()
    {
        return $this->hasOne(UserBalance::class, 'user_id', 'user_id');
    }


}
