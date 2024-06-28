<?php

namespace App\Http\Controllers;

use App\Imports\finalImport;
use App\Imports\minimalImport;
use App\Imports\OperationImport;
use App\Imports\progressImport;
use App\Imports\spotImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importOperation(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:2048'
            ],
        ]);


        Excel::import(new OperationImport, $request->file('file'));

        return redirect()->back()->with('success', 'File successfully imported.');
    }
    public function importInvestigation(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:2048'],
            'Type' => 'required'
        ]);
        // dd($validatedData);
        try {
            if ($validatedData['Type'] == 'Minimal') {
                Excel::import(new minimalImport, $validatedData['file']);
                // dd($request->file('importfile'));
                // return redirect()->back()->with('message', 'File Imported Successfully');
                
            } else if($validatedData['Type'] == 'Spot'){
                Excel::import(new spotImport, $validatedData['file']);
                // dd($validatedData['file']);
                // return redirect()->back()->with('message', 'File Imported Successfully');
            } else if($validatedData['Type'] == 'Progress'){
                Excel::import(new progressImport, $validatedData['file']);
                // dd($validatedData['file']);
                // return redirect()->back()->with('message', 'File Imported Successfully');
            } else if($validatedData['Type'] == 'Final'){
                Excel::import(new finalImport, $validatedData['file']);
                // dd($validatedData['file']);
                // return redirect()->back()->with('message', 'File Imported Successfully');
            } else {
                return redirect()->back()->with('status', 'An unexpected error occurred while importing the file.');
            }
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('status', 'An error occurred while importing the file. Error:' . $e->getMessage());
        }
        return redirect()->back()->with('success', 'Investigation Imported Successfully');
        // Excel::import(new )
    }
}
