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
        toastr()->success(trans('message.success.imported'));

        // 'Excel file imported successfully!'
        return redirect()->back();
    }
}
