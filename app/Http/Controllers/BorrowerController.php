<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\System\Helper;

use App\Models\User;
use App\Models\Section;
use App\Models\Adviser;

class BorrowerController extends Controller
{
    
    public function index(Request $request)
    {
        $borrowers = User::borrowers()->orderBy('lastname')->get();

        return view('master.borrowers.borrowerlist', [
            'borrower' => new User(),
            'borrowers' => $borrowers,
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('section_name')->get(),
            'advisers' => Adviser::latest()->get(),
            'types' => Helper::getDropDownJson('user_types.json'),

        ]);
    }

    public function show(Request $request, User $borrower)
    {   
        // dd($borrower);
        return view('master.borrowers.borrowershow', [
            'borrower' => $borrower,
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('section_name')->get(),
            'advisers' => Adviser::latest()->get(),
            'types' => Helper::getDropDownJson('user_types.json'),
        ]);
    }

    public function create(Request $request)
    {   
        return view('master.borrowers.borrowercreate', [
            'borrower' => new User(),
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('section_name')->get(),
            'advisers' => Adviser::latest()->get(),
            'types' => Helper::getDropDownJson('user_types.json'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'lrn' => 'sometimes|digits:11|unique:users,lrn',
            'grade' => 'sometimes|integer',
            'section_id' => 'sometimes|integer',
            'adviser_id' => 'sometimes|integer',
            'type' => 'required',
            'image_filename' => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);

        //remove image_filename 
        unset($data['image_filename']);

        $borrower = User::create($data);

        if($request->hasFile('image_filename')) {
            $file = $request->file('image_filename');
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->guessExtension();
            $customFileName = uniqid() . now()->timestamp . '.' . $fileExtension;

            $file->storeAs('/public/profile_picture/', $customFileName);

            //update image filename
            $borrower->image_filename = $customFileName;
            $borrower->update();
        }     

        session()->flash('success', $borrower->name . ' is added successfully.');
        return redirect()->route('borrower-index');
    }

    public function update(Request $request, User $borrower)
    {

        // dd($request->all());
        $data = $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'type' => 'required|in:Student,Faculty,Staff',
            'lrn' => 'sometimes|digits:11|unique:users,lrn,'. $borrower->id,
            'grade_no' => 'required_if:type,Student|integer',
            'section_id' => 'required_if:type,Student|integer',
            'adviser_id' => 'required_if:type,Student|integer',
            'image_filename' => 'sometimes|mimes:jpg,jpeg,png|max:5120'
        ]);

        //remove image_filename 
        unset($data['image_filename']);

        $borrower->fill($data);
        $borrower->save();

        if($request->hasFile('image_filename')) {
            $file = $request->file('image_filename');
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->guessExtension();
            $customFileName = uniqid() . now()->timestamp . '.' . $fileExtension;

            $file->storeAs('/public/profile_picture/', $customFileName);

            //update image filename
            $borrower->image_filename = $customFileName;
            $borrower->update();
        }     

        session()->flash('success', $borrower->name . ' is updated successfully.');
        return redirect()->route('borrower-index');
    }

    
}
