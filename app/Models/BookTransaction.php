<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Book;

class BookTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'returned_at', 'cancelled_at'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
