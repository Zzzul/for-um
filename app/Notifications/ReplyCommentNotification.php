<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $reply, $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $comment)
    {
        $this->reply = $reply;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return $this->comment;
        // die;

        return (new MailMessage)
            ->subject('New Reply Notification')
            ->line('Your comment recevied a new reply.')
            ->line('Reply:')
            ->line($this->reply->user->name . ' - ' . $this->reply->body)
            ->action('View post', route('post.show', $this->comment->post->slug))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'reply' => $this->reply,
            'comment' => $this->comment
        ];
    }
}
