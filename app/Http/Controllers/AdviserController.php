<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use Illuminate\Http\Request;

class AdviserController extends Controller
{

    public function index()
    {
        return view('master.others.adviserlist', [
            'advisers' => Adviser::latest()->get()
        ]);
    }

    public function fetchAdviser(Request $request)
    {
        return $advisors = Adviser::where(function($query) use($request) {
            if($request->query('grade_no')) {
                $query->where('grade_no', $request->query('grade_no'));
            }
        })
        ->orderBy('name')->get();
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:advisers,name'
        ]);

        $adviser = Adviser::create($data);

        session()->flash('success', $adviser->name . ' added successfully.');
        return redirect()->route('adviser-index');
    }

    public function update(Request $request, Adviser $adviser)
    {
        $data = $request->validate([
            'name' => 'required|unique:advisers,name,'.$adviser->id.',id'
        ]);

        $adviser->fill($data);
        $adviser->save();

        session()->flash('success', $adviser->name . ' added successfully.');
        return redirect()->route('adviser-index');
    }

    public function destroy(Adviser $adviser)
    {
        //
    }
}
