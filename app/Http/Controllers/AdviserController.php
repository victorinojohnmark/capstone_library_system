<?php

namespace App\Http\Controllers;

use App\Models\Adviser;
use App\Models\Section;
use Illuminate\Http\Request;
use App\System\Helper;

class AdviserController extends Controller
{

    public function index()
    {
        return view('master.others.adviserlist', [
            'advisers' => Adviser::latest()->get(),
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('grade_no', 'asc')->get()
        ]);
    }

    public function fetchAdviser(Request $request)
    {

        $advisors = Adviser::where(function($query) use($request) {
            if($request->query('grade_no') && $request->query('section_id')) {
                $query->where('grade_no', $request->query('grade_no'))
                ->where('section_id', $request->query('section_id'));
            }
        })->first();

        return response()->json($advisors);
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:advisers,name',
            'grade_no' =>'required',
            'section_id' =>'required|exists:sections,id'
        ]);

        $adviser = Adviser::create($data);

        session()->flash('success', $adviser->name . ' added successfully.');
        return redirect()->route('adviser-index');
    }

    public function update(Request $request, Adviser $adviser)
    {
        $data = $request->validate([
            'name' => 'required|unique:advisers,name,'.$adviser->id.',id',
            'grade_no' =>'required',
            'section_id' =>'required|exists:sections,id'
        ]);

        $adviser->fill($data);
        $adviser->save();

        session()->flash('success', $adviser->name . ' added successfully.');
        return redirect()->route('adviser-index');
    }

    public function destroy(Adviser $adviser)
    {
        $adviser->delete();
        session()->flash('success', $adviser->name .'deleted successfully.');
        return redirect()->route('adviser-index');
    }
}
