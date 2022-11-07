<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table='notes';
    
    protected $fillable=['name','description'];
    
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comment::class,'note_id','id');
    }
}
