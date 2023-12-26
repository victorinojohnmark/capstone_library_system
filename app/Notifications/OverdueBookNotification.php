<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\BookTransaction;

class OverdueBookNotification extends Notification
{
    use Queueable;

    protected $bookTransaction;

    public function __construct(BookTransaction $bookTransaction)
    {
        $this->bookTransaction = $bookTransaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('You have a total of '. $this->bookTransaction->overdue_days .' days overdue on your book "'. $this->bookTransaction->book->title. '".')
                    ->action('View Borrowed Books', url('/borrower/borrowed-books'))
                    ->line('Please return the book to the library as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'You have a total of '. $this->bookTransaction->overdue_days .' days overdue on your book "'. $this->bookTransaction->book->title. '". Please return the book to the library as soon as possible.',
            'action_url' => url('/borrower/borrowed-books'),
        ];
    }
}
