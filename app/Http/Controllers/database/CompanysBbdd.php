<?php
namespace App\Http\Controllers\database;

use App\Models\Companys;

class CompanysBbdd extends commonBbdd {
    protected static $model = Companys::class;

    public static function getAll() : \Illuminate\Database\Eloquent\Collection{
        $comps = static::$model::all();
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
    public static function getAllPaginator($paginatorNumber) : \Illuminate\Pagination\LengthAwarePaginator{
        $comps = static::$model::paginate(20);
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
}
