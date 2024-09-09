<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    public function merchant()
    {
        return $this->belongsTo(MerchantDetails::class, 'merchant_id', 'user_id'); // 'merchant_id' links to 'user_id' in merchant_details
    }

    public function outlet()
    {
        return $this->belongsTo(WlOutlets::class, 'outlet_id', 'id'); // 'outlet_id' is the foreign key in the employee table
    }
}
