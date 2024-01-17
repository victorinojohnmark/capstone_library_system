<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\BookRequest;
use App\Models\BookTransaction;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'author', 'isbn', 'publisher', 'category', 'subject', 'year', 'quantity', 'condition' ,'remarks'];


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

    public function bookTransactions()
    {
        return $this->hasMany(BookTransaction::class);
    }

    public function scopeWithApprovedRequests($query)
    {
        return $query->whereHas('bookRequests', function ($query) {
            $query->whereNotNull('approved_at');
        });
    }

    public function scopeWithoutApprovalRequests($query)
    {
        return $query->whereDoesntHave('bookRequests');
    }

    public function scopeAvailableForLending($query)
    {
        return $query->withoutApprovalRequests()->whereDoesntHave('bookTransactions', function ($query) {
            $query->whereNull('returned_at');
        });
    }

    public function scopeBorrowedBooks($query)
    {
        return $query->whereHas('bookTransactions', function ($query) {
            $query->whereNotNull('borrowed_at')->whereNull('returned_at');
        });
    }

    public function getIsReservedAttribute()
    {
        return $this->latestBookRequest()->whereNotNull('approved_at')->exists();
    }

    public function getIsBorrowedAttribute()
    {
        return $this->latestBookTransaction()->whereNotNull('borrowed_at')->whereNull('returned_at')->exists();
    }

    public function getIsReturnedAttribute()
    {
        return $this->latestBookTransaction()->whereNotNull('borrowed_at')->whereNotNull('returned_at')->exists();
    }

    protected function latestBookRequest()
    {
        return $this->hasOne(BookRequest::class)->latest();
    }

    public function latestApprovedBookRequest()
    {
        return $this->hasOne(BookRequest::class)
            ->whereNotNull('approved_at')
            ->latest();
    }

    protected function latestBookTransaction()
    {
        return $this->hasOne(BookTransaction::class)->latest();
    }

    public function latestBorrowedTransaction()
    {
        return $this->hasOne(BookTransaction::class)
            ->whereNotNull('borrowed_at')
            ->whereNull('returned_at')
            ->latest('borrowed_at');
    }

    

    
}
