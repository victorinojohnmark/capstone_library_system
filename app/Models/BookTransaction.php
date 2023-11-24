<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
