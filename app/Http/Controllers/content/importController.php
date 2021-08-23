<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\importContent;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class importController extends Controller
{
    public function index() {
        $importList = importContent::sortable(['id' => 'desc'])->paginate(15);
        return view('content.import.dashboard', compact('importList'));
    }

    public function store(Request $request)
        {
            $category = substr($request->category, 0, -6);
            $classname = "App\Imports\\" . $request->category;
            // $excel = Excel::import(new $classname, $request->import_file);

            // filename
              $file = $request->file('import_file')->store('importContent');
            // filesize
              $size = filesize(storage_path("app/$file"));
            // rows
              $getFile = file(storage_path("app/$file"));
              $rows = count($getFile)-1;

            importContent::create([
                'category' => $category,
                'filesize' => $size,
                'rows'     => $rows
            ]);

            $import = new $classname;
            $import->import($file);

            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }

            return redirect()->route('import.index')->withSuccess('Successfully imported ' . $category);
        }

    public function download_file($filename)
        {
            $filePath = storage_path("app/importContent/$filename");
            $headers = ['Content-Type: text/csv'];
            return response()->download($filePath, $filename, $headers);
        }

}
