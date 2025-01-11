<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FashionModelImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'url',
        'alt_text',
        'fashion_model_id',
    ];
}
