<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BuildingSeeder extends Seeder
{
    private const DATA = [
        ['Сыктывкар ул. Гаражная д.1', '61.657703', '50.813995'],
        ['Сыктывкар ул. Морозова д.12', '61.655029', '50.796783'],
        ['Сыктывкар ул. Старовского д.16', '61.669066', '50.801194'],
    ];



    public function run(): void
    {
        $tableNotEmpty = Building::first()->id ?? 0;

        if($tableNotEmpty)
        {
            //я сею статичные данные, поэтому нет смысла что-то добавлять, если уже что то есть
            $message = 'Таблица не пустая.';
            Log::alert($message);
            $this->command->info($message);
            return;
        }

        foreach(self::DATA as $item)
            Building::create([
                'address' => $item[0],
                'coordx' => $item[1],
                'coordy' => $item[2],
            ]);
    }
}
