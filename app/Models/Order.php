<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

}
