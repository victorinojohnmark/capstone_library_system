<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class BorrowerFrontendController extends Controller
{
    public function home()
    {
        return 'Borrower home';
    }

    
}
