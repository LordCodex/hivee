<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
// public $timestamps = false;
    protected $table = 'tokens';
    protected $fillable = ['user_email','otp_active', 'otp','token','created_at'];
}
