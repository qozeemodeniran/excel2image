<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Export;
use App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;

class E2IController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }

    public function export() 
    {
        return Excel::download(new Export, 'excel2image.xlsx');
    }

    public function import(Request $request) 
    {
        Excel::import(new Import, request()->file('file'));
           
        return back();
    }
}
