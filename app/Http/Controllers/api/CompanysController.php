<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\database\CompanysBbdd;
use App\Http\validators\api\CompanysValidators;
use App\Models\Companys;
use Illuminate\Http\Request;


class CompanysController extends ApiResponseController {
    private $paginate = 20;
    public function allCompanys(){
        $comps = CompanysBbdd::getAllPaginator($this->paginate);
        return $this->successResponse($comps,200);
    }
    public function getCompanyById($id){
        $company = CompanysBbdd::getFromId($id);
        if(count($company) == 0){
            return $this->errorResponse('',500,"Company don't exist");
        }
        $company[0]->contacts;
        return $this->successResponse($company[0],200);
    }
    public function getCompanyByData($someField){
        $company = CompanysBbdd::getFromMultiField($someField,$this->paginate);
        return $this->successResponse($company,200);
    }
    public function newCompany(Request $req){

        $validator = CompanysValidators::verifyCreateCompany($req);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when create company');

        try {
            $companys = CompanysBbdd::insert([
                'cif' => $req->cif,
                'name' => $req->name,
                'contact' => $req->contact,
                'location' => $req->location,
                'telephone' => $req->telephone,
                'email' => $req->email,
                'street' => $req->street,
                'city' => $req->city,
                'province' => $req->province,
                'cta' => $req->cta,
                'state' => $req->state,
                'postalcode' => $req->postalcode,
                'banck' => $req->banck,
                'mobile' => $req->mobile,
                'notas' => $req->notas,
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql insert Error, chech values');
        }
        if(!$companys) $this->errorResponse(null,500,'sql insert Error, chech values');
        return $this->successResponse(null,200,'Company insertada correctamente');
    }
    public function updateCompany(Request $request, $articleID){
        try {
            $validator = CompanysValidators::verifyUpdateACompany($request);
            if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when update Company');
            $newArticle = CompanysBbdd::updateValue($request->all(),$articleID);
            if(!count($newArticle->getChanges()))  return $this->errorResponse('',500,"any data to update");
        }
        catch (\Throwable $th) {
            return $this->errorResponse('',500,"error where update Company");
        }


        return $this->successResponse(null,200,'update article');
    }
    public function deleteCompanyFromId($id){
        try {
            CompanysBbdd::deleteFromId($id);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech id');
        }
        return $this->successResponse(null,200,'Compañia borrada correctamente');
    }
}
