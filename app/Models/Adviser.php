<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Adviser extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_no'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
