<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OrganizationSeeder extends Seeder
{
    //Свои названия хочу
    private const DATA = [
        'Рога и Копыта',
        'Кривые руки',
        'Кошечки собачки',
        'Вася и Ко',
        'Эстебан'
    ];



    public function run(): void
    {
        $tableNotEmpty = Organization::first()->id ?? 0;

        if($tableNotEmpty)
        {
            //я сею статичные данные, поэтому нет смысла что-то добавлять, если уже что то есть
            $message = 'Таблица не пустая.';
            Log::alert($message);
            $this->command->info($message);
            return;
        }

        $countBuild = Building::pluck('id');

        $countActivity = Activity::pluck('id');
        
        $faker = \Faker\Factory::create();

        foreach(self::DATA as $item)
        {
            $org = Organization::create([
                'name' => $item,
                'building_id' => $countBuild->random()
            ]);

            $countPhones = rand(1,3);
            
            for($i=1; $i<=$countPhones; $i++)
            {
                $phone = mb_substr($faker->unique()->e164PhoneNumber(),1);

                $org->phones()->create([
                    'phone' => $phone, 
                ]);
            }

            $org->activities()->sync($countActivity->random(3));
        }
    }
}
