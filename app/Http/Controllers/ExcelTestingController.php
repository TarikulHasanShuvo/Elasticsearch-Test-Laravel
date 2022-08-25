<?php

namespace App\Http\Controllers;

use App\Exports\UsersChunkExport;
use App\Exports\UsersExport;
use App\Jobs\ExcelExportJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelTestingController extends Controller
{
    public function index()
    {
//        $file_name = 'users.xlsx';
//        $file_store = storage_path('app/' . $file_name);
//        Excel::import(new UsersExport(), $file_store);


            $rows = User::query()->get()->take(50000);
            ExcelExportJob::dispatch($rows);


        return 'excel.index';
    }
}
