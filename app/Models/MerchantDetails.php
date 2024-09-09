<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantDetails extends Model
{
    use HasFactory;
    protected $table = 'merchant_details';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'merchant_id', 'user_id'); // 'merchant_id' in employee links to 'user_id' in merchant_details
    }
}
