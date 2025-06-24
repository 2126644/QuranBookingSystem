<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Only if table name doesn’t match Laravel’s default plural form of the model
    // protected $table = 'bookings';

    // Define the fillable properties
    protected $fillable = [
        'user_id',
        'session_day',
        'session_time',
        'class_type',
        'session_type',
        'study_level',
        'additional_info',
    ];

    /**
     * A booking belongs to a user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
