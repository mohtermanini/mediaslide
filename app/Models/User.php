<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['email', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        // return $this->hasOne(RelatedModel::class, 'foreign_key_in_related_model', 'primary_key_in_current_model');
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function role()
    {
        // return $this->belongsTo(RelatedModel::class, 'foreign_key_in_current_model', 'primary_key_in_related_model')->chained_methods;
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
