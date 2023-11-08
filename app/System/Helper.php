<?php

namespace App\System;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use \DateTime;
use \DateInterval;
use \NumberFormatter;

class Helper
{
    public static function getDropDownJson($file_name, $sort = false)
    {
        $lists = Storage::disk('json')->exists($file_name)? Storage::disk('json')->get($file_name) : '';
        $decodedList = json_decode($lists, true);

        if (is_array($decodedList) && $sort) {
            asort($decodedList);
        }

        return $decodedList;
    }

}