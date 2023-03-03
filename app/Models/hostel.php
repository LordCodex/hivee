<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hostel extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'hostels';
    protected $fillable = ['name', 'price', 'location', 'rooms', 'user_id'];
}
