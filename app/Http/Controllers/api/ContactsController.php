<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\database\ContactsBbdd;
use App\Http\validators\api\ContactsValidators;
use Illuminate\Http\Request;


class ContactsController extends ApiResponseController {

    public function allContactsFromCompany($companyId){
        return $this->successResponse(ContactsBbdd::getFromCompanyId($companyId),200);
    }
    public function getContact($Id){
        return $this->successResponse(ContactsBbdd::getFromId($Id),200);
    }
    public function insertContac(Request $req){
        $validator = ContactsValidators::verifyCreateContact($req);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when create contac');
        try {
            $contact = ContactsBbdd::insert([
                "companys_id" => $req->companys_id,
                "email" => $req->email,
                "name" => $req->name,
                "location" => $req->location,
                "telephone" => $req->telephone,
                "facturacion" => $req->facturacion
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql insert Error, chech values');
        }
        if(!$contact) $this->errorResponse(null,500,'sql insert Error, chech values');
        return $this->successResponse(null,200,'Contac insertado correctamente');
    }
    public function deletetContac($contactId){
        try {
            ContactsBbdd::deleteFromId($contactId);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech id');
        }
        return $this->successResponse(null,200,'Contact borrado correctamente');
    }
}
