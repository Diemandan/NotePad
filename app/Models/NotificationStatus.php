<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'read_by_user',
        'notification_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function scopeUserReadNotes()
    {
        $userReadNotes = NotificationStatus::select('notification_id')->where('read_by_user', Auth()->id())->get();

        return $userReadNotes;
    }
}
