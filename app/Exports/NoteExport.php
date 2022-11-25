<?php

namespace App\Exports;

use App\Models\Note;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class NoteExport implements FromCollection, WithHeadings
{
    protected $user_id;

    public function __construct($id)
    {
        $this->user_id = $id;
    }
    /**
     * * @return \Illuminate\Support\Collection
     *
     * */
    public function headings(): array
    {
        return ['id', 'user_id', 'name', 'description', 'Created_at'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Note::select('id', 'user_id', 'name', 'description', 'Created_at')
            ->where('user_id', $this->user_id)->get();
    }
}
