<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FashionModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'date_of_birth',
        'height',
        'shoe_size',
        'gender',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function fashionModelImages()
    {
        return $this->hasMany(FashionModelImage::class, 'fashion_model_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
