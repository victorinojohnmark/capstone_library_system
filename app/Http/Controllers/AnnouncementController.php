<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('announcement.announcement-list', [
            'announcements' => Announcement::latest()->get(),
            'announcement' => new Announcement()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data['created_by_id'] = auth()->user()->id;

        $announcement = Announcement::create($data);
        return redirect()->route('announcements.index')->with('success', 'Announcement successfully added.');

    }

    public function show(Request $request, Announcement $announcement)
    {
        return view('announcement.announcement-show', [
            'announcement' => $announcement
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $announcement->fill($data);
        $announcement->save();

        return redirect()->route('announcements.index')->with('success', 'Announcement successfully updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement successfully deleted.');
    }
}
