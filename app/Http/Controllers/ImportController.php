<?php

namespace App\Http\Controllers;

use App\Imports\OperationImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importOperation(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file'
            ],
        ]);
        

        Excel::import(new OperationImport, $request->file('file'));

        return redirect()->back()->with('success', 'File successfully imported.');
    }
}
