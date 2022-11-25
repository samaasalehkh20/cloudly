<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class SetHitAndMissJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        config::get('images');

        config::set(['images.hit' => 0]);

        config::get('images.miss');

        config::set(['images.miss' => 0]);

        $fp = fopen(base_path() .'/config/images.php' , 'w');
        fwrite($fp, '<?php return ' . var_export(config('images'), true) . ';');
        fclose($fp);
    }
}
