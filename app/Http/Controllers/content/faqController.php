<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;

class faqController extends Controller
{
    public function index()
        {
            $faq = Faq::orderByDesc('id')->paginate(15);
            return view('content.faq.dashboard', compact('faq'));
        }

    public function create()
        {
            return view('content.faq.form');
        }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'question' => 'required|max:255',
                'answer' => 'required|max:255',
            ]);

            Faq::create($request->all()); // create faq

            return redirect()->route('faq.index')->withSuccess('Created FAQ "' . $request->question . '"');
        }

    public function edit(Faq $faq)
        {
            return view('content.faq.form', compact('faq'));
        }

    public function update(Request $request, Faq $faq)
        {
            $validated = $request->validate([
                'question' => 'required|max:255',
                'answer' => 'required|max:255',
            ]);

            $faq->update($request->all()); // update faq

            if ( empty($request->front) )
                $faq->update([ 'front' => null ]);

            if ( empty($request->sponsors) )
                $faq->update([ 'sponsors' => null ]);


            return redirect()->route('faq.index')->withSuccess('Updated FAQ "' . $request->question . '"');
        }

    public function destroy(Faq $faq)
        {
            $faq->delete();
            return redirect()->route('faq.index')->withSuccess('Deleted FAQ "' . $faq->question . '"');
        }
}
