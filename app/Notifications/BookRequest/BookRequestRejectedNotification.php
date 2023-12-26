<?php

namespace App\Notifications\BookRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\BookRequest;

class BookRequestRejectedNotification extends Notification
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
                    ->line('Your book request for "'. $this->bookRequest->book->title. '" has been rejected.')
                    ->action('View Book Request', url('/borrower/book-requests'));
                    // ->line('Proceed to the library to pick up your book.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your book request for "'. $this->bookRequest->book->title. '" has been rejected.',
            'action_url' => url('/borrower/book-requests'),
        ];
    }
}
