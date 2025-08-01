<?php

namespace App\Http\Filters;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

Class OrganizationFilter extends AbstractFilter
{
    public const IDS = 'ids';
    public const INIT = 'init';
    public const BUILDINGS = 'buildings';
    public const ACTIVITIES = 'activities';
    public const NAME = 'name';
    public const ACTIVITY_GROUP = 'activity_group';



    public function __construct($queryParams)
    {
        $queryParams['init'] = 'init';
        parent::__construct($queryParams);
    }



    public function init(Builder $builder)
    {
        $builder->leftJoin('organization_phones as ophone', 'ophone.organization_id', 'organizations.id');
        $builder->leftJoin('organization_activities as oactivity', 'oactivity.organization_id', 'organizations.id');
        $builder->leftJoin('activities', 'activities.id', 'oactivity.activity_id');
        $builder->leftJoin('buildings', 'buildings.id', 'organizations.building_id');
        $builder->groupBy('organizations.id');
    }



    public function getCallbacks() : array
    {
        return [
            self::INIT              => [$this, 'init'],
            self::IDS               => [$this, 'fnIds'],
            self::BUILDINGS         => [$this, 'fnBuildings'],
            self::ACTIVITIES        => [$this, 'fnActivities'],
            self::NAME              => [$this, 'fnName'],
            self::ACTIVITY_GROUP    => [$this, 'fnActivityGroup'],
        ];
    }



    public function fnIds(Builder $builder, int|array $val)
    {
        $val = is_integer($val) ? [$val] : $val;

        $builder->whereIn('organizations.id', $val);
    }



    //фильтр по идентификатору здания
    public function fnBuildings(Builder $builder, int|array $val)
    {
        $val = is_integer($val) ? [$val] : $val;

        $builder->whereIn('organizations.building_id', $val);
    }



    //фильтр по идентификатору деятельности
    public function fnActivities(Builder $builder, int|array $val)
    {
        $val = is_integer($val) ? [$val] : $val;

        $builder->whereIn('oactivity.activity_id', $val);
    }



    //фильтр по названию организации, я так думаю просто лайком
    public function fnName(Builder $builder, string $val)
    {
        $builder->where('organizations.name', 'LIKE', '%'.$val.'%');
    }



    //Фильтр по деятельности через вложеность, машка умеет в рекурсивные запросы
    //запросом получаю все айдишники указанной деятельности
    //Лимитом ограничиваю машку, что бы она не запускала рекурсию глуже 3
    public function fnActivityGroup(Builder $builder, int $val)
    {
        $recQuery = DB::select("
            WITH RECURSIVE rec_activities AS (
                SELECT id, parent_id FROM activities WHERE parent_id = ?
                UNION ALL
                SELECT a.id, a.parent_id FROM activities a
                INNER JOIN rec_activities r ON r.id = a.parent_id
            )
            (SELECT * FROM rec_activities LIMIT 3) union select id, parent_id FROM activities where id = ?
        ", [$val, $val]);

        $ids = collect($recQuery)->pluck('id')->toArray();

        $this->fnActivities($builder, $ids);
    }
}
