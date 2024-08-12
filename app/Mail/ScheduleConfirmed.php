<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $schedule;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.schedule_confirmed')
                    ->with([
                        'userName' => $this->schedule->user->name,
                        'propertyName' => $this->schedule->property->property_name,
                        'tourDate' => $this->schedule->tour_date,
                        'tourTime' => $this->schedule->tour_time,
                    ]);
    }
}
