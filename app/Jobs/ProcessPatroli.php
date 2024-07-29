<?php

namespace App\Jobs;

use App\Models\Patroli;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPatroli implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $path;
    /**
     * Create a new job instance.
     */
    public function __construct($file, $path)
    {
        $this->file = $file;
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filePath = $this->file->storeAs('public/foto', $this->file->getClientOriginalName());
        // Ambil path file yang baru disimpan
        $this->path = str_replace('public/', '', $filePath);
    }
}
