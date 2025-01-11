<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_name',
        'fashion_model_id',
        'booking_date',
    ];

    public function fashionModel()
    {
        return $this->belongsTo(FashionModel::class, 'fashion_model_id', 'id');
    }
}
