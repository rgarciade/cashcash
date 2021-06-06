<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\bbdd\CompanysBbdd;
use App\Models\Companys;
use Illuminate\Http\Request;


class CompanysController extends ApiResponseController {
    function __construct() {
        $this->CompanysBbdd = new CompanysBbdd();
    }
    public function allCompanys(){
        $comps = $this->CompanysBbdd->getAllPaginator(20);
        foreach ($comps as $comp) {
            $comp->contacts;
        }
        return $this->successResponse($comps,200);
    }
    public function getCompany($id){
        $company = $this->CompanysBbdd->getFromId($id);
        $company[0]->contacts;
        if(count($company) == 0){
            return $this->errorResponse('',500,"Company don't exist");
        }
        return $this->successResponse($company[0],200);
    }
}
