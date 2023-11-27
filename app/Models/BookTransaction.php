<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

use App\Models\Book;
use App\Models\User;

class BookTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'returned_at', 'due_date', 'cancelled_at'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsOverdueAttribute()
    {
        $now = Carbon::today();
        $dueDate = Carbon::parse($this->attributes['due_date']);

        return $now->greaterThan($dueDate);
    }

    public function scopeOverdue(Builder $query)
    {
        $now = Carbon::today();

        return $query->whereHas('transactions', function ($query) use ($now) {
            $query->where('due_date', '<', $now);
        });
    }
}
