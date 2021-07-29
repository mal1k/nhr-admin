<?php

namespace App\Http\Controllers\content;

use App\Exports\bannersExport;
use App\Http\Controllers\Controller;
use App\Exports\faqExport;
use App\Models\exportContent;
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
        $name = $name.'_'.date('d-m-Y_H-i').'_' .time();
        // return dd($request->all());
        return redirect()->route('export.index')->withSuccess('Created export file "' . $request->category . '" on server');
    }

    public function localexport(Request $request) {
        $name = $request->category;
        $filename = $name . '_' . date('d-m-Y_H-i');
        $classname = "App\Exports\\" . $request->category;
        return Excel::download(new $classname, $filename.'.csv');
    }
}
