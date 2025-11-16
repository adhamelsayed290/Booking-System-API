<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category_id', 'description', 'location', 'date', 'available_seats', 'is_active'];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
