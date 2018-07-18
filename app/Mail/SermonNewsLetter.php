<?php

namespace Seasonofjubilee\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Seasonofjubilee\Models\Sermon;

class SermonNewsLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private  $sermon;

    public function __construct(Sermon $sermon)
    {
        $this->sermon = $sermon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sermon.newsletter')
            ->with(['title'=>$this->sermon->title,
                'body'=>str_limit($this->sermon->body, 200,'...'),
                'url' => route('sermons.show', $this->sermon->slug)
            ]);
    }
}
