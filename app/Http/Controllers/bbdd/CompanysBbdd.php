<?php
namespace App\Http\Controllers\bbdd;

use App\Models\Companys;

class CompanysBbdd extends commonBbdd {
    function __construct() {
        $this->model = new Companys();
    }
    public function getAll(){
        $comps = $this->model::all();
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
    public function getAllPaginator($paginatorNumber){
        $comps = $this->model::paginate(20);
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $comps;
    }
}
