<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\MemberCertification;

class APL01Rejected extends Mailable
{
    use Queueable, SerializesModels;

    public $cert;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MemberCertification $cert)
    {
        $this->cert = $cert;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pendaftaran Sertifikasi Ditolak')
        ->markdown('emails.peserta.apl.rejected');
    }
}
