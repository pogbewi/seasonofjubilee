<?php

namespace Seasonofjubilee\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Seasonofjubilee\Events\NewsLetter;
use Seasonofjubilee\Mail\EventNewsLetter;
use Seasonofjubilee\Mail\PostNewsLetter;
use Seasonofjubilee\Mail\SermonNewsLetter;
use Seasonofjubilee\Mail\TestimonyNewsLetter;
use Seasonofjubilee\Models\Subscriber;

class NewsLetterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewsLetter $event)
    {
        $subscriber = Subscriber::pluck('email');
        $email = 'p.ogbewi@gmail.com';
        switch($event->type){
            case 'event':
                Mail::to($email)
                    ->cc($subscriber)
                    ->queue(new EventNewsLetter($event->model));
                break;
            case 'post':
                Mail::to($email)
                    ->cc($subscriber)
                    ->queue(new PostNewsLetter($event->model));
                break;
            case 'sermon':
                Mail::to($email)
                    ->cc($subscriber)
                    ->queue(new SermonNewsLetter($event->model));
                break;
            case 'testimony':
                Mail::to($email)
                    ->cc($subscriber)
                    ->queue(new TestimonyNewsLetter($event->model));
                break;
            default:
                break;
        }
    }
}
