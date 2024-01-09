<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Section;
use App\Models\Adviser;
use App\Models\BookTransaction;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'lastname',
        'firstname',
        'middle_initial',
        'email',
        'password',
        'is_admin',
        'lrn',
        'grade',
        'section_id',
        'adviser_id',
        'type',
        'image_filename',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNameAttribute()
    {
        return $this->lastname . ', ' . $this->firstname . ' ' . $this->middle_initial;
    }

    public function adminlte_image()
    {
        return '/img/user-avatar.png';
    }

    public function scopeBorrowers($query)
    {
        return $query->where('is_admin', '=', false);
    }

    public function scopeAdmins($query)
    {
        return $query->where('is_admin', '=', true);
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->image_filename ? '/storage/profile_picture/' . $this->image_filename : '/img/ashi-library-logo.png';
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class);
    }

    public function bookRequests()
    {
        return $this->hasMany(BookRequest::class, 'requested_by_id');
    }

    public function scopeApprovedBookRequests($query)
    {
        return $query->whereHas('bookRequests', function ($query) {
            $query->approved();
        });
    }

    public function bookTransactions()
    {
        return $this->hasMany(BookTransaction::class);
    }

    public function scopeBorrowedBooks($query)
    {
        return $query->whereHas('bookTransactions', function ($query) {
            $query->whereNotNull('borrowed_at')->whereNull('returned_at');
        });
    }

    public function borrowedBooks()
    {
        return $this->hasMany(BookTransaction::class)
            ->whereNotNull('borrowed_at')
            ->whereNull('returned_at')
            ->with('book');
    }
}
