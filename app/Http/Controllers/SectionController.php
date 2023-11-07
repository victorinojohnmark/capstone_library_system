<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        return view('master.others.sectionlist', [
            'section' => new Section(),
            'sections' => Section::orderBy('section_name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_name' => 'required|unique:sections,section_name'
        ]);

        $section = Section::create($data);

        session()->flash('success', $section->section_name . ' added successfully.');
        return redirect()->route('section-index');
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'section_name' => 'required|unique:sections,section_name,'.$section->id.',id'
        ]);

        $section->fill($data);
        $section->save();

        session()->flash('success', $section->section_name . ' updated successfully.');
        return redirect()->route('section-index');
    }
}
