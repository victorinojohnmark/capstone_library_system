<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BookRequest;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'isbn', 'publisher','remarks'];


    public function bookRequests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public function bookRequest()
    {
        return $this->hasOne(BookRequest::class)->orderByDesc('approved_at');
    }

    public function getHasReservationAttribute()
    {
        return $this->bookRequest ? true : false;
    }

    public function getStatusAttribute()
    {
        if($this->has_reservation) {
            return 'Reserve';
        } else {
            return 'Available';
        }

    }

    public function scopeWithApprovedRequests($query)
    {
        return $query->whereHas('bookRequests', function ($subquery) {
            $subquery->whereNotNull('approved_at');
        });
    }

    public function scopeWithoutApprovalRequests($query)
    {
        return $query->whereDoesntHave('bookRequests');
    }

    
}
