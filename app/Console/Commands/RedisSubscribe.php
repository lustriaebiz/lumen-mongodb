<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to Redis Channel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Redis::subscribe(['chanel-1022'], function($message) {
            echo $message;
        });
    }
}
