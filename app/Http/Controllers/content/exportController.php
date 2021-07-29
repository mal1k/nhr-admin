<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\exportContent;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class exportController extends Controller
{
    public function index() {
        $exportList = exportContent::orderByDesc('id')->paginate(15);
        return view('content.export.dashboard', compact('exportList'));
    }

    public function cloudexport(Request $request) {
        $name = $request->category;
        $filename = $name . '_' . date('d-m-Y_H-i-s').'.csv';
        $classname = "App\Exports\\" . $request->category;

        Excel::store(new $classname, 'exportContent/'.$filename, 'local');

        $size = filesize(storage_path("app/exportContent/$filename"));

        exportContent::create([
            'filename' => $filename,
            'filesize' => $size,
        ]);

        return redirect()->route('export.index')->withSuccess('Created export file "' . $filename . '" on server');
    }

    public function localexport(Request $request) {
        $name = $request->category;
        $filename = $name . '_' . date('d-m-Y_H-i-s');
        $classname = "App\Exports\\" . $request->category;
        return Excel::download(new $classname, $filename.'.csv');
    }

    public function download_file($filename)
    {
    	$filePath = storage_path("app/exportContent/$filename");
    	$headers = ['Content-Type: text/csv'];
    	return response()->download($filePath, $filename, $headers);
    }

    public function delete_file($filename)
        {
            unlink(storage_path("app/exportContent/$filename"));
            exportContent::where('filename', $filename)->delete();
            return redirect()->route('export.index')->withDanger('Deleted file "' . $filename . '"');
        }

}
