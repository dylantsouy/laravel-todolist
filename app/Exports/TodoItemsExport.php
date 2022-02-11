<?php

namespace App\Exports;

use App\Models\TodoItem;
use Maatwebsite\Excel\Concerns\FromCollection;

class TodoItemsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TodoItem::all();
    }
}
