<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class BorrowerController extends Controller
{
    
    public function index(Request $request)
    {
        $borrowers = User::borrowers()->orderBy('lastname')->get();

        return view('master.borrowers.borrowerlist', [
            'borrowers' => $borrowers
        ]);
    }
}
