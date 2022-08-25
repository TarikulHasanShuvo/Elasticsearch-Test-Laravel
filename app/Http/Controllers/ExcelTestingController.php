<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelTestingController extends Controller
{
    public function index()
    {
        $file_name = 'users.xlsx';
        $file_store = storage_path('app/' . $file_name);
        Excel::import(new UsersExport(), $file_store);
    }
}
