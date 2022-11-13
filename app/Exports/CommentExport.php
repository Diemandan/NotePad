<?php

namespace App\Exports;
use App\Models\Comment;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommentExport implements FromCollection,WithHeadings

{
    protected $user_id;
    
    public function __construct($id)
{
    $this->user_id=$id;
}
    /**  
     * * @return \Illuminate\Support\Collection 
     *  
     * */   
    public function headings():array
        { 
         return[ 'user_id',  'note_id',  'text',  'Created_at']; 
         }  
     

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Comment::select('user_id','note_id','text','Created_at') 
            ->where('note_id',$this->user_id)->get(); 
    }
}
