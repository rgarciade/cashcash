<?php
namespace App\Http\Controllers\bbdd;

use App\Models\Companys;

class CompanysBbdd extends commonBbdd {
    protected static $model = Companys::class;

    public static function getAll(){
        $comps = static::$model::all();
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
    public static function getAllPaginator($paginatorNumber){
        $comps = static::$model::paginate(20);
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
}
