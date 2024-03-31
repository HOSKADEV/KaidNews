<?php

namespace App\Http\Controllers\Dashboard\ExcelImport;

use Illuminate\Http\Request;
use App\Imports\ImportStudent;
use Excel;
use App\Http\Controllers\Controller;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
    
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new ImportStudent, $file);
 
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
