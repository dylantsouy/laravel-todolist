<?php

namespace App\Exports;

use App\Models\TodoItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TodoItemsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TodoItem::all();
    }
    
    public function headings(): array
    {
        return [
                "id",
                "name", 
                "content", 
                "level", 
                "finish", 
                "is_top", 
                "user_name",
                "deadline",
                "created_at",
                "updated_at",
                "deleted_at" 
        ];
    }
}
