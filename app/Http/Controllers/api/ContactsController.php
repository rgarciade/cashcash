<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\database\ContactsBbdd;
use App\Http\validators\api\ContactsValidators;
use Illuminate\Http\Request;


class ContactsController extends ApiResponseController
{

    public function allContactsFromCompany($companyId): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse(ContactsBbdd::getFromCompanyId($companyId));
    }
    public function getContact($Id): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse(ContactsBbdd::getFromId($Id));
    }
    public function insertContact(Request $req): \Illuminate\Http\JsonResponse
    {
        $validator = ContactsValidators::verifyCreateContact($req);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(), 500, 'error when create contac');
        try {
            ContactsBbdd::insert([
                "companys_id" => $req->companys_id,
                "email" => $req->email,
                "name" => $req->name,
                "location" => $req->location,
                "telephone" => $req->telephone,
                "facturacion" => $req->facturacion
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 500, 'sql insert Error, chech values');
        }
        return $this->successResponse(null, 200, 'Contac insertado correctamente');
    }
    public function deleteContact($contactId): \Illuminate\Http\JsonResponse
    {
        try {
            ContactsBbdd::deleteFromId($contactId);
        } catch (\Throwable $th) {
            return $this->errorResponse(null, 500, 'sql delete Error, chech id');
        }
        return $this->successResponse(null, 200, 'Contact borrado correctamente');
    }
}
