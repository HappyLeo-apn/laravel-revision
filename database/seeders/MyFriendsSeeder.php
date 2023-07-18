<?php

namespace Database\Seeders;

use App\Models\MyFriends;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MyFriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MyFriends::truncate();
        $json = File::get('database/data/myFriends.json');
        $myFriends = json_decode($json);

        foreach ($myFriends as $key => $value){
            try{
                MyFriends::create([
                    "name" => $value->name,
                    "age" => $value->age,
                    "gender"=> $value->gender,
                    "hobby" => json_encode($value->hobby)
                ]);
            }
            catch (\Exception $e) {
                echo "Error occurred while processing a friend: " . $e->getMessage();
            }
        }
    }
}
