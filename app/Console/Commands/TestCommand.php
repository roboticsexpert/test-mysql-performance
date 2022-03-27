<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for ($j = 0; $j < 10; $j++) {

            $count = 10000;
            echo 'TIME before bulk insert for ' . $count . ':' . microtime(true) . PHP_EOL;
            $time = Carbon::now();
            $data = [];
            for ($i = 0; $i < $count; $i++) {

                $data[] = [
                    'name' => 'test',
                    'caption' => 'test',
                    'description' => 'test',
                    'created_at' => $time,
                    'updated_at' => $time
                ];
            }
            DB::table('admin_roles')->insert($data);
            echo 'TIME after bulk insert for ' . $count . ':' . microtime(true) . PHP_EOL;
        }

        return 0;
    }
}
