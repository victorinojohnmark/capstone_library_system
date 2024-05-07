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

    protected $appends = ['overdue_days'];

    public function book()
    {
        return $this->belongsTo(Book::class)->withTrashed();;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();;
    }

    public function getIsOverdueAttribute()
    {
        $now = Carbon::today();
        $dueDate = Carbon::parse($this->attributes['due_date']);

        return $now->greaterThan($dueDate);
    }

    public function scopeOverdue($query)
    {
        $now = Carbon::today();

        return $query->where('due_date', '<', $now)
                ->where(function ($query) use ($now) {
                    $query->whereNull('returned_at')
                        ->orWhereNull('cancelled_at');
                });
    }

    public function getOverdueDaysAttribute()
    {
        $now = Carbon::today();
        $dueDate = Carbon::parse($this->attributes['due_date']);

        return max(0, $now->diffInDays($dueDate));
    }

    public function getPenaltyAttribute()
    {
        if ($this->is_overdue && is_null($this->returned_at)) {
            // Calculate the number of days overdue
            $overdueDays = $this->overdue_days;

            // Calculate the penalty
            $penalty = $overdueDays * 50; // Penalty rate: 50 per day

            return $penalty;
        }

        return 0; // No penalty if not overdue or already returned
    }
}
