<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\MemberCertification;
use App\Models\MemberCertificationAPL02 as APL02;

use Illuminate\Support\Facades\Log;

class CreateAPL02 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cert;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MemberCertification $cert)
    {
        $this->cert = $cert;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $units = $this->cert->schedules->programs->units;
            foreach ($units as $key => $value) {
                foreach ($value->kuk as $k => $v) {
                    APL02::create([
                        'member_certification_id' => $this->cert->id,
                        'competence_kuk_id' => $v->id,
                        'is_competent' => 0
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
