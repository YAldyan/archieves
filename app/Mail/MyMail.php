<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tipe;
    protected $name;
    protected $pesan;
    protected $projectName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipe, $name, $pesan, $projectName)
    {
        //
        $this->tipe = $tipe;
        $this->name = $name;
        $this->pesan = $pesan;
        $this->projectName = $projectName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.myMail')
                    ->subject("Project Bank Sumsel Babel")
                    ->with([
                        'tipe' => $this->tipe,
                        'name' => $this->name,
                        'pesan' => $this->pesan,
                        'projectName' => $this->projectName,
                    ]);
    }
}
