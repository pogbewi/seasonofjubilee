<?php

namespace Seasonofjubilee\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Seasonofjubilee\Models\Post;

class PostNewsLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private  $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.post.newsletter')
            ->with(['title'=>$this->post->title,
                'body'=>str_limit($this->post->body, 150,'...'),
                'url' => route('posts.show', $this->post->slug),
                'photo' => $this->post->photo
            ]);
    }
}
