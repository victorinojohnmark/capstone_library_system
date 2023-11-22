<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Book;

class BookRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'requested_by_id', 'requested_at', 'approved_at', 'rejected_at'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_at');
    }

    public function scopeApproved()
    {
        return $query->whereNotNull('approved_at');
    }

    public function getStatusAttribute()
    {
        if($this->rejected_at) {
            return 'Rejected';
        }

        if($this->approved_at) {
            return 'Approved';
        }

        if(is_null($this->approved_at) && is_null($this->rejected_at)) {
            return 'Pending';
        }
    }

}