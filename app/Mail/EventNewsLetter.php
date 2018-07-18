<?php

namespace Seasonofjubilee\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Seasonofjubilee\Models\Event;

class EventNewsLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private  $event;
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.event.newsletter')
            ->with(['title'=>$this->event->name,
                'from'=> Carbon::parse($this->event->start_date)->format('M d Y @ h:i a'),
                'to' => Carbon::parse($this->event->end_date)->format('M d Y @ h:i a'),
                'body'=>str_limit($this->event->description, 150,'...'),
                'url' => route('events.show', $this->event->slug)
            ]);
    }
}
