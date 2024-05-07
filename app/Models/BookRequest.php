<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Book;
use App\Models\User;

class BookRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'requested_by_id', 'requested_at', 'approved_at', 'rejected_at', 'due_date', 'cancelled_at'];

    public function book()
    {
        return $this->belongsTo(Book::class)->withTrashed();;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by_id')->withTrashed();;
    }

    public function scopeRejected($query)
    {
        return $query->whereNotNull('rejected_at');
    }

    public function scopeApproved($query)
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
