<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Adviser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'grade_no', 'section_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();;
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
