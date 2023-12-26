<?php

namespace App\Notifications\BookRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\BookRequest;

class BookRequestNotification extends Notification
{
    use Queueable;

    protected $bookRequest;

    public function __construct(BookRequest $bookRequest)
    {
        $this->bookRequest = $bookRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Book: "' . $this->bookRequest->book->title . '" has been requested by ' . $this->bookRequest->user->name)
                    ->action('View Book Requests', url('/admin/book-requests'));
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Book: "' . $this->bookRequest->book->title . '" has been requested by ' . $this->bookRequest->user->name,
            'action_url' => url('/admin/book-requests'),
        ];
    }
}
