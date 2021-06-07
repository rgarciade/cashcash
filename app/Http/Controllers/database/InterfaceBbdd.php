<?php
namespace App\Http\Controllers\database;

interface InterfaceBbdd{
    public static function insert(array $request);
    public static function getAll();
    public static function getFromId($id);
    public static function deleteFromId($id);
    public static function deleteFromColumAndValue(string $colum,$id);
    public static function updateValue( array $values,$articleID);
}
