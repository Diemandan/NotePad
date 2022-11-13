<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable=['note_id','user_id','text'];
    
    public function note()
    {
        return $this->belongsTo(Note::class,'id','note_id');
    }
}
