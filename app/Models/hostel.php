<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;
    use Uuid;

    protected $table = 'hostels';
    protected $fillable = ['name', 'price', 'location', 'no_rooms', 'user_id', 'room_type', 'hostel_features', 'img_one', 'img_two', 'img_three'];
}
