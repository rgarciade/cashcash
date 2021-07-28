<?php
namespace App\Http\Controllers\database;

use App\Models\Companys;

class CompanysBbdd extends commonBbdd {
    protected static string $model = Companys::class;

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
    public static function getFromMultiField($someField, $paginate){
        $companies = new Companys();
        $fillables = $companies->getFillable();
        $query = static::$model::where($fillables[0], 'like', '%'.$someField.'%');
        for ($i=1; $i < count($fillables); $i++) { 
            $query->orWhere($fillables[$i], 'like', '%'.$someField.'%');
        }
        $comps = $query->paginate($paginate);
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;  
    }
}
