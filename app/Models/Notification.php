<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description'
    ];

    public function notificationStatus()
    {
        return $this->hasMany(NotificationStatus::class, 'notification_id', 'id');
    }
}
