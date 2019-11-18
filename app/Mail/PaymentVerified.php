<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\MemberCertification;

class PaymentVerified extends Mailable
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
        return $this->subject('Pembayaran Sertifikasi ' . $this->cert->schedules->programs->name)
        ->markdown('emails.peserta.payment.verified');
    }
}
