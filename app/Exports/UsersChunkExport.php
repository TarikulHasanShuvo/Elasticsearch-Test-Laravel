<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersChunkExport implements FromCollection
{
    public $rows;
    public function  __construct($rows)
    {
        $this->rows = $rows;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->rows;
    }
}
