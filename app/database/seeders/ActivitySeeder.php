<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ActivitySeeder extends Seeder
{
    //Возможно конфиг стоит хранить в отдельном фаиле, но тут я думаю это не столь важно
    private const DATA = [
        'Еда' => [
            'Мясная продукция' => [
                'Курица' => [
                    'Полуфабрикаты',
                    'Яйца'
                ],
                'Баранина',
            ],
            'Молочная продукция' => [
                'Молоко' => [
                    'Коровье',
                    'Козье'
                ],
            ],
        ],
        'Автомобили' => [
            'Легковые' => [
                'Запчасти',
                'Аксессуары',
            ],
            'Грузовые',
        ],
    ];



    //Конечно этот метод можжно было отдельно вынести в репозиторий какой нибудь ActivityRepository, но решил упустить
    // так как по тз требуется не  это
    private function save(string $name, null|int $pId = null) : Activity
    {
        $activity = Activity::create(['name' => $name, 'parent_id' => $pId]);

        return $activity;
    }



    private function fill(array $data, null|int $pId = null)
    {
        foreach($data as $key => $item)
        {
            if(is_array($item))
            {
                $parentId = $this->save($key, $pId)->id;

                $this->fill($item, $parentId);
            }
            else
            {
                $this->save($item, $pId);
            }
        }
    }



    public function run(): void
    {
        $tableNotEmpty = Activity::first()->id ?? 0;

        if($tableNotEmpty)
        {
            //я сею статичные данные, поэтому нет смысла что-то добавлять, если уже что то есть
            $message = 'Таблица не пустая.';
            Log::alert($message);
            $this->command->info($message);
            return;
        }

        //тут рекурсией, записываю чтроку и определяю папу
        $this->fill(self::DATA);
    }
}
