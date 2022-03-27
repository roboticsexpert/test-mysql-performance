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
        for ($j = 0; $j < 1; $j++) {
            $count = 200000;

            echo 'TIME before single insert for ' . $count . ':' . microtime(true) . PHP_EOL;
            DB::table('admin_roles')->limit(50000)->update(['name'=>'test2']);
            echo 'TIME before single insert for ' . $count . ':' . microtime(true) . PHP_EOL;
            dd('done');
            $time = Carbon::now();
            Redis::pipeline(function ($pipe) use ($count,$time) {


                for ($i = 0; $i < $count; $i++) {
                    $pipe->set('key', $i);
//            DB::table('admin_roles')->insert([
//                'name'=>'test',
//                'caption'=>'test',
//                'description'=>'test',
//                'created_at'=>$time,
//                'updated_at'=>$time
//            ]);
                }
            });
            echo 'TIME after single insert for ' . $count . ':' . microtime(true) . PHP_EOL;

//            echo 'TIME before bulk insert for ' . $count . ':' . microtime(true) . PHP_EOL;
//            $time = Carbon::now();
//            $data = [];
//            for ($i = 0; $i < $count; $i++) {
//                $data[] = [
//                    'name' => 'test',
//                    'caption' => 'test',
//                    'description' => 'test',
//                    'created_at' => $time,
//                    'updated_at' => $time
//                ];
//            }
//            DB::table('admin_roles')->insert($data);
//            echo 'TIME after bulk insert for ' . $count . ':' . microtime(true) . PHP_EOL;
        }

        return 0;
    }
}
