<?php

namespace App\Http\Controllers;

use App\Imports\DetailPenjualanImportt;
use App\Imports\iiii;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Controller
{
    public function index()
    {
        $request = Request();

        $get = Excel::import(new DetailPenjualanImportt(4, 2), $request->file('file'));

        // dd($get);
    }
}