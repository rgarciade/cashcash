<?php
namespace App\Http\Controllers\bbdd;

interface InterfaceBbdd{
    public static function insert(array $request);
    public static function getAll();
    public static function getFromId($id);
    public static function deleteFromId($id);
    public static function deleteFromColumAndId(string $colum,$id);
    public static function updateValue( array $values,$articleID);
}
