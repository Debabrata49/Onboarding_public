<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WlOutlets extends Model
{
    use HasFactory;

    protected $table = 'wl_outlets';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'outlet_id', 'id'); // 'outlet_id' is the foreign key in the employee table
    }
}
