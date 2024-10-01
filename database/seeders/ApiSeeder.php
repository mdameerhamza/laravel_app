<?php

namespace Database\Seeders;
use DB;
use Hash;
use App\Models\Api;
use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apis = Api::where('consumer_key','hC40oXMeQNvrQGT78GJfZoCkkO7AAKb1')->first();
        if(!$apis){
            DB::table('apis')->insert([
                'name' => 'Shutter Key',
                'consumer_key' => 'hC40oXMeQNvrQGT78GJfZoCkkO7AAKb1',
                'consumer_secret' => 'XCfgD3jNvCnAMLcQ',
                'status' => 1,
            ]);
        }
    }
}
