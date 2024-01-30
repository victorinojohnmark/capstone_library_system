<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\System\Helper;

class GradeController extends Controller
{
    public function fetchGrade(Request $request)
    {
        return $grades = Helper::getDropDownJson('grades.json');
    }
}
