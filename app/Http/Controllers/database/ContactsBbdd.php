<?php
namespace App\Http\Controllers\database;

use App\Models\Contacts;

class ContactsBbdd extends commonBbdd {
    protected static $model = Contacts::class;
        /**
     * @param int companyId 
     * @return row 
     */
    public static function getFromCompanyId($companyId) : array {
        return static::$model::where('companys_id',$companyId)->get()->toarray();
    }
}
