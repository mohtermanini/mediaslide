<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function fashionModels()
    {
        return $this->hasMany(FashionModel::class, 'category_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->with('parentCategory');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'category_id')->with('childrenCategories');
    }
}
