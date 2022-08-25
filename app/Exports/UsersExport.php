<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

class UsersExport implements ToCollection
{

    public function collection(Collection $rows)
    {

         $rows->take(500)->each(function ($row) {
            User::create([
                'name' => $row[1],
                'email' => $row[2],
                'password' => bcrypt('password'),
            ]);
        });
         if (Storage::exists('users.xlsx')) {
             unlink(storage_path('app/users.xlsx'));
        }
        Excel::store(new UsersChunkExport($rows->skip(500)), 'users.xlsx');

//        $file_name = 'users.xlsx';
//        $file_store = storage_path('app/public/' . $file_name);
    }
}
