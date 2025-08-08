<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_number',
        'bill_date',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_email',
        'salesperson_name',
        'jewel_types',
        'net_weight',
        'making_charges',
        'wastage_charges',
        'items_description',
        'payment_mode',
        'total_amount', 
        'status',
 ];

    protected $casts = [
        'bill_date' => 'datetime',
    ];

    public function getBillDateAttribute($value)
{
    return $value ? Carbon::parse($value)->format('Y-m-d\TH:i') : null; 
}
}