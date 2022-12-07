<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable=['read_by_user','notification_id'];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
