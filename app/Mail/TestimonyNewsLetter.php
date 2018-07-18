<?php

namespace Seasonofjubilee\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Seasonofjubilee\Models\Testimony;

class TestimonyNewsLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private  $testimony;
    public function __construct(Testimony $testimony)
    {
        $this->testimony = $testimony;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.testimony.newsletter')
            ->with(['title'=>$this->testimony->subject,
                'body'=>str_limit($this->testimony->body, 150,'...'),
                'url' => route('testimony.show', $this->testimony->slug)
            ]);
    }
}
