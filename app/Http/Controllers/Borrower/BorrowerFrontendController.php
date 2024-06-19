<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\System\Helper;
use App\Models\Section;
use App\Models\Adviser;

class BorrowerFrontendController extends Controller
{
    public function home()
    {
        return view('borrower.borrower-home', [
            'reservedBookCount' => auth()->user()->approvedBookRequests?->count() ?? 0,
            'borrowedBookCount' => auth()->user()->borrowedBooks?->count() ?? 0
        ]);
    }

    public function borrowedBooks()
    {
        return view('borrower.borrowed-books.borrowed-books-list', [
            'borrowedBookTransactions' => auth()->user()->borrowedBooks,

        ]);
    }

    public function profileView(Request $request)
    {
        return view('borrower.profile.profile-view', [
            'user' => auth()->user(),
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('section_name')->get(),
            'advisers' => Adviser::latest()->get(),
            'types' => Helper::getDropDownJson('user_types.json'),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'lastname' => ['required'],
            'firstname' => ['required'],
            'middle_initial' => ['nullable'],
            'lrn' => ['required'],
            'grade' => ['nullable'],
            'section_id' => ['nullable'],
            'adviser_id' => ['nullable'],
            'type' => ['required'],
            'image_filename' => ['sometimes','mimes:jpg,jpeg,png','max:5120'],
        ]);

        $user->fill($data);
        $user->save();

        if($request->hasFile('image_filename')) {
            $file = $request->file('image_filename');
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->guessExtension();
            $customFileName = uniqid() . now()->timestamp . '.' . $fileExtension;

            $file->storeAs('/public/profile_picture/', $customFileName);

            //update image filename
            $user->image_filename = $customFileName;
            $user->update();
        }

        return redirect()->route('borrower.profile')->with('success', 'Profile updated successfully.');
    }

    public function notifications(Request $request)
    {
        return view('borrower.notifications.notifications-list', [
            'notifications' => auth()->user()->unreadNotifications()->latest()->get(),
        ]);
    }

    
}
