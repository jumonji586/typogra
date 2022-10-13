<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Post;

class InformationNotification extends Notification
{
    use Queueable;

    // ここ変更した
    private $fromUser;
    private $targetPost;
    private $action;
    private $to_comment_text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    // ここ変更した
    // Postの前に?つけてるのはnullでもOKにするため
    public function __construct(?Post $targetPost,User $fromUser,string $action,?string $to_comment_text)
    {
        $this->fromUser  = $fromUser;
        $this->targetPost  = $targetPost;
        $this->action  = $action;
        $this->to_comment_text  = $to_comment_text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    // ここ変更した
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        // ここ変更した
        return [
            'from_user_name' => $this->fromUser->name,
            'from_user_display_id' => $this->fromUser->display_id,
            'from_user_image' => $this->fromUser->prof_image_path,
            'target_post_title' => ($this->targetPost) ? $this->targetPost->theme->title : null,
            'target_post_display_id' => ($this->targetPost) ? $this->targetPost->display_id : null,
            'action' => $this->action,
            'to_comment_text' => $this->to_comment_text,
        ];
    }
}
