<?php

namespace App\Jobs;

use App\Models\Absen;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAbsen implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Absen::create([
            'image' => $this->request['image'],
            'name' => $this->request['name'],
            'rlocation' => $this->request['rlocation'],
            'nik' => $this->request['nik'],
            'ket' => $this->request['ket'],
        ]);
    }
}
